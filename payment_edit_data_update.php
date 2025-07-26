<?php

session_start();

include 'db.php';


date_default_timezone_set("Asia/Kolkata");

$user_id = (int) $_SESSION['user_id'];

$order_id = $_POST['order_id'];
$payment_type = $_POST['payment_type'];
$payment_status = $_POST['payment_status'];
$remarks = $_POST['remarks'];

$collection_date = date("Y-m-d H:i:s");

// Update payments table
$sql1 = "UPDATE payments 
         SET payment_type = '$payment_type', 
             payment_status = '$payment_status', 
             remarks = '$remarks', 
             employee_id = '$user_id', 
             collection_date = NOW() 
         WHERE order_id = '$order_id'";

// Update orders table
$sql2 = "UPDATE orders 
         SET payment_type = '$payment_type', 
             payment_status = '$payment_status', 
             payment_date = NOW() 
         WHERE order_id = '$order_id'";

if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
