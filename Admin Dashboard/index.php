<?php

    require("login_connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- ----------------Styles---------- -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <style>
        /* -----------------Sign In-------------- */
        /* Container for the popup */
        .signInContainer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #eee; 
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Popup content */
        .signin-popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            height: 400px;
            text-align: center;
        }
        .signin-popup-content h3{
            margin-top: 20px;
            margin-bottom: 30px;
            font-size: 22px;
        }


        /* Form field wrapper */
        .form-field-wrapper {
            margin-bottom: 15px;
        }

        /* Input fields */
        input[type="text"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 0px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Checkbox and label */
        .form-bottom-checkbox {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-bottom-checkbox input {
            margin-right: 5px;
        }

        .form-bottom-checkbox-label {
            vertical-align: middle;
        }

        /* Button */
        button {
            width: 95%;
            padding: 10px;
            background-color: var(--lightGreen);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 50px;
            font-weight: 600;
        }

        button:hover {
            background-color: green;
        }

        /* Bottom text */
        .form-field-bottom-p {
            margin-top: 15px;
        }

        #switchToSignUp {
            color: green;
            cursor: pointer;
        }

        #switchToSignUp:hover {
            /* text-decoration: underline; */
            color: var(--lightGreen);
        }

    </style>
</head>
<body>
    <div class="signInContainer">
        <div class="signin-popup" id="signin-popup">
            <div class="signin-popup-content">
                <h3>Admin Login Panel</h3>
                <form method="POST" id="loginForm">
                    <div class="form-field-wrapper">
                        <input type="text" id="adminName" name="AdminName" placeholder="Admin Name*" />
                    </div>
                    <div class="form-field-wrapper">
                        <input type="password" id="password" name="AdminPassword" placeholder="Password*" />
                    </div>
                    <div class="form-field-bottom">
                        <button type="submit" name="Signin">Sign In</button><br><br>
                        <span class="form-field-bottom-p">Forgot Password? <span id="switchToSignUp" class="clickable"><b>Click here</b></span></span>
                    </div>
                </form>
            </div>
        </div>
    </div>




        <?php
            require("login_connection.php"); // Ensure you include the database connection

            if (isset($_POST['Signin'])) {
                // Escape user inputs to prevent SQL injection
                $adminName = mysqli_real_escape_string($con, $_POST['AdminName']);
                $adminPassword = mysqli_real_escape_string($con, $_POST['AdminPassword']);

                // Query to fetch admin details
                $query = "SELECT Admin_Id FROM admin_login WHERE Admin_Name='$adminName' AND Admin_Password='$adminPassword'";
                $result = mysqli_query($con, $query);

                // Check if exactly one row is returned
                if (mysqli_num_rows($result) == 1) {
                    session_start();
                    
                    // Fetch the admin ID
                    $row = mysqli_fetch_assoc($result);
                    $adminId = $row['Admin_Id'];

                    // Set session variables
                    $_SESSION['Admin_Id'] = $adminId;
                    $_SESSION['Admin_Name'] = $adminName; // Optionally store the name for display purposes
                    $_SESSION['AdminLoginId'] = $adminName;

                    // Redirect to admin panel
                    header("Location: admin_panel.php");
                    exit(); // Ensure no further code is executed after redirection
                } else {
                    echo "<script>alert('Incorrect User Name or Password');</script>";
                }
            }
        ?>


    <script>
        document.getElementById('switchToSignUp').onclick = function() {
            window.location.href = 'index_password_update.php';
        };
    </script>
</body>
</html>