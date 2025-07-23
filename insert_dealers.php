<?php
session_start(); 

$conn = new mysqli("localhost", "root", "", "test")  or die("Connection Failed");

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$reporting_id = (int) $_SESSION['user_id']; 

$name = $_POST['name'];
$fathername = $_POST['fathername'];
$gst = $_POST['gst'];
$address = $_POST['Address'];
$pin = $_POST['Pin'];
$area = $_POST['area'];
$phone = $_POST['phone'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$scheme = $_POST['scheme'];

if (!is_numeric($latitude) || !is_numeric($longitude)) {
    die("Invalid latitude or longitude.");
}

$sql = "INSERT INTO shop (reporting_id, name, fathername, gst, phone, address, pin, area, latitude, longitude, scheme) VALUES ('$reporting_id', '$name', '$fathername', '$gst', '$phone', '$address', '$pin', '$area','$latitude', '$longitude', '$scheme')";

if ($conn->query($sql) === TRUE) {
    echo "Added successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
