<?php
session_start();
$conn = new mysqli("localhost", "root", "", "test");

$user_id = $_SESSION['user_id'];

// Validate that user_id is an integer
if (!$user_id || !is_numeric($user_id)) {
    echo json_encode([]);
    exit;
}

// Cast to int for safety
$user_id = (int) $user_id;

$sql = "SELECT date, checkin_time, checkout_time, total_hours, status FROM attendance WHERE user_id = $user_id";
$result = $conn->query($sql);

$attendance = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendance[] = $row;
    }
}

echo json_encode($attendance);
?>
