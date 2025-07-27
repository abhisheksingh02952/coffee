<?php

include 'db.php';


$id = $_POST['id'];
$name = $_POST['name'];
$gstno = $_POST['gstno'];
$pin = $_POST['pin'];
$address = $_POST['Address'];
$type = $_POST['type'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$image_name = "";

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = "uploads/";
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $file_type = $_FILES['image']['type'];
    $file_ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

    if (!in_array($file_type, $allowed_types)) {
        echo "Invalid image type.";
        exit;
    }

    // Rename image to avoid name collision
    $image_name = uniqid('dealer_', true) . '.' . $file_ext;
    $target_file = $upload_dir . $image_name;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Image upload failed.";
        exit;
    }
} else {
    // Keep existing image if no new image uploaded
    $query = "SELECT dealer_image FROM dealers WHERE dealer_id = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image_name = $row['dealer_image'];
    }
}

// Update the dealer
$sql = "UPDATE dealers SET dealer_name = '$name', dealer_gst_no = '$gstno', dealer_address = '$address', dealer_pin = '$pin', dealer_type = '$type', dealer_latitude = '$latitude', dealer_longitude = '$longitude', dealer_image = '$image_name' WHERE dealer_id = '$id'";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
