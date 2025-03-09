<?php
require 'db_connect.php'; // Include database connection

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['login_email']);
    $password = $_POST['login_password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    $hasspass =password_hash($password, PASSWORD_DEFAULT);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

       // die($user['password']);
      //  die($hasspass);
        if (password_verify($user['password'],$hasspass)) {
            echo "<script>alert('Login successful!'); window.location.href='welcome.php';</script>";
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('Email not registered!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #9face6);
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin-top: 100px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #333;
        }
        .form-control {
            border: 1px solid #9face6;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(156, 172, 230, 0.8);
            border-color: #9face6;
        }
        .btn-primary {
            background-color: #9face6;
            border: none;
        }
        .btn-primary:hover {
            background-color: #74ebd5;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Login Form</h2>
    <form method="POST">
        <div class="mb-3">
            <input type="email" name="login_email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="login_password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
