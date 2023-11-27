<?php
session_start();
require_once 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_data = $_SESSION['user_data'];
    $otp_entered = $_POST['otp'];

    if ($otp_entered === $user_data['otp']) {
        // Update user as verified in the database
        $stmt = $con->prepare("UPDATE user SET is_verified = 1 WHERE phonenumber = ?");
        $stmt->bind_param("s", $user_data['phonenumber']);
        $stmt->execute();
        $stmt->close();

        // Registration successful, redirect to login page
        $_SESSION['status'] = "Registration Complete!";
        $_SESSION['status_code'] = "success";
        header('Location: ../login/index.php');
        exit();
    } else {
        $_SESSION['status'] = "Invalid OTP. Please try again.";
        $_SESSION['status_code'] = "error";
    }
}

// If the OTP is invalid or the request method is not POST, stay on the same page
header('Location: otp.php');
exit();
?>
