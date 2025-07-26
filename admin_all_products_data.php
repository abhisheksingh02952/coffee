<?php

session_start();

// Create connection
include 'db.php';


$sql = "SELECT * FROM products WHERE is_deleted = 1;";

$result = mysqli_query($conn, $sql) or die("Query Error");

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;

    $_SESSION['id'] = $row['id'];
}

echo json_encode(['data' => $data]); // DataTables expects "data" key
?>
