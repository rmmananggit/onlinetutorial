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
            <table id="datatablesSimple" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Profile Picture</th>
                        <th>Applicant Name</th>
                        <th>Date Applied</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Profile Picture</th>
                        <th>Applicant Name</th>
                        <th>Date Applied</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $query = "SELECT
                                job_application.application_id, 
                                job_application.date_applied, 
                                job_application.job_id,     
                                job_application.`status`, 
                                user_accounts.firstname, 
                                user_accounts.lastname, 
                                tutee.profile_picture
                            FROM
                                job_application
                                INNER JOIN
                                user_accounts
                                ON 
                                    job_application.user_id = user_accounts.user_id
                                INNER JOIN
                                tutee
                                ON 
                                    user_accounts.user_id = tutee.user_id
                            WHERE
                                job_application.job_id = '$id' AND
                                job_application.`status` = 'Pending'";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo '<img class="avatar-md" 
                                            data-image="' . base64_encode($row['profile_picture']) . '" 
                                            src="data:image;base64,' . base64_encode($row['profile_picture']) . '" 
                                            alt="image" style="height: 150px; object-fit: cover;">';
                                        ?>
                                    </td>
                                    <td><b><?= $row['firstname']; ?> <?= $row['lastname']; ?></b></td>
                                    <td><?= date('Y-m-d', strtotime($row['date_applied'])); ?></td>

                                    <td class="text-center">
                                        <form action="process.php" method="POST">
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <!-- Accept button form -->
                                                <input type="hidden" name="job_id" value="<?= $row['job_id']; ?>">
                                                <input type="hidden" name="id" value="<?= $row['application_id']; ?>">
                                                <button type="submit" name="accept" class="btn btn-outline-primary">Accept</button>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <!-- Reject button form -->
                                                <input type="hidden" name="reject" value="<?= $row['application_id']; ?>">
                                                <button type="submit" name="reject" class="btn btn-outline-danger">Reject</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else {
                    ?>
                            <tr>
                                <td colspan="4"><h4>No Record Found!</h4></td>
                            </tr>
                    <?php
                        }
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
