<?php
session_start();

// Create database connection
$conn = mysqli_connect("localhost", "root", "", "test")  or die ("Connection Failed");

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

// Sanitize and retrieve user ID from session
$user_id = (int) $_SESSION['user_id'];

// Query to fetch tasks for the user
$sql = "SELECT * FROM task WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql)or die ("Connection Failed");

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;

}

// Return the task data
echo json_encode(['data' => $data]);
?>
