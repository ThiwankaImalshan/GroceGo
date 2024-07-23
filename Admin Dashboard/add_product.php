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
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0.0;
    $availability = isset($_POST['availability']) ? $_POST['availability'] : 'in stock';

    // Handle file upload
    $image = NULL;
    if (isset($_FILES['image']['error']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDirectory1 = 'C:/xampp/htdocs/GrocGo/GrocGo WebSite/product img/';
        $uploadDirectory2 = 'product img/';

        // Check if the first directory exists, if not, create it
        if (!file_exists($uploadDirectory1)) {
            mkdir($uploadDirectory1, 0777, true);
        }

        // Check if the second directory exists, if not, create it
        if (!file_exists($uploadDirectory2)) {
            mkdir($uploadDirectory2, 0777, true);
        }

        // Move the uploaded file to the first destination directory
        $fileName = $_FILES['image']['name'];
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory1 . $fileName)) {
            // Copy the file to the second destination directory
            if (copy($uploadDirectory1 . $fileName, $uploadDirectory2 . $fileName)) {
                $image = 'product img/' . $fileName;
            } else {
                echo "<script>alert('Failed to copy image to second location');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    } else {
        echo "<script>alert('Image upload error');</script>";
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO category (products_name, products_description, products_price, products_image, products_availability) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare() failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssdss", $name, $description, $price, $image, $availability);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('New product added successfully'); window.location.href='admin_panel.php';</script>";
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
