<?php
// Include the database connection
require 'config.php';

// Ensure the session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if deliver_name is set in the session
if (!isset($_SESSION['deliver_name'])) {
    echo json_encode(['error' => 'Deliver name not set in session.']);
    exit();
}

$deliver_name = $_SESSION['deliver_name'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $name = filter_input(INPUT_POST, 'profile-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'profile-email', FILTER_SANITIZE_EMAIL);
    $vehicle = filter_input(INPUT_POST, 'profile-vehicle', FILTER_SANITIZE_STRING);

    // Check if the file is uploaded without errors
    if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] == 0) {
        // Define the allowed file types and max file size (5MB in this case)
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        $fileName = $_FILES['profile-pic']['name'];
        $fileSize = $_FILES['profile-pic']['size'];
        $fileTmpName = $_FILES['profile-pic']['tmp_name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check if the file type is allowed and the file size is within the limit
        if (in_array($fileExtension, $allowed) && $fileSize <= $maxFileSize) {
            // Define the upload directory and the new file name
            $uploadDir = 'pro_pic/';
            $newFileName = uniqid('profile_', true) . '.' . $fileExtension;
            $uploadFilePath = $uploadDir . $newFileName;
            $upload_Path = $newFileName;

            // Move the uploaded file to the upload directory
            if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
                // Update the delivers table with the new profile data
                $sql = "UPDATE delivers SET deliver_photo = ?, deliver_name = ?, deliver_email = ?, deliver_vehicle = ? WHERE deliver_name = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssss', $upload_Path, $name, $email, $vehicle, $deliver_name);
                
                if ($stmt->execute()) {
                    echo json_encode(['success' => 'Profile updated successfully.']);
                } else {
                    echo json_encode(['error' => 'Database update failed.']);
                }

                $stmt->close();
            } else {
                echo json_encode(['error' => 'Error moving the uploaded file.']);
            }
        } else {
            echo json_encode(['error' => 'Invalid file type or file size exceeds the limit.']);
        }
    } else {
        // If no file is uploaded, update the other details only
        $sql = "UPDATE delivers SET deliver_name = ?, deliver_email = ?, deliver_vehicle = ? WHERE deliver_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $email, $vehicle, $deliver_name);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => 'Profile updated successfully.']);
        } else {
            echo json_encode(['error' => 'Database update failed.']);
        }

        $stmt->close();
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}

$conn->close();
?>
