<?php
include 'auth.php';
authorize('employee'); 
if (isset($_GET['id'])) {
    $_SESSION['dealer_id'] = $_GET['id'];
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
      <h2 class="mb-4">Wholesaler Data</h2>
      <table id="userTable" class="display table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>GST NO</th>
            <th>Address</th>
            <th>Pin Code</th>
            <th>Onboarding Date</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Image</th>
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
      $('#userTable').DataTable({
        "ajax": "Wholesalerdata.php",
        "columns": [
          { "data": "dealer_id" },
          { "data": "dealer_name" },
          { "data": "dealer_gst_no" },
          { "data": "dealer_address" },
          { "data": "dealer_pin" },
          { "data": "dealer_onboarding_date" },
          { "data": "dealer_latitude" },
          { "data": "dealer_longitude" },
          {
            "data": "dealer_image",
            "render": function(data) {
              return `<img src="${data}" width="50" height="50" alt="image">`;
            }
          },
          {
            data: null,
            render: function(data, type, row) {
             return `<a href="dealer_edit.php?id=${row.dealer_id}" class="btn btn-sm btn-primary">Edit</a>`;
            }
          }
        ]
      });
    });
  </script>
</body>
</html>








