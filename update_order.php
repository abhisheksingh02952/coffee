<?php
$conn = mysqli_connect("localhost", "root", "", "test");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

// order_id is VARCHAR
$order_id = isset($_POST['order_id']) ? mysqli_real_escape_string($conn, $_POST['order_id']) : '';
if ($order_id == '') {
    die("Invalid or missing order_id");
}

$items = isset($_POST['items']) ? $_POST['items'] : [];

$total_amount = 0;

foreach ($items as $item) {
    $product_id = isset($item['product_id']) ? (int)$item['product_id'] : 0;
    $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
    $price = isset($item['price']) ? (float)$item['price'] : 0.0;

    $subtotal = $quantity * $price;
    $total_amount += $subtotal;

    $sql = "UPDATE order_items 
            SET quantity = $quantity, price = $price 
            WHERE order_id = '$order_id' AND product_id = $product_id";

    mysqli_query($conn, $sql);
}

$update_order_sql = "UPDATE orders SET total_amount = $total_amount WHERE order_id = '$order_id'";
mysqli_query($conn, $update_order_sql);

echo "Order updated successfully.";
?>
