<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['page1_data']['firstname'] = $_POST['firstname'];
    $_SESSION['page1_data']['middlename'] = $_POST['middlename'];
    $_SESSION['page1_data']['lastname'] = $_POST['lastname'];
    $_SESSION['page1_data']['suffix'] = $_POST['suffix'];
    $_SESSION['page1_data']['email'] = $_POST['email'];
    $_SESSION['page1_data']['password'] = $_POST['password'];
    $_SESSION['page1_data']['re_password'] = $_POST['re_password'];
    $_SESSION['page1_data']['phonenumber'] = $_POST['phonenumber'];
    $_SESSION['page1_data']['birthday'] = $_POST['birthday'];
    $_SESSION['page1_data']['purok'] = $_POST['purok'];
    $_SESSION['page1_data']['barangay'] = $_POST['barangay'];

    // Check if passwords match
    if ($_SESSION['page1_data']['password'] !== $_SESSION['page1_data']['re_password']) {
        $_SESSION['status'] = 'Passwords do not match.';
        $_SESSION['status_code'] = 'error';
        header('Location: tutor_page1.php'); // Redirect back to page1.php
        exit();
    }

    // Redirect to page 2 if passwords match
    header('Location: tutor_page2.php');
    exit();
} else {
    // If someone tries to access this page directly, redirect to page 1
    header('Location: ../login/index.php');
    exit();
}
?>
