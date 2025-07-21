<?php
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

$id = $_POST['id'];
$name = $_POST['name'];
$fathername = $_POST['fathername'];
$mothername = $_POST['mothername'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['Address'];
$pin = $_POST['Pin'];
$username = $_POST['username'];
$password = $_POST['password'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$position = $_POST['position'];
$reporting_id = $_POST['reporting_id'];

$image_name = "";

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = "uploads/";
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $file_type = $_FILES['image']['type'];
    $file_ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

    if (!in_array($file_type, $allowed_types)) {
        echo "Invalid image type.";
        exit;
    }

    $image_name = uniqid('employee_', true) . '.' . $file_ext;
    $target_file = $upload_dir . $image_name;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Image upload failed.";
        exit;
    }
} else {
    // Keep existing image if no new image uploaded
    $query = "SELECT image FROM employees WHERE user_id = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image_name = $row['image'];
    }
}

// Update employee table
$sql = "UPDATE employees SET name = '$name', fathername = '$fathername', mothername = '$mothername', phone = '$phone', email = '$email', address = '$address', pin = '$pin', username = '$username', password = '$password', dob = '$dob', gender = '$gender', position = '$position', reporting_id = '$reporting_id', image = '$image_name' WHERE user_id = '$id'";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
