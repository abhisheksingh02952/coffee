<?php

include 'auth.php';
authorize('employee');

if (isset($_GET['order_id'])) {
  $_SESSION['order_id'] = $_GET['order_id'];
}
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
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    button.update:hover {
      background-color: #3749b5;
    }


    button {
      background-color: #4761d3;
      color: white;
      border: none;
      padding: 14px 20px;
      margin: 10px 5px 0 0;
      border-radius: 5px;
      cursor: pointer;
      width: 30%;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #3749b5;
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

      include "sidebar.php";

      ?>

      <!-- Form Content -->
      <main class="col-md-10 py-4">

        <form action="" method="POST" id="geoForm" enctype="multipart/form-data">
          <div id="data" class="container">
            <h1>Payment Update</h1>
            <hr>

            <label for="name"><b>Order ID</b></label>
            <input type="text" name="order_id" id="order_id" required><br>
            <!--
            <label for="name"><b>Shop ID</b></label>
            <input type="text"  name="shop_id" id="shop_id" required><br>

            <label for="name"><b>Amount</b></label>
            <input type="text" name="amount" id="amount" required><br>

            -->

            <label for="payment_type"><b>Choose Payment Type:</b></label>
            <select id="payment_type" name="payment_type" class="payment_type">
              <option value="cash">Cash</option>
              <option value="online">Online</option>
            </select><br>

            <label for="payment_status"><b>Choose Payment Status:</b></label>
            <select id="payment_status" name="payment_status" class="payment_type">
              <option value="Pending">Pending</option>
              <option value="Paid">Paid</option>
            </select><br>

            <label for="name"><b>Remarks</b></label>
            <input type="text" placeholder="Enter Remarks" name="remarks" id="remarks" required><br>


            <div class="clearfix">
              <button type="button" onclick="location.href='order_payment.php'" class="cancelbtn">Cancel</button>
              <button type="submit" id="admin-add-employee-data" class="update">Submiit</button>
            </div>
          </div>
        </form>
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
    $(document).ready(function() {
      // Load employee data
      $.ajax({
        url: "payment_edit_data.php",
        type: "POST",
        dataType: "json",
        success: function(data) {
          if (data) {
            $("#order_id").val(data.order_id);
            $("#shop_id").val(data.shop_id);
            $("#amount").val(data.amount);
            $("#payment_type").val(data.payment_type);
            $("#payment_status").val(data.payment_status);
            $("#remarks").val(data.remarks);

          }
        },
      });

      // Update on submit
      $("#admin-add-employee-data").on("click", function(e) {
        e.preventDefault();

        if (!confirm("Are you sure you to Update Payment?")) {
          return;
        }

        var formData = new FormData($('#geoForm')[0]);

        $.ajax({
          url: "payment_edit_data_update.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            alert("Employee updated successfully!");
          },
          error: function(xhr, status, error) {
            console.error("Update failed:", status, error);
            alert("Failed to update employee.");
          }
        });
      });
    });
  </script>
</body>

</html>