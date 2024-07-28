<?php
require 'config.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $contact = $_POST['contact'];
    $vehicleType = $_POST['vehicle-type'];
    $branch = $_POST['branch'];

    // Validate form data
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit();
    }

    // Use plain text for the password as per your preference
    $hashedPassword = $password;

    // Generate confirmation code
    $confirmationCode = md5(uniqid(rand(), true));

    // Set default photo
    $defaultPhoto = 'DefaultPro.png';

    // Fetch the latest numplate for the vehicle type and increment it
    $stmt = $conn->prepare("SELECT MAX(deliver_numplate) AS last_numplate FROM delivers WHERE deliver_vehicle = ?");
    $stmt->bind_param("s", $vehicleType);
    $stmt->execute();
    $stmt->bind_result($lastNumplate);
    $stmt->fetch();
    $stmt->close();

    if ($lastNumplate) {
        // Extract the last number and increment it
        preg_match('/(\d+)$/', $lastNumplate, $matches);
        $nextNum = intval($matches[1]) + 1;
    } else {
        // Start with 1 if no previous numplate exists
        $nextNum = 1;
    }

    $deliverNumplate = "NumPlate-$vehicleType-$nextNum.png";

    // Set default status
    $deliverStatus = 'available';

    // Store user data, confirmation code, numplate, and status in the database
    $stmt = $conn->prepare("INSERT INTO delivers (deliver_name, deliver_email, deliver_password, delivery_contact, deliver_vehicle, deliver_from, confirmation_code, deliver_photo, deliver_numplate, deliver_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $username, $email, $hashedPassword, $contact, $vehicleType, $branch, $confirmationCode, $defaultPhoto, $deliverNumplate, $deliverStatus);

    if ($stmt->execute()) {
        // Send confirmation email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'helawiskam2019@gmail.com'; // Replace with your email
            $mail->Password = 'hawc rfod mbxk zdyq'; // Replace with your email password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('helawiskam2019@gmail.com', 'GrocGo - Delivery Service Registration'); // Replace with your email and name
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->Subject = 'Email Confirmation for your GrocGo Delivery Registration';
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; color: #333; line-height: 1.5;'>
                    <h2 style='color: #51ac37;'>Confirm Your Email Address</h2>
                    <p>Hello,</p>
                    <p>Thank you for signing up with us. Please click the button below to confirm your email address:</p>
                    <a href='http://localhost/GroceGo/Deliver Dashboard/confirm_email.php?code=$confirmationCode' 
                       style='display: inline-block; background-color: #51ac37; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 10px;'>
                       Confirm Email
                    </a>
                    <p style='margin-top: 20px;'>If you did not sign up, please ignore this email.</p>
                    <p>Thank you!</p>
                    <p style='color: #aaa; font-size: 12px;'>This is an automated message, please do not reply.</p>
                </div>";

            $mail->send();
            echo "<script>alert('Confirmation email has been sent. Please check your inbox.');</script>";
            echo "<script>window.location.href='https://mail.google.com';</script>"; // Redirect to mail.google.com after email is sent
            exit();
        } catch (Exception $e) {
            echo "<script>alert('Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('Error: {$stmt->error}');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
