<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['AdminLoginId'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit; // Make sure to exit after redirection
}

require("login_connection.php");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteAdmin'])) {
    $adminName = $_POST['adminName']; // Get admin name from form
    
    // Prepare and execute the DELETE query
    $stmt = $con->prepare("DELETE FROM admin_login WHERE Admin_Name = ?");
    $stmt->bind_param("s", $adminName); // Admin_Name is a string
    if ($stmt->execute()) {
        echo "Admin data deleted successfully.";
        // Redirect to index.php
        header("Location: index.php");
        exit; // Make sure to exit after redirection
    } else {
        echo "Error deleting admin data: " . $stmt->error;
    }

    $stmt->close();
}

$con->close();
?>
