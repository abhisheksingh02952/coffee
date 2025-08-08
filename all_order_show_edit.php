<?php

include 'auth.php';
authorize('employee');

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

include 'db.php';


$order_id_safe = mysqli_real_escape_string($conn, $order_id);

$sql = "SELECT order_items.*, products.name 
        FROM order_items 
        JOIN products ON products.id = order_items.product_id 
        WHERE order_items.order_id = '$order_id_safe'";

$result = mysqli_query($conn, $sql);

if (!$result) {
  die("Query Failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Order</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <?php
  include "head.php";
  ?>
  <style>
    /* Base Reset */
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }



    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
      color: #000;
      background-color: #fff;
    }

    /* Layout Structure */
    .container-fluid {
      height: 100%;
    }

    .row {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
    #sidebar {
      min-height: 100vh;
      background: #2b2b2b;
      color: white;
    }

    #sidebar .nav-link {
      color: #ccc;
    }

    #sidebar .nav-link.active,
    #sidebar .nav-link:hover {
      background-color: #495057;
      color: #ffc107 !important;
    }

    /* Main Content */
    main {
      flex-grow: 1;
      padding: 20px;
    }

    /* Form Container */
    .container {
      max-width: 700px;
      margin: auto;
      padding: 20px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* Typography */
    h1 {
      text-align: center;
      margin-bottom: 10px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #333;
    }

    /* Inputs & Selects */
    input[type="text"],
    input[type="password"],
    input[type="date"],
    input[type="number"],
    select,
    input[type="file"] {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background: #f9f9f9;
      color: #000;
    }

    input:focus,
    select:focus {
      background-color: #eee;
      outline: none;
    }

    select {
      appearance: none;
      background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
      background-repeat: no-repeat;
      background-position: right 10px center;
      background-size: 16px 16px;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #f5f5f5;
      color: #000;
    }

    th,
    td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #ddd;
    }

    /* Button Styles */
    .clearfix {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      flex-wrap: wrap;
    }

    button {
      border: none;
      padding: 14px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      flex: 1;
      min-width: 100px;
      transition: background-color 0.3s ease;
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

    /* 🟡 Extra Small Devices (Phones, ≤ 480px) */
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

    /* 🟡 Small Devices (Phones Landscape, ≤ 600px) */
    @media (max-width: 600px) {
      .clearfix {
        flex-direction: column;
        justify-content: flex-start;
      }

      .clearfix>* {
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

      .clearfix>* {
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

      .clearfix>* {
        flex: 1 1 30%;
      }
    }

    /* 🟣 Extra Large Devices (Desktops, > 1024px) */
    @media (min-width: 1025px) {
      .clearfix {
        flex-direction: row;
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
      <!-- Sidebar -->
      <?php
      include "sidebar.php";
      ?>

      <!-- Form Content -->
      <main class="col-md-10 py-4">

        <form action="" method="POST" id="updateForm" enctype="multipart/form-data">
          <div id="data" class="container">
            <h1>Edit Order Details</h1>
            <!-- <h2>Edit Order #<?php echo $order_id; ?></h2>  -->
            <hr>

            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <table border="1" cellpadding="5">
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
              <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td>
                    <?php echo htmlspecialchars($row['name']); ?>
                    <input type="hidden" name="items[<?php echo $row['product_id']; ?>][product_id]" value="<?php echo $row['product_id']; ?>">
                  </td>
                  <td>
                    <input type="number" name="items[<?php echo $row['product_id']; ?>][quantity]" value="<?php echo $row['quantity']; ?>" min="0">
                  </td>
                  <td>
                    <input type="hidden" class="unit-price" value="<?php echo $row['price']; ?>">
                    <input type="number" step="0.01" class="total-price" name="items[<?php echo $row['product_id']; ?>][price]" value="<?php echo $row['quantity'] * $row['price']; ?>" readonly>

                  </td>

                </tr>
              <?php } ?>
            </table>
            <br>
            <div class="clearfix">
              <button type="button" id="delete-order" class="deletebtn">Delete</button>
              <button type="button" onclick="location.href='all_orders.php'" class="cancelbtn">Cancel</button>
              <button type="submit" name="submit" id="profile-update-data" class="update">Update Order</button>
            </div>
        </form>

        <div id="result"></div>

        <script>
          $(document).ready(function() {
            $("input[type='number'][name*='[quantity]']").on("input", function() {
              const row = $(this).closest("tr");
              const quantity = parseFloat($(this).val()) || 0;
              const unitPrice = parseFloat(row.find(".unit-price").val()) || 0;
              const totalPrice = (quantity * unitPrice).toFixed(2);
              row.find(".total-price").val(totalPrice);
            });
          });


          $("#updateForm").on("submit", function(e) {
            e.preventDefault();

            if (!confirm("Are you sure you want to update the order quantity?")) {
              return;
            }

            $.ajax({
              url: "update_order.php",
              method: "POST",
              data: $(this).serialize(),
              success: function(response) {
                alert("Order is successfully updated");
                window.location.href = "all_orders.php";
              },
              error: function() {
                alert("Something went wrong. Please try again.");
              }
            });
          });

          $("#delete-order").on("click", function() {
            if (confirm("Are you sure you want to delete this order?")) {
              const orderId = $("input[name='order_id']").val();

              $.ajax({
                url: "delete_order.php", // This should point to your PHP delete handler
                type: "POST",
                data: {
                  order_id: orderId
                },
                success: function(response) {
                  alert("Order deleted successfully!");
                  window.location.href = 'all_orders.php';
                },
                error: function() {
                  alert("Failed to delete the order.");
                }
              });
            }
          });
        </script>
</body>

</html>