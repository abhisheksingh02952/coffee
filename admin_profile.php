<?php
include 'auth.php';
authorize('admin');
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
    input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }

    input[type=text]:focus,
    input[type=password]:focus {
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
      margin: 10px;
      float: right;
      background-color: rgb(71, 97, 211);
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
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

      include "admin_sidebar.php";

      ?>

      <!-- Form Content -->
      <main class="col-md-10 py-4">
        <form action="" method="POST">
          <div id="data" class="container">
            <h1>Employee Profile</h1>
            <hr>

            <input type="hidden" id="id" name="id">

            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name" required>

            <label for="phone"><b>Phone</b></label>
            <input type="text" placeholder="Enter Phone" name="phone" id="phone" required>

            <label for="email"><b>Email Id</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            <label for="address"><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" id="address" required>

            <label for="userid"><b>User Id</b></label>
            <input type="text" placeholder="Enter User ID" name="user_id" id="user_id" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>

            <label for="Pin Code"><b>Pin</b></label>
            <input type="text" placeholder="Enter pin" name="pin" id="pin" required>

            <div class="clearfix">
              <button type="submit" id="profile-update-data" class="update">Update</button>
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
        url: "profiledata.php",
        type: "POST",
        dataType: "json",
        success: function(data) {
          if (data) {
            $("#id").val(data.user_id);
            $("#name").val(data.name);
            $("#phone").val(data.phone);
            $("#email").val(data.email);
            $("#address").val(data.address);
            $("#location").val(data.location);
            $("#pin").val(data.pin);
            $("#user_id").val(data.user_id);
            $("#password").val(data.password);
          } else {
            alert("No data returned.");
          }
        },
      });
    });

    // Profile data update
    $("#profile-update-data").on("click", function(e) {
      e.preventDefault();
      var id = $('#id').val();
      var name = $('#name').val();
      var phone = $('#phone').val();
      var email = $('#email').val();
      var address = $('#address').val();
      var location = $('#location').val();
      var pin = $('#pin').val();
      var user_id = $('#user_id').val();
      var password = $('#password').val();

      $.ajax({
        url: "profileupdatedata.php",
        type: "POST",
        data: {
          id: id,
          name: name,
          phone: phone,
          email: email,
          address: address,
          location: location,
          pin: pin,
          user_id: user_id,
          password: password
        },
        success: function(data) {
          if (data) {
            alert("Data successfully updated");
          } else {
            alert("data not updated.");
          }
        },
      });
    });
  </script>
</body>

</html>