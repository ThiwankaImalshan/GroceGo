<?php
require 'config.php';

if (isset($_GET['code'])) {
    $confirmationCode = $_GET['code'];

    $stmt = $conn->prepare("SELECT * FROM delivers WHERE confirmation_code = ?");
    $stmt->bind_param("s", $confirmationCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE delivers SET confirmed = 1 WHERE confirmation_code = ?");
        $stmt->bind_param("s", $confirmationCode);

        if ($stmt->execute()) {
            echo "<script>alert('Email confirmed successfully!');</script>";
            echo "<script>window.location.href='index.php';</script>"; // Redirect to index.html after email is sent
        } else {
            echo "<script>alert('Error confirming email.');</script>";
        }
    } else {
        echo "<script>alert('Invalid confirmation code.');</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No confirmation code provided.');</script>";
}
?>
