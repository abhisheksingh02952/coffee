<?php

include 'auth.php';
authorize('admin');

if (isset($_GET['id'])) {
  $_SESSION['user_id'] = $_GET['id'];
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
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 600px;
      margin: auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #444;
    }

    input[type="text"],
    input[type="password"],
    input[type="date"],
    input[type="number"],
    select,
    input[type="file"] {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: none;
      border-radius: 5px;
      background: #f1f1f1;
      transition: background-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="date"]:focus,
    input[type="number"]:focus,
    select:focus,
    input[type="file"]:focus {
      background-color: #e0e0e0;
      outline: none;
    }

    select {
      appearance: none;
      background-image: url('data:image/svg+xml;utf8,<svg fill="%23666" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
      background-repeat: no-repeat;
      background-position: right 10px center;
      background-size: 16px 16px;
    }

    button.update {
      background-color: #4761d3;
      color: white;
      border: none;
      padding: 14px 20px;
      margin: 10px 5px 0 0;
      border-radius: 5px;
      cursor: pointer;
      width: 30%;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    button.update:hover {
      background-color: #3749b5;
    }


    button {
      background-color: #4761d3;
      color: white;
      border: none;
      padding: 14px 20px;
      margin: 10px 5px 0 0;
      border-radius: 5px;
      cursor: pointer;
      width: 30%;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    button.delete {
      background-color: #d9534f;
      /* Bootstrap's red */
      color: white;
      border: none;
      padding: 14px 20px;
      margin: 10px 5px 0 0;
      border-radius: 5px;
      cursor: pointer;
      width: 30%;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    button.delete:hover {
      background-color: #c9302c;
    }

    button:hover {
      background-color: #3749b5;
    }

    .clearfix {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    @media (max-width: 600px) {
      button.update {
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

      <?php
      include "admin_sidebar.php";
      ?>

      <!-- Form Content -->
      <main class="col-md-10 py-4">

        <form action="" method="POST" id="geoForm" enctype="multipart/form-data">
          <div id="data" class="container">
            <h1>Update Employee Data</h1>
            <hr>

            <input type="hidden" name="id" id="id">

            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name" required><br>

            <label for="name"><b>Reporting Person id</b></label>
            <input type="text" placeholder="Enter Reporting ID" name="reporting_id" id="reporting_id" required><br>

            <label for="name"><b>Father's Name</b></label>
            <input type="text" placeholder="Enter Father's Name" name="fathername" id="fathername" required><br>

            <label for="name"><b>Mother's Name</b></label>
            <input type="text" placeholder="Enter Mother's Name" name="mothername" id="mothername" required><br>

            <label for="phone"><b>Phone Number</b></label>
            <input type="number" placeholder="Enter Phone Number" name="phone" id="phone" required><br>

            <label for="email"><b>Email Id</b></label>
            <input type="text" placeholder="Enter Email Id" name="email" id="email" required><br>

            <label for="Address"><b>Address</b></label>
            <input type="text" name="Address" id="Address"><br>

            <label for="pin"><b>Pin</b></label>
            <input type="number" name="Pin" id="Pin"><br>

            <label for="UserName"><b>UserName</b></label>
            <input type="text" name="username" id="username" required><br>

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" id="password" required><br>

            <label for="dob"><b>Date of Birth</b></label>
            <input type="date" name="dob" id="dob" required><br>

            <label for="gender"><b>Choose a Gender:</b></label>
            <select id="gender" name="gender" class="select">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Transgender">Transgender</option>
            </select><br>

            <label for="position"><b>Choose Employee Position:</b></label>
            <select id="position" name="position" class="select">
              <option value="Territory Sales Executive">Territory Sales Executive</option>
              <option value="Distributor">Distributor</option>
              <option value="Distributor Sales">Distributor Sales</option>
              <option value="Retailer">Retailer</option>
              <option value="Admin">Admin</option>
            </select><br>

            <label for="role"><b>Choose Portal Access:</b></label>
            <select id="role" name="role" class="role">
              <option value="admin">Admin</option>
              <option value="employee">Employee</option>
            </select><br>

            <div class="clearfix">
              <button type="button" id="delete-employee" class="delete">Delete</button>
              <button type="button" onclick="location.href='admin_allemployee.php'" class="cancelbtn">Cancel</button>
              <button type="submit" id="admin-add-employee-data" class="update">Submit</button>
            </div>
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
      // Load employee data
      $.ajax({
        url: "admin_employee_edit_data.php",
        type: "POST",
        dataType: "json",
        success: function(data) {
          if (data) {
            $("#id").val(data.user_id);
            $("#reporting_id").val(data.reporting_id);
            $("#name").val(data.name);
            $("#fathername").val(data.fathername);
            $("#mothername").val(data.mothername);
            $("#phone").val(data.phone);
            $("#email").val(data.email);
            $("#Address").val(data.address);
            $("#Pin").val(data.pin);
            $("#username").val(data.username);
            $("#password").val(data.password);
            $("#dob").val(data.dob);
            $("#gender").val(data.gender);
            $("#position").val(data.position);
            $("#role").val(data.role);
          }
        },
      });

      // Update on submit
      $("#admin-add-employee-data").on("click", function(e) {
        e.preventDefault();

        var formData = new FormData($('#geoForm')[0]);

        $.ajax({
          url: "admin-update-employee-data.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            alert("Employee updated successfully!");
            window.location.href = 'admin_allemployee.php';
          },
          error: function(xhr, status, error) {
            console.error("Update failed:", status, error);
            alert("Failed to update employee.");
          }
        });
      });

      // Delete button handler
      $("#delete-employee").on("click", function() {
        if (confirm("Are you sure you want to delete this employee?")) {
          const id = $("#id").val();

          $.ajax({
            url: "admin-delete-employee.php", // Create this PHP file
            type: "POST",
            data: {
              user_id: id
            },
            success: function(response) {
              alert("Employee deleted successfully!");
              window.location.href = 'admin_allemployee.php';
            },
            error: function() {
              alert("Failed to delete employee.");
            }
          });
        }
      });

    });
  </script>
</body>

</html>