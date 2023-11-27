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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <title>TMS: Registration</title>
  <style>
    .hidden {
      display: none;
    }
    .rounded-circle {
      border-radius: 50%;
    }
  </style>
</head>
<body>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/register.png');"></div>
    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 py-5">
            <h3><b>Register as Tutor</b></h3>
            <p class="mb-4" style="color: black;">Empowering Minds, Crafting Futures - A Nexus of Innovation and Education!</p>
            <form action="#" method="post" enctype="multipart/form-data">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                  <label for="Profile Picture">Profile Picture:</label>
                  <img id="previewImage" class="rounded-circle img-fluid hidden mt-3 mb-3" width="200" height="200" style="display: block; margin-left: auto; margin-right: auto;">
                    <input class="form-control" type="file" name="picture" accept="image/jpeg, image/png" id="profilePicture">
                   
                  </div>
                </div>
              </div>
              
              

              <input type="submit" value="Submit" class="btn px-5 btn-primary" id="submitButton">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>

    function toggleAdditionalInfo() {
      var roleSelect = document.getElementById('roleSelect');
      var previewImage = document.getElementById('previewImage');

      if (roleSelect.value === '2') { // '2' corresponds to the value for Tutor
        previewImage.classList.remove('hidden');
      } else {
        previewImage.classList.add('hidden');
      }
    }

    // Display the uploaded image
    document.getElementById('profilePicture').addEventListener('change', function() {
      var previewImage = document.getElementById('previewImage');
      var fileInput = this;

      if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          previewImage.src = e.target.result;
          previewImage.classList.remove('hidden');
        };

        reader.readAsDataURL(fileInput.files[0]);
      }
    });
  </script>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
