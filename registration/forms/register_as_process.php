<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['register_as']['role_type'] = $_POST['role_type'];

    if ($_SESSION['register_as']['role_type'] == 2) {
        header('Location: tutor_subscription.php');
        exit();
    } elseif ($_SESSION['register_as']['role_type'] == 3) {
        header('Location: tutee_subscription.php');
        exit();
    }
} else {
    header('Location: ../login/index.php');
    exit();
}
?>
