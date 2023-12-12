<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');
?>

<div class="container-fluid px-4 mt-4">
<div class="container-fluid px-4 mt-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Learning Materials</li>
        <li class="breadcrumb-item">Submit</li>
    </ol>
    <div class="row">
        <div class="col-md-12 mb-2"> <!-- Adjust the column size as needed -->
            <a class="btn btn-primary" href="submit_learning1.php" role="button" style="float: right;">Submit</a>
        </div>
    </div>  
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           My Uploaded Files
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered" width="400px">
                    <thead>
                        <tr>
                            <th>Module File</th>
                            <th>Description</th>
                            <th>File Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Module File</th>
                            <th>Description</th>
                            <th>File Type</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
    <tbody>
        <?php
        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "SELECT
            job_module_files.title, 
            submit_module.submit_id, 
            submit_module.description, 
            submit_module.file_name, 
            submit_module.file_type, 
            submit_module.file_path, 
            submit_module.module_id, 
            submit_module.user_id
        FROM
            submit_module
            INNER JOIN
            job_module_files
            ON 
                submit_module.module_id = job_module_files.file_id
        WHERE
            submit_module.user_id = $user_id";
        $query_run = mysqli_query($con, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $row) {
                $fileExtension = pathinfo($row['file_name'], PATHINFO_EXTENSION);
        ?>
                <tr>
                    <td width="100px"><?= $row['title']; ?></td>
                    <td width="100px"><?= $row['description']; ?></td>
                    <td width="100px"><?= $row['file_type']; ?></td>
                    <td width="100px">
    <form action="process.php" method="POST">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <a href="#" class="btn btn-outline-primary d-flex justify-content-center" onclick="viewFile('<?= $row['file_path'] ?>', '<?= $fileExtension ?>')">View</a>
            <button type="submit" name="delete_submit_file" class="btn btn-outline-danger" value="<?= $row['submit_id']; ?>">Delete</button>
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

<!-- Modal -->
<div class="modal fade" id="viewFileModal" tabindex="-1" role="dialog" aria-labelledby="viewFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewFileModalLabel">View File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content placeholder for the file -->
                <div id="fileContent"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function viewFile(filePath, fileExtension) {
        // Display the file content in the modal
        if (fileExtension === 'pdf') {
            // PDF file
            $('#fileContent').html(`<object data="${filePath}" type="application/pdf" width="100%" height="600px"></object>`);
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
            // Image file
            $('#fileContent').html(`<img src="${filePath}" class="img-fluid" alt="Image" />`);
        } else if (fileExtension === 'mp4' || fileExtension === 'avi') {
            // Video file (you can customize this based on your video types)
            $('#fileContent').html(`<video controls width="100%" height="400px"><source src="${filePath}" type="video/${fileExtension}"></video>`);
        } else {
            // Default case: embed in an iframe (you might need additional handling for other file types)
            $('#fileContent').html(`<iframe src="${filePath}" frameborder="0" width="100%" height="600px"></iframe>`);
        }

        // Show the modal
        $('#viewFileModal').modal('show');
    }
</script>

<?php
include('./includes/footer.php');
?>