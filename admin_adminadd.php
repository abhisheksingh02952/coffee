<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

// Get POST values
$name = $_POST['name'];
$fathername = $_POST['fathername'];
$mothername = $_POST['mothername'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['Address'];
$username = $_POST['email'];
$pin = $_POST['Pin'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$position = $_POST['position'];
$password  = $_POST['password'];
$reportingid  = $_POST['reporting_id'];

// Image Upload
$image_name = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];
$image_folder = "uploads/" . basename($image_name);

// Move uploaded image to folder
if (move_uploaded_file($image_tmp, $image_folder)) {
    // Insert into database
    $sql = "INSERT INTO employees (name, fathername, mothername, phone, email, address, pin, dob, gender, password, position, image, reporting_id, username)
        VALUES ('$name', '$fathername', '$mothername', '$phone', '$email', '$address', '$pin', '$dob', '$gender', '$password', '$position', '$image_name', '$reportingid', '$username')";

    if (mysqli_query($conn, $sql)) {
        echo "Employee added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Failed to upload image.";
}

// Close connection
mysqli_close($conn);
?>
