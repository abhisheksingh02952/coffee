<?php
session_start();

// DB connection
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connect Error");

// Query for only Distributors
$sql = "SELECT * FROM dealers WHERE dealer_type = 'Distributor'";
$result = mysqli_query($conn, $sql) or die("Query Error");

// Collect all data
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;

    // Optional: store last dealer_id in session
    $_SESSION['dealer_id'] = $row['dealer_id'];
}

// Output as JSON (for DataTables)
echo json_encode(['data' => $data]);
?>
