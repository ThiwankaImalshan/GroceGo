<?php
// Database connection
require("config.php");

$category = isset($_GET['category']) ? $_GET['category'] : '';

$sql = "SELECT subcategories_name, products_id, products_name, products_price, products_image, products_availability 
        FROM category 
        WHERE categories_name = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$products = array();

while ($row = $result->fetch_assoc()) {
    $subcategoryName = $row['subcategories_name'];
    if (!isset($products[$subcategoryName])) {
        $products[$subcategoryName] = array();
    }
    $products[$subcategoryName][] = array(
        'id' => $row['products_id'],
        'name' => $row['products_name'],
        'price' => $row['products_price'],
        'image' => $row['products_image'],
        'availability' => $row['products_availability']
    );
}
// $stmt->close();
// $conn->close();

// header('Content-Type: application/json');
echo json_encode($products);
?>