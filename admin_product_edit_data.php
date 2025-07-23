<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");


if (!isset($_SESSION['id'])) {    
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

// Sanitize the session value (assumes it's an integer)
 $id = (int) $_SESSION['id'];

$sqli = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sqli) or die("Query Error");

$data = [];

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);

?>

