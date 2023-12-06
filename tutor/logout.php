<?php
session_start();

unset( $_SESSION['auth']);
unset( $_SESSION['user_type']);
unset( $_SESSION['auth_user']);

$_SESSION['status'] = "You have been logout!";
$_SESSION['status_code'] = "success";
header("Location: ../login/index.php");
exit(0);
?>
