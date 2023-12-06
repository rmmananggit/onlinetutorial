<?php
session_start();
require_once '../admin/config/config.php';

// Check if the user is logged in
if (isset($_SESSION['auth_user']['user_id'])) {
    $userId = $_SESSION['auth_user']['user_id'];
    $username = $_SESSION['auth_user']['user_name'];

    // Assuming your details table has a column 'user_id' which links to the 'user_accounts' table
    $checkProfileStmt = $con->prepare("SELECT * FROM tutor WHERE user_id = ?");
    $checkProfileStmt->bind_param("i", $userId);
    $checkProfileStmt->execute();
    $profileResult = $checkProfileStmt->get_result();
    $checkProfileStmt->close();

    if ($profileResult->num_rows > 0) {
        $_SESSION['status'] = "Welcome $username";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
    } else {
        $_SESSION['status'] = "Fill-up profile information to proceed to dashboard";
        $_SESSION['status_code'] = "warning";
        header('Location: add_profile_details.php');
        exit();
    }
} else {
    // Redirect to the login page if the user is not logged in
    header('Location: ../login/index.php');
    exit();
}
?>
