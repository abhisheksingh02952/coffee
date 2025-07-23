<?php

session_start();

// Create connection
$conn = mysqli_connect("localhost","root","","test") or die("Connect Error");

$sql = "SELECT * FROM products";

$result = mysqli_query($conn, $sql) or die("Query Error");

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;

    $_SESSION['id'] = $row['id'];
}

echo json_encode(['data' => $data]); // DataTables expects "data" key
?>
