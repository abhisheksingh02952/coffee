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
     * {box-sizing: border-box}

          /* Full-width input fields */
            input[type=text], input[type=password], input[type=date] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
          }

          input[type=text]:focus, input[type=password]:focus,  input[type=date]:focus{
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
                  background-color:rgb(71, 97, 211);
                  color: white;
                  padding: 14px 20px;
                  margin: 8px 0;
                  border: none;
                  cursor: pointer;
                  width: 20%;
                  opacity: 0.9;
                }

          button:hover {
            opacity:1;
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

          /* Extra styles for the cancel button */
          .update {
            text-align: center;
                  margin: 10px;
                  padding: 14px 20px;
                  background-color:rgb(71, 97, 211);
          }

          .cancelbtn {
            text-align: center;
                  margin: 10px;
                  padding: 14px 20px;
                  background-color:rgb(71, 97, 211);
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

          /* Change styles for cancel button and signup button on extra small screens */
          @media screen and (max-width: 300px) {
            .cancelbtn, .update {
              width: 100%;
            }
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

      include "sidebar.php";

   ?>

    <!-- Form Content -->
    <main class="col-md-10 py-4">
        
      <form action="" method="POST">
        <div id="data" class="container">
          <h1>Add New Task </h1>
          <hr>

        
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
            <button type="submit" id="profile-update-data" class="update">Add New Task</button>
            <button type="button" onclick="location.href='task.php'" class="cancelbtn">Cancel</button>
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

         // Profile data update
     $("#profile-update-data").on("click", function(e) {
        e.preventDefault();
    var Title = $('#Title').val();
    var Description = $('#Description').val();
    var AssignDate = $('#AssignDate').val();
    var TimelineDate = $('#TimelineDate').val();
    var Status = $('#Status').val();
    
        $.ajax({
            url: "newtaskdata.php",
            type: "POST",
            data: { Title: Title, Description: Description, AssignDate: AssignDate, TimelineDate: TimelineDate, Status: Status },
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


