<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connect Error");

$sql = "SELECT * FROM employees";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode(['data' => $data]);

mysqli_close($conn);
?>
