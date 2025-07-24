<?php
include 'auth.php';
authorize('admin');

$conn = mysqli_connect("localhost", "root", "", "test");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_id'])) {
    $id = (int) $_POST['user_id'];

    // Soft delete (set is_deleted = 1)
    $sql = "UPDATE employees SET is_deleted = 0 WHERE user_id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Deleted";
    } else {
        http_response_code(500);
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}