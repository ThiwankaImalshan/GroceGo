<?php
// Include the database connection
require 'config.php';

// Ensure the session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if deliver_name is set in the session
if (!isset($_SESSION['deliver_name'])) {
    echo json_encode(['error' => 'Deliver name not set in session.']);
    exit();
}

// Get the deliver_name from the session
$deliver_name = $_SESSION['deliver_name'];

// Get the form data
$current_password = $_POST['current-password'];
$new_password = $_POST['new-password'];
$confirm_password = $_POST['confirm-password'];

// Check if new password and confirm password match
if ($new_password !== $confirm_password) {
    echo json_encode(['error' => 'New password and confirm password do not match.']);
    exit();
}

// Prepare a statement to fetch the current password from the database
$sql = "SELECT deliver_password FROM delivers WHERE deliver_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $deliver_name);
$stmt->execute();
$result = $stmt->get_result();
$deliver = $result->fetch_assoc();

if ($deliver) {
    // Verify current password
    if ($deliver['deliver_password'] !== $current_password) {
        echo json_encode(['error' => 'Current password is incorrect.']);
        exit();
    }

    // Update the password
    $sql = "UPDATE delivers SET deliver_password = ? WHERE deliver_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $new_password, $deliver_name);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => 'Password updated successfully.']);
    } else {
        echo json_encode(['error' => 'Failed to update password.']);
    }
} else {
    echo json_encode(['error' => 'Deliver not found.']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
