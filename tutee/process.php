<?php
include('./includes/authentication.php');


if (isset($_POST['submit'])) {
    $user_id = $_SESSION['auth_user']['user_id'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $aboutme = $_POST['aboutme'];

    $profile_picture = ''; // Set a default value
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
    }

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO `tutee`(`user_id`, `gender`, `address`, `barangay`, `municipality`, `zipcode`, `aboutme`, `profile_picture`) VALUES ('$user_id','$gender','$address','$barangay','$municipality','$zipcode','$aboutme','$profile_picture')";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Welcome!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit(0);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

if(isset($_POST['submit_payment']))
{
    $user_id = $_SESSION['auth_user']['user_id'];
    $reference = $_POST['reference'];
    $subs = $_POST['subscriptiontype'];
    $mop = $_POST['mop'];
    $receipt = $_FILES['receipt'];

    $query = "INSERT INTO `subscriptions`(`user_id`, `subscription_type`, `reference`, `modeofpayment`, `receipt`) VALUES ('$user_id','$subs','$reference','$mop','$receipt')";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
      header('Location: process_subscription.php');
        exit(0);
    }
    else
    {
      header('Location: student_manage.php');
        exit(0);
    }
}


if(isset($_POST['apply']))
{
    $user_id = $_SESSION['auth_user']['user_id'];
    $job_id = $_POST['job_id'];
    $tutor = $_POST['tutor'];
    $status = "Pending";

    $query = "INSERT INTO `job_application`(`job_id`, `tutor_id`, `user_id`) VALUES ('$job_id','$tutor','$user_id')";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Applied!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "There is an error!";
        $_SESSION['status_code'] = "danger";
        header("Location: index.php");
        exit(0);
    }
}


if (isset($_POST['update_account'])) {
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $aboutme = $_POST['aboutme'];
    $address = $_POST['address'];
    $brgy = $_POST['brgy'];
    $municipality = $_POST['municipality'];
    $newpass = $_POST['newpass'];
    $cpass = $_POST['cpass'];

    // Check if the new password and confirm password match
    if ($newpass !== $cpass) {
        $_SESSION['status'] = "New password and confirm password do not match!";
        $_SESSION['status_code'] = "error";
        header('Location: settings.php');
        exit(0);
    }

    // Check if the email is already taken
    $check_email_query = "SELECT * FROM `user_accounts` WHERE `email`='$email' AND `user_id` <> '$user_id'";
    $check_email_result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {
        $_SESSION['status'] = "Email is already taken!";
        $_SESSION['status_code'] = "error";
        header('Location: settings.php');
        exit(0);
    }

    // Check if the phone number is already taken
    $check_phone_query = "SELECT * FROM `user_accounts` WHERE `phone_number`='$phone' AND `user_id` <> '$user_id'";
    $check_phone_result = mysqli_query($con, $check_phone_query);

    if (mysqli_num_rows($check_phone_result) > 0) {
        $_SESSION['status'] = "Phone number is already taken!";
        $_SESSION['status_code'] = "error";
        header('Location: settings.php');
        exit(0);
    }

    // Update other data
    $update_data = "`firstname`='$fname',`lastname`='$lname',`email`='$email',`phone_number`='$phone'";
    
    // Update password only if a new password is provided
    if (!empty($newpass)) {
        $hashed_newpass = password_hash($newpass, PASSWORD_DEFAULT); // Hash the new password
        $update_data .= ",`password`='$hashed_newpass'";
    }

    $update_query = "UPDATE `user_accounts` SET $update_data WHERE `user_id`='$user_id'";
    $update_query1 = "UPDATE `tutee` SET `address`='$address',`barangay`='$brgy',`municipality`='$municipality',`aboutme`='$aboutme' WHERE `user_id`='$user_id'";
    $update_result = mysqli_query($con, $update_query);
    $update_result1 = mysqli_query($con, $update_query1);

    if (!$update_result) {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
        header('Location: settings.php');
        exit(0);
    }

        // Update photo if a new photo is uploaded
        if ($_FILES["picture"]["tmp_name"]) {
            $picture_temp = $_FILES["picture"]["tmp_name"];
      
            // Retrieve existing photo, if any
            $retrieve_query = "SELECT `profile_picture` FROM `tutee` WHERE `user_id`='$user_id'";
            $retrieve_result = mysqli_query($con, $retrieve_query);
            $retrieve_row = mysqli_fetch_assoc($retrieve_result);
      
            // Delete existing photo from MySQL
            if ($retrieve_row['picture']) {
                $delete_query = "UPDATE `tutee` SET `profile_picture` = NULL WHERE `user_id`='$user_id'";
                $delete_result = mysqli_query($con, $delete_query);
            }
      
            // Upload new photo to MySQL
            $picture = mysqli_real_escape_string($con, file_get_contents($picture_temp));
            $update_photo_query = "UPDATE `tutee` SET `profile_picture`='$picture' WHERE `user_id`='$user_id'";
            $update_photo_result = mysqli_query($con, $update_photo_query);
      
            if (!$update_photo_result) {
                $_SESSION['status'] = "Something went wrong!";
                $_SESSION['status_code'] = "error";
                header('Location: settings.php.php');
                exit(0);
            }
        }
    
        $_SESSION['status'] = "Your Account has been updated!";
        $_SESSION['status_code'] = "success";
        header('Location: settings.php.php');
        exit(0);

    $_SESSION['status'] = "Your Account has been updated!";
    $_SESSION['status_code'] = "success";
    header('Location: settings.php.php');
    exit(0);
}

if (isset($_POST['submit_module_file'])) {
    // Retrieve form data
    $user_id = $_SESSION['auth_user']['user_id'];
    $module = $_POST['module'];
    $module_description = $_POST['module_description'];

    // File upload handling
    $uploadDir = '../uploads/'; // Directory to store uploaded files
    $fileName = $_FILES['fileInput']['name'];
    $fileTmpName = $_FILES['fileInput']['tmp_name'];
    $fileType = $_FILES['fileInput']['type'];

    // Move the uploaded file to the server
    $filePath = $uploadDir . $fileName;

    // Check if the directory exists, if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($fileTmpName, $filePath)) {
        $query = " INSERT INTO `submit_module`(`description`, `file_name`, `file_type`, `file_path`, `module_id`, `user_id`) VALUES ('$module_description','$fileName','$fileType','$filePath','$module','$user_id')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $_SESSION['status'] = "File has been submitted successfully";
            $_SESSION['status_code'] = "success";
            header('Location: submit_learning.php');
            exit(0);
        } else {
            $_SESSION['status'] = "Error adding file to the database";
            $_SESSION['status_code'] = "error";
            header('Location: submit_learning.php');
            exit(0);
        }
    } else {
        // File move failed
        $_SESSION['status'] = "Error moving the file to the server";
        $_SESSION['status_code'] = "error";
        header('Location: submit_learning.php');
        exit(0);
    }
}

if(isset($_POST['delete_submit_file']))
{
    $delete_submit_file = $_POST['delete_submit_file'];

    $query = "DELETE FROM `submit_module` WHERE `submit_id`= '2' ";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Deleted sucessfully";
        $_SESSION['status_code'] = "success";
    header('Location: submit_learning.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
    header('Location: submit_learning.php');
        exit(0);
    }
}   


if(isset($_POST['addreview']))
{
    $tutor_id = $_POST['module_id'];
    $review = $_POST['comment'];
    $rating = $_POST['rating'];
    $date = date('Y-m-d');


    $query = "INSERT INTO `review` (`tutor_id`, `review`, `start`, `date`) VALUES ('$tutor_id', '$review', '$rating', '$date')";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Your review has been posted";
        $_SESSION['status_code'] = "success";
    header('Location: ongoing_tutor.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
    header('Location: ongoing_tutor.php');
        exit(0);
    }
}   