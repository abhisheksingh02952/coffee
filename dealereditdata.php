<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");


if (!isset($_SESSION['dealer_id'])) {    
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}


// Sanitize the session value (assumes it's an integer)
 $dealer_id = (int) $_SESSION['dealer_id'];

$sql = "SELECT * FROM dealers WHERE dealer_id = $dealer_id";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = [];

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);

?>
