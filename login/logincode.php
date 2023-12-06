<?php
session_start();
include('../admin/config/config.php');

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // $login_query = "SELECT id, firstname, middlename, lastname, username, password, role, is_verified, status FROM `tutor` WHERE username ='$username' AND password ='$password' LIMIT 1";
    // $login_query_run = mysqli_query($con, $login_query);

    $login_query = "SELECT `user_id`, `firstname`, `lastname`, `email`, `password`, `phone_number`, `is_verified`, `role`, `otp`, `user_status` FROM `user_accounts` WHERE email = '$email' AND password = '$password' LIMIT 1";
$login_query_run = mysqli_query($con, $login_query);


if (mysqli_num_rows($login_query_run) > 0) {
    $data = mysqli_fetch_assoc($login_query_run);

    $user_id = $data['user_id'];
    $full_name = $data['firstname'] . ' ' . $data['lastname'];
    $user_status = $data['user_status'];
    $user_type = $data['role'];
    $user_email = $data['email'];
    $is_verified = $data['is_verified'];

    if (!$is_verified) {
        $_SESSION['status'] = "Your account is not verified. Please verify using OTP.";
        $_SESSION['status_code'] = "warning";
        header("Location: ../login/index.php");
        exit(0);
    }

    $_SESSION['auth'] = true;
    $_SESSION['user_type'] = "$user_type";
    $_SESSION['u_status'] = "$user_status";
    $_SESSION['auth_user'] = [
        'user_id' => $user_id,
        'user_name' => $full_name,
        'user_email' => $user_email,
    ];

    if ($_SESSION['u_status'] == 'Deactivated') {
        $_SESSION['status'] = "Your account has been deactivated";
        $_SESSION['status_code'] = "error";
        header("Location: ../login/index.php");
        exit(0);
    } elseif ($_SESSION['u_status'] == 'Pending') {
        $_SESSION['status'] = "Your account is still pending";
        $_SESSION['status_code'] = "warning";
        header("Location: ../login/index.php");
        exit(0);
    } elseif ($_SESSION['u_status'] == 'Active') {
        if ($_SESSION['user_type'] == '2') {
            $_SESSION['status'] = "Welcome $full_name";
            $_SESSION['status_code'] = "success";
            header("Location: ../tutor/checkprofile.php");
            exit(0);
        } elseif ($_SESSION['user_type'] == '1') {
            header("Location: ../tutee/checkprofile.php");
            exit(0);
        } elseif ($_SESSION['user_type'] == '3') {
            $_SESSION['status'] = "Welcome $full_name!";
            $_SESSION['status_code'] = "success";
            header("Location: ../admin/index.php");
            exit(0);
        }   else {
            $_SESSION['status'] = "Invalid account type";
            $_SESSION['status_code'] = "error";
            header("Location: ../login/index.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Invalid Username and Password";
        $_SESSION['status_code'] = "error";
        header("Location: index.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = "Invalid Username and Password";
    $_SESSION['status_code'] = "error";
    header("Location: index.php");
    exit(0);
}
}
?>
