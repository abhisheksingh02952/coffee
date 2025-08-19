<?php
session_start();
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';
date_default_timezone_set("Asia/Kolkata");

$shop_id = isset($_SESSION['shop_id']) ? (int)$_SESSION['shop_id'] : 0;
$user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

// Safety check for session
if ($shop_id === 0 || $user_id === 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Session expired. Please log in again."
    ]);
    exit;
}

// 1️⃣ Check last order payment status
$check_sql = "
    SELECT p.payment_status
    FROM payments p
    INNER JOIN orders o ON o.order_id = p.order_id
    WHERE o.shop_id = $shop_id
    ORDER BY p.id DESC
    LIMIT 1
";
$result = $conn->query($check_sql);

if ($result && $row = $result->fetch_assoc()) {
    if (strtolower($row['payment_status']) === "pending") {
        echo json_encode([
            "status" => "pending",
            "message" => "Your last order payment is still pending."
        ]);
        exit;
    }
}

// 2️⃣ Collect POST data for new order
$payment_type   = $_POST['payment_type'] ?? '';
$payment_status = $_POST['payment_status'] ?? '';
$scheme         = $_POST['scheme'] ?? '';
$product_ids    = $_POST['product_id'] ?? [];
$quantities     = $_POST['quantity'] ?? [];

// Generate order_id
$timestamp = time();
$date = date("Ymd");
$order_id = "ORD-" . $date . "-" . $timestamp . "-" . $shop_id;

// 3️⃣ Insert into orders table
$insert_order_sql = "
    INSERT INTO orders (order_id, shop_id, employee_id, scheme, payment_type, payment_status)
    VALUES ('$order_id', $shop_id, $user_id, '$scheme', '$payment_type', '$payment_status')
";
if (!$conn->query($insert_order_sql)) {
    echo json_encode([
        "status" => "error",
        "message" => "Order insert failed: " . $conn->error
    ]);
    exit;
}

// 4️⃣ Insert order items & calculate total
$total_amount = 0;
for ($i = 0; $i < count($product_ids); $i++) {
    $product_id = (int)$product_ids[$i];
    $quantity = (int)$quantities[$i];

    $price_result = $conn->query("SELECT price FROM products WHERE id = $product_id LIMIT 1");
    if ($price_result && $row = $price_result->fetch_assoc()) {
        $price = (float)$row['price'];
        $subtotal = $quantity * $price;
        $total_amount += $subtotal;

        $conn->query("
            INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES ('$order_id', $product_id, $quantity, $price)
        ");
    }
}

// 5️⃣ Update total amount in orders
$conn->query("UPDATE orders SET total_amount = $total_amount WHERE order_id = '$order_id'");

// 6️⃣ Insert into payments table
$conn->query("
    INSERT INTO payments (order_id, shop_id, amount, payment_status)
    VALUES ('$order_id', '$shop_id', $total_amount, '$payment_status')
");

// ✅ Success response
echo json_encode([
    "status" => "success",
    "message" => "Order placed successfully.",
    "order_id" => $order_id,
    "total_amount" => $total_amount
]);
exit;
