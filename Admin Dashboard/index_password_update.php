<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Function to validate email
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Function to check if email exists in the database
    function emailExists($con, $email) {
        $stmt = $con->prepare("SELECT * FROM admin_login WHERE Admin_Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Function to validate password
    function validatePassword($password) {
        // Password must be at least 8 characters long
        // You can add more validation rules as needed
        return strlen($password) >= 8;
    }

    // Retrieve form data
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // Validate email
    if (!validateEmail($email)) {
        echo "<script>alert('Error: Invalid email address.');window.location.href = 'index.php';</script>";
        exit; // Stop further execution
    }

    // Include your database connection file
    require("login_connection.php");

    // Check if email exists in the database
    if (!emailExists($con, $email)) {
        echo "<script>alert('Error: Email address not registered.');window.location.href = 'index.php';</script>";
        exit; // Stop further execution
    }
    
    // Validate password
    if (!$newPassword || !$confirmPassword || $newPassword !== $confirmPassword || !validatePassword($newPassword)) {
        echo "<script>alert('Error: Invalid password.'window.location.href = 'index.php';);</script>";
        exit; // Stop further execution
    }
    
    
    // Prepare and execute the SQL query
    $stmt = $con->prepare("UPDATE admin_login SET Admin_Password = ? WHERE Admin_Email = ?");
    $stmt->bind_param("ss", $newPassword, $email);
    if ($stmt->execute()) {
        echo "<script>alert('Password updated successfully.'); window.location.href = 'index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating password: " . $stmt->error . "');window.location.href = 'index.php';</script>";
    }

    $stmt->close();
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE PASSWORD</title>
    <!-- ----------------Styles---------- -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <style>
        /* -------------Password Change Popup------------- */
        .change_popup, .delete_popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px); /* Adds background blur effect */
        }

        .change_popup_content,  .delete_popup_content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .change_popup_content{
            width: 500px;
            height: 500px;
        }

        .delete_popup_content{
            width: 250px;
            height: 250px;
        }

        .delete_popup_content p{
            margin-top: 30px;
        }

        .delete_popup_content button{
            margin-top: 40px;
            padding: 8px 16px;
            border-radius: 8px;
            width:100%;
            font-weight: 600;
            font-size: 18px;
            color: white;
            background-color: red;
            border: 1px solid white;
        }

        .delete_popup_content button:hover{
            color: red;
            background-color: pink;
            border: 1px solid red;
            cursor:pointer;
        }

        .change_popup_close, .delete_popup_close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 30px;
        }

        .change_popup input[type=password]{
            border-radius: 8px;
            border: 1px solid var(--black2);
            height: 30px;
            padding-left: 10px;
            margin-top: 8px;
            width: 100%;
        }

        .change_popup input[type=email]{
            border-radius: 8px;
            border: 1px solid var(--black2);
            height: 30px;
            padding-left: 10px;
            margin-top: 8px;
            width: 100%;
        }

        .change_popup form{
            margin-top: 50px;
        }

        .change_popup button{
            margin-top: 100px;
            padding: 8px 16px;
            border-radius: 8px;
            width:100%;
            font-weight: 600;
            font-size: 18px;
            color: white;
            background-color: green;
            border: 1px solid white;
        }

        .change_popup button:hover{
            color: green;
            background-color: white;
            border: 1px solid green;
            cursor:pointer;
        }
    </style>
</head>
<body>

        <div id="change_popup" class="change_popup" style="display: block;">
            <div class="change_popup_content">
                <span id="change_closePopupBtn" class="change_popup_close">&times;</span>
                <h2>Change Password</h2>
                <form action="" method="post">
                    <label for="email">Your Email:</label><br>
                    <input type="email" name="email" placeholder="Email" required><br><br>

                    <label for="newPassword">Password:</label><br>
                    <input type="password" name="newPassword" placeholder="New Password" required><br><br>

                    <label for="confirmPassword">Confirm Password:</label><br>
                    <input type="password" name="confirmPassword" placeholder="Confirm New Password" required><br><br>

                    <button type="submit" name="submit">Save Changes</button>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('change_closePopupBtn').onclick = function() {
                document.getElementById('change_popup').style.display = 'none';
            };

            document.getElementById('change_closePopupBtn').onclick = function() {
                window.location.href = 'index.php';
            };
        </script>
    
</body>
</html>