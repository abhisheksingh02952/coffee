<?php

session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");


// Sanitize the session value (assumes it's an integer)
$user_id = (int) $_SESSION['user_id'];

$sql = "SELECT * FROM employees WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = [];

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);

?>
