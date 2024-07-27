<?php
session_start();
require 'config.php'; // Include the database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM delivers WHERE deliver_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Directly compare the password
        if (strcmp($password, $user['deliver_password']) === 0 && strcmp($username, $user['deliver_name']) === 0) {
            $_SESSION['deliver_name'] = $user['deliver_name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic Reset */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signin-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        .logo img {
            width: 150px; /* Adjust size as needed */
            margin-bottom: 5px;
        }

        .heading {
            font-size: 26px;
            margin-bottom: 30px;
            color: black;
        }

        .signin-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
            margin-right: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .signin-button {
            background-color: #51ac37; /* Green color */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .signin-button:hover {
            background-color: green; /* Lighter green */
        }

        .signin-button:active {
            background-color: #1e4b00; /* Darker green */
        }

        .register-link {
            margin-top: 20px;
        }

        .register-link a {
            color: #2f5e00; /* Blue color */
            text-decoration: none;
            font-weight: bold;
        }
        .register-link a:hover{
            color: #51ac37;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .signin-container {
                padding: 15px;
                max-width: 90%;
            }

            .logo img {
                width: 60px; /* Smaller logo for smaller screens */
            }

            .heading {
                font-size: 20px; /* Adjust heading size */
            }

            .form-group label {
                font-size: 13px; /* Smaller label text */
            }

            .form-group input {
                font-size: 14px; /* Smaller input text */
                padding: 8px; /* Adjust input padding */
            }

            .signin-button {
                font-size: 14px; /* Smaller button text */
                padding: 12px; /* Adjust button padding */
            }
        }

    </style>
</head>
<body>
    <div class="signin-container">
        <div class="logo">
            <img src="assets/img/logo-colored.png" alt="Deliver Dashboard Logo">
        </div>
        <h1 class="heading">Deliver Dashboard</h1>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form class="signin-form" method="POST" action="index.php">
            <div class="form-group">
                <!-- <label for="username">Username</label> -->
                <input type="text" id="username" name="username" placeholder="Username*" required>
            </div>
            <div class="form-group">
                <!-- <label for="password">Password</label> -->
                <input type="password" id="password" name="password" placeholder="Password*" required>
            </div>
            <button type="submit" class="signin-button">Sign In</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="#">Register here</a></p>
        </div>
    </div>
</body>
</html>
