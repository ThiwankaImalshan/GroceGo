<?php
require("login_connection.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $adminName = $_POST['admin_name'];
    $adminEmail = $_POST['admin_email'];
    $adminPhone = $_POST['admin_phone'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $adminPhoto = '';

    // Validate email
    if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email address.";
        exit; // Stop further execution
    }

    // Validate password
    if ($newPassword !== $confirmPassword || strlen($newPassword) < 8) {
        echo "Error: Passwords do not match or invalid password.";
        exit; // Stop further execution
    }

    // Handle file upload
    if (isset($_FILES['admin_photo']) && $_FILES['admin_photo']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'assets/imgs/';
        $uploadFile = $uploadDir . basename($_FILES['admin_photo']['name']);
        
        if (move_uploaded_file($_FILES['admin_photo']['tmp_name'], $uploadFile)) {
            $adminPhoto = basename($_FILES['admin_photo']['name']);
        } else {
            echo "Error uploading file.";
            exit; // Stop further execution
        }
    } else {
        echo "Error: No file uploaded.";
        exit; // Stop further execution
    }

    // Insert new admin into the database
    $stmt = $con->prepare("INSERT INTO admin_login (Admin_Name, Admin_Email, Admin_Phone, Admin_Photo, Admin_Password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $adminName, $adminEmail, $adminPhone, $adminPhoto, $newPassword);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Admin registered successfully.'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    // If form is not submitted, redirect to the registration page
    header("Location: index.php");
    exit;
}
?>
