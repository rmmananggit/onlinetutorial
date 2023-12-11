<?php
include('./includes/authentication.php');


if (isset($_POST['create_tutoring_services'])) {
    $tutor_id = $_SESSION['auth_user']['user_id'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $rate = mysqli_real_escape_string($con, $_POST['rate']);
    $rate_description = mysqli_real_escape_string($con, $_POST['rate_description']);

    $currentDateTime = date('Y-m-d H:i:s');
    $days = $_POST['day'];
    $startTimes = $_POST['starttime'];
    $endTimes = $_POST['endtime'];

    // Insert data into the job table
    $queryJob = "INSERT INTO `job`(`user_id`, `title`, `description`, `rate`, `rate_description`, `date_posted`) VALUES ('$tutor_id','$title','$description','$rate','$rate_description','$currentDateTime')";
    $query_run_job = mysqli_query($con, $queryJob);

    if ($query_run_job) {
        $jobId = $con->insert_id;  // Get the ID of the inserted row (assumes `id` is the primary key in `job`)

        // Insert data into the job_module table
        if (isset($_POST["module"]) && is_array($_POST["module"])) {
            foreach ($_POST["module"] as $key => $moduleName) {
                $moduleDesc = mysqli_real_escape_string($con, $_POST["moduledesc"][$key]);
                $queryModule = "INSERT INTO `job_module` (`job_id`, `module_title`, `module_description`) VALUES ('$jobId', '$moduleName', '$moduleDesc')";
                $query_run_module = mysqli_query($con, $queryModule);

                // Insert data into the job_schedule table for each module
                if ($query_run_module) {
                    $moduleId = $con->insert_id;

                    // Check if the corresponding days, start times, and end times exist
                    if (isset($days[$key]) && isset($startTimes[$key]) && isset($endTimes[$key])) {
                        $day = mysqli_real_escape_string($con, $days[$key]);
                        $startTime = mysqli_real_escape_string($con, $startTimes[$key]);
                        $endTime = mysqli_real_escape_string($con, $endTimes[$key]);

                        // Insert data into the job_schedule table
                        $querySchedule = "INSERT INTO `job_schedule` (`job_id`, `day`, `start`, `end`) VALUES ('$moduleId', '$day', '$startTime', '$endTime')";
                        $query_run_schedule = mysqli_query($con, $querySchedule);

                        if (!$query_run_schedule) {
                            // Handle the error (you can log it, display a message, etc.)
                            $_SESSION['status'] = "Error inserting schedule data.";
                            $_SESSION['status_code'] = "error";
                            header('Location: my_tutoring_services.php');
                            exit(0);
                        }
                    }
                }
            }
        }

        $_SESSION['status'] = "Your job has been posted!";
        $_SESSION['status_code'] = "success";
        header('Location: my_tutoring_services.php');
        exit(0);
    } else {
        $_SESSION['status'] = "Failed to insert job data.";
        $_SESSION['status_code'] = "error";
        header('Location: my_tutoring_services.php');
        exit(0);
    }
}






if (isset($_POST['submit'])) {
    $user_id = $_SESSION['auth_user']['user_id'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $aboutme = $_POST['aboutme'];
    $position = $_POST['position'];
    $employmenttype = $_POST['employmenttype'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $school = $_POST['school'];
    $degree = $_POST['degree'];
    $fieldofstudy = $_POST['fieldofstudy'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $skills_string = implode(', ', $_POST['skills']);

    // Handle file uploads
    $resume_file_path = ''; // Set a default value
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $resume_file_path = 'uploads/' . basename($_FILES['resume']['name']);
        move_uploaded_file($_FILES['resume']['tmp_name'], $resume_file_path);
    }

    $profile_picture = ''; // Set a default value
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
    }

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO `tutor`(`user_id`, `gender`, `address`, `barangay`, `municipality`, `zipcode`, `aboutme`, `position`, `employmenttype`, `company`, `location`, `school`, `degree`, `fieldofstudy`, `startdate`, `enddate`, `skills`, `resume_file_path`, `profile_picture`) VALUES ('$user_id','$gender','$address','$barangay','$municipality','$zipcode','$aboutme','$position','$employmenttype','$company','$location','$school','$degree','$fieldofstudy','$startdate','$enddate','$skills_string','$resume_file_path','$profile_picture')";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "";
        $_SESSION['status_code'] = "success";
        header('Location: index.php');
        exit(0);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}


if (isset($_POST['delete'])) {
    $job_id = $_POST['job_id'];

    // Use prepared statements to prevent SQL injection
    $query = "DELETE FROM `job` WHERE `job_id` = '$job_id' ";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Job deleted sucessfully";
        $_SESSION['status_code'] = "success";
        header('Location: my_tutoring_services.php');
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


if (isset($_POST['update_account'])) {
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $newpass = $_POST['newpass'];
    $cpass = $_POST['cpass'];

    // Check if the new password and confirm password match
    if ($newpass !== $cpass) {
        $_SESSION['status'] = "New password and confirm password do not match!";
        $_SESSION['status_code'] = "error";
        header('Location: my_profile.php');
        exit(0);
    }

    // Check if the email is already taken
    $check_email_query = "SELECT * FROM `user_accounts` WHERE `email`='$email' AND `user_id` <> '$user_id'";
    $check_email_result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {
        $_SESSION['status'] = "Email is already taken!";
        $_SESSION['status_code'] = "error";
        header('Location: my_profile.php');
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
    $update_result = mysqli_query($con, $update_query);

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
                header('Location: my_profile.php');
                exit(0);
            }
        }
    
        $_SESSION['status'] = "Your Account has been updated!";
        $_SESSION['status_code'] = "success";
        header('Location: my_profile.php');
        exit(0);

    $_SESSION['status'] = "Your Account has been updated!";
    $_SESSION['status_code'] = "success";
    header('Location: my_profile.php');
    exit(0);
}

if (isset($_POST['add_file'])) {
    // Retrieve form data
    $module_id = $_POST['module_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // File upload handling
    $uploadDir = './uploads/'; // Directory to store uploaded files
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
        // File has been moved successfully
        $query = "INSERT INTO `job_module_files`(`module_id`, `title`, `description`, `file_name`, `file_type`, `file_path`) VALUES ('$module_id','$title','$description','$fileName','$fileType','$filePath')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $_SESSION['status'] = "File has been added successfully";
            $_SESSION['status_code'] = "success";
            header('Location: learning_resources.php');
            exit(0);
        } else {
            $_SESSION['status'] = "Error adding file to the database";
            $_SESSION['status_code'] = "error";
            header('Location: learning_resources.php');
            exit(0);
        }
    } else {
        // File move failed
        $_SESSION['status'] = "Error moving the file to the server";
        $_SESSION['status_code'] = "error";
        header('Location: learning_resources.php');
        exit(0);
    }
}


if (isset($_POST['accept'])) {
    $applicationId = $_POST['id'];
    $status = "Accept";
    
    $query = "UPDATE `job_application` SET `status`='$status' WHERE `application_id`= $applicationId";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Application Accepted";
        $_SESSION['status_code'] = "success";
      header('Location: hire.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
      header('Location: hire.php');
        exit(0);
    }

} 

    if (isset($_POST['reject'])) {
    $applicationId = $_POST['id'];
    $status = "Rejected";
    
    $query1 = "UPDATE `job_application` SET `status`='$status' WHERE `application_id`= $applicationId";
    $query_run = mysqli_query($con, $query1);
    
    if($query_run)
    {
        $_SESSION['status'] = "Application Rejected";
        $_SESSION['status_code'] = "error";
      header('Location: hire.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
      header('Location: hire.php');
        exit(0);
    }

}
