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
                            job_application.date_applied, 
                            job_application.job_id, 
                            job_application.tutor_id, 
                            job_application.user_id, 
                            job_application.stars, 
                            job_application.review, 
                            job_application.feedback_date, 
                            job.title
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
<td width="100px" style="color: <?= $row['review'] !== null ? 'black' : 'red'; ?>">
    <?= $row['review'] !== null ? $row['review'] : '<span style="color: red;">No feedback yet</span>'; ?>
</td>
<td width="100px" style="color: <?= $row['feedback_date'] !== null ? 'black' : 'red'; ?>">
    <?= $row['feedback_date'] !== null ? $row['feedback_date'] : '<span style="color: red;">No feedback yet</span>'; ?>
</td>
                                    <td width="100px">
                                    <form action="process.php" method="POST">  
<div class="btn-group" role="group" aria-label="Basic outlined example">
<a type="button" class="btn btn-outline-primary" href="review.php?id=<?=$row['tutor_id'];?>">View</a>
</div>
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



	<script src="./js/star-ratings.js"></script>


<?php
include('./includes/footer.php');
?>
