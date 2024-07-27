<?php
session_start();
require 'config.php'; // Include your database configuration

header('Content-Type: application/json');

// Get deliver_name from session or POST data
$deliverName = isset($_SESSION['deliver_name']) ? $_SESSION['deliver_name'] : '';

// Prepare and execute query to fetch orders for the specific deliver_name
$query = "SELECT order_id, order_name, 
                 CONCAT(order_address, ', ', order_city, ', ', order_postal_code) AS full_address, 
                 order_price, order_deliver, order_deliveryCharge, order_status
          FROM orders
          WHERE order_deliver = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $deliverName);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

echo json_encode($orders);

$stmt->close();
$conn->close();
?>
