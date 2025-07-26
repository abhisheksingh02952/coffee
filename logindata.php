<?php

session_start();

include 'db.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    

    $sql = "SELECT * FROM employees WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql) or die("Query Error");

      if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result); // Fetch the user data

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['reporting_id'] = $user['reporting_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['position'] = $user['position'];
        $_SESSION['user_role'] = $user['role'];

        echo json_encode([
                'status' => 'success',
                'position' => $user['position']
            ]);
            exit;
    } else {
        echo 'Invalid username or password';
    }
}

?>