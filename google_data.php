<?php
$mysqli = new mysqli("localhost", "root", "", "test1");
$mysqli->set_charset("utf8");



ini_set("log_errors", 1);
ini_set("error_log", __DIR__ . "/php-error.log");

error_log("Logging start");

$start_id = $_GET['reporting_id'] ?? null;
if (!$start_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing reporting_id']);
    exit;
}

// Fetch employees
$result = $mysqli->query("
    SELECT 
        employees.user_id, 
        employees.reporting_id, 
        employees.name AS user_name, 
        employees.position
    FROM employees 
    WHERE is_deleted = 1
");

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = [
        'id' => (int)$row['user_id'],
        '_key' => 'emp_' . $row['user_id'],
        '_pid' => $row['reporting_id'] ? 'emp_' . $row['reporting_id'] : null,
        'name' => $row['user_name'],
        'position' => $row['position'] ?: null,
        'order_id' => null,
        'quantity' => null,
        'payment_type' => null,
        'payment_status' => null,
        'payment_date' => null,
        'scheme' => null,
        'shop_name' => null,
    ];
}

function getUserAndDescendants(array $employees, $startKey): array
{
    $result = [];
    foreach ($employees as $employee) {
        if ($employee['_key'] === $startKey) {
            $result[] = $employee;
            break;
        }
    }
    $result = array_merge($result, getDescendants($employees, $startKey));
    return $result;
}

function getDescendants(array $employees, $parentKey): array
{
    $descendants = [];
    foreach ($employees as $employee) {
        if ($employee['_pid'] === $parentKey) {
            $descendants[] = $employee;
            $descendants = array_merge($descendants, getDescendants($employees, $employee['_key']));
        }
    }
    return $descendants;
}

$descendants = getUserAndDescendants($users, 'emp_' . $start_id);

// Fetch shops and products
$shops = [];
foreach ($descendants as $emp) {
    $employ_id_num = $emp['id'];
    $shop_result = $mysqli->query("
        SELECT shop.shop_id, shop.reporting_id, shop.name 
        FROM shop 
        WHERE reporting_id = $employ_id_num 
        AND is_deleted = 1
    ");
    while ($row = $shop_result->fetch_assoc()) {
        $shop_key = 'shop_' . $row['shop_id'];

        // Latest order
        $order_result = $mysqli->query("
            SELECT 
                orders.order_id, 
                orders.payment_type, 
                orders.payment_status, 
                orders.scheme, 
                orders.payment_date
            FROM orders 
            WHERE shop_id = {$row['shop_id']} 
            AND is_deleted = 1 
            ORDER BY id DESC LIMIT 1
        ");
        $order_row = mysqli_fetch_assoc($order_result);

        $shops[] = [
            'id' => (int)$row['shop_id'],
            '_key' => $shop_key,
            '_pid' => $emp['_key'],
            'name' => $row['name'],
            'position' => 'shop',
            'order_id' => $order_row['order_id'] ?? null,
            'quantity' => null,
            'payment_type' => $order_row['payment_type'] ?? null,
            'payment_status' => $order_row['payment_status'] ?? null,
            'payment_date' => $order_row['payment_date'] ?? null,
            'scheme' => $order_row['scheme'] ?? null,
            'shop_name' => null,
        ];

        // Stock
        $stock_result = $mysqli->query("
            SELECT stock.shop_id, stock.product_id, stock.quantity, products.name 
            FROM stock 
            JOIN products ON products.id = stock.product_id 
            WHERE shop_id = {$row['shop_id']}
        ");
        $total_quantity = 0;
        while ($stock_row = $stock_result->fetch_assoc()) {
            $total_quantity += (int)$stock_row['quantity'];

            $shops[] = [
                'id' => (int)$stock_row['product_id'],
                '_key' => 'product_' . $stock_row['product_id'],
                '_pid' => $shop_key,
                'name' => $stock_row['name'],
                'position' => 'Product quantity ' . $stock_row['quantity'],
                'order_id' => null,
                'quantity' => $stock_row['quantity'],
                'payment_type' => null,
                'payment_status' => null,
                'payment_date' => null,
                'scheme' => null,
                'shop_name' => null,
            ];
        }

        // Update shop node with total qty
        $last_shop_index = count($shops) - $stock_result->num_rows - 1;
        if (isset($shops[$last_shop_index])) {
            $shops[$last_shop_index]['quantity'] = $total_quantity;
            $shops[$last_shop_index]['position'] .= " | Total Qty: $total_quantity";
        }
    }
}

$descendants = array_merge($descendants, $shops);

function buildTree(array $elements, $parentKey = null)
{
    $branch = [];
    foreach ($elements as $element) {
        if ($element['_pid'] === $parentKey) {
            $children = buildTree($elements, $element['_key']);
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

function buildTreeFromStart(array $elements, $startKey)
{
    $map = [];
    foreach ($elements as $el) {
        $map[$el['_key']] = $el;
    }

    if (!isset($map[$startKey])) {
        return null;
    }

    // Build the tree starting from THIS node
    $rootNode = $map[$startKey];
    $rootChildren = buildTree($elements, $rootNode['_key']);
    $rootTree = [
        "text" => [
            "name" => $rootNode['name'],
            "title" => $rootNode['position']
        ],
        "HTMLid" => "node_" . $rootNode['id'],
        "HTMLclass" => "node-style",
        "data" => [
            "id" => $rootNode['id'],
            "order_id" => $rootNode['order_id'],
            "quantity" => $rootNode['quantity'],
            "payment_type" => $rootNode['payment_type'],
            "payment_status" => $rootNode['payment_status'],
            "payment_date" => $rootNode['payment_date'],
            "scheme" => $rootNode['scheme'],
            "shop_name" => $rootNode['shop_name']
        ],
        "children" => $rootChildren
    ];
    return $rootTree;
}

$tree = buildTreeFromStart($descendants, 'emp_' . $start_id);

header('Content-Type: application/json');
echo json_encode($tree, JSON_PRETTY_PRINT);