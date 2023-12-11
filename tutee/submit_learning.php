<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');
?>

<div class="container-fluid px-4 mt-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Learning Materials</li>
        <li class="breadcrumb-item">Submit</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           Modules
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered" width="400px">
                    <thead>
                        <tr>
                            <th>Tutorial Title</th>
                            <th>Module</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tutorial Title</th>
                            <th>Module</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        job_module.module_title, 
                        job_module.module_description, 
                        job.title, 
                        job_application.`status`, 
                        job_application.user_id, 
                        job_module.module_id
                    FROM
                        job_module
                        INNER JOIN
                        job
                        ON 
                            job_module.job_id = job.job_id
                        INNER JOIN
                        job_application
                        ON 
                            job.job_id = job_application.job_id
                    WHERE
                        job_application.user_id = '$user_id' AND
                        job_application.`status` = 'Ongoing'";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td width="100px"><?= $row['title']; ?></td>
                                    <td width="100px"><?= $row['module_title']; ?></td>
                                    <td width="100px"><?= $row['module_description']; ?></td>
                                    <td width="100px">
                                    <form action="process.php" method="POST">  
                                    <div class="btn-group" rolez="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn btn-outline-primary" href="module_files.php?id=<?=$row['module_id'];?>">View</a>
                                    </div>
                                    </form>
                                    </td>
                                
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="4">No Record Found</td>
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
