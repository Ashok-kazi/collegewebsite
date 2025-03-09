<?php
require 'db_connect.php'; // Include database connection

// Handle form submission
if (isset($_POST['register'])) {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $dob = $_POST['dob'];
    $address = htmlspecialchars($_POST['address']);
    $email = htmlspecialchars($_POST['email']);
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, dob, address, email, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $dob, $address, $email, $gender, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='signup.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #9face6);
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #333;
        }
        .form-control, .form-check-input {
            border: 1px solid #9face6;
        }
        .form-control:focus, .form-check-input:focus {
            box-shadow: 0 0 5px rgba(156, 172, 230, 0.8);
            border-color: #9face6;
        }
        .btn-success {
            background-color: #9face6;
            border: none;
        }
        .btn-success:hover {
            background-color: #74ebd5;
        }
        label {
            font-weight: 500;
            color: #555;
        }
        .form-check-label {
            margin-right: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Signup Form</h2>
    <form method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" id="dob" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control" id="address" required></textarea>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <div>
                <input type="radio" name="gender" value="Male" class="form-check-input" id="male" required>
                <label for="male" class="form-check-label">Male</label>

                <input type="radio" name="gender" value="Female" class="form-check-input" id="female" required>
                <label for="female" class="form-check-label">Female</label>

                <input type="radio" name="gender" value="Other" class="form-check-input" id="other" required>
                <label for="other" class="form-check-label">Other</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button type="submit" name="register" class="btn btn-success w-100">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
