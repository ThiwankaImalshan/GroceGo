<?php
// Include your database connection file
include 'config.php';

if (isset($_GET['product_id'])) {
    $productId = intval($_GET['product_id']);

    // Prepare and execute the query
    $query = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    // Return the product details as JSON
    echo json_encode($product);
}
?>
