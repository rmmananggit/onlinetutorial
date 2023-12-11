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
                            <th>Tutor</th>
                            <th>Feedback</th>
							<th>Review</th>
							<th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
							<th>Tutorial Title</th>
                            <th>Tutor</th>
                            <th>Feedback</th>
							<th>Review</th>
							<th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        job_module.module_title, 
                        job_module.module_description, 
                        job.title, 
                        job_application.`status`, 
                        job_application.user_id, 
                        job_module.module_id
                    FROM
                        job_module
                        INNER JOIN
                        job
                        ON 
                            job_module.job_id = job.job_id
                        INNER JOIN
                        job_application
                        ON 
                            job.job_id = job_application.job_id
                    WHERE
                        job_application.user_id = '$user_id' AND
                        job_application.`status` = 'Ongoing'";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td width="100px"><?= $row['title']; ?></td>
                                    <td width="100px"><?= $row['module_title']; ?></td>
                                    <td width="100px"><?= $row['module_description']; ?></td>
                                    <td width="100px">
                                    <form action="process.php" method="POST">  
                                    <div class="btn-group" rolez="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn btn-outline-primary" href="module_files.php?id=<?=$row['module_id'];?>">View</a>
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
