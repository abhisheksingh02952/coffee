<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}


date_default_timezone_set("Asia/Kolkata");  
    $date = date("Y-m-d");
    $user_id = (int) $_SESSION['user_id']; 
    $shop_id = $_POST['id'];
    $scheme = $_POST['scheme'];
    $product1 = $_POST['product1'];
    $product2 = $_POST['product2'];
    $product3 = $_POST['product3'];
    $product4 = $_POST['product4'];
    $product5 = $_POST['product5'];
    $quantity = $_POST['quantity'];
    $cost = $_POST['cost'];
    $payment_type = $_POST['payment_type'];
    $payment_status = $_POST['payment_status'];

    $sql = "INSERT INTO order_db (user_id, product1, product2, product3, product4, product5, quantity, cost, payment_type, payment_status, shop_id, date, scheme) 
        VALUES ('$user_id', '$product1', '$product2', '$product3', '$product4', '$product5', '$quantity', '$cost', '$payment_type', '$payment_status','$shop_id', '$date', '$scheme')";


    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => mysqli_error($conn)]);
    }

?>
