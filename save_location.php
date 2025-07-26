<?php

session_start();
include 'db.php';


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? null;
if (!$user_id AND !$username ) {
    echo "Not logged in";
    exit;
}

$lat = $conn->real_escape_string($_POST['latitude'] ?? '');
$lng = $conn->real_escape_string($_POST['longitude'] ?? '');
$date = $_POST['date'] ?? date('Y-m-d');
$time = $_POST['time'] ?? date('H:i:s');
$type = $_POST['type'] ?? 'checkin';

if ($type === 'checkin') {
    $check = $conn->query("SELECT * FROM attendance WHERE user_id = $user_id AND date = '$date'");
    if ($check->num_rows > 0) {
        echo "Already checked in";
    } else {
       $conn->query("INSERT INTO attendance (user_id, username, date, checkin_time, latitude_checkin, longitude_checkin) VALUES ('$user_id', '$username', '$date', '$time', '$lat', '$lng')");
        echo "Check-in recorded";
    }
} elseif ($type === 'checkout') {
    $result = $conn->query("SELECT * FROM attendance WHERE user_id = $user_id AND date = '$date'");
    $row = $result->fetch_assoc();

    if ($row) {
        $checkin_time = $row['checkin_time'];
        $checkout_time = $time;

        $checkin_ts = strtotime($checkin_time);
        $checkout_ts = strtotime($checkout_time);
        $hours_worked = round(($checkout_ts - $checkin_ts) / 3600, 2); // to 2 decimal hours

        // Determine status
        if ($hours_worked >= 9) {
            $status = 'Present';
        } elseif ($hours_worked >= 4) {
            $status = 'Half Day';
        } else {
            $status = 'Absent';
        }

        $conn->query("UPDATE attendance 
                      SET checkout_time = '$time', total_hours = $hours_worked, status = '$status', 
                          latitude_checkout = '$lat', longitude_checkout = '$lng' 
                      WHERE user_id = $user_id AND date = '$date'");

        echo "Checkout recorded. Status: $status";
    } else {
        echo "No check-in found for today.";
    }
}


?>
