<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>


<div class="container-fluid px-4">
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Tutoring Applicants</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Posted Tutoring Services
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                        <th>Job Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date Posted</th>
                        <th class="text-center">Action</th>
                                          
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Job Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th >Date Posted</th>
                        <th class="text-center">Action</th>
                                          
                                        </tr>
                                    </tfoot>
                                    <tbody>


                                    <?php

$user_id = $_SESSION['auth_user']['user_id'];
$query = "SELECT
job.job_id, 
job.user_id, 
job.title, 
job.description, 
job.rate, 
job.rate_description, 
job.`status`, 
job.date_posted
FROM
job
WHERE
job.user_id = $user_id";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $row)
    {
        ?>
                                        <tr>
                                        <td><b><?= $row['title']; ?></b></td>
                                    <td><?= $row['description']; ?></td>
                                    <td style="color: <?= $row['status'] === 'Active' ? 'green' : ($row['status'] === 'Ongoing' ? 'orange' : 'black') ?>; font-weight: bold;">
                                        <?= $row['status'] ?>
                                    </td>
                                    <td><?= date('Y-m-d', strtotime($row['date_posted'])); ?></td>
                                  

                                    
                                <td class="text-center">

<div class="btn-group" role="group" aria-label="Basic outlined example">
<a type="button" class="btn btn-outline-primary" href="hire_applicants.php?id=<?=$row['job_id'];?>">View</a>
</div></td>
                                        </tr>

                                        <?php
                                }
                            } else
                            {
                            ?>
                                <tr>
                                    <td colspan="6">No Record Found</td>
                                </tr>
                            <?php
                            }
                            ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


<?php
 include('./includes/footer.php');
 ?>
