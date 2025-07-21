<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connect Error");

// Correct SQL query (make sure the table name is correct: "employee" or "employees" — check your DB)
$sql = "SELECT * FROM employees";
$result = mysqli_query($conn, $sql) or die("Query Error");

// Prepare data array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Output for DataTables
echo json_encode(['data' => $data]);

// Close DB connection
mysqli_close($conn);
?>
