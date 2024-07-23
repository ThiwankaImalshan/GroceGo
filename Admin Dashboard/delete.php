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
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Check if the product exists
    $checkQuery = "SELECT * FROM category WHERE products_id = ?";
    $checkStmt = $connection->prepare($checkQuery);
    if ($checkStmt === false) {
        die("Prepare failed: " . $connection->error);
    }

    $checkStmt->bind_param("i", $product_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows == 0) {
        echo "Product ID not found in the database.";
    } else {
        // Fetch product details
        $product = $result->fetch_assoc();
        $imageFileName = $product['products_image'];

        // Prepare the SQL delete statement
        $stmt = $connection->prepare("DELETE FROM category WHERE products_id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $connection->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $product_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Delete the image file from both locations
            $uploadDirectory1 = 'C:/xampp/htdocs/GrocGo/GrocGo WebSite/product img/';
            $uploadDirectory2 = 'product img/';
            if (file_exists($uploadDirectory1 . $imageFileName)) {
                unlink($uploadDirectory1 . $imageFileName);
            }
            if (file_exists($uploadDirectory2 . $imageFileName)) {
                unlink($uploadDirectory2 . $imageFileName);
            }
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
    echo "Product ID not provided";
}

// Close the connection
$connection->close();
?>
