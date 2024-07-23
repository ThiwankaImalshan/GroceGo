<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "grocgo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_email = ? AND customer_password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists and the password is correct
    if ($result->num_rows > 0) {
        // User authentication successful, set session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        
        // Set first login session variable
        if (!isset($_SESSION["first_login"])) {
            $_SESSION["first_login"] = true;
        }

        // Redirect the user to index.php
        header("location: index.php");
        exit;
    } else {
        // Invalid credentials, set loggedin to false and display an error message
        $_SESSION["loggedin"] = false;
        echo "<script>alert('Invalid email or password');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap");
        *{
            font-family: "Inter", sans-serif;
        }
        body{
            background:#eee;
        }
        .signin-popup-content{
            width:500px;
            height:500px;
        }
        .signin-popup-content h3{
            padding-left:30px;
        }
    </style>
</head>
<body>
    <div class="signin-popup" id="signin-popup" >
        <div class="signin-popup-content">
            <!-- <span class="signin-popup-close" id="signin-popup-close2">&times;</span> -->
            <h3>Sign In</h3>
            <form action="" method="post">

                <div class="form-field-wrapper">
                    <input type="text" id="login_email" name="login_email" placeholder="Email*" required/>
                </div>
                    
                <div class="form-field-wrapper">
                    <input type="password" id="login_password" name="login_password" placeholder="Password*" required/>
                </div>

           
            <div class="form-field-bottom">
                <div class="form-bottom-checkbox">
                    <!-- <input type="checkbox" name="" id=""><span class="form-bottom-checkbox-label">Remember me</span><br> -->
                </div>
                <button type="submit">Login</button><br><br>
                <!-- <span class="form-field-bottom-p">I don't have an account? <span id="switchToSignUp"><b>Sign Up</b></span></span> -->
            </div>
            </form>
        </div>
    </div>
</body>
</html>