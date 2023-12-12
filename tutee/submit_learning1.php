<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>


<div class="container-fluid px-4">
    <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item">Learning Materials</li>
        <li class="breadcrumb-item active">Submit Learning Materials</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Select Module File</label>
                            <select name="module" class="form-control">
                                <?php
                                $m_query = "SELECT
                                    job_module_files.title,
                                    job_module_files.file_id
                                FROM
                                    job_module_files";
                                $module = mysqli_query($con, $m_query);
                                while ($c = mysqli_fetch_array($module)) {
                                ?>
                                    <option value="<?php echo $c['file_id'] ?>"><?php echo $c['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>


                            <div class="col-md-12 mb-3">
                                <textarea class="form-control" name="module_description" rows="7" placeholder="Description *" maxlength="200"></textarea>
                            </div>

                        <div class="col-md-12 mb-3">
                        <label for="formFile" class="form-label">File</label>
                        <input class="form-control" type="file" id="formFile" name="fileInput" accept="image/*,video/*,.ppt,.pptx,.doc,.docx">
                        </div>

                        </div>

                        <div class="text-right">
                            <a href="my_tutoring_services.php" class="btn btn-danger">Back</a>
                            <button type="submit" name="submit_module_file" class="btn btn-primary">Create</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
 include('./includes/footer.php');
 ?>
