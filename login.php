<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
        body {
        background: linear-gradient(to right, #4facfe, #00f2fe);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .login-box {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        }

        .login-box h2 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
        }

        .form-control:focus {
        box-shadow: none;
        border-color: #4facfe;
        }

        .btn-primary {
        background-color: #4facfe;
        border: none;
        }

        .btn-primary:hover {
        background-color: #00c6ff;
        }

        .text-muted {
        font-size: 0.9rem;
        }

        @media (max-width: 576px) {
        .login-box {
            padding: 25px;
        }
        }
  </style>
</head>

<body>

  <div class="login-box">
    <h2>Login</h2>
    <form action="login.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username or Email</label>
        <input type="text" name="username" class="form-control" id="username" required />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required />
      </div>

      <div class="d-grid mb-3">
        <button type="submit" id="loginForm" class="btn btn-primary">Login</button>
      </div>

      <div class="text-center">
        <a href="#" class="text-muted">Forgot password?</a><br>
      </div>
    </form>
  </div>

        <div id="response"></div>
  <!-- Bootstrap JS (optional for form enhancement) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
    $('form').on('submit', function(e) {
        e.preventDefault();
        var username = $('#username').val(); 
        var password = $('#password').val();

        $.ajax({
            url: 'logindata.php',
            type: 'POST',
            dataType: 'json', // This is important!
            data: { username: username, password: password },
            success: function(response) {
                if(response.status === 'success') {
                    if(response.position === "Admin") {
                        window.location.href = 'admin_profile.php';
                    } else {
                        window.location.href = 'dashboard.php';
                    }
                } else {
                    $('#response').html('<p class="text-danger">' + response.message + '</p>');
                }
            },
        });
    });
});

</script>

</body>
</html>
