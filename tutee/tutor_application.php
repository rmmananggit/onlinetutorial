<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');
?>

<div class="container-fluid px-4 mt-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Tutor</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           My Application
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered" width="300px">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Job Title</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        job.title, 
                        job.description, 
                        job_application.user_id, 
                        job_application.`status`, 
                        job_application.date_applied
                    FROM
                        job_application
                        INNER JOIN
                        job
                        ON 
                            job_application.job_id = job.job_id
                    WHERE
                        job_application.user_id = $user_id AND
                        job_application.`status` = 'Pending'
                    ORDER BY
                        job_application.date_applied DESC";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td width="100px"><?= $row['title']; ?></td>
                                    <td width="100px"><?= $row['description']; ?></td>
                                    <td width="100px" style="color: <?= $row['status'] === 'Accepted' ? 'green' : ($row['status'] === 'Rejected' ? 'red' : ($row['status'] === 'Ongoing' ? 'orange' : 'black')) ?>; font-weight: bold;">
                                    <?= $row['status'] ?>
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
