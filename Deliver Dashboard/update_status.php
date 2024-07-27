<?php
session_start();
require 'config.php'; // Include your database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['deliver_name']) && isset($_POST['status'])) {
        $status = $_POST['status'];
        $username = $_SESSION['deliver_name'];

        // Validate status
        if ($status !== 'available' && $status !== 'unavailable') {
            http_response_code(400); // Bad Request
            exit('Invalid status');
        }

        // Update status in the database
        $stmt = $conn->prepare("UPDATE delivers SET deliver_status = ? WHERE deliver_name = ?");
        $stmt->bind_param("ss", $status, $username);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    } else {
        http_response_code(403); // Forbidden
        exit('Unauthorized');
    }
}
?>
