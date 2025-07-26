<?php
include 'auth.php';
authorize('employee'); 

if (isset($_GET['shop_id']) && isset($_GET['scheme'])) {
    $_SESSION['shop_id'] = $_GET['shop_id'];
    $_SESSION['scheme'] = $_GET['scheme']; 
}
?>

<script>
  console.log("Shop ID: <?= isset($_SESSION['shop_id']) ? $_SESSION['shop_id'] : 'Not set' ?>");
</script>

<?php
include 'db.php';


// Fetch products
$product_result = $conn->query("SELECT id, name FROM products");
$products = [];
while ($row = $product_result->fetch_assoc()) {
    $products[] = $row;
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

  <script>
  function addRow() {
    const container = document.getElementById("product-container");
    const newRow = document.createElement("div");
    newRow.className = "row";

    newRow.innerHTML = `
      <select name="product_id[]" class="select">
        <?php foreach ($products as $p): ?>
          <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
        <?php endforeach; ?>
      </select>
      <input type="number" name="quantity[]" placeholder="Quantity" required min="1" />
      <button type="button" class="remove" onclick="this.parentElement.remove()">Remove</button>
      <br><br>
    `;
    container.appendChild(newRow);
  }
</script>

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
       
            <form action=""  method="POST" id="geoForm" enctype="multipart/form-data">
        <div id="data" class="container">
            <h1>Add Order Details</h1>
            <hr>

            <input type="hidden" id="id" name="id">

            <input type="hidden" id="scheme" name="scheme">

            <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">

             <div id="product-container">
              <div class="row">
                <select name="product_id[]" class ="select">
                  <?php foreach ($products as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                  <?php endforeach; ?>
                </select>
                <input type="number" name="quantity[]" placeholder="Quantity" required min="1" />
                <br><br>               
              </div>
            </div>
                <button type="buttons" class="buttons" onclick="addRow()">Add More</button><br><br>

            <label for="payment_type"><b>Choose Payment Type:</b></label>
            <select id="payment_type" name="payment_type" class="select">
              <option value="cash">Cash</option>
              <option value="online">Online</option>
            </select><br>

            <label for="payment_status"><b>Choose Payment Status:</b></label>
            <select id="payment_status" name="payment_status" class="select">
              <option value="Pending">Pending</option>
              <option value="Paid">Paid</option>
            </select><br>

            <div class="clearfix">
              <button type="button"  class="cancel" onclick="location.href='all_shop.php'" class="cancelbtn">Cancel</button>
            <<button type="submit" name="submit" id="profile-update-data" class="update">Submit</button>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $product_ids = $_POST['product_id'];
        $quantities = $_POST['quantity'];

        echo "<h4>Order Summary:</h4>";
        for ($i = 0; $i < count($product_ids); $i++) {
            $pid = (int)$product_ids[$i];
            $qty = (int)$quantities[$i];

            $res = $conn->query("SELECT name FROM products WHERE id = $pid LIMIT 1");
            $product = $res->fetch_assoc();
            echo "<p>" . htmlspecialchars($product['name']) . " - Quantity: $qty</p>";
        }
    }
    ?>

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

$(document).ready(function () {

$.ajax({
        url: "order_edit_id_data.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
            if (data) {
                $("#id").val(data.shop_id);
                $("#scheme").val(data.scheme);
            }
        },
    });


  $("#profile-update-data").on("click", function (e) {
  e.preventDefault();

  let formData = $("#geoForm").serialize();

  $.ajax({
    url: "order_submit.php",
    type: "POST",
    data: formData,
    success: function (data) {
      alert("Order submitted successfully.");
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: ", status, error);
      alert("An error occurred.");
    }
  });
});
});


  </script>
</body>
</html>
