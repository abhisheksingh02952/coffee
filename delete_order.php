<?php
include 'auth.php';
authorize('employee');

include 'db.php';

if (!$conn) {
    http_response_code(500);
    echo "Connection failed";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

    // Soft delete both records
    $sql1 = "UPDATE orders SET is_deleted = 0 WHERE order_id = '$order_id'";
    $sql2 = "UPDATE payments SET is_deleted = 0 WHERE order_id = '$order_id'";

    $success1 = mysqli_query($conn, $sql1);
    $success2 = mysqli_query($conn, $sql2);

    if ($success1 && $success2) {
        echo "Deleted";
    } else {
        http_response_code(500);
        echo "Failed to delete: " . mysqli_error($conn);
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}
