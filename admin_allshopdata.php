<?php
session_start();

// Create connection
include 'db.php';


// SQL query
$sql = "SELECT * FROM shop WHERE is_deleted = 1";
$result = mysqli_query($conn, $sql) or die("Query Failed");

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;

    // Store GST of the last row into session (optional — may overwrite)
    $_SESSION['shop_id'] = $row['shop_id'];
}

// Return the data in DataTables expected format
echo json_encode(["data" => $data]);

?>
