<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>

<style>
    body {
    margin: 0;
    color: #2e323c;
    background: #f5f6fa;
    position: relative;
    height: 100%;
}
.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}
.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}
.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}
.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}
.account-settings .user-profile h6.user-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
    color: #9fa8b9;
}
.account-settings .about {
    margin: 2rem 0 0 0;
    text-align: center;
}
.account-settings .about h5 {
    margin: 0 0 15px 0;
    color: #007ae1;
}
.account-settings .about p {
    font-size: 0.825rem;
}
.form-control {
    border: 1px solid #cfd1d8;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: .825rem;
    background: #ffffff;
    color: #2e323c;
}

.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}
</style>






<div class="container">

            <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Membership</li>
            </ol>
            </nav>

<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">

    <?php

$user_id = $_SESSION['auth_user']['user_id'];
$users = "SELECT
user_accounts.user_id, 
user_accounts.firstname, 
user_accounts.lastname, 
user_accounts.email, 
subscriptions.user_id, 
subscriptions.subscription_type, 
subscriptions.`status`, 
subscriptions.approved_date, 
subscriptions.expiration_date, 
subscriptions.reference, 
subscriptions.modeofpayment, 
subscriptions.receipt, 
tutor.profile_picture, 
tutor.aboutme
FROM
user_accounts
INNER JOIN
tutor
ON 
    user_accounts.user_id = tutor.user_id
INNER JOIN
subscriptions
ON 
    user_accounts.user_id = subscriptions.user_id
WHERE
user_accounts.user_id = $user_id";
$users_run = mysqli_query($con, $users);
        ?>
        <?php
        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
         ?>


    <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
		<div class="account-settings">
			<div class="user-profile"> 
				<div class="user-avatar">
                    <?php 
                    echo '<img class="img-fluid" src = "data:image;base64,'.base64_encode($user['profile_picture']).'" 
                    alt="image" style="object-fit: cover;">';
                    ?>
				</div>
				<h5 class="user-name"><?= $user['firstname']; ?> <?= $user['lastname']; ?></h5>
				<h6 class="user-email"><?= $user['email']; ?></h6>
			</div>
			
		</div>
	</div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Membership Details</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="fullName">Membership Plan</label>
					<input type="text" class="form-control" value="<?= $user['subscription_type']; ?>" readonly>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="eMail">Status</label>
					<input type="email" class="form-control" value="<?= $user['status']; ?>" readonly>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="phone">Date Subscription Approved</label>
                <?php
                    $approvedDate = $user['approved_date'];
                    $timestamp = strtotime($approvedDate);
                    
                    // Check if conversion is successful before formatting
                    if ($timestamp !== false) {
                        $formattedDate = date('l, F j, Y h:i A', $timestamp);
                    } else {
                        // Handle the case where the conversion fails
                        $formattedDate = 'Invalid date';
                    }
                ?>
                <input type="text" class="form-control" value="<?= $formattedDate; ?>" readonly>
            </div>

			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="form-group">
                <label for="phone">Date Subscription Expire</label>
                <?php
                    $expdate = $user['expiration_date'];
                    $exptimestamp = strtotime($expdate);
                    
                    // Check if conversion is successful before formatting
                    if ($exptimestamp !== false) {
                        $formattedDate = date('l, F j, Y h:i A', $exptimestamp);
                    } else {
                        // Handle the case where the conversion fails
                        $formattedDate = 'Invalid date';
                    }
                ?>
                <input type="text" class="form-control" value="<?= $formattedDate; ?>" readonly>
            </div>
			</div>
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
                        
                        ?>
</div>
</div>
</div>
</div>


<?php
 include('./includes/footer.php');
 ?>
