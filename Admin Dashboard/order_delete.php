<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "grocgo";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Assuming $product_id is obtained from a GET request
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Print the product ID for debugging
    echo "Order ID to delete: " . htmlspecialchars($order_id) . "<br>";

    // Check if the product exists
    $checkQuery = "SELECT * FROM orders WHERE order_id = ?";
    $checkStmt = $connection->prepare($checkQuery);
    if ($checkStmt === false) {
        die("Prepare failed: " . $connection->error);
    }

    $checkStmt->bind_param("i", $order_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows == 0) {
        echo "Order ID not found in the database.";
    } else {
        // Prepare the SQL delete statement
        $stmt = $connection->prepare("DELETE FROM orders WHERE order_id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $connection->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $order_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the check statement
    $checkStmt->close();
} else {
    echo "Order ID not provided";
}

// Close the connection
$connection->close();
?>
