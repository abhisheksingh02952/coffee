<?php

include 'auth.php';
authorize('employee'); 

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

$conn = mysqli_connect("localhost", "root", "", "test");

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
            width: 53%;
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
            font-size: 16px;
            transition: background-color 0.3s ease;
          }

          button.update:hover {
            background-color: #3749b5;
          }
          .clearfix {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
          }

          @media (max-width: 600px) {
            button.update {
              width: 100%;
              margin-bottom: 10px;
            }
          }

          /* Full-width input fields */
            input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
          }

          input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
          }

          hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
          }

          /* Set a style for all buttons */
          /* Full-width input fields */
            input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
          }

          input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
          }

          hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
          }

          /* Set a style for all buttons */
          .buttone {
            text-align: center;
            margin: 10px;
            float: right;
            background-color:rgb(71, 97, 211);
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 20%;
            opacity: 0.9;
          }

          .button:hover {
            opacity:1;
          }

          .buttons {
            text-align: center;
            margin: 10px;
            float: right;
            background-color:rgb(71, 97, 211);
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 30%;
            opacity: 0.9;
          }

          .buttons:hover {
            opacity:1;
          }


          .remove, .cancel {
            text-align: center;
            margin: 10px;
            float: right;
            background-color:rgba(194, 56, 31, 1);
            color: white;
            padding: 14px 20px;
            margin: 1px;
            border: none;
            cursor: pointer;
            width: 30%;
            opacity: 0.9;
            height: 43px;
            float: right;
            margin-left: 90px;
          }

          .remove:hover {
            opacity:1;
          }

          a.button {
            display: inline-block;
            text-align: center;
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            margin: 8px 0;
            width: 100%;
          }

          /* Add padding to container elements */
          .container {
            padding: 16px;
          }

          /* Clear floats */
          .clearfix::after {
            content: "";
            clear: both;
            display: table;
          }

          /* Change styles for cancel button and signup button on extra small screens */
          @media screen and (max-width: 300px) {
            .cancelbtn, .update {
              width: 100%;
            }
          }

          #sidebar {
            min-height: 100vh;
          }
          .nav-link.active, .nav-link:hover {
            background-color: #495057;
            color: #ffc107 !important;
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

<form action=""  method="POST" id="updateForm" enctype="multipart/form-data">
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
                <input type="number" name="items[<?php echo $row['product_id']; ?>][quantity]" value="<?php echo $row['quantity']; ?>" min="1">
            </td>
            <td>
                <input type="number" step="0.01" name="items[<?php echo $row['product_id']; ?>][price]" value="<?php echo $row['price']; ?>">
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
         <div class="clearfix">
              <button type="button"  class="cancel" onclick="location.href='all_orders.php'" class="cancelbtn">Cancel</button>
            <button type="submit" name="submit" id="profile-update-data" class="update">Update Order</button>
            </div>
</form>

<div id="result"></div>

<script>
$("#updateForm").on("submit", function(e) {
    e.preventDefault();

     if (!confirm("Are you sure you to Update Payment?")) {
        return;
    }

    $.ajax({
        url: "update_order.php",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            $("#result").html("<strong>" + response + "</strong>");
        }
    });
});
</script>
</body>
</html>
