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
            <h3><b>Verification</b></h3>
            <p class="mb-4" style="color: black;">Empowering Minds, Crafting Futures - A Nexus of Innovation and Education!</p>
                   <form action="verify_otp.php" method="post">
                    <div class="form-group">
                        <label for="otp">Enter OTP sent to your phone number:</label>
                        <input type="text" name="otp" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
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