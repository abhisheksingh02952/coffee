<?php
include 'auth.php';
authorize('employee');
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
  font-family: "Segoe UI", Roboto, Arial, sans-serif;
  margin: 0;
  padding: 0;
}

/* ===== General Body ===== */
body {
  background: #f4f6f9;
  color: #333;
  line-height: 1.6;
}

/* ===== Form Container ===== */
.container {
  padding: 20px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.08);
  margin: 20px auto;
  max-width: 100%;
}

h1 {
  font-size: 1.8rem;
  font-weight: 600;
  margin-bottom: 15px;
  text-align: center;
  color: #333;
}

hr {
  border: 0;
  height: 1px;
  background: #eee;
  margin: 15px 0;
}

/* ===== Input Fields ===== */
input[type=text],
input[type=password] {
  width: 100%;
  padding: 12px 15px;
  margin: 8px 0 18px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 6px;
  background: #f9f9f9;
  transition: all 0.3s ease;
}

input[type=text]:focus,
input[type=password]:focus {
  background-color: #fff;
  border-color: #4761d3;
  box-shadow: 0 0 6px rgba(71, 97, 211, 0.3);
  outline: none;
}

/* ===== Buttons ===== */
button,
a.button {
  display: inline-block;
  text-align: center;
  color: white;
  background-color: #4761d3;
  text-decoration: none;
  padding: 12px 20px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-weight: 500;
  transition: all 0.3s ease;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
}

button:hover,
a.button:hover {
  background-color: #3749b5;
  transform: translateY(-2px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

/* Cancel / Delete Buttons */
button.cancelbtn { background-color: #6c757d; }
button.cancelbtn:hover { background-color: #5a6268; }
button.deletebtn { background-color: #d9534f; }
button.deletebtn:hover { background-color: #c9302c; }

/* ===== Flexbox Button Area ===== */
.clearfix {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: flex-end;
  margin-top: 20px;
}

/* ===== Sidebar Styling ===== */
#sidebar {
  min-height: 100vh;
  background: #343a40;
  padding-top: 20px;
  transition: all 0.3s ease;
}

#sidebar .nav-link {
  color: #ddd;
  padding: 12px 20px;
  display: block;
  border-radius: 6px;
  margin: 4px 10px;
  transition: all 0.3s ease;
}

#sidebar .nav-link.active,
#sidebar .nav-link:hover {
  background-color: #495057;
  color: #ffc107 !important;
  transform: translateX(4px);
}

/* ===== RESPONSIVE BREAKPOINTS ===== */

/* Phones (≤ 480px) */
@media (max-width: 480px) {
  .container { width: 95%; padding: 15px; }
  h1 { font-size: 1.5rem; }
  .clearfix { flex-direction: column; align-items: stretch; }
  .clearfix > * { width: 100%; }
  #sidebar { 
    position: fixed; 
    width: 70%; 
    left: -100%; 
    top: 0; 
    z-index: 1000; 
  }
  #sidebar.active { left: 0; }
}

/* Tablets (481px - 768px) */
@media (min-width: 481px) and (max-width: 768px) {
  .container { width: 85%; }
  .clearfix { justify-content: center; }
  .clearfix > * { flex: 1 1 45%; }
}

/* Small Desktops (769px - 1024px) */
@media (min-width: 769px) and (max-width: 1024px) {
  .container { width: 70%; }
  .clearfix { justify-content: space-around; }
  .clearfix > * { flex: 1 1 30%; }
}

/* Large Desktops (≥ 1025px) */
@media (min-width: 1025px) {
  .container { width: 550px; }
  .clearfix { justify-content: flex-end; }
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
        <form method="POST" id="geoForm" enctype="multipart/form-data">
          <div class="container">
            <h1>Employee Profile</h1>
            <hr>
            <input type="hidden" id="id" name="id">

            <!-- Name -->
            <label for="name"><b>Name</b></label>
            <input type="text" name="name" id="name" required>

            <!-- Phone -->
            <label for="phone"><b>Phone</b></label>
            <input type="text" name="phone" id="phone" required>

            <!-- Email -->
            <label for="email"><b>Email Id</b></label>
            <input type="text" name="email" id="email" required>

            <!-- Optional: Location -->
            <label for="location"><b>Location</b></label>
            <input type="text" name="location" id="location">

            <!-- User ID -->
            <label for="user_id"><b>User Id</b></label>
            <input type="text" name="user_id" id="em_user_id" required>

            <!-- Password -->
            <label for="password"><b>Password</b></label>
            <input type="password" name="password" id="password" required>

            <!-- Pin -->
            <label for="pin"><b>Pin</b></label>
            <input type="text" name="pin" id="pin" required>

            <div class="clearfix">
              <button type="submit" class="update">Update</button>
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
            $("#em_user_id").val(data.user_id);
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
      var em_user_id = $('#em_user_id').val();
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
          em_user_id: em_user_id,
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