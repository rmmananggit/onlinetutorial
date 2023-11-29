<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>

<div class="col-md-12 mb-3 text-center">
    <h3 style="font-size: 35px;">All Online Tutoring Services</h3>
    <small><i>Unlocking Potential, One Lesson at a Time.</i></small>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<section class="section">
    <div class="container">
        <div class="justify-content-center row">
            <div class="col-lg-12">
                <div class="candidate-list-widgets mb-4">
                    <form action="#" class="">
                        <div class="g-2 row">
                            <div class="col-lg-3">
                                <div class="filler-job-form">
                                    <i class="uil uil-briefcase-alt"></i><input id="exampleFormControlInput1" placeholder="Job, Company name... " type="search" class="form-control filler-job-input-box form-control" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="filler-job-form">
                                    <i class="uil uil-location-point"></i>
                                    <select class="form-select selectForm__inner" data-trigger="true" name="choices-single-location" id="choices-single-location" aria-label="Default select example">
                                        <option value="AF">Afghanistan</option>
                                        <option value="AX">Åland Islands</option>
                                        <option value="AL">Albania</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="filler-job-form">
                                    <i class="uil uil-clipboard-notes"></i>
                                    <select class="form-select selectForm__inner" data-trigger="true" name="choices-single-categories" id="choices-single-categories" aria-label="Default select example">
                                        <option value="4">Accounting</option>
                                        <option value="1">IT &amp; Software</option>
                                        <option value="3">Marketing</option>
                                        <option value="5">Banking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div>
                                    <a class="btn btn-primary" href="#"><i class="uil uil-filter"></i> Filter</a><a class="btn btn-success ms-2" href="#"><i class="uil uil-cog"></i> Advance</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="align-items-center row">
                    <div class="col-lg-8">
                        <div class="mb-3 mb-lg-0"><h6 class="fs-16 mb-0">Showing 1 – 8 of 11 results</h6></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="candidate-list-widgets">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="selection-widget">
                                        <select class="form-select" data-trigger="true" name="choices-single-filter-orderby" id="choices-single-filter-orderby" aria-label="Default select example">
                                            <option value="df">Default</option>
                                            <option value="ne">Newest</option>
                                            <option value="od">Oldest</option>
                                            <option value="rd">Random</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="selection-widget mt-2 mt-lg-0">
                                        <select class="form-select" data-trigger="true" name="choices-candidate-page" id="choices-candidate-page" aria-label="Default select example">
                                            <option value="df">All</option>
                                            <option value="ne">8 per Page</option>
                                            <option value="ne">12 per Page</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="candidate-list">
                   

            <?php

        require '../admin/config/config.php';

        $query = "SELECT
        tutor.lastname, 
        tutor.middlename, 
        tutor.firstname, 
        tutor.id, 
        job.job_id,
        job.date_posted, 
        job.job_title, 
        job.description, 
        job.rate, 
        job.rate_desc, 
        job.job_duration, 
        job.duration_desc, 
        job.`Status`,
        tutor.profile_image,
        tutor.address,
        tutor.skills,
        tutor.id AS tutor_id
    FROM
        job
        INNER JOIN
        tutor
        ON 
            job.tutor_id = tutor.id";

        $query_run = mysqli_query($con, $query);
        $check_jobs = mysqli_num_rows($query_run) > 0;

        if($check_jobs)
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
                ?>
                
                <div class="candidate-list-box card mt-4">
                        <div class="p-4 card-body">
                            <div class="align-items-center row">
                                <div class="col-auto">
                                    <div class="candidate-list-images">

                                    <a href="view_tutor_profile.php?id=<?= $row['tutor_id']; ?>">
                                    <?php 
                                        echo '<img class="avatar-md rounded-circle" 
                                            data-image="'.base64_encode($row['profile_image']).'" 
                                            src="data:image;base64,'.base64_encode($row['profile_image']).'" 
                                            alt="image" style="object-fit: cover;">'; 
                                    ?>
                                </a>

                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="candidate-list-content mt-3 mt-lg-0">
                                        <h5 class="fs-19 mb-0">
                                            <a class="primary-link"><?php echo $row['job_title'] ?></a>
                                        </h5>
                                        <p class="mb-2 mt-1" style="color: green;"><?php echo $row['Status'] ?></p>
                                        <ul class="list-inline mb-0 text-muted">
                                            <li class="list-inline-item"><i class="fa-solid fa-location-dot"></i> <?php echo $row['address'] ?></li>
                                            <br>
                                            <li class="list-inline-item"><i class="fa-solid fa-peso-sign"></i> <?php echo $row['rate'] ?>/<?php echo $row['rate_desc'] ?></li>
                                            <br>
                                            <li class="list-inline-item">Date posted: <?php $datePosted = strtotime($row['date_posted']);  $formattedDate = date('Y-m-d', $datePosted); echo $formattedDate; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                    <?php
                                    $skills = explode(',', $row['skills']);
                                    foreach ($skills as $skill) {
                                        echo '<span class="badge bg-soft-secondary fs-14 mt-1">' . trim($skill) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                               
                            </div>
                            <div class="favorite-icon">
                            <a class="btn btn-primary" href="apply.php?id=<?= $row['job_id']; ?>"><b>APPLY</b></a>
                            </div>
                        </div>
                    </div>
                   
                    <?php
               
            }
        }
        else{
            echo "No job posted yet";
        }


            ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="mt-4 pt-2 col-lg-12">
                <nav aria-label="Page navigation example">
                    <div class="pagination job-pagination mb-0 justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" tabindex="-1" href="#"><i class="mdi mdi-chevron-double-left fs-15"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="mdi mdi-chevron-double-right fs-15"></i></a>
                        </li>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>



<?php
 include('./includes/footer.php');
 ?>
