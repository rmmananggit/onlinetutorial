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
        job.tutor_id, 
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
?>
        <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <?php
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addModuleButton = document.getElementById('addModule');
        const moduleContainer = document.querySelector('.module-container');

        let taskNumber = <?= $taskNumber; ?>; // Set the taskNumber based on the last value fetched from the database

        function addModule() {
            taskNumber++;

            const newModule = document.createElement('div');
            newModule.classList.add('col-md-12', 'mb-3', 'module');
            newModule.dataset.taskNumber = taskNumber;

            newModule.innerHTML = `
                <label for="module_${taskNumber}"><strong>Learning Task ${taskNumber}</strong></label>
                <input required type="text" Placeholder="Module Name *" name="module[${taskNumber}]" class="form-control" readonly>
                <br>
                <textarea class="form-control" name="moduledesc[${taskNumber}]" rows="5" placeholder="Module Description *" maxlength="200" readonly></textarea>
            `;

            moduleContainer.appendChild(newModule);
        }

        addModuleButton.addEventListener('click', addModule);
    });
</script>

<?php
 include('./includes/footer.php');
 ?>
