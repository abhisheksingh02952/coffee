<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

// Use proper key name — assuming it's order_id (not order_ids)
$order_ids = isset($_SESSION['order_ids']) ? mysqli_real_escape_string($conn, $_SESSION['order_ids']) : '';

if (!$order_ids) {
    echo json_encode(["error" => "Order ID not set in session"]);
    exit;
}

$sql = "SELECT * FROM payments WHERE order_ids = '$order_ids'";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = [];

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);
?>
