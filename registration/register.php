<?php
session_start();
require_once 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $middlename = empty($_POST['middlename']) ? null : $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $suffix = $_POST['suffix'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $gender = $_POST['gender'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $user_status = 1;

    // Validate if the password and re_password match
    if ($password !== $re_password) {
        $_SESSION['status'] = "Passwords do not match. Please re-enter your passwords.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); // Redirect back to the registration page
        exit();
    }

    // Add password security measures here (e.g., minimum length, complexity requirements)

    // Example: Minimum password length of 8 characters
    if (strlen($password) < 8) {
        $_SESSION['status'] = "Password must be at least 8 characters long.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); // Redirect back to the registration page
        exit();
    }

    // Check if the email is unique
    $email_check_stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
    $email_check_stmt->bind_param("s", $email);
    $email_check_stmt->execute();
    $email_result = $email_check_stmt->get_result();
    $email_check_stmt->close();

    if ($email_result->num_rows > 0) {
        // Email is not unique, handle the error 
        $_SESSION['status'] = "Email is already in use. Please use a different email.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); // Redirect back to the registration page
        exit();
    }

    // Check if the phone number is unique
    $phone_check_stmt = $con->prepare("SELECT * FROM user WHERE phonenumber = ?");
    $phone_check_stmt->bind_param("s", $phonenumber);
    $phone_check_stmt->execute();
    $phone_result = $phone_check_stmt->get_result();
    $phone_check_stmt->close();

    if ($phone_result->num_rows > 0) {
        // Phone number is not unique, handle the error
        $_SESSION['status'] = "Phone number is already in use. Please use a different phone number.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); // Redirect back to the registration page
        exit();
    }

    // If both email and phone number are unique, proceed with insertion
    $otp = generateOTP();

    // Commented out the hashing for demonstration purposes
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO `user`(`firstname`, `middlename`, `lastname`, `suffix`, `email`, `password`, `phonenumber`, `picture`, `otp`, `gender`, `user_status`, `user_type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Corrected binding parameters
    $stmt->bind_param("ssssssssssss", $firstname, $middlename, $lastname, $suffix, $email, $password, $phonenumber, $profilepicture, $otp, $gender, $user_status, $user_type);

    // Get binary data of the image
    $profilepicture = file_get_contents($_FILES["picture"]['tmp_name']);

    $stmt->send_long_data(7, $profilepicture);

    $stmt->execute();
    $stmt->close();

    // Store user data in session for verification
    $_SESSION['user_data'] = [
        'firstname' => $firstname,
        'middlename' => $middlename,
        'phonenumber' => $phonenumber,
        'password' => $hashed_password,
        'otp' => $otp,
    ];

    // Redirect to OTP verification page
    header('Location: otp.php');
    exit();
}

function generateOTP() {
    return str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
}
?>