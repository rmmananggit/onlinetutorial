<?php
include('./includes/authentication.php');
include('./includes/header.php');
include('./includes/topnav.php');
include('./includes/sidenav.php');
?>

<style>
    body {
        margin-top: 20px;
        background: #f8f8f8
    }
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row flex-lg-nowrap">
        <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
            <div class="card p-3">
                <div class="e-navlist e-navlist--active-bg">
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link px-2 active" href="my_profile.php"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Overview</span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $users = "SELECT
                                user_accounts.user_id, 
                                user_accounts.firstname, 
                                user_accounts.lastname, 
                                user_accounts.`password`, 
                                user_accounts.phone_number, 
                                user_accounts.email,
                                user_accounts.role, 
                                user_accounts.user_status, 
                                tutor.gender, 
                                tutor.address, 
                                tutor.barangay, 
                                tutor.municipality, 
                                tutor.zipcode, 
                                tutor.aboutme, 
                                tutor.position, 
                                tutor.employmenttype, 
                                tutor.company, 
                                tutor.location, 
                                tutor.employ_start, 
                                tutor.employ_end, 
                                tutor.school, 
                                tutor.degree, 
                                tutor.fieldofstudy, 
                                tutor.startdate, 
                                tutor.enddate, 
                                tutor.skills,
                                tutor.profile_picture
                            FROM
                                user_accounts
                                INNER JOIN
                                tutor
                                ON 
                                    user_accounts.user_id = tutor.user_id
                            WHERE
                                user_accounts.user_id = $user_id";
                        $users_run = mysqli_query($con, $users);
                        ?>
                        <?php
                        if (mysqli_num_rows($users_run) > 0) {
                            foreach ($users_run as $user) {
                        ?>
                                <form action="process.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">
                                    <!-- Add a closing bracket here for the foreach loop -->
                                    <div class="card-body">
                                        <div class="e-profile">
                                            <div class="row">
                                            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
        
                      <?php 
                                               echo '<img class="avatar-md" 
                                                   data-image="'.base64_encode($user['profile_picture']).'" 
                                                   src="data:image;base64,'.base64_encode($user['profile_picture']).'" 
                                                   alt="image" style="object-fit: cover;">'; 
                                           ?>
                 
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $user['firstname']; ?> <?= $user['lastname']; ?></h4>
                    <p class="mb-0"><?= $user['email']; ?></p>
                  </div>
                  <div class="text-center text-sm-right">
                  <span class="badge badge-success">
                        <?php
                        $role = $user['role'];
                        if ($role == 1) {
                            echo 'Tutee';
                        } elseif ($role == 2) {
                            echo 'Tutor';
                        } elseif ($role == 3) {
                            echo 'Admin';
                        } else {
                            echo 'Unknown Role';
                        }
                        ?>
                    </span>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <form class="form" novalidate="">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>First Name</label>
                              <input class="form-control" type="text" name="fname" placeholder="Name" value="<?= $user['firstname']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input class="form-control" type="text" name="lname" placeholder="Name" value="<?= $user['lastname']; ?>">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" type="text" name="phone" id="phone" placeholder="09X-XXX-XXXXX" value="<?= $user['phone_number']; ?>">
                                <small class="text-muted">Format: 09X-XXX-XXXXX</small>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="text" name="email" placeholder="user@example.com" value="<?= $user['email']; ?>">
                            </div>
                          </div>

                          <hr>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Change Password</b></div>
                        <div class="row">
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" type="password" name="newpass" placeholder="••••••">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                              <input class="form-control" type="password" name="cpass" placeholder="••••••"></div>
                          </div>
                        </div>
                      </div>   
                      
                      <div class="col-md-12 col-sm-6 mb-3">
                      <div class="form-group">
                    <label for="formFile" class="form-label">Upload Profile Picture</label>
                    <input class="form-control" type="file" id="formFile" name="picture">
                </div>
                      </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                      <button type="submit" name="update_account" class="btn btn-primary">Save Changes</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        <?php
                            }
                        } else {
                        ?>
                            <h4>No Record Found!</h4>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Add event listener to the input field
    document.getElementById('phone').addEventListener('input', function (event) {
        // Remove non-numeric characters
        let phoneNumber = event.target.value.replace(/\D/g, '');

        // Check if the length is greater than 11, then trim to 11 digits
        if (phoneNumber.length > 11) {
            phoneNumber = phoneNumber.slice(0, 11);
        }

        // Format the phone number using regex
        phoneNumber = phoneNumber.replace(/^(\d{2})(\d{3})(\d{5})$/, '$1-$2-$3');

        // Set the formatted phone number back to the input field
        event.target.value = phoneNumber;
    });
</script>

<?php
include('./includes/footer.php');
?>
