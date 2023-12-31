<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>


<div class="container-fluid px-4">
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item">Online Tutoring Services</li>
        <li class="breadcrumb-item active">Post Online Tutoring Services</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Online Tutoring Services</h5>
                </div>
                <div class="card-body">

                    <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <input required type="text" Placeholder="Job Title *" name="title" class="form-control" maxlength="80">
                            </div>

                            <div class="col-md-12 mb-3">
                                <textarea class="form-control" name="description" rows="7" placeholder="Description *" maxlength="200"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input required type="text" Placeholder="Rate *" name="rate" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <select name="rate_description" required class="form-control">
                                    <option value="" disabled selected>-- Select Rate Description--</option>
                                    <option value="Hour">Hour</option>
                                    <option value="Day">Day</option>
                                    <option value="Session">Session</option>
                                </select>
                            </div>

                            <div class="module-container">
                                <div class="col-md-12 mb-3 module" data-task-number="1">
                                    <label for="module_1"><b>Learning Task 1</b></label>
                                    <input required type="text" Placeholder="Module Name *" name="module[1]" class="form-control">
                                    <br>
                                    <textarea class="form-control" name="moduledesc[1]" rows="5" placeholder="Module Description *" maxlength="200"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="button" id="addModule" class="btn btn-success">Add More</button>
                            </div>

                        </div>

                        <div class="text-right">
                            <a href="my_tutoring_services.php" class="btn btn-danger">Back</a>
                            <button type="submit" name="create_tutoring_services" class="btn btn-primary">Create</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addModuleButton = document.getElementById('addModule');
        const moduleContainer = document.querySelector('.module-container');

        let taskNumber = 1;

        function addModule() {
            taskNumber++;

            const newModule = document.createElement('div');
            newModule.classList.add('col-md-12', 'mb-3', 'module');
            newModule.dataset.taskNumber = taskNumber;

            newModule.innerHTML = `
                <label for="module_${taskNumber}"><strong>Learning Task ${taskNumber}</strong></label>
                <input required type="text" Placeholder="Module Name *" name="module[${taskNumber}]" class="form-control">
                <br>
                <textarea class="form-control" name="moduledesc[${taskNumber}]" rows="5" placeholder="Module Description *" maxlength="200"></textarea>
            `;

            moduleContainer.appendChild(newModule);
        }

        addModuleButton.addEventListener('click', addModule);
    });
</script>



<?php
 include('./includes/footer.php');
 ?>
