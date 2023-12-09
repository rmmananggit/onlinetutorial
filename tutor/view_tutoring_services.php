<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');
?>

<div class="container-fluid px-4">
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item">Online Tutoring Services</li>
        <li class="breadcrumb-item active">View Online Tutoring Services</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $query = "SELECT
                            job.job_id, 
                            job.user_id, 
                            job.title, 
                            job.description, 
                            job.rate, 
                            job.rate_description, 
                            job.`status`, 
                            job.date_posted, 
                            job_module.module_title, 
                            job_module.module_description
                        FROM
                            job
                            INNER JOIN
                            job_module
                            ON 
                            job.job_id = job_module.job_id
                        WHERE
                            job.job_id = $id";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            $taskNumber = 1;

                            // Fetch other fields outside the loop
                            $jobDetails = mysqli_fetch_assoc($result);
                    ?>
                            <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <input required type="text" Placeholder="Job Title *" name="title" class="form-control" maxlength="80" value="<?= $jobDetails['title']; ?>" readonly>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <textarea class="form-control" name="description" rows="7" placeholder="Description *" maxlength="200" readonly><?= $jobDetails['description']; ?></textarea>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <input required type="text" Placeholder="Rate *" name="rate" class="form-control" value="₱<?= $jobDetails['rate']; ?>/<?= $jobDetails['rate_description']; ?>" readonly>
                                        </div>
                                    </div>

                                    <?php
                                    // Reset the data seek pointer for the main result set
                                    mysqli_data_seek($result, 0);

                                    // Loop for the module-related fields
                                    while ($user = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <div class="col-md-12 mb-3 module" data-task-number="<?= $taskNumber; ?>">
                                            <label for="module_<?= $taskNumber; ?>"><b>Learning Task <?= $taskNumber; ?></b></label>
                                            <input required type="text" Placeholder="Module Name *" name="module[<?= $taskNumber; ?>]" class="form-control" readonly value="<?= $user['module_title']; ?>">
                                            <br>
                                            <textarea class="form-control" name="moduledesc[<?= $taskNumber; ?>]" rows="5" placeholder="Module Description *" maxlength="200" readonly><?= $user['module_description']; ?></textarea>
                                        </div>
                                    <?php
                                        $taskNumber++;
                                    }
                                    ?>
                                </div>

                                <div class="text-right">
                                    <a href="my_tutoring_services.php" class="btn btn-danger">Back</a>
                                </div>
                            </form>
                    <?php
                        } else {
                            echo '<h4>No Record Found!</h4>';
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('./includes/footer.php');
?>
