<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "test");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['shop_id'])) {
     $shop_id = $_POST['shop_id'];

    // Soft delete (set is_deleted = 1)
    $sql = "UPDATE shop SET is_deleted = 0 WHERE shop_id = '$shop_id'";
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
