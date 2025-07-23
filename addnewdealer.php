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
        width: 48%;
        font-size: 16px;
        transition: background-color 0.3s ease;
      }

      button.update:hover {
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
      include "sidebar.php";
    ?>

    <!-- Form Content -->
    <main class="col-md-10 py-4">
        <div class="clearfix"> 
            <button type="button" onclick="location.href='profile.php'" class="cancelbtn">Cancel</button>
        </div>
        
        <form action=""  method="POST" id="geoForm" enctype="multipart/form-data">
        <div id="data" class="container">
            <h1>Add New Shop</h1>
            <hr>

            <label for="Title"><b>Owner Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name" required><br>

            <label for="Title"><b>Owner Name Father Name</b></label>
            <input type="text" placeholder="Enter Name" name="fathername" id="fathername" required><br>

            <label for="gst"><b>GST NO</b></label>
            <input type="text" placeholder="Enter GST NO" name="gst" id="gst" required><br>

            <label for="phone"><b>Phone Number</b></label>
            <input type="text" placeholder="Enter Address" name="phone" id="phone" required><br>

            <label for="Address"><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="Address" id="Address" required><br>
            
            <label for="pin"><b>Pin</b></label>
            <input type="text" placeholder="Enter Pin code" name="Pin" id="Pin" required><br>

            <label for="area"><b>Area</b></label>
            <input type="text" placeholder="Enter Pin code" name="area" id="area" required><br>

            <label for="latitude"><b>Latitude</b></label>
            <input type="text" name="latitude" id="latitude" readonly><br>

            <label for="longitude"><b>Longitude</b></label>
            <input type="text" name="longitude" id="longitude" readonly><br>

            <label for="Title"><b>Scheme</b></label>
            <input type="text" placeholder="Enter Scheme Name" name="scheme" id="scheme" required><br>

            <div class="clearfix">
            <button type="submit" id="profile-update-data" class="update">Submiit</button>
            <button type="button" onclick="getLocation()" class="update">Get Geo Location</button>
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
    function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
        // ✅ Do NOT submit the form
        }, function (error) {
        alert("Error getting location: " + error.message);
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    }


      $(document).ready(function () {
        $("#geoForm").on("submit", function (e) {
          e.preventDefault(); 

          var formData = new FormData(this);

          $.ajax({
            url: "insert_dealers.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              alert(response); // or show a message in the page
              $("#geoForm")[0].reset(); // reset the form
            },
            error: function () {
              alert("Something went wrong!");
            }
          });
        });
      });


</script>
</body>
</html>


