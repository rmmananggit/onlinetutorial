<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['tutor_subscription']['subscription_type'] = $_POST['subscription_type'];


    header('Location: tutor_page1.php');
    exit();
} else {

    header('Location: ../login/index.php');
    exit();
}
?>
