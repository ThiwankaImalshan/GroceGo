<?php
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // Validate email
    if (!validateEmail($email)) {
        echo "<script>alert('Error: Invalid email address.');window.location.href = 'admin_panel.php';</script>";
        exit; // Stop further execution
    }

    // Check if email exists in the database
    require("login_connection.php"); // Include your database connection file
    if (!emailExists($con, $email)) {
        echo "<script>alert('Error: Email address not registered.');window.location.href = 'admin_panel.php';</script>";
        exit; // Stop further execution
    }
    
    // Validate password
    if (!$newPassword || !$confirmPassword || $newPassword !== $confirmPassword || !validatePassword($newPassword)) {
        echo "<script>alert('Error: Invalid password.');window.location.href = 'admin_panel.php';</script>";
        exit; // Stop further execution
    }
    
    // Update password in the database
    require("login_connection.php"); // Include your database connection file
    
    // Prepare and execute the SQL query
    $stmt = $con->prepare("UPDATE admin_login SET Admin_Password = ? WHERE Admin_Email = ?");
    $stmt->bind_param("ss", $newPassword, $email);
    if ($stmt->execute()) {
        echo "<script>alert('Password updated successfully.');window.location.href = 'index.php';</script>";
        exit;
    } else {
        echo "Error updating password: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    // If form is not submitted, redirect to the change password page
    header("Location: admin_panel.php");
    exit;
}
?>
