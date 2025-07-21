
<?php
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

$id = $_POST['id'];
$name = $_POST['name'];
$sku = $_POST['sku'];
$price = $_POST['price'];

// Update employee table
$sql = "UPDATE products SET name = '$name', sku = '$sku', price = '$price' WHERE id = '$id'";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
