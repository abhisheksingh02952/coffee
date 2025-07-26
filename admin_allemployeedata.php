<?php
session_start();

include 'db.php';


$sql = "SELECT * FROM employees WHERE is_deleted = 1";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode(['data' => $data]);

mysqli_close($conn);
?>
