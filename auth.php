<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Authorization check
function authorize($role_required) {
    if ($_SESSION['user_role'] !== $role_required) {
        echo "⛔ Access Denied: You do not have permission.";
        exit;
    }
}
?>
