<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

// Use proper key name — assuming it's order_id (not order_id)
$order_id = isset($_SESSION['order_id']) ? mysqli_real_escape_string($conn, $_SESSION['order_id']) : '';

if (!$order_id) {
    echo json_encode(["error" => "Order ID not set in session"]);
    exit;
}

$sql = "SELECT * FROM payments WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = [];

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);
?>
