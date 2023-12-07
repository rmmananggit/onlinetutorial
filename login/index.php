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

      <title>TMS</title>
    </head>
    <body>
    
    <?php session_start(); ?>
    
    <div class="content">
      <div class="container">
        <div class="row">
        
          <div class="col-md-6 contents">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="mb-4">
                <h3>Sign In</h3>
                <h6 class="mb-4">Transforming Minds, Shaping Futures - Where Innovation Meets Education!</h6>
              </div>
              <form action="logincode.php" method="POST" autocomplete="off">

                <div class="form-group first">
                  <label for="username">Email</label>
                  <input type="text" class="form-control" id="username"  name="email" required>

                </div>
                <div class="form-group last mb-4">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                  
                </div>
                
                <div class="d-flex align-items-center">
                  <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input type="checkbox"/>
                    <div class="control__indicator"></div>
                  </label>
                  <span class="ml-auto"><a href="forgotpassword.php" class="forgot-pass">Forgot Password</a></span> 
                </div>

                <div class="d-flex mb-5 align-items-center">
                  <span class="ml-auto"><a href="../registration/index.php" class="forgot-pass">Create an Account</a></span> 
                </div>

                <input type="submit" name="login" class="btn btn-block btn-primary">

              
              
              </form>
              </div>
            </div>
            
          </div>

          <div class="col-md-6">
            <img src="images/TM.png" alt="Image" class="img-fluid">
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