<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocgo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}

// Fetch all products
$sql = "SELECT * FROM category";
$result = $conn->query($sql);

if (!$result) {
    die(json_encode(array("error" => "Error executing query: " . $conn->error)));
}

$products = array();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$conn->close();

echo json_encode($products);
?>
