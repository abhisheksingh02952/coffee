<?php
include 'auth.php';
authorize('admin');
?>
<!DOCTYPE html>
<html>

<head>
  <?php include "head.php"; ?>
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

    input:focus,
    select:focus {
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

    button {
      background-color: #4761d3;
      color: white;
      border: none;
      padding: 14px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #3749b5;
    }

    button.cancelbtn {
      background-color: #6c757d;
    }

    button.cancelbtn:hover {
      background-color: #5a6268;
    }

    button.deletebtn {
      background-color: #d9534f;
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

    .clearfix > * {
      flex: 1 1 auto;
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

    /* 📱 Extra Small Devices (Phones ≤ 480px) */
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

    /* 📱 Small Devices (Phones Landscape ≤ 600px) */
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

    /* 💻 Medium Devices (Tablets 601px - 768px) */
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

    /* 🖥️ Large Devices (Small Desktops 769px - 1024px) */
    @media (min-width: 769px) and (max-width: 1024px) {
      .clearfix {
        flex-direction: row;
        justify-content: space-around;
      }

      .clearfix > * {
        flex: 1 1 30%;
      }
    }

    /* 🖥️ Extra Large Devices (> 1024px) */
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
      <?php include "admin_sidebar.php"; ?>

      <main class="col-md-10 py-4">
        <form action="" method="POST" id="geoForm" enctype="multipart/form-data">
          <div id="data" class="container">
            <h1>Add New Employee</h1>
            <hr>

            <label for="reporting_id">Reporting Person ID</label>
            <input type="number" name="reporting_id" id="reporting_id" required>

            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>

            <label for="fathername">Father's Name</label>
            <input type="text" name="fathername" id="fathername" required>

            <label for="mothername">Mother's Name</label>
            <input type="text" name="mothername" id="mothername" required>

            <label for="phone">Phone Number</label>
            <input type="number" name="phone" id="phone" required>

            <label for="email">Email ID</label>
            <input type="text" name="email" id="email" required>

            <label for="Address">Address</label>
            <input type="text" name="Address" id="Address">

            <label for="Pin">Pin</label>
            <input type="number" name="Pin" id="Pin">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" required>

            <label for="gender">Gender</label>
            <select id="gender" name="gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Transgender">Transgender</option>
            </select>

            <label for="position">Employee Position</label>
            <select id="position" name="position">
              <option value="Territory Sales Executive">Territory Sales Executive</option>
              <option value="Distributor">Distributor</option>
              <option value="Distributorsales">Distributor Sales</option>
              <option value="Retailer">Retailer</option>
              <option value="admin">Admin</option>
            </select>

            <label for="role">Portal Access</label>
            <select id="role" name="role">
              <option value="admin">Admin</option>
              <option value="employee">Employee</option>
            </select>

            <div class="clearfix">
              <button type="button" onclick="location.href=''" class="cancelbtn">Cancel</button>
              <button type="submit" id="add-employee-data" class="update">Submit</button>
            </div>
          </div>
        </form>
      </main>
    </div>
  </div>

  <!-- JS & AJAX -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $("#add-employee-data").on("click", function(e) {
      e.preventDefault();

      var form = $('#geoForm')[0];
      var formData = new FormData(form);

      $.ajax({
        url: "admin_adminadd.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          alert("Employee added successfully!");
          $('#geoForm')[0].reset();
        },
        error: function(xhr, status, error) {
          alert("An error occurred: " + error);
        }
      });
    });
  </script>
</body>

</html>
