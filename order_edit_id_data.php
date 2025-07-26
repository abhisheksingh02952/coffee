<?php
session_start();
// Create connection
include 'db.php';


$shop_id = (int) $_SESSION['shop_id'];

$sql = "SELECT * FROM shop WHERE shop_id = $shop_id AND is_deleted = 1";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = [];

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);

?>
