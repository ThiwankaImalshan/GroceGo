<?php
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this if your database username is different
$password = ""; // Change this if your database password is set
$database = "grocgo"; // Change this to your actual database name

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
