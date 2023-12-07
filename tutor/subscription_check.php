<?php
session_start();
require_once '../admin/config/config.php';

$userId = $_SESSION['auth_user']['user_id'];

$sql = "SELECT * FROM subscriptions WHERE user_id = $userId";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $subscription = $result->fetch_assoc();

    // Check if the subscription status is 'pending'
    if ($subscription['status'] === 'Pending') {
        header("Location: subscription_pending.php");
        exit(); // Make sure to exit after redirect
    }

    // Assuming you have a column named 'expiration_date' in your 'subscriptions' table
    $expirationDate = strtotime($subscription['expiration_date']);
    $currentDate = time();

    // Compare the current date with the expiration date
    if ($currentDate > $expirationDate) {
        $_SESSION['status'] = "Your subscription has been expired.";
        $_SESSION['status_code'] = "warning";
        header("Location: update_payment.php");
    } else {
        header("Location: checkprofile.php");
    }
} else {
    $_SESSION['status'] = "Manage your subscription here";
    $_SESSION['status_code'] = "info";
    header("Location: subscription.php");
}

$con->close();
?>
