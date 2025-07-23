<?php

include 'auth.php';
authorize('admin');

if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
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

      @media (max-width: 600px) {
        button.update {
          width: 100%;
          margin-bottom: 10px;
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

    <!-- Form Content -->
    <main class="col-md-10 py-4">
        
        <form action=""  method="POST" id="geoForm" enctype="multipart/form-data">
        <div id="data" class="container">
            <h1>Update Products Data</h1>
            <hr>

             <input type="hidden" name="id" id="id">

             <label for="name"><b>Enter Product Name</b></label>
            <input type="text" placeholder="Enter Product Name" name="name" id="name" required><br>

            <label for="name"><b>Enter SKU ID</b></label>
            <input type="text" placeholder="Enter SKU ID" name="sku" id="sku" required><br>

            <label for="name"><b>Enter Product Price</b></label>
            <input type="number" placeholder="Enter Product Price" name="price" id="price" required><br>

            <div class="clearfix">
                 <button type="button" onclick="location.href='admin_allemployee.php'" class="cancelbtn">Cancel</button>
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

   $(document).ready(function () {
    // Load employee data
    $.ajax({
        url: "admin_product_edit_data.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
            if (data) {
                $("#id").val(data.id);
                $("#name").val(data.name);
                $("#sku").val(data.sku);
                $("#price").val(data.price);                
            }
        },
    });

    // Update on submit
    $("#admin-add-employee-data").on("click", function (e) {
        e.preventDefault();

        var formData = new FormData($('#geoForm')[0]);

        $.ajax({
            url: "admin-product-update-data.php", 
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert("Employee updated successfully!");
                window.location.href = 'admin_allemployee.php';
            },
        });
    });
});

</script>
</body>
</html>


