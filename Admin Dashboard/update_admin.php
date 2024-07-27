<?php
require("login_connection.php");

session_start(); // Initialize sessions

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Ensure Admin_Id is set in the session
if (isset($_SESSION['Admin_Id'])) {
    $adminId = $_SESSION['Admin_Id'];

    // Capture and validate form data
    $adminName = isset($_POST['admin_name']) ? $_POST['admin_name'] : '';
    $adminEmail = isset($_POST['admin_email']) ? $_POST['admin_email'] : '';
    $adminPhone = isset($_POST['admin_phone']) ? $_POST['admin_phone'] : '';
    $adminPhoto = '';

    // Handle file upload
    if (isset($_FILES['admin_photo']) && $_FILES['admin_photo']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'assets/imgs/';
        $uploadFile = $uploadDir . basename($_FILES['admin_photo']['name']);
        
        if (move_uploaded_file($_FILES['admin_photo']['tmp_name'], $uploadFile)) {
            $adminPhoto = basename($_FILES['admin_photo']['name']);
        } else {
            echo "<script>alert('Error uploading file.'); window.location.href='admin_panel.php';</script>";
            exit; // Exit to prevent further processing
        }
    }

    // Prepare the SQL query
    if ($adminPhoto) {
        $stmt = $con->prepare("UPDATE admin_login SET Admin_Name = ?, Admin_Email = ?, Admin_Phone = ?, Admin_Photo = ? WHERE Admin_Id = ?");
        $stmt->bind_param("ssssi", $adminName, $adminEmail, $adminPhone, $adminPhoto, $adminId);
    } else {
        $stmt = $con->prepare("UPDATE admin_login SET Admin_Name = ?, Admin_Email = ?, Admin_Phone = ? WHERE Admin_Id = ?");
        $stmt->bind_param("sssi", $adminName, $adminEmail, $adminPhone, $adminId);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Admin details updated successfully'); window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='admin_panel.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No Admin_Id found in session.'); window.location.href='admin_panel.php';</script>";
}

$con->close();
?>
