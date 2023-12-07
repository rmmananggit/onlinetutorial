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
    $queryJob = "INSERT INTO `job`(`tutor_id`, `title`, `description`, `rate`, `rate_description`, `date_posted`) VALUES ('$tutor_id','$title','$description','$rate','$rate_description','$currentDateTime')";
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
        $_SESSION['status'] = "Account has been added";
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