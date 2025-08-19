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

  /* Flex container for DataTable */
  .datatable-flex-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    overflow-x: auto;
  }

  /* Make the table itself scrollable if needed */
  #userTable {
    display: block;
    width: 100%;
    overflow-x: auto;
  }

  /* Action column cell styling using Flexbox */
  .action-cell {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    min-width: 120px; /* Ensures consistent width */
  }

  .action-cell .btn {
    white-space: nowrap;
    padding: 6px 12px;
  }

    button.update {
            background-color: #4761d3;
            color: white;
        }

        button.update:hover {
            background-color: #3749b5;
        }

        button.cancelbtn {
            background-color: #6c757d;
            color: white;
        }

        button.cancelbtn:hover {
            background-color: #5a6268;
        }

        button.deletebtn {
            background-color: #d9534f;
            color: white;
        }

        button.deletebtn:hover {
            background-color: #c9302c;
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

    /* Child Elements */
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

    /* 🟡 Extra Small Devices (Phones, ≤ 480px) */
    @media (max-width: 480px) {
      .clearfix {
        flex-direction: column;
        align-items: stretch;
      }

      .clearfix > * {
        width: 100%;
        margin-bottom: 10px;
      }
    }

    /* 🟡 Small Devices (Phones Landscape, ≤ 600px) */
    @media (max-width: 600px) {
      .clearfix {
        flex-direction: column;
        justify-content: flex-start;
      }

      .clearfix > * {
        width: 100%;
        margin-bottom: 10px;
      }
    }

    /* 🟠 Medium Devices (Tablets, 601px - 768px) */
    @media (min-width: 601px) and (max-width: 768px) {
      .clearfix {
        flex-direction: row;
        justify-content: center;
      }

      .clearfix > * {
        flex: 1 1 45%;
        margin: 10px;
      }
    }

    /* 🔵 Large Devices (Small Desktops, 769px - 1024px) */
    @media (min-width: 769px) and (max-width: 1024px) {
      .clearfix {
        flex-direction: row;
        justify-content: space-around;
      }

      .clearfix > * {
        flex: 1 1 30%;
      }
    }

    /* 🟣 Extra Large Devices (Desktops, > 1024px) */
    @media (min-width: 1025px) {
      .clearfix {
        flex-direction: row;
        justify-content: space-between;
      }

      .clearfix > * {
        flex: 1 1 20%;
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
      <h2 class="mb-4">All Orders</h2>

      <div class="datatable-flex-container">
        <table id="userTable" class="display table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>Reporting ID</th>
              <th>Shop ID</th>
              <th>Order ID</th>
              <th>Scheme</th>
              <th>Payment Type</th>
              <th>Payment Status</th>
              <th>Total Amount</th>
              <th>Date</th>
              <th>Payment Date</th>
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
      "ajax": "admin_allorderdata.php",
      "columns": [
        { "data": "employee_id" },
        { "data": "shop_id" },
        { "data": "order_id" },
        { "data": "scheme" },
        { "data": "payment_type" },
        { "data": "payment_status" },
        { "data": "total_amount" },
        { "data": "date" },
        { "data": "payment_date" }
      ]
    });
  });
</script>
</body>
</html>
