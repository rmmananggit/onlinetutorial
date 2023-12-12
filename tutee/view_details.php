<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');
?>
<style>
    body {
        background: #f7f7ff;
        margin-top: 20px;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .me-2 {
        margin-right: .5rem!important;
    }
</style>

<div class="container">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tutor</li>
        <li class="breadcrumb-item active">Ongoing Tutor</li>
        <li class="breadcrumb-item active">View Details</li>
    </ol>
</div>

<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">

                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $users = "SELECT
                        job.user_id, 
                        job.title, 
                        job.description, 
                        job.rate, 
                        job.rate_description, 
                        tutor.profile_picture, 
                        tutor.address, 
                        tutor.gender, 
                        job_module.module_title, 
                        job_module.module_description, 
                        user_accounts.firstname, 
                        user_accounts.lastname, 
                        user_accounts.phone_number, 
                        review.review, 
                        review.stars, 
                        review.date
                    FROM
                        job
                        INNER JOIN
                        job_module
                        ON 
                            job.job_id = job_module.job_id
                        INNER JOIN
                        user_accounts
                        ON 
                            job.user_id = user_accounts.user_id
                        INNER JOIN
                        tutor
                        ON 
                            user_accounts.user_id = tutor.user_id
                        INNER JOIN
                        review
                        ON 
                            job.user_id = review.tutor_id
                    WHERE
                        job.user_id = $id";
                        $users_run = mysqli_query($con, $users);
                    ?>
                        <?php
                        if (mysqli_num_rows($users_run) > 0) {
                            $user = mysqli_fetch_assoc($users_run);
                        ?>

                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">

                                    <?php
                                    echo '<img class="rounded-circle p-1" width="110" src = "data:image;base64,' . base64_encode($user['profile_picture']) . '"
                                    alt="image" style="object-fit: cover;">';
                                    ?>
                                    <div class="mt-3">
                                        <h4><?= $user['firstname']; ?> <?= $user['lastname']; ?></h4>
                                        <p class="text-secondary mb-1">Tutor</p>
                                        <p class="text-muted font-size-sm"><?= $user['address']; ?></p>
                                        <button class="btn btn-outline-primary">Message</button>
                                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#reviewModal" data-job-user-id="<?= $user['user_id']; ?>">Review</button>
                                    </div>
                                </div>
                                <hr class="my-4">
						<h5><u>Review</u></h5>

                        <div class="form-group">
                        <textarea class="form-control" name="comment" rows="7" maxlength="200" id="description" placeholder="Max character is 200." disabled><?= $user['review']; ?></textarea>
                    </div>
                    <div class="form-group">
    <label for="rating" class="d-block mb-2">Rating:</label>
    <div class="rating">
        <?php
        $stars = $user['stars'];
        for ($i = 5; $i >= 1; $i--) {
            $checked = ($stars == $i) ? 'checked' : '';
            echo '<input type="radio" id="star' . $i . '" name="rating" value="' . $i . '" ' . $checked . ' disabled>';
            echo '<label for="star' . $i . '">' . $i . '</label>';
        }
        ?>
    </div>
</div>


                            </div>
                </div>
            </div>

            
            
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <h5 class="text-center mb-4">Tutor Details</h5>
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tutor Title</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="<?= $user['title']; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Description</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <textarea class="form-control" rows="7" maxlength="200" id="aboutme" disabled><?= $user['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Rate</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="₱<?= $user['rate']; ?>/ <?= $user['rate_description']; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="<?= $user['address']; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="<?= $user['phone_number']; ?>" disabled>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3"><u>Modules</u></h5>
                                <?php
                                $users_run = mysqli_query($con, $users); // Run the query again to fetch modules
                                foreach ($users_run as $module) {
                                ?>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Module Title</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" value="<?= $module['module_title']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Module Description</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea class="form-control" rows="7" maxlength="200" id="aboutme" disabled><?= $module['module_description']; ?></textarea>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>

<?php
                        }
                        ?>
                        <?php
                    }
                    ?>


 <!-- Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Review Tutor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process.php" method="POST">
                <input type="hidden" name="module_id" id="module_id" value="<?= $user['user_id'] ?>">
                    <input type="hidden" name="job_user_id" id="job_user_id" value="">
                    <div class="form-group">
                        <label for="description">Comment:</label>
                        <textarea class="form-control" name="comment" rows="7" maxlength="200" id="description" placeholder="Max character is 200."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rating" class="d-block mb-2">Rate this tutor:</label>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5"></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"></label>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="addreview" class="btn btn-primary">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add this script at the end of your HTML body or in the head section -->
<script>
    $(document).ready(function() {
        $('#reviewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var jobUserId = button.data('job-user-id'); // Extract job_user_id from data-* attributes
            $('#job_user_id').val(jobUserId); // Set the value to the hidden input field
        });
    });
</script>



                    <?php
                    include('./includes/footer.php');
                    ?>
