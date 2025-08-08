<?php

session_start();
include 'db.php';

if (!isset($_SESSION['employee_id'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

$user_id = mysqli_real_escape_string($conn, $_SESSION['employee_id']);

$sql = "SELECT * FROM employees WHERE employee_code = '$user_id' AND status = 'Active'";
$result = mysqli_query($conn, $sql) or die("Query Error");

$data = [];

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
}

echo json_encode($data);
?>
