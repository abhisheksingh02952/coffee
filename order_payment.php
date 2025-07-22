<?php
include 'auth.php';
authorize('employee'); 
if (isset($_GET['order_id'])) {
    $_SESSION['order_id'] = $_GET['order_id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
include "head.php";
?>
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
      <h2 class="mb-4">All Orders Data</h2>
      <table id="usersTable" class="display table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Shop ID</th>
            <th>Total Amount</th>
            <th>Payment Type</th>
            <th>Payment Status</th>
            <th>order_date</th>
            <th>Collection Employee ID</th>
            <th>Collection Employee Date</th>
            <th>Remarks</th>
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
    "ajax": "order_payment_show.php",
    "columns": [
      { "data": "order_id" },
      { "data": "shop_id" },
      { "data": "amount" },
      { "data": "payment_type" },
      { "data": "payment_status" },
      { "data": "order_date" },
      { "data": "employee_id" },
      { "data": "collection_date" },
      { "data": "remarks" },
      {
        data: null,
        render: function(data, type, row) {
         return `<a href="order_payment_update.php?order_id=${row.order_id}" class="btn btn-sm btn-primary">Edit Payment</a>`;
        }
      }
    ]
  });
});

  </script>
</body>
</html>

