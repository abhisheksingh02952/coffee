<?php

session_start();


$conn = new mysqli("localhost", "root", "", "test");
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection Failed"]));
}

// Session check
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

$user_id = (int) $_SESSION['user_id']; 
$username = $_SESSION['username']; 

// Validate and escape month
if (!isset($_POST['month']) || !preg_match('/^\d{4}-\d{2}$/', $_POST['month'])) {
    echo json_encode(["error" => "Invalid month format"]);
    exit;
}
$month = mysqli_real_escape_string($conn, $_POST['month']);

// Query attendance
$sql = "SELECT user_id, username, date, status 
        FROM attendance 
        WHERE DATE_FORMAT(date, '%Y-%m') = '$month' 
        AND user_id = $user_id";

$result = mysqli_query($conn, $sql);

$attendance = [];
$dates = [];

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['username'];
    $date = $row['date'];
    $status = $row['status'];

    $attendance[$name][$date] = $status;

    if (!in_array($date, $dates)) {
        $dates[] = $date;
    }
}   

sort($dates); 

// Start HTML output
$output = "<style>
    body {
        font-family: Arial, sans-serif;
    }
    .present { background-color: #c8e6c9; }       /* green */
    .absent { background-color: #ffcdd2; }        /* red */
    .HalfDay { background-color: #ffe0b2; }       /* orange */
    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
    }
    th, td {
        text-align: center;
        padding: 10px;
        border: 1px solid #ccc;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .btn {
        float: right;
        background-color: #4761d3;
        color: white;
        padding: 14px 20px;
        margin: 10px;
        border: none;
        cursor: pointer;
        width: 12%;
        text-align: center;
    }
</style>";


$output .= "<h3>Attendance for " . date('F Y', strtotime($month . '-01')) . "</h3>";
$output .= "<table border='1' cellpadding='5'><thead><tr><th>Employee</th>";

// Day headers
foreach ($dates as $d) {
    $output .= "<th style='padding: 10px;'>" . date('d', strtotime($d)) . "</th>";
}
$output .= "<th>Present</th><th>Absent</th><th>Half Day</th></tr></thead><tbody>";

// If no data
if (empty($attendance)) {
    $output .= "<tr><td colspan='" . (count($dates) + 3) . "'>No attendance data available for this month.</td></tr>";
}

// Fill rows
foreach ($attendance as $employee => $days) {
    $present = 0;
    $absent = 0;
    $HalfDay = 0;
    $output .= "<tr><td>" . htmlspecialchars($employee) . "</td>";

    foreach ($dates as $d) {
        $status = $days[$d] ?? '-';
        if ($status === 'Present') $present++;
        if ($status === 'Absent') $absent++;
        if ($status === 'Half Day') $HalfDay++;

        $statusClass = ($status === 'Present') ? 'class="present"' :
                       (($status === 'Absent') ? 'class="absent"' :
                       (($status === 'Half Day') ? 'class="HalfDay"' : ''));
        $output .= "<td style='padding:10px;' $statusClass>" . htmlspecialchars($status) . "</td>";
    }

    $output .= "<td>$present</td><td>$absent</td><td>$HalfDay</td></tr>";
}

$output .= "</tbody></table>";

echo $output;
$conn->close();


?>