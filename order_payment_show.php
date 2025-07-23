<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

$sql = "SELECT * FROM payments";
$result = mysqli_query($conn, $sql) or die("Query Failed");

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;

    $_SESSION['shop_id'] = $row['shop_id'];
}

echo json_encode(["data" => $data]);

?>
