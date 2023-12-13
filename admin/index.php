<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>

<div class="container-fluid px-4 mt-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           All Accounts
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                                    job.title, 
                                    job.description, 
                                    job.rate, 
                                    job.rate_description, 
                                    job.user_id,
                                    job_application.`status`, 
                                    job_application.job_id
                                FROM
                                    job
                                INNER JOIN
                                    job_application
                                ON 
                                    job.job_id = job_application.job_id
                                WHERE
                                    job_application.user_id = $user_id AND
                                    job_application.`status` = 'Ongoing'";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td><b><?= $row['title']; ?></b></td>
                                    <td><?= $row['description']; ?></td>
                                    <td><?= $row['rate']; ?>/<?= $row['rate_description']; ?></td>
                                    <td style="color: <?= $row['status'] === 'Accepted' ? 'green' : ($row['status'] === 'Rejected' ? 'red' : ($row['status'] === 'Ongoing' ? 'orange' : 'black')) ?>; font-weight: bold;">
                                    <?= $row['status'] ?>
                                    </td>
                                    <td class="text-center">

<div class="btn-group" role="group" aria-label="Basic outlined example">
<a type="button" class="btn btn-outline-primary" href="view_details.php?id=<?=$row['user_id'];?>">View Details</a>
</div></td>                         
                                
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
