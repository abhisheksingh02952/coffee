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

        // Skip zero or negative quantities
        if ($quantity <= 0) continue;

        // Check if record already exists
        $check_sql = "SELECT id FROM stock WHERE shop_id = $shop_id AND product_id = $product_id";
        $check_result = mysqli_query($conn, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            // Update existing stock
            $update_sql = "UPDATE stock 
                           SET quantity = $quantity, last_updated = '$timestamp' 
                           WHERE shop_id = $shop_id AND product_id = $product_id";
            mysqli_query($conn, $update_sql) or die("Update Failed: " . mysqli_error($conn));
        } else {
            // Insert new stock
            $insert_sql = "INSERT INTO stock (shop_id, product_id, quantity, last_updated) 
                           VALUES ($shop_id, $product_id, $quantity, '$timestamp')";
            mysqli_query($conn, $insert_sql) or die("Insert Failed: " . mysqli_error($conn));
        }
    }

    // Redirect or output message
    header("Location: insert_stock_form.php?msg=Stock%20updated"); // Change 'your_page.php' to your actual page
    exit();
} else {
    echo "Invalid request.";
}
?>
