<?php
include 'db.php';


$id = $_POST['id'];
$name = $_POST['name'];
$fathername = $_POST['fathername'];
$mothername = $_POST['mothername'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['Address'];
$pin = $_POST['Pin'];
$username = $_POST['username'];
$password = $_POST['password'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$position = $_POST['position'];
$reporting_id = $_POST['reporting_id'];
$role = $_POST['role'];


// Update employee table
$sql = "UPDATE employees SET name = '$name', fathername = '$fathername', mothername = '$mothername', phone = '$phone', email = '$email', address = '$address', pin = '$pin', username = '$username', password = '$password', dob = '$dob', gender = '$gender', position = '$position', reporting_id = '$reporting_id', role = '$role', WHERE user_id = '$id'";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
