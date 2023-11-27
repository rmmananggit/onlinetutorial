<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>TMS: Registration</title>
  </head>
  <body>

  <?php session_start(); ?>
  
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/register.png');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 py-3">
            <h3><b>Register Now!</b></h3>
            <p class="mb-4" style="color: black;">Empowering Minds, Crafting Futures - A Nexus of Innovation and Education!</p>
            <form action="register.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="firstname">First Name:</label>
                    <input required type="text" class="form-control" placeholder="e.g. John" name="firstname">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="middlename">Middle Name:<small>(Optional)</small></label>
                    <input type="text" class="form-control" placeholder="e.g. Smith" name="middlename">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lastname">Last Name:</label>
                    <input required type="text" class="form-control" placeholder="e.g. Creed" name="lastname">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="suffix">Suffix: <small>(Optional)</small></label>
                    <select class="form-control" name="suffix">
                      <option selected value="N/A">N/A</option>
                      <option value="JR">JR</option>
                      <option value="SR">SR</option>
                      <option value="II">II</option>
                      <option value="III">III</option>
                      <option value="IV">IV</option>
                    </select>
                  </div>    
                </div>
              
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="email">Email Address:</label>
                    <input required type="email" class="form-control" placeholder="e.g. john@your-domain.com" name="email">
                  </div>  
                </div>
                <div class="col-md-6">
              
              <div class="form-group last mb-3">
                <label for="password">Password:</label>
                <input required type="password" class="form-control" placeholder="Your Password" name="password">
              </div>
            </div>
            <div class="col-md-6">
          
              <div class="form-group last mb-3">
                <label for="re-password">Confirm Password:</label>
                <input required type="password" class="form-control" placeholder="Your Password" name="re_password">
              </div>
            </div>
              </div>
              <div class="row">
              <div class="col-md-6">
              <div class="form-group first">
                  <label for="lname">Phone Number:</label>
                  <input required
                        type="text"
                        class="form-control"
                        placeholder="09123456789"
                        name="phonenumber"
                        pattern="[0-9]*"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11);">
              </div>
          </div>
                <div class="col-md-6">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" required>
                            <option selected disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                </div>


                <div class="col-md-6">
                    <label for="">Register As:</label>
                    <select class="form-control" name="user_type" required>
                      <option selected disabled>Select</option>
                      <option value="2">Tutor</option>
                      <option value="3">Tutee</option>
                    </select>
                </div>

                <div class="col-md-6">                 
                <label class="mb-2">Upload Profile Picture:</label> 
                <input type="file" class="form-control" name="picture" accept=".jpg, .jpeg, .png" required>
                </div>

              </div>

              <input type="submit" value="Submit" class="btn px-5 btn-primary mt-4">

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      
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