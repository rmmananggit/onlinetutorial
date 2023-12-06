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
