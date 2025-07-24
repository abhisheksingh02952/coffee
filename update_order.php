<?php
$conn = mysqli_connect("localhost", "root", "", "test");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$order_id = isset($_POST['order_id']) ? mysqli_real_escape_string($conn, $_POST['order_id']) : '';
if ($order_id === '') {
    die("Invalid or missing order_id");
}

$items = isset($_POST['items']) ? $_POST['items'] : [];

$total_amount = 0;

foreach ($items as $item) {
    $product_id = isset($item['product_id']) ? (int)$item['product_id'] : 0;
    $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
    $total_price = isset($item['price']) ? (float)$item['price'] : 0.0;

    // Avoid division by zero
    $unit_price = ($quantity > 0) ? $total_price / $quantity : 0;

    $total_amount += $total_price;

    $sql = "UPDATE order_items 
            SET quantity = $quantity, price = $unit_price 
            WHERE order_id = '$order_id' AND product_id = $product_id";

    if (!mysqli_query($conn, $sql)) {
        echo "Error updating product $product_id: " . mysqli_error($conn);
    }
}

// Update total in orders table
$update_order_sql = "UPDATE orders SET total_amount = $total_amount WHERE order_id = '$order_id'";
if (!mysqli_query($conn, $update_order_sql)) {
    echo "Error updating order total: " . mysqli_error($conn);
}

// Update corresponding payment table (assumes amount column exists)
$update_payment_sql = "UPDATE payments SET amount = $total_amount WHERE order_id = '$order_id'";
if (!mysqli_query($conn, $update_payment_sql)) {
    echo "Error updating payment amount: " . mysqli_error($conn);
}

echo "Order and payment updated successfully.";
?>
