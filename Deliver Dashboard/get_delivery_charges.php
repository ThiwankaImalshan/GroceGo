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

$deliver_name = $_SESSION['deliver_name'];

// Fetch the latest 10 delivery charges from the orders table for the logged-in deliverer
$sql = "SELECT order_deliveryCharge FROM orders WHERE order_deliver = ? ORDER BY order_id DESC LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $deliver_name);
$stmt->execute();
$result = $stmt->get_result();

$deliveryCharges = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $deliveryCharges[] = $row['order_deliveryCharge'];
    }
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($deliveryCharges);

// Close the statement and connection
$stmt->close();
$conn->close();
?>

