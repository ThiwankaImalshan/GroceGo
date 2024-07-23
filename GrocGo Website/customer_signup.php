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
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Combine first name and last name
    $customer_name = $fname . ' ' . $lname;


    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO customers (customer_name, customer_email, customer_phone, customer_password) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare() failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssss", $customer_name, $email, $tel, $password);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Account created successfully'); window.location.href='signIn.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}
?>
