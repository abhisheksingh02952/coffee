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

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            height: 100%;
        }

        .row {
            display: flex;
            min-height: 100vh;
        }

        #sidebar {
            background-color: #2b2b2b;
            color: white;
            min-height: 100vh;
        }

        #sidebar .nav-link {
            color: #ccc;
        }

        #sidebar .nav-link.active,
        #sidebar .nav-link:hover {
            background-color: #495057;
            color: #ffc107 !important;
        }

        main {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
        }

        .update {
            background-color: #4761d3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .update:hover {
            background-color: #3749b5;
        }

        .clearfix {
            margin-top: 20px;
        }

        /* Flex container for DataTable */
        .datatable-flex-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* space between elements if needed */
        }

        /* Optional: make table scrollable if overflow occurs */
        #usersTable {
            width: 100%;
            overflow-x: auto;
            display: block;
        }

        button.update {
            background-color: #4761d3;
            color: white;
        }

        button.update:hover {
            background-color: #3749b5;
        }

        button.cancelbtn {
            background-color: #6c757d;
            color: white;
        }

        button.cancelbtn:hover {
            background-color: #5a6268;
        }

        button.deletebtn {
            background-color: #d9534f;
            color: white;
        }

        button.deletebtn:hover {
            background-color: #c9302c;
        }

        .clearfix {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: space-between;
      align-items: center;
      margin: 20px;
      padding: 10px;
      background-color: #f1f1f1;
      border: 1px solid #ddd;
      border-radius: 10px;
    }

    /* Child Elements */
    .clearfix > * {
      padding: 12px 20px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      background-color: #007bff;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .clearfix > *:hover {
      background-color: #0056b3;
    }

    /* 🟡 Extra Small Devices (Phones, ≤ 480px) */
    @media (max-width: 480px) {
      .clearfix {
        flex-direction: column;
        align-items: stretch;
      }

      .clearfix > * {
        width: 100%;
        margin-bottom: 10px;
      }
    }

    /* 🟡 Small Devices (Phones Landscape, ≤ 600px) */
    @media (max-width: 600px) {
      .clearfix {
        flex-direction: column;
        justify-content: flex-start;
      }

      .clearfix > * {
        width: 100%;
        margin-bottom: 10px;
      }
    }

    /* 🟠 Medium Devices (Tablets, 601px - 768px) */
    @media (min-width: 601px) and (max-width: 768px) {
      .clearfix {
        flex-direction: row;
        justify-content: center;
      }

      .clearfix > * {
        flex: 1 1 45%;
        margin: 10px;
      }
    }

    /* 🔵 Large Devices (Small Desktops, 769px - 1024px) */
    @media (min-width: 769px) and (max-width: 1024px) {
      .clearfix {
        flex-direction: row;
        justify-content: space-around;
      }

      .clearfix > * {
        flex: 1 1 30%;
      }
    }

    /* 🟣 Extra Large Devices (Desktops, > 1024px) */
    @media (min-width: 1025px) {
      .clearfix {
        flex-direction: row;
        justify-content: space-between;
      }

      .clearfix > * {
        flex: 1 1 20%;
      }
    }
  
    </style>

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
                    <tbody id="attendance-body"></tbody>
                </table>

                <div id="attendance_table" style="margin-top: 20px;"></div>

                <div class="clearfix">
                    <button type="button" class="updates" onclick="window.location.href='admin_profile.php'">Back</button>
                </div>
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {

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

            $('#show_attendance').click(function() {
                var month = $('#month').val(); // format: YYYY-MM
                if (!month) {
                    alert("Please select a month");
                    return;
                }

                $.ajax({
                    url: 'get_monthly_attendance.php',
                    type: 'POST',
                    data: {
                        month: month
                    },
                    success: function(response) {
                        $('#attendance_table').html(response);
                    }
                });
            });


            $("#log-location").on("click", function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
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
                            success: function(response) {
                                alert(response); // Show message from PHP
                            },
                            error: function() {
                                alert('Error sending data.');
                            }
                        });
                    }, function(error) {
                        alert('Geolocation error: ' + error.message);
                    });
                } else {
                    alert('Geolocation is not supported by your browser.');
                }
            });


            $("#log-locations").on("click", function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
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
                            success: function(response) {
                                alert(response);
                            },
                            error: function() {
                                alert('Error sending data.');
                            }
                        });
                    }, function(error) {
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