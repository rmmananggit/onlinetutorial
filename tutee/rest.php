<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />

<div class="container mt-3">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Tutoring Services</li>
        </ol>
    </nav>
</div>

<div class="col-lg-12">
    <div class="candidate-list-widgets mb-4">
        <form action="#" class="">
            <div class="g-2 row">
                <div class="col-lg-4">
                    <div class="filler-job-form">
                        <i class="uil uil-location-point"></i>
                        <select class="form-select selectForm__inner" data-trigger="true" name="category" id="category" aria-label="Default select example" required>
                            <option selected disabled>Select Category</option>
                            <option value="Academic">Academic</option>
                            <option value="Non Academic">Non Academic</option>
                        </select>
                    </div>
                </div>

                <!-- Second dropdown for Academic and Non Academic subjects -->
                <div class="col-lg-4" id="subjectDropdown" style="display: none;">
                    <div class="filler-job-form">
                        <i class="uil uil-location-point"></i>
                        <select class="form-select selectForm__inner" name="subjects" id="subjects" aria-label="Default select example" required>
                            <option selected disabled>Select Subject</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="filler-job-form">
                        <i class="uil uil-location-point"></i>
                        <select class="form-select selectForm__inner" data-trigger="true" name="municipality" id="municipality" aria-label="Default select example" required>
                            <option selected disabled>Select Municipality</option>
                            <option value="All">All</option>
                            <option value="Aloran">Aloran</option>
                            <option value="Baliangao">Baliangao</option>
                            <option value="Bonifacio">Bonifacio</option>
                            <!-- Add other municipalities as needed -->
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="align-items-center row">
                <div class="col-lg-8">
                    <div class="mb-3 mb-lg-0"><h6 class="fs-16 mb-0">Showing 1 – 8 of 11 results</h6></div>
                </div>
                <div class="col-lg-4">
                    <div class="candidate-list-widgets">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
            </div>
            <div class="col-lg-12">
                <div class="candidate-list">
                    <?php
                    require '../admin/config/config.php';

                    if (isset($_SESSION['auth_user'])) {
                        $id = $_SESSION['auth_user']['user_id'];

                        $query = "SELECT
                                job.job_id, 
                                job.user_id, 
                                job.title, 
                                job.description, 
                                job.rate, 
                                job.rate_description, 
                                job.`status`, 
                                job.date_posted, 
                                tutor.municipality,
                                tutor.address, 
                                tutor.profile_picture,
                                tutor.skills
                            FROM
                                job,
                                tutor
                            ORDER BY
                                job.date_posted DESC";

                        $query_run = mysqli_query($con, $query);
                        $check_jobs = mysqli_num_rows($query_run) > 0;

                        if ($check_jobs) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $userSkills = explode(',', $row['skills']);
                                $selectedCategory = $_POST['category'] ?? '';
                                $selectedSubject = $_POST['subjects'] ?? '';
                                $selectedMunicipality = $_POST['municipality'] ?? '';

                                $isValidCategory = ($selectedCategory === 'All') || ($selectedCategory === 'Academic' && in_array('Academic', $userSkills)) || ($selectedCategory === 'Non Academic' && in_array('Non Academic', $userSkills));
                                $isValidSubject = ($selectedSubject === 'All') || in_array($selectedSubject, $userSkills);
                                $isValidMunicipality = ($selectedMunicipality === 'All') || ($row['municipality'] === $selectedMunicipality);

                                if ($isValidCategory && $isValidSubject && $isValidMunicipality) {
                                    // Rest of your code to display the job
                                    ?>
                                    <div class="candidate-list-box card mt-2">
                                        <div class="p-4 card-body">
                                            <div class="align-items-center row">
                                                <div class="col-auto">
                                                    <div class="candidate-list-images">
                                                        <?php
                                                        echo '<img class="avatar-md rounded-circle" 
                                                            data-image="' . base64_encode($row['profile_picture']) . '" 
                                                            src="data:image;base64,' . base64_encode($row['profile_picture']) . '" 
                                                            alt="image" style="object-fit: cover;">';
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="candidate-list-content mt-3 mt-lg-0">
                                                        <h5 class="fs-19 mb-0">
                                                            <a class="primary-link"><?php echo $row['title'] ?></a>
                                                        </h5>
                                                        <ul class="list-inline mb-0 text-muted">
                                                            <li class="list-inline-item"><?php echo $row['address'] ?></li>
                                                            <br>
                                                            <li class="list-inline-item">
                                                                <span class="badge <?php echo ($row['status'] === 'Active') ? 'bg-success' : (($row['status'] === 'Ongoing') ? 'bg-warning' : 'bg-secondary'); ?>">
                                                                    <?php echo $row['status'] ?>
                                                                </span>
                                                            </li>
                                                            <br>
                                                            <li class="list-inline-item">Date posted: <?php $datePosted = strtotime($row['date_posted']); $formattedDate = date('Y-m-d', $datePosted); echo $formattedDate; ?></li>
                                                            <br>
                                                            <li class="list-inline-item">
                                                                <a href="view_tutor_profile.php?id=<?= $row['user_id']; ?>" class="btn btn-info btn-sm">View Profile</a>
                                                            </li>
                                                            <br>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                                        <?php
                                                        foreach ($userSkills as $skill) {
                                                            echo '<span class="badge bg-soft-secondary fs-14 mt-1">' . trim($skill) . '</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="favorite-icon mt-2">
                                                <!-- Your existing code for the apply button -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        } else {
                            echo "No job posted yet";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Your existing modal code -->
</div>

<script>
    document.getElementById('category').addEventListener('change', function () {
        var subjectDropdown = document.getElementById('subjectDropdown');
        var subjectsSelect = document.getElementById('subjects');

        if (this.value === 'Academic' || this.value === 'Non Academic') {
            subjectDropdown.style.display = 'block';
            // Add subjects dynamically based on the selected category
            subjectsSelect.innerHTML = '<option selected disabled>Select Subject</option>';
            if (this.value === 'Academic') {
                subjectsSelect.innerHTML += '<option value="Science">Science</option>';
                subjectsSelect.innerHTML += '<option value="Math">Math</option>';
                subjectsSelect.innerHTML += '<option value="English">English</option>';
                // Add other academic subjects as needed
            } else if (this.value === 'Non Academic') {
                subjectsSelect.innerHTML += '<option value="Guitar Lesson">Guitar Lesson</option>';
                subjectsSelect.innerHTML += '<option value="Public Speaking Masterclass">Public Speaking Masterclass</option>';
                subjectsSelect.innerHTML += '<option value="Bookkeeping NC III">Bookkeeping NC III</option>';
                // Add other non-academic subjects as needed
            }
        } else {
            subjectDropdown.style.display = 'none';
        }
    });
</script>

<script>
    document.getElementById('municipality').addEventListener('change', function () {
        var selectedMunicipality = this.value;
        var cards = document.querySelectorAll('.candidate-list-box');

        cards.forEach(function (card) {
            var cardMunicipality = card.getAttribute('data-municipality');
            card.style.display = (selectedMunicipality === 'All' || selectedMunicipality === cardMunicipality) ? 'block' : 'none';
        });
    });
</script>

<?php
include('./includes/footer.php');
?>
    