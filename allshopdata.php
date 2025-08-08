<?php
session_start();
include 'db.php';

// SQL query to fetch latest payment per shop using a subquery join
$sql = "
    SELECT 
        shop.*, 
        payments.id, 
        payments.order_id, 
        payments.payment_status, 
        payments.collection_date
    FROM shop
    LEFT JOIN (
        SELECT p1.*
        FROM payments p1
        INNER JOIN (
            SELECT shop_id, MAX(collection_date) AS latest_collection
            FROM payments
            GROUP BY shop_id
        ) p2 ON p1.shop_id = p2.shop_id AND p1.collection_date = p2.latest_collection
    ) AS payments ON shop.shop_id = payments.shop_id
    WHERE shop.is_deleted = 1
";

$result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
    $_SESSION['shop_id'] = $row['shop_id']; // optional
}


echo json_encode(["data" => $data]);

?>
