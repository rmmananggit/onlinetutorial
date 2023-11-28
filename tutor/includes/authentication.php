<?php
session_start();
include('../admin/config/config.php');

if(!isset($_SESSION['auth']))
{
    $_SESSION['status'] = "Login to access dashboard";
    $_SESSION['status_code'] = "warning";
    header("Location: ../login/index.php");
    exit(0);
}
// else
// {
//     if ($_SESSION['u_status'] != "1")
//     {
//         $_SESSION['message'] = "You are not authorized as ADMIN";
//         header("Location: ../login.php");
//         exit(0);
//     }
// }

?>

