<?php
include 'auth.php';
authorize('admin');
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
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
      include "admin_sidebar.php";
   ?>

    <!-- Main Content Area -->
    <main class="col-md-10 ms-sm-auto px-4 py-4">
      <h2 class="mb-4">All Products</h2>
      <table id="userTable" class="display table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SKU ID</th>
            <th>Price</th>
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
        "ajax": "admin_all_products_data.php",
        "columns": [
          { "data": "id" },
          { "data": "name" },
          { "data": "sku" },
          { "data": "price" },
          {
            data: null,
            render: function(data, type, row) {
             return `<a href="admin_product_edit.php?id=${row.id}" class="btn btn-sm btn-primary">Edit</a>`;
            }
          }
        ]
      });
    });
  </script>
</body>
</html>








