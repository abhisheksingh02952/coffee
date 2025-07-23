<?php
include 'auth.php';
authorize('employee'); 
if (isset($_GET['id'])) {
    $_SESSION['task_id'] = $_GET['id'];
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
    <main class="col-md-10 ms-sm-auto px-4 py-4 col-md-10">
      <div class="clearfix">  
            <button type="button" onclick="location.href='newtask.php'" class="newtask" >New Task</button>
          </div>
      <h2 class="mb-4">Task Dashboard</h2>
      <table id="taskTable" class="display table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title </th>
            <th>Description</th>
            <th>Assign Date</th>
            <th>Timeline Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
      <div class="clearfix">
            <button type="button" class="update" onclick="window.location.href='profile.php'">Back</button>
      </div>
    </main>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="..."></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<<script>
  $(document).ready(function() {
    $('#taskTable').DataTable({
      "ajax": "taskdata.php",
      "columns": [
        { "data": "id" },
        { "data": "Title" },
        { "data": "Description" },
        { "data": "Assign_Date" },
        { "data": "Timeline_Date" },
        { "data": "Status" },
        {
          data: null,
          render: function(data, type, row) {
            return `<a href="edit.php?id=${row.id}" class="btn btn-sm btn-primary">Edit</a>`;
          }
        }
      ]
    });
  });
</script>
</body>
</html>

