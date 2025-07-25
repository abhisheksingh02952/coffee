<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "test");

// Set timezone
mysqli_query($conn, "SET time_zone = '+05:30'");
date_default_timezone_set('Asia/Kolkata');

// Get input
$user_id = (int)($_SESSION['user_id'] ?? 0);
$shop_id = (int)($_POST['shop_id'] ?? 0);
$product_ids = $_POST['product_ids'] ?? [];
$quantities = $_POST['quantities'] ?? [];
$latitude = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;
$timestamp = date('Y-m-d H:i:s');

// Validate input
if (!$shop_id || !$user_id || empty($product_ids) || count($product_ids) !== count($quantities)) {
    http_response_code(400);
    echo "Invalid request.";
    exit;
}

// ✅ First, update shop table with geolocation + user
$updateShopSQL = "UPDATE shop 
                  SET stock_latitude = '$latitude', 
                      stock_longitude = '$longitude', 
                      stock_user_id = $user_id 
                  WHERE shop_id = $shop_id";

if (!mysqli_query($conn, $updateShopSQL)) {
    http_response_code(500);
    echo "Failed to update shop: " . mysqli_error($conn);
    exit;
}

// ✅ Now, loop to insert/update stock
for ($i = 0; $i < count($product_ids); $i++) {
    $product_id = (int)$product_ids[$i];
    $quantity = (int)$quantities[$i];

    $stockSQL = "INSERT INTO stock (shop_id, product_id, quantity, last_updated)
                 VALUES ($shop_id, $product_id, $quantity, '$timestamp')
                 ON DUPLICATE KEY UPDATE 
                     quantity = VALUES(quantity),
                     last_updated = VALUES(last_updated)";

    if (!mysqli_query($conn, $stockSQL)) {
        http_response_code(500);
        echo "Failed to update stock for product $product_id: " . mysqli_error($conn);
        exit;
    }
}

echo "success";
?>
