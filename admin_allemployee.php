<?php
include 'auth.php';
authorize('admin');
if (isset($_GET['id'])) {
    $_SESSION['user_id'] = $_GET['id'];
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
      <h2 class="mb-4">All Employees </h2>
      <table id="userTable" class="display table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Reporting Person ID</th>
            <th>Name</th>
            <th>Father's Name</th>
            <th>Mother's Name</th>
            <th>Phone Number</th>
            <th>Email Id</th>
            <th>Address</th>
            <th>Pin</th>
            <th>UserName</th>
            <th>Password</th>
            <th>Portal Access</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Position</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
      <div class="clearfix">
            <button type="button" class="update" onclick="window.location.href='admin_profile.php'">Back</button>
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
    "ajax": "admin_allemployeedata.php",
    "columns": [
    { "data": "user_id" },
    { "data": "reporting_id" },
    { "data": "name" },
    { "data": "fathername" },
    { "data": "mothername" },
    { "data": "phone" },
    { "data": "email" },
    { "data": "address" },
    { "data": "pin" },
    { "data": "username" },
    { "data": "password" },
    { "data": "role" },    
    { "data": "dob" },
    { "data": "gender" },
    { "data": "position" },
    {
        "data": "image",
        "render": function(data) {
            return `<img src="uploads/${data}" width="50" height="50" alt="image">`;
        }
    },
    {
        data: null,
        render: function(data, type, row) {
            return `<a href="admin_employee_edit.php?id=${row.user_id}" class="btn btn-sm btn-primary">Edit</a>`;
        }
    }
]
    });
});

  </script>
</body>
</html>

