<?php
require 'config.php'; // Include your database configuration

// Ensure the session is started
session_start();

// Check if deliver_name is set in the session
if (!isset($_SESSION['deliver_name'])) {
    echo json_encode(['error' => 'Deliver name not set in session.']);
    exit();
}

// Use deliver_name from the session
$deliver_name = $_SESSION['deliver_name'];

// Fetch the order_id from the delivers table
$sql_delivers = "SELECT order_id FROM delivers WHERE deliver_name = ? AND deliver_status = 'assigned'";

if ($stmt = $conn->prepare($sql_delivers)) {
    $stmt->bind_param("s", $deliver_name);
    $stmt->execute();
    $result_delivers = $stmt->get_result();
    
    if ($deliver = $result_delivers->fetch_assoc()) {
        $order_id = $deliver['order_id'];
        
        // Fetch order details using the order_id
        $sql_orders = "SELECT order_id, order_name, CONCAT(order_address, ', ', order_city, ', ', order_postal_code) AS full_address, order_price
                       FROM orders
                       WHERE order_id = ?";
                       
        if ($stmt = $conn->prepare($sql_orders)) {
            $stmt->bind_param("i", $order_id);
            $stmt->execute();
            $result_orders = $stmt->get_result();
            
            if ($orderDetails = $result_orders->fetch_assoc()) {
                echo json_encode($orderDetails);
            } else {
                echo json_encode(['error' => 'Order not found.']);
            }
            
            $stmt->close();
        } else {
            echo json_encode(['error' => 'SQL prepare statement failed.']);
        }
    } else {
        echo json_encode(['error' => 'No assigned orders found.']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['error' => 'SQL prepare statement failed.']);
}

$conn->close();
?>
