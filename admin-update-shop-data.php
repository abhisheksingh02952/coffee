<?php
include 'db.php';


$shop_id = $_POST['shop_id'];
$reporting_id = $_POST['reporting_id'];
$name = $_POST['name'];
$fathername = $_POST['fathername'];
$gst = $_POST['gst'];
$phone = $_POST['phone'];
$Address = $_POST['Address'];
$Pin = $_POST['Pin'];
$area = $_POST['area'];
$scheme = $_POST['scheme'];


// Update employee table
$sql = "UPDATE shop SET 
    reporting_id = '$reporting_id',
    name = '$name',
    owner_fathername = '$fathername',
    gst = '$gst',
    phone = '$phone',
    address = '$address',
    pin = '$pin',
    area = '$area',
    scheme = '$scheme'
    WHERE shop_id = '$shop_id'";

    
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
