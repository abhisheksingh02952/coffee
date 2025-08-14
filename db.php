<?php
$host = "localhost";      // Your database host
$user = "root";           // Your database username
$password = "";           // Your database password
$database = "test1";       // Your database name

$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
   
?>
