<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

if (!isset($_SESSION['shop_id'])) {    
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

$shop_id = (int) $_SESSION['shop_id'];

$name = $_POST['name'];
$fathername = $_POST['fathername'];
$gst = $_POST['gst'];
$phone = $_POST['phone'];
$reporting_id = $_POST['reporting_id'];
$address = $_POST['Address'];
$pin = $_POST['Pin'];
$area = $_POST['area'];
$scheme = $_POST['scheme'];

// Update employee table
$sql = "UPDATE shop SET name = '$name', fathername = '$fathername', gst = '$gst', phone = '$phone', address = '$address', pin = '$pin', area = '$area', scheme = '$scheme',  reporting_id = '$reporting_id' WHERE shop_id = '$shop_id'";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
