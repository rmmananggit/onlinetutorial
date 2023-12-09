<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>

<style>
  body{
margin-top:20px;
background:#f7f8fa
}

.avatar-xxl {
    height: 7rem;
    width: 7rem;
}

.card {
    margin-bottom: 20px;
    -webkit-box-shadow: 0 2px 3px #eaedf2;
    box-shadow: 0 2px 3px #eaedf2;
}

.pb-0 {
    padding-bottom: 0!important;
}

.font-size-16 {
    font-size: 16px!important;
}
.avatar-title {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background-color: #038edc;
    color: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    font-weight: 500;
    height: 100%;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 100%;
}

.bg-soft-primary {
    background-color: rgba(3,142,220,.15)!important;
}
.rounded-circle {
    border-radius: 50%!important;
}

.nav-tabs-custom .nav-item .nav-link.active {
    color: #038edc;
}
.nav-tabs-custom .nav-item .nav-link {
    border: none;
}
.nav-tabs-custom .nav-item .nav-link.active {
    color: #038edc;
}

.avatar-group {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    padding-left: 12px;
}

.border-end {
    border-right: 1px solid #eff0f2 !important;
}

.d-inline-block {
    display: inline-block!important;
}

.badge-soft-danger {
    color: #f34e4e;
    background-color: rgba(243,78,78,.1);
}

.badge-soft-warning {
    color: #f7cc53;
    background-color: rgba(247,204,83,.1);
}

.badge-soft-success {
    color: #51d28c;
    background-color: rgba(81,210,140,.1);
}

.avatar-group .avatar-group-item {
    margin-left: -14px;
    border: 2px solid #fff;
    border-radius: 50%;
    -webkit-transition: all .2s;
    transition: all .2s;
}

.avatar-sm {
    height: 2rem;
    width: 2rem;
}

.nav-tabs-custom .nav-item {
    position: relative;
    color: #343a40;
}

.nav-tabs-custom .nav-item .nav-link.active:after {
    -webkit-transform: scale(1);
    transform: scale(1);
}

.nav-tabs-custom .nav-item .nav-link::after {
    content: "";
    background: #038edc;
    height: 2px;
    position: absolute;
    width: 100%;
    left: 0;
    bottom: -2px;
    -webkit-transition: all 250ms ease 0s;
    transition: all 250ms ease 0s;
    -webkit-transform: scale(0);
    transform: scale(0);
}

.badge-soft-secondary {
    color: #74788d;
    background-color: rgba(116,120,141,.1);
}

.badge-soft-secondary {
    color: #74788d;
}

.work-activity {
    position: relative;
    color: #74788d;
    padding-left: 5.5rem
}

.work-activity::before {
    content: "";
    position: absolute;
    height: 100%;
    top: 0;
    left: 66px;
    border-left: 1px solid rgba(3,142,220,.25)
}

.work-activity .work-item {
    position: relative;
    border-bottom: 2px dashed #eff0f2;
    margin-bottom: 14px
}

.work-activity .work-item:last-of-type {
    padding-bottom: 0;
    margin-bottom: 0;
    border: none
}

.work-activity .work-item::after,.work-activity .work-item::before {
    position: absolute;
    display: block
}

.work-activity .work-item::before {
    content: attr(data-date);
    left: -157px;
    top: -3px;
    text-align: right;
    font-weight: 500;
    color: #74788d;
    font-size: 12px;
    min-width: 120px
}

.work-activity .work-item::after {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    left: -26px;
    top: 3px;
    background-color: #fff;
    border: 2px solid #038edc
}
</style>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">

<nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Apply</li>
            </ol>
            </nav>


<div class="row">
    <div class="col-xl-8">
        <div class="card">


              <?php

if(isset($_GET['id']))
{
    $user_id = $_SESSION['auth_user']['user_id'];
     $id = $_GET['id'];
      $users = "SELECT
      user_accounts.user_id, 
      user_accounts.firstname, 
      job.job_id, 
      job.title, 
      job.description, 
      job.rate, 
      job.rate_description, 
      job.`status`, 
      job.date_posted, 
      tutor.address, 
      tutor.skills, 
      job_module.module_title, 
      job_module.module_description
  FROM
      user_accounts
      INNER JOIN
      job
      ON 
          user_accounts.user_id = job.tutor_id
      INNER JOIN
      tutor
      ON 
          user_accounts.user_id = tutor.user_id
      INNER JOIN
      job_module
      ON 
          job.job_id = job_module.job_id
  WHERE
      job.job_id = $id";
      $users_run = mysqli_query($con, $users);
              ?>
              <?php
              if(mysqli_num_rows($users_run) > 0)
              {
                  foreach($users_run as $user)
                  {
              ?>

<form action="process.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="job_id" value="<?= $user['job_id']; ?>">

            <div class="card-body pb-0">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <div class="ms-0">
                        <div class="form-group mb-3">
                        <label for="aboutme">Title:</label>
                        <input type="text" class="form-control" value="<?= $user['title']; ?>" aria-describedby="basic-addon1" readonly>
                        </div>

                        <div class="form-group">
					<label for="aboutme">Description:</label>
					<textarea class="form-control" name="aboutme" rows="7" readonly><?= $user['description']; ?></textarea>
				</div>
                            <div class="row my-4">
                                <div class="col-md-12">
                                    <div>
                                      
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                         
                          <!-- end ul -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->

        <div class="card">
            <div class="tab-content p-4">
                

                

                <div class="tab-pane active show" id="team-tab" role="tabpanel">
                    <h4 class="card-title mb-4">Modules</h4>
                    <div class="row">
                       
                    </div><!-- end row -->
                </div><!-- end tab pane -->
            </div>
        </div><!-- end card -->

        <div class="card">
            <div class="tab-content p-4">
                

                

                <div class="tab-pane active show" id="team-tab" role="tabpanel">
                    <h4 class="card-title mb-4">Schedule</h4>
                    <div class="row">
                       
                    </div><!-- end row -->
                </div><!-- end tab pane -->
            </div>
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <h4 class="card-title mb-4">Tutor Skill</h4>
                    <div class="d-flex gap-2 flex-wrap">
                    <?php
                                    $skills = explode(',', $user['skills']);
                                    foreach ($skills as $skills) {
                                        echo '<span class="badge bg-soft-secondary fs-14 mt-1">' . trim($skills) . '</span>';
                                    }
                                    ?>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->

        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="card-title mb-4">Other Details</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Location</th>
                                    <td><?= $user['address']; ?></td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">Rate</th>
                                    <td>₱<?= $user['rate']; ?> / <?= $user['rate_description']; ?></td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">Status</th>
                                  <td>
                                  <span class="badge <?php echo ($user['status'] === 'Active') ? 'bg-success' : (($user['status'] === 'Ongoing') ? 'bg-warning' : 'bg-secondary'); ?>">
                                                    <?php echo $user['status'] ?>
                                                </span>
                                  </td>
                                </tr><!-- end tr -->
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

        <div class="card">
            <div class="card-body">
            <button type="submit" name="apply" class="btn btn-block btn-primary btn-sm">Apply</button>
            </div><!-- end card body -->
        </div><!-
    

      
    </div><!-- end col -->
</div>

</div>
</form>
<?php
                                  }
                                }
                                else
                                {
                                    ?>
                                    <h4>No Record Found!</h4>
                                    <?php
                                }
                            }
                            ?>

<?php
 include('./includes/footer.php');
 ?>
