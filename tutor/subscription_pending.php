<?php
session_start();

unset( $_SESSION['auth']);
unset( $_SESSION['user_type']);
unset( $_SESSION['auth_user']);

$_SESSION['status'] = "Your subscription is still pending.";
$_SESSION['status_code'] = "warning";
header("Location: ../loginpage/index.php");
exit(0);
?>
