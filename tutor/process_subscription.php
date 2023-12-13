<?php
session_start();

unset( $_SESSION['auth']);
unset( $_SESSION['user_type']);
unset( $_SESSION['auth_user']);

$_SESSION['status'] = "Your payment has been processed. We will send you an update via email";
$_SESSION['status_code'] = "info";
header("Location: ../loginpage/index.php");
exit(0);
?>
