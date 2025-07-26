<?php
session_start();

include 'db.php';


$sql = "SELECT * FROM payments WHERE is_deleted = 1";
$result = mysqli_query($conn, $sql) or die("Query Failed");

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;

    $_SESSION['shop_id'] = $row['shop_id'];
}

echo json_encode(["data" => $data]);

?>
