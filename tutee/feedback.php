<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');
?>

<div class="container-fluid px-4 mt-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Feedback</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           Rate Tutor
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered" width="400px">
                    <thead>
                        <tr>    
                            <th>Tutorial Title</th>
                            <th>Review</th>
							<th>Feedback</th>
							<th>Feedback Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
							<th>Tutorial Title</th>
                            <th>Review</th>
							<th>Feedback</th>
							<th>Feedback Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                                 $user_id = $_SESSION['auth_user']['user_id'];
                            $query = "SELECT
                            job_application.application_id, 
                            job.title, 
                            job.description, 
                            job.stars, 
                            job.feedback, 
                            job.feedback_date, 
                            job.user_id, 
                            job_application.user_id
                        FROM
                            job_application
                            INNER JOIN
                            job
                            ON 
                                job_application.job_id = job.job_id
                        WHERE
                            job_application.user_id = $user_id";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td width="100px"><?= $row['title']; ?></td>
                                    <td width="100px" style="color: <?= $row['stars'] !== null ? 'black' : 'red'; ?>">
    <?= $row['stars'] !== null ? $row['stars'] : '<span style="color: red;">No feedback yet</span>'; ?>
</td>
<td width="100px" style="color: <?= $row['feedback'] !== null ? 'black' : 'red'; ?>">
    <?= $row['feedback'] !== null ? $row['feedback'] : '<span style="color: red;">No feedback yet</span>'; ?>
</td>
<td width="100px" style="color: <?= $row['feedback_date'] !== null ? 'black' : 'red'; ?>">
    <?= $row['feedback_date'] !== null ? $row['feedback_date'] : '<span style="color: red;">No feedback yet</span>'; ?>
</td>
                                    <td width="100px">
                                    <a type="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#addFileModal">Add Review</a>
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
                <?php
                // Check if 'id' is set in the URL
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                ?>
                <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <!-- Add a hidden input field to store module_id -->
                    <input type="text" name="module_id" id="module_id" value="<?= $id ?>">
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
                    <button type="submit" name="add_file" class="btn btn-primary" style="float: right;">Upload</button>
                </form>
                <?php } else {
                    echo "Module ID not provided in the URL.";
                } ?>
            </div>
        </div>
    </div>
</div>





<div class="container">
		<div class="rating-wrap">
			<h2>Star Rating</h2>
			<div class="center">
				<fieldset class="rating">
					<input type="radio" id="star5" name="rating" value="5"/><label for="star5" class="full" title="Awesome"></label>
					<input type="radio" id="star4.5" name="rating" value="4.5"/><label for="star4.5" class="half"></label>
					<input type="radio" id="star4" name="rating" value="4"/><label for="star4" class="full"></label>
					<input type="radio" id="star3.5" name="rating" value="3.5"/><label for="star3.5" class="half"></label>
					<input type="radio" id="star3" name="rating" value="3"/><label for="star3" class="full"></label>
					<input type="radio" id="star2.5" name="rating" value="2.5"/><label for="star2.5" class="half"></label>
					<input type="radio" id="star2" name="rating" value="2"/><label for="star2" class="full"></label>
					<input type="radio" id="star1.5" name="rating" value="1.5"/><label for="star1.5" class="half"></label>
					<input type="radio" id="star1" name="rating" value="1"/><label for="star1" class="full"></label>
					<input type="radio" id="star0.5" name="rating" value="0.5"/><label for="star0.5" class="half"></label>
				</fieldset>
			</div>

			<h4 id="rating-value"></h4>
		</div>
	</div>


	<script src="./js/star-ratings.js"></script>


<?php
include('./includes/footer.php');
?>
