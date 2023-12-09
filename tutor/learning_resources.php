<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>


<div class="container-fluid mt-3">
                    <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modules</li>
                </ol>
                </nav>
</div>
<div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Modules
                            </div>
                            <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tutorial Title</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
    
                <tbody>
              <?php

                            $user_id = $_SESSION['auth_user']['user_id'];
                            $query = "SELECT
                            job_module.module_id, 
                            job_module.module_title, 
                            job_module.module_description, 
                            job.title, 
                            job.user_id
                        FROM
                            job
                            INNER JOIN
                            job_module
                            ON 
                                job.job_id = job_module.job_id
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
                                    <td><?= $row['module_title']; ?></td>
                                    <td><?= $row['module_description']; ?></td>
                                  

                                    
                                <td class="text-center">

<form action="process.php" method="POST">  
<div class="btn-group" role="group" aria-label="Basic outlined example">
<a type="button" class="btn btn-outline-primary" href="module_files.php?id=<?=$row['module_id'];?>">View</a>
</div>

</form>


</td>
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
                    </div>

                    
<?php
 include('./includes/footer.php');
 ?>
