<?php
include 'auth.php';
authorize('admin');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <?php
include "head.php";
?>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
  <?php
      include "admin_sidebar.php";
   ?>

<main class="col-md-10 ms-sm-auto px-4 py-4 col-md-10">

<h2>Attendance Calculator</h2>

<label for="month">Select Month:</label>
<input type="month" id="month" name="month">
<button type="button" class="show_attendances" id="show_attendance">Show Attendance</button>
<button type="button" class="log-locations" id="log-location">Check In</button>
<button type="button" class="log-locationss" id="log-locations">Check Out</button>

<table class="table_data">
    <thead>
        <tr>
            <th>Date</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Hours</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody  id="attendance-body"></tbody>
</table>

<div id="attendance_table" style="margin-top: 20px;"></div>

<div class="clearfix">
            <button type="button" class="updates" onclick="window.location.href='admin_profile.php'">Back</button>
      </div>
</main>
  </div>
</div>

<script>
    $(document).ready(function () {

        $.ajax({
            url: "showattendance.php",
            type: "POST",
            dataType: "json",
            success: function(data) {
                if (Array.isArray(data) && data.length > 0) {
                    // Sort records by date descending (latest first)
                    data.sort((a, b) => new Date(b.date) - new Date(a.date));
                    const record = data[0]; // Only the latest

                    let row = `
                        <tr>
                            <td>${record.date}</td>
                            <td>${record.checkin_time}</td>
                            <td>${record.checkout_time}</td>
                            <td>${record.total_hours}</td>
                            <td>${record.status}</td>
                        </tr>
                    `;

                    $("#attendance-body").html(row);
                } 
            },
            error: function(xhr, status, error) {
                console.error("Error fetching attendance:", error);
            }
        });

        $('#show_attendance').click(function () {
            var month = $('#month').val(); // format: YYYY-MM
            if (!month) {
                alert("Please select a month");
                return;
            }

            $.ajax({
                url: 'get_monthly_attendance.php',
                type: 'POST',
                data: { month: month },
                success: function (response) {
                    $('#attendance_table').html(response);
                }
            });
        });

        
        $("#log-location").on("click", function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    const now = new Date();
                    const date = now.toISOString().split('T')[0]; // YYYY-MM-DD
                    const time = now.toTimeString().split(' ')[0]; // HH:MM:SS

                    $.ajax({
                        url: 'save_location.php',
                        type: 'POST',
                        data: {
                            latitude: latitude,
                            longitude: longitude,
                            date: date,
                            time: time,
                            type: 'checkin' // differentiate if needed
                        },
                        success: function (response) {
                            alert(response); // Show message from PHP
                        },
                        error: function () {
                            alert('Error sending data.');
                        }
                    });
                }, function (error) {
                    alert('Geolocation error: ' + error.message);
                });
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        });

        
        $("#log-locations").on("click", function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    const now = new Date();
                    const date = now.toISOString().split('T')[0];
                    const time = now.toTimeString().split(' ')[0];

                    $.ajax({
                        url: 'save_location.php',
                        type: 'POST',
                        data: {
                            latitude: latitude,
                            longitude: longitude,
                            date: date,
                            time: time,
                            type: 'checkout'
                        },
                        success: function (response) {
                            alert(response);
                        },
                        error: function () {
                            alert('Error sending data.');
                        }
                    });
                }, function (error) {
                    alert('Geolocation error: ' + error.message);
                });
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        });
    });

</script>

</body>
</html>
