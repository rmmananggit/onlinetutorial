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

    <script>
  $(document).ready(function() {
    // Function to show/hide the checkbox based on the selected role
    function toggleCheckboxVisibility() {
      var selectedRole = $("#roleSelect").val();
      if (selectedRole === "2") { // Check if the selected role is "Tutor"
        $("#checkboxContainer").show();
      } else {
        $("#checkboxContainer").hide();
      }
    }

    // Initial visibility check based on the default selected role
    toggleCheckboxVisibility();

    // Attach an event listener to the role dropdown to handle changes
    $("#roleSelect").change(function() {
      toggleCheckboxVisibility();
    });
  });
</script>

    <title>TMS: Registration</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/register.png');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 py-5">
            <h3><b>Registration Page 2</b></h3>
            <p class="mb-4" style="color: black;">Empowering Minds, Crafting Futures - A Nexus of Innovation and Education!</p>
            <form action="#" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="purok">Purok</label>
                    <input type="text" class="form-control" placeholder="e.g. 1" name="purok">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="barangay">Barangay</label>
                    <input type="text" class="form-control" placeholder="e.g. San Juan" name="barangay">
                  </div>    
                </div>
  
              
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="picture">Profile Picture</label>
                    <input class="form-control" type="file" name="picture" accept="image/jpeg, image/png">
                  </div>    
                </div>
              </div>
              <div class="row">

              <div class="col-md-12">
              <div class="form-group first">
                <label for="suffix">Role</label>
                <select class="form-control" name="role" id="roleSelect">
                  <option selected>Select Role</option>
                  <option value="2">Tutor</option>
                  <option value="3">Tutee</option>
                </select>
              </div>
            </div>

            <div class="col-md-12" id="checkboxContainer" style="display: none;">
  <label for="academicSkills">Academic Skills: Click the checkbox if you have academic skills</label>
  <div class="form-group">
    <input type="checkbox" name="academicSkills" id="checkbox1">
    <label for="checkbox1">Skill 1</label>
  </div>
  <div class="form-group">
    <input type="checkbox" name="academicSkills" id="checkbox2">
    <label for="checkbox2">Skill 2</label>
  </div>
  <div class="form-group">
    <input type="checkbox" name="academicSkills" id="checkbox3">
    <label for="checkbox3">Skill 3</label>
  </div>
</div>


                <div class="col-md-6">
                  <div class="form-group last mb-3">
                    <label for="re-password">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Your Password" id="re-password">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lname">Phone Number</label>
                    <input type="text" class="form-control" placeholder="09123456789" name="phonenumber">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="lname">Birthday</label>
                    <input type="date" class="form-control" name="birthday">
                  </div>    
                </div>
              </div>

              
              <div class="d-flex mb-5 mt-4 align-items-center">
                <div class="d-flex align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Creating an account means you're okay with our <a href="#">Terms and Conditions</a> and our <a href="#">Privacy Policy</a>.</span>
                  <input type="checkbox" required/>
                  <div class="control__indicator"></div>
                </label>
              </div>
              </div>

              <input type="submit" value="Submit" class="btn px-5 btn-primary">

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
  </body>
</html>