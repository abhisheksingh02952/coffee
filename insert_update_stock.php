<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "test");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shop_id'], $_POST['product_ids'], $_POST['quantities'])) {
    $shop_id = (int) $_POST['shop_id'];
    $product_ids = $_POST['product_ids'];
    $quantities = $_POST['quantities'];
    $timestamp = date("Y-m-d H:i:s");

    foreach ($product_ids as $index => $product_id) {
        $product_id = (int) $product_id;
        $quantity = (int) $quantities[$index];

        if ($quantity < 0) continue;

        $sql = "INSERT INTO stock (shop_id, product_id, quantity, last_updated)
                VALUES ($shop_id, $product_id, $quantity, '$timestamp')
                ON DUPLICATE KEY UPDATE 
                    quantity = VALUES(quantity),
                    last_updated = VALUES(last_updated)";
        
        mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));
    }

    header("Location: insert_stock_form.php?msg=Stock%20updated");
    exit();
} else {
    echo "Invalid request.";
}
?>
