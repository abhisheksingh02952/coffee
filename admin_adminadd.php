<?php
// Connect to database
include 'db.php';


// Get POST values safely
$name         = $_POST['name'] ?? '';
$fathername   = $_POST['fathername'] ?? '';
$mothername   = $_POST['mothername'] ?? '';
$phone        = $_POST['phone'] ?? '';
$email        = $_POST['email'] ?? '';
$address      = $_POST['Address'] ?? '';
$username     = $username['username'];
$pin          = $_POST['Pin'] ?? '';
$dob          = $_POST['dob'] ?? '';
$gender       = $_POST['gender'] ?? '';
$position     = $_POST['position'] ?? '';
$password     = $_POST['password'] ?? '';
$reportingid  = $_POST['reporting_id'] ?? '';
$role         = $_POST['role'] ?? '';


// Insert SQL query
$sql = "INSERT INTO employees 
        (name, fathername, mothername, phone, email, address, pin, dob, gender,username, password, position, reporting_id, username, role)
        VALUES 
        ('$name', '$fathername', '$mothername', '$phone', '$email', '$address', '$pin', '$dob', '$gender','$username', '$Password', '$position', '$reportingid', '$username', '$role')";

// Execute query
if (mysqli_query($conn, $sql)) {
    echo "✅ Employee added successfully.";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
