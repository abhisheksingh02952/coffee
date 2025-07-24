<?php
$conn = mysqli_connect("localhost", "root", "", "test");

$shop_id = isset($_GET['shop_id']) ? (int)$_GET['shop_id'] : 0;

$sql = "SELECT 
            p.name AS product_name,
            s.quantity,
            s.last_updated
        FROM stock s
        JOIN products p ON s.product_id = p.id
        WHERE s.shop_id = $shop_id AND s.is_deleted = 1
        ORDER BY p.name";

$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        $row['product_name'],
        $row['quantity'],
        $row['last_updated']
    ];
}

echo json_encode(["data" => $data]);
?>
