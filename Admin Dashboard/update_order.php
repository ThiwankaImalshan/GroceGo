<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "grocgo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture and validate form data
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $name = isset($_POST['order_name']) ? $_POST['order_name'] : '';
    $price = isset($_POST['order_price']) ? (float)$_POST['order_price'] : 0.0;
    $payment = isset($_POST['order_payment']) ? $_POST['order_payment'] : '';
    $status = isset($_POST['order_status']) ? $_POST['order_status'] : 'In Progress';

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE orders SET order_name = ?, order_price = ?, order_payment = ?, order_status = ? WHERE order_id = ?");
    if ($stmt === false) {
        die('Prepare() failed: ' . htmlspecialchars($conn->error));
    }

    // Corrected bind_param call
    $stmt->bind_param("sdssi", $name, $price, $payment, $status, $orderId);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Order updated successfully'); window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='admin_panel.php';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}
?>
