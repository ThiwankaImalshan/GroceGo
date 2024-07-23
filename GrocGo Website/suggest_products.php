<?php
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

// Get search input
$searchInput = isset($_GET['search']) ? $_GET['search'] : '';

if ($searchInput !== '') {
    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT products_name FROM category WHERE products_name LIKE ?");
    $searchTerm = '%' . $conn->real_escape_string($searchInput) . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch results
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row['products_name'];
    }

    // Return results as JSON
    echo json_encode($products);

    $stmt->close();
}

$conn->close();
?>
