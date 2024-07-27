<?php
// Include the database connection
require 'config.php';

// Ensure the session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch the latest 10 delivery charges from the orders table
$sql = "SELECT order_deliveryCharge FROM orders ORDER BY order_id DESC LIMIT 10";
$result = $conn->query($sql);

$deliveryCharges = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $deliveryCharges[] = $row['order_deliveryCharge'];
    }
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($deliveryCharges);

// Close the connection
$conn->close();
?>
