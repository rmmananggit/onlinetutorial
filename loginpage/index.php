<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="../loginpage/assets/bootstrap.min.css">

<link rel="stylesheet" href="../loginpage/assets/style.css">

<!-- font awesome  -->
<link rel="stylesheet" href="../loginpage/assets/fontawesome-free-6.4.2-web/css/all.css">
</head>

<body style="background-color: #eee;">

<?php session_start(); ?>

<div class="container-fluid">
  <div class="row d-flex justify-content-center align-items-center m-0" style="height:70vh;">
    <div class="login_oueter pb-3">
      <div class="col-md-12 logo_outer mb-2 text-center">
        <img src="../landingpage/assets/img/logo.png" style="margin:auto;width:220px;" alt="">
      </div>
      <form action="logincode.php" method="post" utocomplete="off" class="bg-light border shadow p-3 rounded">
        <div class="form-row" style="padding:10px;padding-top:30px;padding-bottom:5px;">
          <h4 class="title" style="margin-bottom:30px;">Login Your Account</h4>

         <div class="col-12">
             <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
              </div>
              <input name="email" type="text" value="" class="input form-control" id="email" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
            </div>
          </div>
          <div class="col-12">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
              </div>
              <input name="password" type="password" value="" class="input form-control" id="password" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" />
              <div class="input-group-append">
                <span class="input-group-text" onclick="password_show_hide();">
                  <i class="fas fa-eye" id="show_eye"></i>
                  <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group text-left">
              <label><a href="">Forgot Password?</a></label>
            </div>
          </div>
          <div class="col-sm-12 text-right">
            <p>Not yet registered? <a href="../registration/index.php" class="ml-1">Register Here</a></p>
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit" name="login">Login</button>
          </div>
        </div>
      </form>
    </div>
    
  </div>
  
</div>


<script src="../loginpage/assets/script.js"></script>

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