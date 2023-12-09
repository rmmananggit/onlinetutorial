<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');

// Function to map file extensions to icons
function getFileIcon($extension) {
    $iconMap = [
        'pdf' => 'far fa-file-pdf',
        'doc' => 'far fa-file-word',
        'docx' => 'far fa-file-word',
        'xls' => 'far fa-file-excel',
        'xlsx' => 'far fa-file-excel',
        'ppt' => 'far fa-file-powerpoint',
        'pptx' => 'far fa-file-powerpoint',
        // Add more file format mappings as needed
    ];

    return $iconMap[strtolower($extension)] ?? 'far fa-file'; // Default to a generic file icon
}

?>
<div class="container-fluid mt-3">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Modules</li>
            <li class="breadcrumb-item active" aria-current="page">Module Files</li>
        </ol>
    </nav>
</div>

<div class="col-md-12 mt-2 mb-2">
    <a type="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#addFileModal" style="float: right;">Add File</a>
</div>

<div class="container-fluid mt-5">
    <div class="row">
        <?php
        require '../admin/config/config.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM `job_module_files` WHERE module_id = ?";

            // Use prepared statement to prevent SQL injection
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 's', $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $fileExtension = pathinfo($row['name'], PATHINFO_EXTENSION);
                    $fileIcon = getFileIcon($fileExtension);
        ?>
                    <div class="card" style="width: 18rem;">
                        <i class="<?= $fileIcon ?> fa-3x mt-2"></i>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $row['name'] ?></h5>
                            <p class="card-text"><?= $row['description'] ?></p>
                            <a href="#" class="btn btn-primary d-flex justify-content-center">View</a>
                            <a href="#" class="btn btn-secondary d-flex justify-content-center mt-2">Download</a>
                        </div>
                    </div>
        <?php
                }
            } else {
                echo "No module files found";
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        }
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="addFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFileModalLabel">Add File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form for adding files can go here -->
                <!-- For simplicity, let's add a placeholder form -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" rows="7" maxlength="200" id="description" placeholder="Max character is 200."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fileInput">File Input:</label>
                        <input type="file" class="form-control" id="fileInput" name="fileInput" accept="image/*,video/*,.ppt,.pptx,.doc,.docx">
                    </div>
                    <button type="submit" class="btn btn-primary" style="float: right;">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('./includes/footer.php');
?>
