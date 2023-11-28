<?php
include('./includes/authentication.php');


//add tutoring services
if(isset($_POST['create_tutoring_services']))
{
    $tutor_id = $_SESSION['auth_user']['user_id'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $rate = mysqli_real_escape_string($con, $_POST['rate']);
    $rate_description = mysqli_real_escape_string($con, $_POST['rate_description']);
    $datetime = mysqli_real_escape_string($con, $_POST['datetime']);
    $job_duration = mysqli_real_escape_string($con, $_POST['job_duration']);
    $job_description = mysqli_real_escape_string($con, $_POST['job_description']);
    $skills = isset($_POST['skills']) ? array_map(function($value) use ($con) {
        return mysqli_real_escape_string($con, $value);
    }, $_POST['skills']) : [];

    // Ensure proper handling of date and time input
    $formattedDatetime = date("Y-m-d H:i:s", strtotime($datetime));

    $serializedSkills = implode(',', $skills);

    $query = "INSERT INTO `job`(`tutor_id`, `job_title`, `description`, `rate`, `rate_desc`, `skills_required`, `prefer_schedule`, `job_duration`, `duration_desc`) VALUES ('$tutor_id','$title','$description','$rate','$rate_description','$serializedSkills','$formattedDatetime','$job_duration','$job_description')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['status'] = "Success";
        $_SESSION['status_code'] = "success";
        header('Location: index.php');
        exit(0);
    } else {
        $_SESSION['status'] = "Failed";
        $_SESSION['status_code'] = "error";
        header('Location: index.php');
        exit(0);
    }
}
