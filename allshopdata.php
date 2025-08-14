<?php
session_start();
include 'db.php';

$sql = "
    SELECT 
        s.*, 
        p.id AS payment_id,
        p.order_id,
        p.payment_status,
        p.collection_date
    FROM shop s
    LEFT JOIN (
        SELECT p1.*
        FROM payments p1
        INNER JOIN (
            SELECT shop_id, MAX(id) AS max_payment_id
            FROM payments
            GROUP BY shop_id
        ) latest ON p1.id = latest.max_payment_id
    ) p ON s.shop_id = p.shop_id
    WHERE s.is_deleted = 1
";

$result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
    $_SESSION['shop_id'] = $row['shop_id']; // optional
}

echo json_encode(["data" => $data]);
?>
