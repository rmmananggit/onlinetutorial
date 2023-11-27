<?php
session_start();
include('../admin/config/config.php');

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT id,firstname,middlename,lastname,username,password,role, is_verified,status
    FROM users WHERE username = '$username' AND password = '$password' UNION SELECT id, firstname, middlename, lastname, username, password,role, is_verified, status
    FROM tutor WHERE username = '$username' AND password = '$password' UNION SELECT id, firstname, middlename, lastname, username, password, role, is_verified, status
    FROM tutee WHERE username = '$username' AND password = '$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $data = mysqli_fetch_assoc($login_query_run);

        $user_id = $data['id'];
        $full_name = $data['firstname'] . ' ' . $data['lastname'];
        $status = $data['status'];
        $roles = $data['role'];
        $user_username = $data['username'];
        $is_verified = $data['is_verified'];

        if (!$is_verified) {
            $_SESSION['status'] = "Your account is not verified. Please verify using OTP.";
            $_SESSION['status_code'] = "warning";
            header("Location: ../login/index.php");
            exit(0);
        }

        $_SESSION['auth'] = true;
        $_SESSION['roles'] = "$roles";
        $_SESSION['status'] = "$status";
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_name' => $full_name,
            'user_username' => $user_username,
        ];

        if ($_SESSION['status'] == 'Deactivated') {
            $_SESSION['status'] = "Your account has been deactivated";
            $_SESSION['status_code'] = "error";
            header("Location: ../login/index.php");
            exit(0);
        } elseif ($_SESSION['status'] == 'Pending') {
            $_SESSION['status'] = "Your account is still pending";
            $_SESSION['status_code'] = "warning";
            header("Location: ../login/index.php");
            exit(0);
        } elseif ($_SESSION['status'] == '1') {
            if ($_SESSION['roles'] == '1') {
                $_SESSION['status'] = "Welcome $full_name";
                $_SESSION['status_code'] = "success";
                header("Location: ../tutor/index.php");
                exit(0);
            } elseif ($_SESSION['roles'] == '2') {
                $_SESSION['status'] = "Welcome $full_name!";
                $_SESSION['status_code'] = "success";
                header("Location: ../tutee/index.php");
                exit(0);
            } elseif ($_SESSION['roles'] == '3') {
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
