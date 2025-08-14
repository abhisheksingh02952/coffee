<?php
include 'auth.php';
authorize('admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "head.php"; ?>
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
  .datatable-flex-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    overflow-x: auto;
  }
  #userTable {
    display: block;
    width: 100%;
    overflow-x: auto;
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
  @media (max-width: 600px) {
    .clearfix {
      flex-direction: column;
      align-items: stretch;
    }
    .clearfix > * {
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
    <?php include "admin_sidebar.php"; ?>

    <!-- Main Content Area -->
    <main class="col-md-10 ms-sm-auto px-4 py-4">
      <h2 class="mb-4">All Shops Details</h2>

      <div class="datatable-flex-container">
        <table id="userTable" class="display table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>Shop ID</th>
              <th>Reporting Person ID</th>
              <th>Name</th>
              <th>Father's Name</th>
              <th>GST Number</th>
              <th>Phone Number</th>
              <th>Address</th>
              <th>Pin</th>
              <th>Area</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>Scheme</th>
            </tr>
          </thead>
        </table>
      </div>

      <div class="clearfix">
        <button type="button" class="update" onclick="window.location.href='admin_profile.php'">Back</button>
      </div>
    </main>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#userTable').DataTable({
      "ajax": "admin_allshopingdata.php",
      "columns": [
        { "data": "shop_id" },
        { "data": "reporting_id" },
        { "data": "name" },
        { "data": "fathername" },
        { "data": "gst" },
        { "data": "phone" },
        { "data": "address" },
        { "data": "pin" },
        { "data": "area" },
        { "data": "latitude" },
        { "data": "longitude" },
        { "data": "scheme" }
      ]
    });
  });
</script>
</body>
</html>
