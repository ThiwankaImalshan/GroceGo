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
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0.0;
    $availability = isset($_POST['availability']) ? $_POST['availability'] : 'inStock';

    // Handle file upload
    $image = NULL;
    if (isset($_FILES['image']['error']) && $_FILES['image']['error'] === 4) {
        // No new image uploaded, retain the old image
        $query = "SELECT products_image FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $image = $product['products_image'];
        $stmt->close();
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } else if ($fileSize > 1000000) {
            echo "<script>alert('Image Size is Too Large');</script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;

            $uploadDirectory1 = 'C:/xampp/htdocs/GrocGo/GrocGo WebSite/product img/'; // Absolute path to the external folder
            $uploadDirectory2 = 'product img/'; // Second location

            // Ensure the first upload directory exists
            if (!file_exists($uploadDirectory1)) {
                mkdir($uploadDirectory1, 0777, true);
            }

            // Ensure the second upload directory exists
            if (!file_exists($uploadDirectory2)) {
                mkdir($uploadDirectory2, 0777, true);
            }

            if (move_uploaded_file($tmpName, $uploadDirectory1 . $newImageName)) {
                // Copy the file to the second location
                if (copy($uploadDirectory1 . $newImageName, $uploadDirectory2 . $newImageName)) {
                    $image = 'product img/' . $newImageName;
                } else {
                    echo "<script>alert('Failed to copy image to the second location');</script>";
                }
            } else {
                echo "<script>alert('Failed to upload image');</script>";
            }
        }
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE category SET products_name = ?, products_description = ?, products_price = ?, products_image = ?, products_availability = ? WHERE products_id = ?");
    if ($stmt === false) {
        die('Prepare() failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssdssi", $name, $description, $price, $image, $availability, $productId);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully'); window.location.href='admin_panel.php';</script>";
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
