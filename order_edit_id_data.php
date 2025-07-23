<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

$shop_id = (int) $_SESSION['shop_id'];

$sql = "SELECT * FROM shop WHERE shop_id = $shop_id";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = [];

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);

?>
