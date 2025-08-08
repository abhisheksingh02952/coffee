<?php
include 'auth.php';
authorize('employee');

include 'db.php';

// Sanitize and set shop_id
if (isset($_GET['shop_id'])) {
    $_SESSION['shop_id'] = intval($_GET['shop_id']);
}
$shop_id = $_SESSION['shop_id'] ?? 0;

// Fetch product stock
$result = mysqli_query($conn, "
    SELECT p.id AS product_id, p.name, COALESCE(s.quantity, 0) AS quantity 
    FROM products p 
    LEFT JOIN stock s ON s.product_id = p.id AND s.shop_id = $shop_id
");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
        }

        #geoForm {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 800px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
            border: 1px solid #dee2e6;
        }

        input.form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
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

        .clearfix>* {
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .clearfix>*:hover {
            background-color: #0056b3;
        }

        @media (max-width: 480px) {
            .clearfix {
                flex-direction: column;
                align-items: stretch;
            }

            .clearfix>* {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        @media (min-width: 601px) and (max-width: 768px) {
            .clearfix {
                justify-content: center;
            }

            .clearfix>* {
                flex: 1 1 45%;
                margin: 10px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .clearfix {
                justify-content: space-around;
            }

            .clearfix>* {
                flex: 1 1 30%;
            }
        }

        @media (min-width: 1025px) {
            .clearfix {
                justify-content: space-between;
            }

            .clearfix>* {
                flex: 1 1 20%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "sidebar.php"; ?>

            <main class="col-md-10 py-4">
                <form id="geoForm">
                    <input type="hidden" name="shop_id" id="shop_id" value="<?= htmlspecialchars($shop_id) ?>">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($row['name']) ?>
                                        <input type="hidden" name="product_ids[]" value="<?= $row['product_id'] ?>">
                                    </td>
                                    <td>
                                        <input type="number" name="quantities[]" value="<?= $row['quantity'] ?>" min="0" class="form-control">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="form-group mb-3">
                        <label for="scheme"><b>Scheme</b></label>
                        <input type="text" name="scheme" id="scheme" required class="form-control">
                    </div>

                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <div class="clearfix mt-3">
                        <button type="button" onclick="location.href='shop_stock_update.php'" class="btn btn-secondary deletebtn">Cancel</button>
                        <button type="button" class="btn btn-primary update" onclick="submitWithLocation()">Submit</button>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function submitWithLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const form = document.getElementById("geoForm");
                    const formData = new FormData(form);

                    // Append geolocation
                    formData.append("latitude", position.coords.latitude);
                    formData.append("longitude", position.coords.longitude);

                    const shop_id = $('#shop_id').val();
                    const scheme = $('#scheme').val();

                    // First update scheme
                    $.post("scheme_update_data.php", {
                            shop_id: shop_id,
                            scheme: scheme
                        })
                        .done(function(schemeResponse) {
                            // Then update stock
                            $.ajax({
                                url: "insert_update_stock.php",
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    alert("Stock updated successfully!");
                                    location.href = "place_order.php";
                                },
                                error: function(xhr, status, error) {
                                    alert("Error: " + error);
                                }
                            });
                        });
                }, function(error) {
                    alert("Geolocation Error: " + error.message);
                });
            } else {
                alert("Geolocation is not supported by your browser.");
            }
        }

        $(document).ready(function() {
            // Load existing scheme
            $.ajax({
                url: "scheme_show.php",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $("#shop_id").val(data.shop_id);
                        $("#scheme").val(data.scheme);
                    }
                }
            });
        });
    </script>
</body>

</html>