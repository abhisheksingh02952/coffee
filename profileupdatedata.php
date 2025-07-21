<?php

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$em_user_id = $_POST['em_user_id'];
$password = $_POST['password'];

// Basic SQL UPDATE
$sql = "UPDATE employees SET name = '$name', phone = '$phone', email = '$email', address = '$address', password = '$password' WHERE user_id = '$id'";

if (mysqli_query($conn, $sql)) {
    // Send back updated record
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    echo json_encode($data);
} else {
    echo json_encode(null);
}

mysqli_close($conn);
?>
