<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}
date_default_timezone_set("Asia/Kolkata");  

$product_ids = $_POST['product_id'];
$quantities = $_POST['quantity'];
$date = date("Ymd");               
$timestamp = time();             
$order_id = "ORD" . $date . $timestamp;

for ($i = 0; $i < count($product_ids); $i++) {
    $product_id = (int)$product_ids[$i];
    $quantity = (int)$quantities[$i];

    // Get product price
    $result = $conn->query("SELECT price FROM products WHERE id = $product_id LIMIT 1");

    if ($result && $row = $result->fetch_assoc()) {
        $price = (float)$row['price'];

        // Insert order item directly
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) 
                      VALUES ($order_id, $product_id, $quantity, $price)");

                           }
}


    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => mysqli_error($conn)]);
    }

?>
