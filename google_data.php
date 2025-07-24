<?php
$mysqli = new mysqli("localhost", "root", "", "test");
$mysqli->set_charset("utf8");

// Get the parent node to start from (e.g., via session or GET/POST)
$start_id = $_GET['reporting_id'];
if (!$start_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing reporting_id']);
    exit;
}

// 1. Fetch all users and related data
$result = $mysqli->query("
    SELECT 
        employees.user_id, 
        employees.reporting_id, 
        employees.name AS user_name, 
        employees.position
    FROM employees WHERE is_deleted = 1; 
");

$users = [];
while ($row = $result->fetch_assoc()) {
    array_push($users, [
        'id' => $row['user_id'],
        'pid' => $row['reporting_id'] ?: null,
        'name' => $row['user_name'],
        'position' => $row['position'] ?: null,
        'order_id' =>  null,
        'quantity' => null,
        'payment_type' => null,
        'payment_status' =>  null,
        'payment_date' => null,
        'scheme' =>  null,
        'shop_name' => null,
    ]);
}

function getUserAndDescendants(array $employees, $startId): array
{
    $result = [];

    foreach ($employees as $employee) {
        if ($employee['id'] === $startId) {
            $result[] = $employee;
            break;
        }
    }

    $result = array_merge($result, getDescendants($employees, $startId));

    return $result;
}

function getDescendants(array $employees, $parentId): array
{
    $descendants = [];

    foreach ($employees as $employee) {
        if ($employee['pid'] === $parentId) {
            $descendants[] = $employee;

            $descendants = array_merge($descendants, getDescendants($employees, $employee['id']));
        }
    }

    return $descendants;
}

$descendants = getUserAndDescendants($users, $start_id);

$shops = [];
foreach ($descendants as $emp) {
    $employ = $emp['id'];
    $shop_result = $mysqli->query("
    SELECT shop.shop_id, shop.reporting_id ,shop.name FROM shop where reporting_id = $employ AND is_deleted = 1");
    while ($row = $shop_result->fetch_assoc()) {
        $shop_id = $row['shop_id'];
        $order_result = $mysqli->query("
    SELECT 
            orders.order_id, 
            orders.payment_type, 
            orders.payment_status, 
            orders.scheme, 
            orders.payment_date,
            orders.shop_id,
            orders.total_amount
        FROM orders WHERE shop_id =$shop_id AND is_deleted = 1 ORDER BY id DESC LIMIT 1");
        $order_row = mysqli_fetch_assoc($order_result);
        array_push($shops, [
            'id' => $row['shop_id'],
            'pid' => $row['reporting_id'] ?: null,
            'name' => $row['name'],
            'position' => 'shop',
            'order_id' =>  $order_row['order_id'] ?? null,
            'quantity' => null,
            'payment_type' => $order_row['payment_type'] ?? null,
            'payment_status' => $order_row['payment_status'] ?? null,
            'payment_date' => $order_row['payment_date'] ?? null,
            'scheme' => $order_row['scheme'] ?? null,
            'shop_name' => null,
        ]);
        $stock_result = $mysqli->query("
        SELECT stock.shop_id, stock.product_id, stock.quantity, products.name FROM stock 
        JOIN products on products.id = stock.product_id WHERE shop_id = $shop_id");
        $total_quantity = 0;
        while ($stock_row = $stock_result->fetch_assoc()) {
            $total_quantity += (int) $stock_row['quantity'];

            array_push($shops, [
                'id' => $stock_row['product_id'] + 1000,
                'pid' => $stock_row['shop_id'] ?: null,
                'name' => $stock_row['name'],
                'position' => 'Product quantity ' . $stock_row['quantity'],
                'order_id' => null,
                'quantity' => $stock_row['quantity'],
                'payment_type' => null,
                'payment_status' => null,
                'payment_date' => null,
                'scheme' => null,
                'shop_name' => null,
            ]);
        }
        $last_shop_index = count($shops) - $stock_result->num_rows - 1;
        if (isset($shops[$last_shop_index])) {
            $shops[$last_shop_index]['quantity'] = $total_quantity;
            $shops[$last_shop_index]['position'] .= " | Total Qty: $total_quantity";
        }
    }
}

$descendants = array_merge($descendants, $shops);

function buildTree(array $elements, $parentId = null)
{
    $branch = [];

    foreach ($elements as $element) {
        if ((string)$element['pid'] === (string)$parentId) {
            $children = buildTree($elements, $element['id']);

            $node = [
                "text" => [
                    "name" => $element['name'],
                    "title" => $element['position']
                ],
                "HTMLid" => "node_" . $element['id'],
                "HTMLclass" => "node-style",
                "data" => [
                    "id" => $element['id'],
                    "order_id" => $element['order_id'],
                    "quantity" => $element['quantity'],
                    "payment_type" => $element['payment_type'],
                    "payment_status" => $element['payment_status'],
                    "payment_date" => $element['payment_date'],
                    "scheme" => $element['scheme'],
                    "shop_name" => $element['shop_name']
                ]
            ];

            if (!empty($children)) {
                $node["children"] = $children;
                $node["stackChildren"] = true;
                $node["collapsed"] = true;
            }

            $branch[] = $node;
        }
    }

    return $branch;
}

function buildTreeFromStart(array $elements, $startId)
{
    // Map all elements by their ID for quick lookup
    $map = [];
    foreach ($elements as $el) {
        $map[$el['id']] = $el;
    }

    // If the starting node doesn't exist, return empty
    if (!isset($map[$startId])) {
        return null;
    }

    // Climb to the root (pid == 0 or null)
    $currentId = $startId;
    while (
        isset($map[$currentId]) &&
        isset($map[$currentId]['pid']) &&
        $map[$currentId]['pid'] !== null &&
        $map[$currentId]['pid'] != 0 &&
        isset($map[$map[$currentId]['pid']])
    ) {
        $currentId = $map[$currentId]['pid'];
    }

    $rootPid = $map[$currentId]['pid'] ?? null;

    // Now build the tree from that root
    $tree = buildTree($elements, $rootPid);

    // Return only the root node (if exists)
    return $tree[0] ?? null;
}



$tree = buildTreeFromStart($descendants, $start_id);

header('Content-Type: application/json');
echo json_encode($tree, JSON_PRETTY_PRINT); // assuming one root node
