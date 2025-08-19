<?php
include 'auth.php';
authorize('employee');
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    include "head.php";
    ?>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="number"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus,
        select:focus,
        input[type="file"]:focus {
            background-color: #e0e0e0;
            outline: none;
        }

        select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="%23666" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px 16px;
        }

        button.update {
            background-color: #4761d3;
            color: white;
            border: none;
            padding: 14px 20px;
            margin: 10px 5px 0 0;
            border-radius: 5px;
            cursor: pointer;
            width: 30%;
            flex: auto;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button.update:hover {
            background-color: #3749b5;
        }

        button.cancelbtn {
            background-color: #4761d3;
            color: white;
            border: none;
            margin: 10px 5px 0 0;
            padding: 14px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 30%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button.cancelbtn:hover {
            background-color: #bbb;
        }

        .clearfix {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
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

        /* Responsive */
        @media (max-width: 600px) {
            .clearfix {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }

        /* Success & Error Alerts */
        #message .alert {
            border-radius: 8px;
            padding: 15px 20px;
            font-size: 16px;
            margin-top: 20px;
            opacity: 0;
            transform: translateY(-10px);
            animation: fadeSlideIn 0.5s forwards;
        }

        @keyframes fadeSlideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Table Styling */
        #message table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        #message table thead {
            background: #4761d3;
            color: #fff;
        }

        #message table th,
        #message table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        #message table tr:hover {
            background-color: #f9f9f9;
            transition: background 0.3s;
        }

        /* Loader */
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4761d3;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 10px;
            vertical-align: middle;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php
            include "sidebar.php";
            ?>

            <!-- Form Content -->
            <main class="col-md-10 py-4">

                <form action="" method="POST" id="uploadExcel" enctype="multipart/form-data">
                    <div id="data" class="container">
                        <h1>Bulk Upload Data</h1>
                        <hr>
                        <input type="file" name="excelFile" accept=".xls,.xlsx" required>
                        <button type="submit">Upload</button>
                    </div>
                </form>
                <div id="message"></div>
            </main>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $("#uploadExcel").on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            // Show loader while uploading
            $("#message").html('<div class="alert alert-info">⏳ Uploading file... <span class="loader"></span></div>');

            $.ajax({
                url: 'fileupload.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#message").html(
                        '<div class="alert alert-success">✅ File uploaded successfully!</div>' + response
                    );

                    // Activate DataTables if table is returned
                    if ($("#message table").length) {
                        $("#message table").DataTable({
                            responsive: true,
                            pageLength: 5
                        });
                    }
                },
                error: function() {
                    $("#message").html('<div class="alert alert-danger">❌ Error uploading file.</div>');
                }
            });
        });
    </script>
</body>

</html>