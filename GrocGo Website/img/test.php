<?php
require 'vendor/autoload.php'; // Include the Composer autoloader
require 'fpdf/fpdf.php'; // Include FPDF library

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database credentials
$host = 'localhost';
$db = 'grocgo';
$user = 'root';
$pass = '';

// Create a new MySQLi instance
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the radio button values are set
if (isset($_POST['cityName']) && isset($_POST['totalValue']) && isset($_POST['shippingOption'])) {
    $cityName = $_POST['cityName'];
    $totalPrice = $_POST['totalValue'];
    $shippingOption = $_POST['shippingOption'];
    
    // Get the order details from the AJAX request
    $orderDetails = json_decode($_POST['order-details'], true);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO orders (order_name, order_email, order_phone, order_price, order_payment, order_status, order_address, order_city, order_postal_code, order_details) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiissssis", $orderName, $orderEmail, $orderPhone, $totalPrice, $orderPayment, $orderStatus, $orderAddress, $orderCity, $orderPostalCode, $orderDetailsJSON);

    // Set parameters
    $orderEmail = $orderDetails['email'];
    $orderPhone = $orderDetails['phone'];
    $firstName = $orderDetails['firstName'];
    $lastName = $orderDetails['lastName'];
    $orderName = $firstName . ' ' . $lastName; // Combine first name and last name
    $orderAddress = $orderDetails['address'];
    $orderCity = $orderDetails['city'];
    $orderPostalCode = $orderDetails['postalCode'];
    $orderPrice = 0; // Initialize total price
    foreach ($orderDetails['cartItems'] as $item) {
        if (isset($item['price']) && isset($item['quantity'])) {
            $orderPrice += $item['price'] * $item['quantity']; // Calculate the total price
        }
    }
    $orderPayment = 'Due'; // Set the order payment status
    $orderStatus = 'Pending'; // Set the order status
    $orderDetailsJSON = json_encode($orderDetails['cartItems']);

    // Execute the order insertion
    if ($stmt->execute()) {
        $orderId = $stmt->insert_id; // Get the inserted order ID

        // Set branch email based on city
        $branchEmail = '';
        switch ($cityName) {
            case 'panadura':
                $branchEmail = 'panadura.grocgo@gmail.com';
                break;
            case 'dehiwala':
                $branchEmail = 'dehiwala.grocgo@gmail.com';
                break;
            case 'colombo':
                $branchEmail = 'colombo.grocgo@gmail.com';
                break;
            default:
                $branchEmail = 'default@grocgo.com'; // Default email if city not matched
                break;
        }

        // Check the shipping option
        if ($shippingOption == 'radio2') {
            // Assign delivery personnel
            $deliveryPersonData = assignDeliveryPerson($conn, $orderId, $cityName);

            if ($deliveryPersonData) {
                $deliveryPerson = $deliveryPersonData['name'];
                $deliveryPersonEmail = $deliveryPersonData['email'];

                // Build the success message
                $message = "Order placed and delivery assigned.\nOrder ID: $orderId\nDelivery Person: $deliveryPerson";
                // Send email notification to branch and delivery person
                sendEmailNotification($orderDetails, $branchEmail, $message, $orderId);
                sendEmailNotification($orderDetails, $deliveryPersonEmail, $message, $orderId);
                echo "$message";
            } else {
                // If delivery personnel are not available
                $message = "Order placed successfully but delivery assignment is pending. Order ID: $orderId";
                // Send email notification to branch
                sendEmailNotification($orderDetails, $branchEmail, $message, $orderId);
                echo "$message";
            }
        } else {
            // No delivery assignment needed
            // Build the success message
            $message = "Order placed successfully.\nOrder ID: $orderId\nPickup from: $cityName";
            // Send email notification to branch
            sendEmailNotification($orderDetails, $branchEmail, $message, $orderId);
            echo "$message";
        }

        // Send thank you email to the customer
        $thankYouMessage = "Thank you for ordering from GrocGo.\nOrder ID: $orderId";
        sendEmailNotification($orderDetails, $orderEmail, $thankYouMessage, $orderId, true);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Order placement failed.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Error: Missing data.";
}

/**
 * Function to assign a delivery person to an order and update the deliveries table
 */
function assignDeliveryPerson($conn, $orderId, $cityName) {
    // Query to get an available delivery person for the specific city
    $query = "SELECT deliver_id, deliver_name, deliver_email FROM delivers WHERE deliver_status = 'available' AND deliver_from = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $cityName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $deliveryId = $row['deliver_id'];
        $deliveryPerson = $row['deliver_name'];
        $deliveryPersonEmail = $row['deliver_email'];

        // Update the delivery status to assigned and link to the order
        $updateQuery = "UPDATE delivers SET deliver_status = 'assigned', order_id = ? WHERE deliver_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ii", $orderId, $deliveryId);
        if ($updateStmt->execute()) {
            return ['name' => $deliveryPerson, 'email' => $deliveryPersonEmail];
        }
    }
    return false;
}

/**
 * Function to send email notification
 */
function sendEmailNotification($orderDetails, $to, $message, $orderId, $isCustomer = false) {
    $messageContent = '<html><body>';
    $messageContent .= '<h1 style="color: #333;">New Order Received</h1>';
    $messageContent .= '<p style="font-size: 14px;">You have received a new order. Details:</p>';
    $messageContent .= '<p><strong>Email:</strong> ' . htmlspecialchars($orderDetails['email']) . '</p>';
    $messageContent .= '<p><strong>Phone:</strong> ' . htmlspecialchars($orderDetails['phone']) . '</p>';
    $messageContent .= '<p><strong>Name:</strong> ' . htmlspecialchars($orderDetails['firstName'] . ' ' . $orderDetails['lastName']) . '</p>';
    $messageContent .= '<p><strong>Address:</strong> ' . htmlspecialchars($orderDetails['address']) . '</p>';
    $messageContent .= '<p><strong>City:</strong> ' . htmlspecialchars($orderDetails['city']) . '</p>';
    $messageContent .= '<p><strong>Postal Code:</strong> ' . htmlspecialchars($orderDetails['postalCode']) . '</p>';
    $messageContent .= '<h2 style="color: #333;">Order Details</h2>';
    $messageContent .= '<ul style="list-style-type: none; padding: 0;">';
    foreach ($orderDetails['cartItems'] as $item) {
        $messageContent .= '<li style="margin-bottom: 10px;">';
        $messageContent .= '<strong>Product ID:</strong> ' . htmlspecialchars($item['product_id']) . '<br>';
        $messageContent .= '<strong>Quantity:</strong> ' . htmlspecialchars($item['quantity']);
        $messageContent .= '</li>';
    }
    $messageContent .= '</ul>';
    $messageContent .= '<p style="font-size: 14px;">' . nl2br(htmlspecialchars($message)) . '</p>';
    $messageContent .= '<p style="font-size: 12px; color: #777;">Order ID: ' . htmlspecialchars($orderId) . '</p>';
    $messageContent .='';

    
}
?>