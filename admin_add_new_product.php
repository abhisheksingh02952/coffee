<?php
// Connect to database
include 'db.php';


// Get POST values
$name = $_POST['name'];
$sku = $_POST['sku'];
$price = $_POST['price'];

    // Insert into database
    $sql = "INSERT INTO products (name, sku, price) VALUES ('$name', '$sku', '$price')";

    if (mysqli_query($conn, $sql)) {
        echo "Employee added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }


// Close connection
mysqli_close($conn);
?>
