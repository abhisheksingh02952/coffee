<?php

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

$id = $_POST['id'];
$Title = $_POST['Title'];
$Description = $_POST['Description'];
$AssignDate = $_POST['AssignDate'];
$TimelineDate = $_POST['TimelineDate'];
$Status = $_POST['Status'];

// Basic SQL UPDATE
$sql = "UPDATE task SET Title = '$Title', Description = '$Description', Assign_Date = '$AssignDate', Timeline_Date = '$TimelineDate', Status = '$Status' WHERE id = '$id'";

if (mysqli_query($conn, $sql)) {
    // Send back updated record
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    echo json_encode($data);
} else {
    echo json_encode(null);
}

mysqli_close($conn);
?>
