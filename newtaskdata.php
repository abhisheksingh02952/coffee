<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

$user_id = (int) $_SESSION['user_id'];

$id = $_POST['id'];
$Title = $_POST['Title'];
$Description = $_POST['Description'];
$AssignDate = $_POST['AssignDate'];
$TimelineDate = $_POST['TimelineDate'];
$Status = $_POST['Status'];

// Basic SQL UPDATE

$sql = "INSERT INTO task (user_id, Title, Description, Assign_Date, Timeline_Date, Status, Rating) VALUES ('$user_id', '$Title', '$Description', '$AssignDate', '$TimelineDate', '$Status', '0')";

$result = mysqli_query($conn, $sql) or die("Query Error");

if ($result && mysqli_num_rows($result) > 0) {

        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
        
} else {
    echo json_encode(null);
}

mysqli_close($conn);
?>
