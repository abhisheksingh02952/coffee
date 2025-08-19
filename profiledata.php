<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

// Check authentication
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

// Force integer type for safety
$user_id = intval($_SESSION['user_id']);

// Run query
$sql = "SELECT * FROM employees WHERE user_id = '$user_id' AND is_deleted = 1 LIMIT 1";
$result = mysqli_query($conn, $sql) or die(json_encode(["error" => "Query Error"]));

// Prepare response
if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    $data = ["error" => "No employee found"];
}

echo json_encode($data);
?>
