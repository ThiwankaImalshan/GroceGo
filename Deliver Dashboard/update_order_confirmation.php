<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['order_id']) || !isset($data['action'])) {
    echo json_encode(['error' => 'Invalid request.']);
    exit();
}

$order_id = $data['order_id'];
$action = $data['action'];

if ($action === 'confirm') {
    // Update orders table
    $sql = "UPDATE orders SET order_payment = 'Paid', order_status = 'Delivered', order_deliver = (SELECT deliver_name FROM delivers WHERE order_id = ?) WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $order_id, $order_id);

    if ($stmt->execute()) {
        // Update deliver status in delivers table
        $sql_delivers = "UPDATE delivers SET deliver_status = 'available' WHERE order_id = ?";
        $stmt_delivers = $conn->prepare($sql_delivers);
        $stmt_delivers->bind_param('i', $order_id);
        $stmt_delivers->execute();
        $stmt_delivers->close();
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to update order status.']);
    }

    $stmt->close();
} elseif ($action === 'not_delivered') {
    // Update orders table
    $sql = "UPDATE orders SET order_payment = 'Due', order_status = 'Return' WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to update order status.']);
    }

    $stmt->close();
}

$conn->close();
?>
