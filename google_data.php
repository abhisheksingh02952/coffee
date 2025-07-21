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

$shop_result = $mysqli->query("
   SELECT * FROM shop");
   while ($row = $shop_result->fetch_assoc()) {
    array_push($users, [
            'id' => $row['shop_id'],
            'pid' => $row['reporting_id'] ?: null,
            'name' => $row['name'],
            'position' => 'shop',
            'order_id' =>  null,
            'quantity' => null,
            'payment_type' => null,
            'payment_status' => null,
            'date' => null,
            'scheme' => null,
            'shop_name' => null,
    ]);
}

$order_result = $mysqli->query("
   SELECT 
        order_db.order_id, 
        order_db.quantity, 
        order_db.payment_type, 
        order_db.payment_status, 
        order_db.scheme, 
        order_db.date,
        shop.shop_id,
        shop.name AS shop_name,
        order_db.reporting_id, 
        shop.reporting_id AS shop_reporting_id
    FROM order_db
    JOIN shop ON shop.shop_id = order_db.shop_id");
   while ($row = $order_result->fetch_assoc()) {
    array_push($users, [
            'id' => $row['order_id'] + "10000",
            'pid' => $row['shop_id'] ?: null,
            'name' => $row['shop_name'],
            'position' => 'order',
            'order_id' =>  $row['order_id'],
            'quantity' => $row['quantity'],
            'payment_type' => $row['payment_type'],
            'payment_status' => $row['payment_status'],
            'date' => $row['date'],
            'scheme' => $row['scheme'],
            'shop_name' => $row['shop_name'],
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

header('Content-Type: application/json');
echo json_encode($descendants);

?>