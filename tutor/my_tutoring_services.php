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
              <li class="breadcrumb-item active" aria-current="page">My Tutoring Services</li>
            </ol>
          </nav>
</div>



<section class="section">
    <div class="container">
        <div class="row">
        <div class="container">
    <div class="col-md-12">
    <a class="btn btn-primary" href="post_tutoring_services.php" role="button" style="float:right;">Create</a>
    </div>
</div>
            <div class="col-lg-12">
          
                <div class="candidate-list">
                   

            <?php

        require '../admin/config/config.php';

        if(isset($_SESSION['auth_user'])) {
            // Retrieve the user ID from the session
            $id = $_SESSION['auth_user']['user_id'];

        $query = "SELECT
        job.job_id,
        job.tutor_id, 
        job.title, 
        job.description, 
        job.rate, 
        job.rate_description, 
        job.date_posted, 
        job.status,
        tutor.profile_picture, 
        tutor.address,
        tutor.skills,
        tutor.address
    FROM
        job
        INNER JOIN
        tutor
        ON 
            job.tutor_id = tutor.tutor_id
        INNER JOIN
        user_accounts
        ON 
            tutor.user_id = user_accounts.user_id
    WHERE
        job.tutor_id = $id";

        $query_run = mysqli_query($con, $query);
        $check_jobs = mysqli_num_rows($query_run) > 0;

        if($check_jobs)
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
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
                                            <li class="list-inline-item"><?php echo $row['description'] ?></li>
                                            <br>
                                            <li class="list-inline-item">
                                                <span class="badge <?php echo ($row['status'] === 'Active') ? 'bg-success' : (($row['status'] === 'Ongoing') ? 'bg-warning' : 'bg-secondary'); ?>">
                                                    <?php echo $row['status'] ?>
                                                </span>
                                            </li>
                                            <br>
                                            <li class="list-inline-item">Date posted: <?php $datePosted = strtotime($row['date_posted']);  $formattedDate = date('Y-m-d', $datePosted); echo $formattedDate; ?></li>
                                            <br>
                                        </ul>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4">
                <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                    <?php
                                    $skills = explode(',', $row['skills']);
                                    foreach ($skills as $skills) {
                                        echo '<span class="badge bg-soft-secondary fs-14 mt-1">' . trim($skills) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div> -->
                               
                            </div>
                            <div class="favorite-icon mt-2">
                <a class="btn btn-outline-primary" href="view_tutoring_services.php?id=<?= $row['job_id']; ?>"><b>VIEW</b></a>
                <a class="btn btn-outline-info" href="view_tutoring_services.php?id=<?= $row['job_id']; ?>"><b>UPDATE</b></a>
                <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#exampleModal" onclick="setJobIdToDelete(<?= $row['job_id']; ?>)"><b>DELETE</b></a>
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
    function setJobIdToDelete(jobId) {
        document.getElementById('job_id').value = jobId;
    }
</script>




<?php
 include('./includes/footer.php');
 ?>
