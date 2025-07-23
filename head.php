<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP</title>
  <link rel="stylesheet" href="css/style.css">
  <!-- Bootstrap 5 CSS CDN -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
     * {box-sizing: border-box}

      /* Full-width input fields */
        input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
      }

      input[type=text]:focus, input[type=password]:focus {
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
        width: 12%;
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

      .show_attendances {
        text-align: center;
        margin: 10px;
        padding: 14px 20px;
        background-color:rgb(71, 97, 211);
      }

       .show_attendances {
        text-align: center;
        margin: 10px;
        padding: 14px 20px;
        background-color:rgb(71, 97, 211);
      }

       .log-locations {
        text-align: center;
        margin: 10px;
        padding: 14px 20px;
        background-color:rgb(71, 97, 211);
      }

      /* Extra styles for the cancel button */
      .Distributor {
        text-align: center;
        margin: 10px;
        padding: 14px 20px;
        background-color:rgb(71, 97, 211);
      }

      .table_data {
        border-collapse: collapse;
        width: 100%;
      }

      .table_data th  {
        text-align: center;
        padding: 10px;
        border: 1px solid #ddd; /* Optional: adds visible borders */
        }

      .table_data td {
        text-align: center;
        padding: 10px;
        border: 1px solid #ddd; /* Optional: adds visible borders */
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

      .updates {
        display: inline-block;
        float: left;
        margin: 5px;
        background-color: rgb(71, 97, 211);
        color: white;
        padding: 14px 20px;
        border: none;
        cursor: pointer;
        width: 12%;
        opacity: 0.9;
        text-align: center;
      }


      .updates:hover {
        opacity:1;
      }

</style>