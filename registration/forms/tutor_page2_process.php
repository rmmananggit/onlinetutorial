<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['skills']['checkbox'] = $_POST['math'];


    header('Location: page1.php');
    exit();
} else {

    header('Location: ../login/index.php');
    exit();
}
?>
