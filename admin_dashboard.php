<?php
include 'auth.php';
authorize('admin');
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Org Chart</title>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <style>
    * { box-sizing: border-box }

    input[type=text], input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    #tree {
      width: 100%;
      height: 900px;
        padding: 20px;
    box-sizing: border-box;
    background-color: #f8f9fa;
      }

    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
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
      include "admin_sidebar.php";
    ?>
      <!-- Main Content -->
      <main class="col-md-10">
        
        <div id="tree"></div>
      </main>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <!-- OrgChart.js -->
  <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
  <script src="https://cdn.balkan.app/orgchart.js"></script>

  <script>
    fetch('google_data.php?reporting_id=<?= $_SESSION['user_id'] ?>') 
      .then(res => res.json())
      .then(data => {
        new OrgChart(document.getElementById("tree"), {
          nodes: data,
          collapse: { level: 2, allChildren: true },
          showXScroll: true,
          showYScroll: true,
          template: 'polina',
          nodeBinding: {
            field_0: "name",
            field_1: "position",
           
          },
          toolbar: {
            layout: true,
            zoom: true,
            fit: true,
            expandAll: false,
            fullScreen: true
          }
        });
      })
   .catch(error => console.error("Error loading org chart:", error));

  </script>
</body>

</html>