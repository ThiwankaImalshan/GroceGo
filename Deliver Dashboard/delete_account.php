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

// Prepare a statement to delete the user from the delivers table
$sql = "DELETE FROM delivers WHERE deliver_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $deliver_name);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Optionally destroy the session and redirect the user
    session_destroy();
    echo json_encode(['success' => 'Account deleted successfully.']);
} else {
    echo json_encode(['error' => 'Failed to delete account or account not found.']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
