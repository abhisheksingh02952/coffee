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
    FROM employees 
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
        'date' => null,
        'scheme' =>  null,
        'shop_name' => null,
    ]);
}

function getUserAndDescendants(array $employees, $startId): array {
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

function getDescendants(array $employees, $parentId): array {
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
    SELECT shop.shop_id, shop.reporting_id ,shop.name FROM shop where reporting_id = $employ");
    while ($row = $shop_result->fetch_assoc()) {
        $shop_id = $row['shop_id'];
        $order_result = $mysqli->query("
    SELECT 
            orders.order_id, 
            orders.payment_type, 
            orders.payment_status, 
            orders.scheme, 
            orders.date,
            orders.shop_id,
            orders.total_amount
        FROM orders WHERE shop_id =$shop_id ORDER BY id DESC LIMIT 1");
        $order_row = mysqli_fetch_assoc($order_result);
        array_push($shops, [
                'id' => $row['shop_id'],
                'pid' => $row['reporting_id'] ?: null,
                'name' => $row['name'],
                'position' => 'shop',
                'order_id' =>  $order_row['order_id'],
                'quantity' => null,
                'payment_type' => $order_row['payment_type'],
                'payment_status' => $order_row['payment_status'],
                'date' => $order_row['date'],
                'scheme' => $order_row['scheme'],
                'shop_name' => null,
        ]);
        $stock_result = $mysqli->query("
        SELECT stock.shop_id, stock.product_id, stock.quantity, products.name FROM stock 
        JOIN products on products.id = stock.product_id WHERE shop_id = $shop_id");
        while ($stock_row = $stock_result->fetch_assoc()) {
            array_push($shops, [
                'id' => $stock_row['product_id']+1000,
                'pid' => $stock_row['shop_id'] ?: null,
                'name' => $stock_row['name'],
                'position' => 'Product quantity ' . $stock_row['quantity'],
                'order_id' =>  null,
                'quantity' => $stock_row['quantity'],
                'payment_type' => null,
                'payment_status' => null,
                'date' => null,
                'scheme' => null,
                'shop_name' => null,
        ]);
        }
    }
}

$descendants = array_merge($descendants, $shops);

header('Content-Type: application/json');
echo json_encode($descendants);

?>