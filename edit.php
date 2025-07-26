<?php

include 'auth.php';
authorize('employee');

if (isset($_GET['id'])) {
  $_SESSION['task_id'] = $_GET['id'];
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
      box-sizing: border-box
    }

    /* Full-width input fields */
    input[type=text],
    input[type=password],
    input[type=date] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }

    input[type=text]:focus,
    input[type=password]:focus,
    input[type=date]:focus {
      background-color: #ddd;
      outline: none;
    }

    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    /* Set a style for all buttons */
    button {
      text-align: center;
      float: right;
      margin: 10px;
      background-color: rgb(71, 97, 211);
      color: white;
      padding: 14px 20px;
      border: none;
      cursor: pointer;
      width: 20%;
      opacity: 0.9;
    }

    button:hover {
      opacity: 1;
    }

    a.button {
      display: inline-block;
      text-align: center;
      color: white;
      text-decoration: none;
      padding: 14px 20px;
      margin: 8px 0;
      width: 100%;
    }


    /* Add padding to container elements */
    .container {
      padding: 16px;
    }

    /* Clear floats */
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
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

    /* Responsive */
    @media (max-width: 600px) {
      .clearfix {
        flex-direction: column;
      }

      button {
        width: 100%;
      }
    }

    #sidebar {
      min-height: 100vh;
    }

    .nav-link.active,
    .nav-link:hover {
      background-color: #495057;
      color: #ffc107 !important;
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
      <?php

      include "sidebar.php";

      ?>
      <!-- Form Content -->
      <main class="col-md-10 py-4">

        <form action="" method="POST">
          <div id="data" class="container">
            <h1>Edit Task Data</h1>
            <hr>

            <input type="hidden" id="id" name="id">

            <label for="name"><b>Title</b></label>
            <input type="text" placeholder="Enter Name" name="Title" id="Title" required>

            <label for="phone"><b>Description</b></label>
            <input type="text" placeholder="Enter Phone" name="Description" id="Description" required>

            <label for="date"><b>Assign Date</b></label>
            <input type="date" placeholder="Enter Email" name="AssignDate" id="AssignDate" required>

            <label for="Date"><b>Timeline Date</b></label>
            <input type="date" placeholder="Enter Address" name="TimelineDate" id="TimelineDate" required>

            <label for="Status"><b>Status</b></label>
            <input type="text" placeholder="Enter User ID" name="Status" id="Status" required>

            <div class="clearfix">
              <button type="button" class="update" onclick="window.location.href='task.php'">Cancel</button>
              <button type="button" id="profile-update-data" class="update">Update</button>
            </div>
            <td id="table-data"></td>
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
    $(document).ready(function() {
      $.ajax({
        url: "editdata.php",
        type: "POST",
        dataType: "json",
        success: function(data) {
          if (data) {
            $("#id").val(data.id);
            $("#Title").val(data.Title);
            $("#Description").val(data.Description);
            $("#AssignDate").val(data.Assign_Date);
            $("#TimelineDate").val(data.Timeline_Date);
            $("#Status").val(data.Status);
          } else {
            alert("No data returned.");
          }
        },
      });

      // Profile data update
      $("#profile-update-data").on("click", function(e) {
        e.preventDefault();
        var id = $('#id').val();
        var Title = $('#Title').val();
        var Description = $('#Description').val();
        var AssignDate = $('#AssignDate').val();
        var TimelineDate = $('#TimelineDate').val();
        var Status = $('#Status').val();

        $.ajax({
          url: "editupdatedata.php",
          type: "POST",
          data: {
            id: id,
            Title: Title,
            Description: Description,
            AssignDate: AssignDate,
            TimelineDate: TimelineDate,
            Status: Status
          },
          success: function(data) {
            if (data) {
              alert("Data successfully updated");
              window.location.href = 'task.php';
            } else {
              alert("data not updated.");
            }
          },
        });
      });
    });
  </script>
</body>

</html>