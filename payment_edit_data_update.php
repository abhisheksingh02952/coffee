<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

date_default_timezone_set("Asia/Kolkata");

$user_id = (int) $_SESSION['user_id'];

$order_ids = $_POST['order_ids'];
$payment_type = $_POST['payment_type'];
$payment_status = $_POST['payment_status'];
$remarks = $_POST['remarks'];

$collection_date = date("Y-m-d H:i:s");

// Update employee table
$sql = "UPDATE payments SET payment_type = '$payment_type', payment_status = '$payment_status', remarks = '$remarks', employee_id = '$user_id', collection_date = NOW() WHERE order_ids = '$order_ids'";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
