<?php
session_start();
require_once 'dbcon.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['c_password'];
    $phonenumber = $_POST['phone'];
    $user_type = $_POST['role'];
    $is_verified = "0";

    if ($password !== $re_password) {
        $_SESSION['status'] = "Passwords do not match. Please re-enter your passwords.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); 
        exit();
    }

    // Example: Minimum password length of 8 characters
    if (strlen($password) < 8) {
        $_SESSION['status'] = "Password must be at least 8 characters long.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); 
        exit();
    }

    // Hash the password
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email is unique
    $email_check_stmt = $con->prepare("SELECT * FROM user_accounts WHERE email = ?");
    $email_check_stmt->bind_param("s", $email);
    $email_check_stmt->execute();
    $email_result = $email_check_stmt->get_result();
    $email_check_stmt->close();

    if ($email_result->num_rows > 0) {
        // Email is not unique, handle the error 
        $_SESSION['status'] = "Email is already in use. Please use a different email.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); // Redirect back to the index page
        exit();
    }

    // Check if the phone number is unique
    $phone_check_stmt = $con->prepare("SELECT * FROM user_accounts WHERE phone_number = ?");
    $phone_check_stmt->bind_param("s", $phonenumber);
    $phone_check_stmt->execute();
    $phone_result = $phone_check_stmt->get_result();
    $phone_check_stmt->close();

    if ($phone_result->num_rows > 0) {
        // Phone number is not unique, handle the error
        $_SESSION['status'] = "Phone number is already in use. Please use a different phone number.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); // Redirect back to the index page
        exit();
    }

    // If both email and phone number are unique, proceed with insertion
    $otp = generateOTP();

    $stmt = $con->prepare("INSERT INTO `user_accounts` (`firstname`, `lastname`, `email`, `password`, `phone_number`, `is_verified`, `role`, `otp`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $firstname = htmlentities($_POST['firstname']);
    $lastname = htmlentities($_POST['lastname']);
    $email = htmlentities($_POST['email']);
    $otp = htmlentities($otp);

    $subject = 'Your One-Time Password (OTP) for Account Verification';
    $message = "
    Dear $firstname $lastname,<br>
    Thank you for registering with our platform. To verify your account, please use the following One-Time Password (OTP):<br>
    $otp<br>
    This OTP is valid for a single use and will expire in 5 minutes. Please enter this code on the verification page to complete the registration process.<br>
    If you did not attempt to register, please ignore this email.<br>
    ";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'teachmesenseitutorngsystem@gmail.com';
    $mail->Password= 'oxlhbwvzqhqcgwok';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom($email, $firstname);
    $mail->addAddress("$email");
    $mail->Subject = ("$subject");
    $mail->Body = $message;
    $mail->send();

if (!$stmt) {
    die('Error during prepare: ' . $con->error);
}

// Corrected binding parameters
$stmt->bind_param("ssssssss", $firstname, $lastname, $email, $password, $phonenumber, $is_verified, $user_type, $otp);

if (!$stmt->execute()) {
    die('Error during execute: ' . $stmt->error);
}

    // Store user data in session for verification
    $_SESSION['user_data'] = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'phonenumber' => $phonenumber,
        'password' => $password,
        'otp' => $otp,
    ];

    // Redirect to OTP verification page
    header('Location: otp.php');
    exit();
}

function generateOTP() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $otp = '';

    for ($i = 0; $i < 8; $i++) {
        $otp .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $otp;
}
?>
