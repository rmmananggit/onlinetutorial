<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
    </head>

    <?php session_start(); ?>

<body style="background: rgb(174,211,238);">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create  Account</h3></div>
                                <div class="card-body">
                                    <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        <!-- Existing form elements -->

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" name="firstname" />
                                                    <label for="inputFirstName">First name</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="suffix" name="suffix" required>
                                                    <option disabled selected value="">Select Suffix</option>
                                                    <option value="I">I</option>
                                                    <option value="II">II</option>
                                                    <option value="III">III</option>
                                                </select>
                                                <label for="registerAs">Suffix:</label>
                                            </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="lastname" />
                                                    <label for="inputLastName">Last name</label>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <!-- Email input -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email" />
                                            <label for="inputEmail">Email address</label>
                                        </div>

                                        <!-- Password input -->
                                        <div class="row mb-3">
                                       
                                        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" name="password" />
                <label for="inputPassword">Password</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" name="c_password" />
                <label for="inputPasswordConfirm">Confirm Password</label>
                <p id="passwordMatchError" style="color: red; display: none;">Passwords do not match.</p>
            </div>
        </div>

                                            <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" type="text" name="phone" id="phone" placeholder="09X-XXX-XXXXX">
                                <small class="text-muted">Format: 09X-XXX-XXXXX</small>
                            </div>
                                            </div>

                                            
                                            <div class="col-md-6 mt-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="registerAs" name="role" required>
                                                    <option disabled selected value="">Select</option>
                                                    <option value="2">Tutor</option>
                                                    <option value="1">Tutee</option>
                                                </select>
                                                <label for="registerAs">Register As:</label>
                                            </div>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                            <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" id="termsCheckbox">
                                            <label class="form-check-label" for="termsCheckbox">
                                            I agree to the <a href="#" target="_blank">Terms and Conditions</a>
                                            </label>
                                            </div>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                            <div class="g-recaptcha" data-sitekey="6LehgUYpAAAAAGcCEb3JrgAuGgwvczS8sep-C5_s"></div> 
                                            </div>

                                            </div>

                                            
                                        



                                        <!-- Create Account button -->
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                            <button type="submit" class="btn btn-primary mt-3" id="submitButton" disabled>Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="../loginpage/index.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-5">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

    </div>

    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
    $(document).ready(function () {
        function validatePassword() {
            var password = $("#inputPassword").val();
            var confirmPassword = $("#inputPasswordConfirm").val();

            if (password !== confirmPassword) {
                $("#passwordMatchError").show();
            } else {
                $("#passwordMatchError").hide();
            }
        }

        function checkPasswordMatch() {
            validatePassword();

            // Use AJAX to send the password and confirm password to the server for validation
            $.ajax({
                type: "POST",
                url: "check_password.php", // Replace with the actual path to your server-side script
                data: {
                    password: $("#inputPassword").val(),
                    confirmPassword: $("#inputPasswordConfirm").val()
                },
                success: function (response) {
                    if (response === "false") {
                        $("#passwordMatchError").show();
                    } else {
                        $("#passwordMatchError").hide();
                    }
                    enableSubmitButton();
                }
            });
        }

        function enableSubmitButton() {
            // Enable the submit button only if the terms and conditions checkbox is checked
            if ($("#termsCheckbox").prop("checked")) {
                $("#submitButton").prop("disabled", false);
            } else {
                $("#submitButton").prop("disabled", true);
            }
        }

        // Attach the input event handler to both password fields
        $("#inputPassword, #inputPasswordConfirm").on("input", checkPasswordMatch);

        // Attach the change event handler to the terms and conditions checkbox
        $("#termsCheckbox").change(enableSubmitButton);

        // Initial validation on document load
        validatePassword();
    });
</script>

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