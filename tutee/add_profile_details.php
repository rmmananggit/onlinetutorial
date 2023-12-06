<?php
 include('./includes/authentication.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <style>
      ::-webkit-scrollbar {
          width: 8px;
      }
      
      /* Track */
      ::-webkit-scrollbar-track {
          background: #f1f1f1; 
      }
          
      /* Handle */
      ::-webkit-scrollbar-thumb {
          background: #888; 
      }
      
      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
          background: #555; 
      }

      @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");

      body {
        background: rgb(174, 211, 238);
        font-family: "Poppins", sans-serif;
        font-weight: 300;
        color: black !important;
        position: relative;
        height: 100%;
      }

      .container {
        height: 100vh;
      }

      .navbar-brand {
        margin-right: 0 !important;
      }

      .navbar-nav .nav-item .nav-link {
        font-size: 20px;
        text-decoration: none;
        transition: text-decoration 0.3s;
      }

      .navbar-nav .nav-item .nav-link:hover {
        text-decoration: underline;
      }

      .card {
        border: none;
      }

      .card-header {
        padding: .5rem 1rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .03);
        border-bottom: none;
      }

      .btn-light:focus {
        color: #212529;
        background-color: #e2e6ea;
        border-color: #dae0e5;
        box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, .5);
      }

      .form-control {
        height: 50px;
        border: 2px solid #eee;
        border-radius: 6px;
        font-size: 14px;
      }

      .form-control:focus {
        color: black;
        background-color: #fff;
        border-color: #039be5;
        outline: 0;
        box-shadow: none;
      }

      .input {
        position: relative;
      }

      .input i {
        position: absolute;
        top: 16px;
        left: 11px;
        color: #989898;
      }

      .input input {
        text-indent: 25px;
      }

      .card-text {
        font-size: 13px;
        margin-left: 6px;
      }

      .certificate-text {
        font-size: 12px;
      }

      .billing {
        font-size: 11px;
      }

      .super-price {
        top: 0px;
        font-size: 22px;
      }

      .super-month {
        font-size: 11px;
      }

      .line {
        color: #bfbdbd;
      }

      .free-button {
        background: #1565c0;
        height: 52px;
        font-size: 15px;
        border-radius: 8px;
      }

      .payment-card-body {
        flex: 1 1 auto;
        padding: 24px 1rem !important;
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
  </head>

  <body>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="./img/logo.png" width="200" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <!-- Wrap the "Sign Out" link in a form -->
                <form action="logout.php" method="post">
                    <button type="submit" name="logout" class="nav-link btn btn-link">Sign Out</button>
                </form>
            </li>
        </ul>
    </div>
</nav>



<div class="container mt-4">
<div class="row gutters">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
    
  <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">

		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Your Personal Details</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option disabled selected value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="Address">Complete Address</label>
					<input type="Address" class="form-control" name="address" id="Address" placeholder="Enter Address">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="barangay">Barangay</label>
					<input type="text" class="form-control" name="barangay" id="barangay" placeholder="Enter Barangay">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="municipality">Municipality</label>
					<input type="text" class="form-control" name="municipality" id="municipality" placeholder="Enter Municipality">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="zIp">Zip Code</label>
					<input type="text" class="form-control" name="zipcode" id="zIp" placeholder="Zip Code">
				</div>
			</div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="form-group">
					<label for="aboutme">About me</label>
					<textarea class="form-control" name="aboutme" rows="7" maxlength="200" id="aboutme" placeholder="Max character is 200."></textarea>
				</div>
			</div>
		</div>


        	<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mt-3 mb-2 text-primary">Files</h6>
			</div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                    <label for="formFile" class="form-label">Upload Profile Picture</label>
                    <input class="form-control" type="file" id="formFile" name="profile_picture">
                </div>
            </div>
		</div>
	<!-- ... Your existing HTML code ... -->

<div class="row gutters">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="text-right">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</div>

</form>
</div>
</div>
</div>
</div>
</div>







    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/sweetalert.min.js"></script>

<script>
        function validateForm() {
            var skillsCheckboxes = document.getElementsByName('skills[]');
            var atLeastOneChecked = false;

            for (var i = 0; i < skillsCheckboxes.length; i++) {
                if (skillsCheckboxes[i].checked) {
                    atLeastOneChecked = true;
                    break;
                }
            }

            if (!atLeastOneChecked) {
                alert("Please check at least one skill.");
                return false;
            }

            return true;
        }
    </script>
    
<?php
        if(isset($_SESSION['status']) && $_SESSION['status_code'] !='' )
        {
            ?>
                <script>
                swal({
                  title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                });
                </script>
                <?php
                unset($_SESSION['status']);
                unset($_SESSION['status_code']);
        }     
 ?>

</body>
</html>
