<?php
include 'auth.php';
authorize('admin');

$conn = mysqli_connect("localhost", "root", "", "test");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    // Soft delete (preferred)
    $sql = "UPDATE products SET is_deleted = 0 WHERE id = $id";

    // For permanent delete, use:
    // $sql = "DELETE FROM products WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Deleted";
    } else {
        http_response_code(500);
        echo "Error deleting product: " . mysqli_error($conn);
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}
