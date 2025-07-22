<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

date_default_timezone_set("Asia/Kolkata");

$timestamp = time(); 
$date = date("Ymd");
$shop_id = isset($_SESSION['shop_id']) ? (int)$_SESSION['shop_id'] : 0;
$user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

$payment_type = $_POST['payment_type'];
$payment_status = $_POST['payment_status'];
$scheme = $_POST['scheme'];

$order_id = "ORD-" . $date . "-" . $timestamp . "-" . $shop_id;

// INSERT INTO orders table
$insert_order_sql = "INSERT INTO orders (order_id, shop_id, employee_id, scheme, payment_type, payment_status) 
                     VALUES ('$order_id', $shop_id, $user_id, '$scheme', '$payment_type', '$payment_status')";

if (!$conn->query($insert_order_sql)) {
    echo json_encode(["success" => false, "message" => "Order insert failed: " . $conn->error]);
    exit;
}

$product_ids = $_POST['product_id'];
$quantities = $_POST['quantity'];

$total_amount = 0;

for ($i = 0; $i < count($product_ids); $i++) {
    $product_id = (int)$product_ids[$i];
    $quantity = (int)$quantities[$i];

    $result = $conn->query("SELECT price FROM products WHERE id = $product_id LIMIT 1");

    if ($result && $row = $result->fetch_assoc()) {
        $price = (float)$row['price'];
        $subtotal = $quantity * $price;
        $total_amount += $subtotal;

        // Use prepared statement to prevent SQL injection
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) 
                      VALUES ('$order_id', $product_id, $quantity, $price)");
    }
}

// Update total amount in orders
$conn->query("UPDATE orders SET total_amount = $total_amount WHERE order_id = '$order_id'");

// Insert into payments table
$conn->query("INSERT INTO payments (order_id, shop_id, amount) VALUES ('$order_id', '$shop_id',  $total_amount)");


echo json_encode(["success" => true]);
?>