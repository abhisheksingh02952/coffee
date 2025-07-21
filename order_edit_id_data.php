<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");


if (!isset($_SESSION['shop_id'])) {    
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

// Sanitize the session value (assumes it's an integer)
 $shop_id = (int) $_SESSION['shop_id'];

$sql = "SELECT * FROM shop WHERE shop_id = $shop_id";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = [];

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);

?>
