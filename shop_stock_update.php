<?php
include 'auth.php';
authorize('employee'); 
if (isset($_GET['shop_id'])) {
    $_SESSION['shop_id'] = $_GET['shop_id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
include "head.php";
?>


<style>
  html, body {
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
  gap: 20px; /* space between elements if needed */
}

/* Optional: make table scrollable if overflow occurs */
#usersTable {
  width: 100%;
  overflow-x: auto;
  display: block;
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

    <!-- Main Content Area -->
    <main class="col-md-10 ms-sm-auto px-4 py-4">
      <h2 class="mb-4">Shops Data And Stocks</h2>
      <table id="usersTable" class="display table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>Shop ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Pin Code</th>
            <th>Area</th>
            <th>Phone</th>
            <th>Scheme</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
      <div class="clearfix">
            <button type="button" class="update" onclick="window.location.href='profile.php'">Back</button>
      </div>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script>
$(document).ready(function() {
  $('#usersTable').DataTable({
    "ajax": "allshopdata.php",
    "columns": [
      { "data": "shop_id" },
      { "data": "name" },
      { "data": "address" },
      { "data": "pin" },
      { "data": "area" },
      { "data": "phone" },
      { "data": "scheme" },
      { "data": "latitude" },
      { "data": "longitude" },
      {
        data: null,
        render: function(data, type, row) {
        return `<a href="insert_stock_form.php?shop_id=${row.shop_id}&scheme=${row.scheme}" class="btn btn-sm btn-primary">Insert Stock</a>`;

        }
      }
    ]
  });
});

  </script>
</body>
</html>

