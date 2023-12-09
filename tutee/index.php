<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />

<div class="container mt-3">
<nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Tutoring Services</li>
            </ol>
          </nav>
</div>

 <div class="col-lg-12">
                <div class="candidate-list-widgets mb-4">
                    <form action="#" class="">
                        <div class="g-2 row">
                            <div class="col-lg-4">
                            <div class="filler-job-form">
                            <i class="uil uil-location-point"></i>
                            <select class="form-select selectForm__inner" data-trigger="true" name="choices-single-location" id="choices-single-location" aria-label="Default select example" required>
                            <option selected disabled>Select Category</option>
                            <option value="Academic">Academic</option>
                            <option value="Non Academic">Non Academic</option>
                            </select>
                            </div>
                            </div>
                           
                                                        <!-- Second dropdown for Academic subjects -->
                            <div class="col-lg-4" id="academicSubjects" style="display: none;">
                                <div class="filler-job-form">
                                    <i class="uil uil-location-point"></i>
                                    <select class="form-select selectForm__inner" name="academicSubjects" aria-label="Default select example" required>
                                        <option selected disabled>Select Academic Subject</option>
                                        <option value="Science">Science</option>
                                        <option value="Math">Math</option>
                                        <option value="English">English</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Second dropdown for Non Academic subjects -->
                            <div class="col-lg-4" id="nonAcademicSubjects" style="display: none;">
                                <div class="filler-job-form">
                                    <i class="uil uil-location-point"></i>
                                    <select class="form-select selectForm__inner" name="nonAcademicSubjects" aria-label="Default select example" required>
                                        <option selected disabled>Select Non Academic Subject</option>
                                        <option value="Guitar Lesson">Guitar Lesson</option>
                                        <option value="Public Speaking Masterclass">Public Speaking Masterclass</option>
                                        <option value="Bookkeeping NC III">Bookkeeping NC III</option>
                                    </select>
                                </div>
                            </div>
                         
                            <div class="col-lg-4">
                                <div class="filler-job-form">
                                    <i class="uil uil-location-point"></i>
                                    <select class="form-select selectForm__inner" data-trigger="true" name="choices-single-location" id="choices-single-location" aria-label="Default select example" required>
                                       
                                    <option selected disabled>Select Municipality</option>
                                        <option value="Academic">Academic</option>
                                        <option value="Aloran">Aloran</option>
                                        <option value="Aloran">Baliangao</option>
                                        <option value="Bonifacio">Bonifacio</option>
                                        <option value="Calamba">Calamba</option>
                                        <option value="Clarin">Clarin</option>
                                        <option value="Conception">Conception</option> 
                                        <option value="Don Victoriano">Don Victoriano</option>
                                        <option value="Jimenez">Jimenez</option>
                                        <option value="Lopez Jaena">Lopez Jaena</option>
                                        <option value="Oroquieta City">Oroquieta City</option>
                                        <option value="Ozamis City">Ozamis City</option>
                                        <option value="Panaon">Panaon</option>
                                        <option value="Plaridel">Plaridel</option>
                                        <option value="Sapang Dalaga">Sapang Dalaga</option>
                                        <option value="Sinacaban">Sinacaban</option>
                                        <option value="Tangub City">Tangub City</option>
                                        <option value="Tudela">Tudela</option>

                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>

<section class="section">
    <div class="container">
        <div class="row">
        <div class="align-items-center row">
                    <div class="col-lg-8">
                        <div class="mb-3 mb-lg-0"><h6 class="fs-16 mb-0">Showing 1 – 8 of 11 results</h6></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="candidate-list-widgets">
                            <div class="row">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="container">
   
</div>
            <div class="col-lg-12">
          
                <div class="candidate-list">
                   

            <?php

        require '../admin/config/config.php';

        if (isset($_SESSION['auth_user'])) {
            // Retrieve the user ID from the session
            $id = $_SESSION['auth_user']['user_id'];

            $query = "SELECT
                onlinetutorial.job.job_id, 
                onlinetutorial.job.title, 
                onlinetutorial.job.description, 
                onlinetutorial.job.rate, 
                onlinetutorial.job.rate_description, 
                onlinetutorial.job.`status`, 
                onlinetutorial.job.date_posted, 
                onlinetutorial.tutor.address, 
                onlinetutorial.tutor.skills, 
                onlinetutorial.tutor.profile_picture, 
                onlinetutorial.tutor.tutor_id, 
                onlinetutorial.user_accounts.user_id
            FROM
                onlinetutorial.job
                INNER JOIN
                onlinetutorial.user_accounts
                ON 
                    onlinetutorial.job.tutor_id = onlinetutorial.user_accounts.user_id
                INNER JOIN
                onlinetutorial.tutor
                ON 
                    onlinetutorial.user_accounts.user_id = onlinetutorial.tutor.user_id";

            $query_run = mysqli_query($con, $query);
            $check_jobs = mysqli_num_rows($query_run) > 0;

            if ($check_jobs) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    // Check if the user has applied for this job
                    $jobId = $row['job_id'];
                    $checkApplicationQuery = "SELECT * FROM job_application WHERE tutee_id = $id AND job_id = $jobId";
                    $checkApplicationResult = mysqli_query($con, $checkApplicationQuery);
                    $isApplied = mysqli_num_rows($checkApplicationResult) > 0;

                    ?>
                
                <div class="candidate-list-box card mt-2">
                        <div class="p-4 card-body">
                            <div class="align-items-center row">
                                <div class="col-auto">
                                    <div class="candidate-list-images">

                                    <!-- <a href="view_tutor_profile.php?id=<?= $row['tutor_id']; ?>"> -->
                                    <?php 
                                        echo '<img class="avatar-md rounded-circle" 
                                            data-image="'.base64_encode($row['profile_picture']).'" 
                                            src="data:image;base64,'.base64_encode($row['profile_picture']).'" 
                                            alt="image" style="object-fit: cover;">'; 
                                    ?>
                                </a>

                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="candidate-list-content mt-3 mt-lg-0">
                                        <h5 class="fs-19 mb-0">
                                            <a class="primary-link"><?php echo $row['title'] ?></a>
                                        </h5>
                                        <ul class="list-inline mb-0 text-muted">
                                            <li class="list-inline-item"><?php echo $row['address'] ?></li>
                                            <br>
                                            <li class="list-inline-item">
                                                <span class="badge <?php echo ($row['status'] === 'Active') ? 'bg-success' : (($row['status'] === 'Ongoing') ? 'bg-warning' : 'bg-secondary'); ?>">
                                                    <?php echo $row['status'] ?>
                                                </span>
                                            </li>

                                            <br>
                                            <li class="list-inline-item">Date posted: <?php $datePosted = strtotime($row['date_posted']);  $formattedDate = date('Y-m-d', $datePosted); echo $formattedDate; ?></li>
                                            <br>
                                            <li class="list-inline-item">
                                                <a  href="view_tutor_profile.php?id=<?= $row['user_id']; ?>" class="btn btn-info btn-sm" >View Profile</a>
                                            </li>
                                            <br>


                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                    <?php
                                    $skills = explode(',', $row['skills']);
                                    foreach ($skills as $skills) {
                                        echo '<span class="badge bg-soft-secondary fs-14 mt-1">' . trim($skills) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                               
                            </div>

                           
                            <div class="favorite-icon mt-2">
                                            <?php if ($row['status'] !== 'Ongoing') : ?>
                                                <?php if ($isApplied) : ?>
                                                    <a class="btn btn-outline-primary disabled" aria-disabled="true"><b>APPLIED</b></a>
                                                <?php else : ?>
                                                    <a class="btn btn-outline-primary" href="apply.php?id=<?= $row['job_id']; ?>"><b>APPLY</b></a>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <a class="btn btn-outline-primary disabled" aria-disabled="true"><b>APPLIED</b></a>
                                            <?php endif; ?>
                                        </div>


                        </div>
                    </div>
                   
                    <?php
               
            }
        }
        else{
            echo "No job posted yet";
        }
    }


            ?>

                </div>
            </div>
        </div>
    </div>
</section>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deleteJobForm" action="process.php" method="post">
                    <input type="hidden" name="job_id" id="job_id">
                    <p>Are you sure you want to delete this post?</p>
                    <div class="text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="delete" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('choices-single-location').addEventListener('change', function () {
        var academicSubjects = document.getElementById('academicSubjects');
        var nonAcademicSubjects = document.getElementById('nonAcademicSubjects');

        if (this.value === 'Academic') {
            academicSubjects.style.display = 'block';
            nonAcademicSubjects.style.display = 'none';
        } else if (this.value === 'Non Academic') {
            academicSubjects.style.display = 'none';
            nonAcademicSubjects.style.display = 'block';
        } else {
            academicSubjects.style.display = 'none';
            nonAcademicSubjects.style.display = 'none';
        }
    });
</script>


<script>
    function setJobIdToDelete(jobId) {
        document.getElementById('job_id').value = jobId;
    }
</script>




<?php
 include('./includes/footer.php');
 ?>
