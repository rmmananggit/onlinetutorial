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
        
        #book_experience:disabled,
        #psm_experience:disabled,
        #guitar_experience:disabled,
        #expeng:disabled,
        #math:disabled,
        #science:disabled {
            background-color: #f0f0f0; /* Use the desired gray color */
            color: #888888; /* Text color for disabled state */
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
                    <form action="tutor_page2_process.php" method="post" enctype="multipart/form-data">

                        <div class="row">

                        <div class="col-md-12 mb-4">
                  <div class="form-group first">
                    <label for="educational_attainment">Educational Attainment:</label>
                    <select class="form-control" name="educational_attainment" required>
                      <option selected disabled>Select Attainment</option>
                      <option value="Elementary">Elementary</option>
                      <option value="High School">High School</option>
                      <option value="Senior High School">Senior High School</option>
                      <option value="College">College</option>
                      <option value="Master's Degree">Master's Degree</option>
                    </select>
                  </div>    
                </div>

                            <div class="col-md-6">
                                <label for="english"><h5>Academic Skills:</h5></label>
                                <div class="form-check-input-label ml-3">
                                    <input type="checkbox" class="form-check-input" value="English" id="english"
                                           onchange="toggleExperienceInputEnglish(this)">
                                    <label class="form-check-input-label" for="english">
                                        English
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group first">
                                    <label for="expeng">Years of Experience:</label>
                                    <input required type="text" class="form-control" placeholder="e.g. 1" name="expeng"
                                           id="expeng" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check-input-label ml-3">
                                    <input type="checkbox" class="form-check-input" value="Math" id="Math"
                                           onchange="toggleExperienceInputMath(this)">
                                    <label class="form-check-input-label" for="Math">
                                        Math
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group first">
                                    <input required type="text" class="form-control" placeholder="e.g. 1" name="math"
                                           id="math" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check-input-label ml-3">
                                    <input type="checkbox" class="form-check-input" value="Science" id="Science"
                                           onchange="toggleExperienceInputScience(this)">
                                    <label class="form-check-input-label" for="Science">
                                        Science
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group first">
                                    <input required type="text" class="form-control" placeholder="e.g. 1" name="science"
                                           id="science" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">
    <label for="guitar_checkbox"><h5>Non-Academic Skills:</h5></label>
    <div class="form-check-input-label ml-3">
        <input type="checkbox" class="form-check-input" value="Guitar Lesson" id="guitar_checkbox" onchange="toggleExperienceInputGuitar(this)">
        <label class="form-check-input-label" for="guitar_checkbox">
            Guitar Lesson
        </label>
    </div>
</div>

<div class="col-md-6 mt-3">
    <div class="form-group first">
        <input required type="text" class="form-control" placeholder="e.g. 1" name="guitar_experience" id="guitar_experience" disabled>
    </div>
</div>

                    <div class="col-md-6">
                        <div class="form-check-input-label ml-3">
                            <input type="checkbox" class="form-check-input" value="Public Speaking Masterclass" id="psm_checkbox"
                                    onchange="toggleExperienceInputPsm(this)">
                            <label class="form-check-input-label" for="psm_checkbox">
                                Public Speaking Masterclass
                            </label>
                        </div>
                    </div>

                            <div class="col-md-6">
                                <div class="form-group first">
                                    <input required type="text" class="form-control" placeholder="e.g. 1" name="psm_experience"
                                           id="psm_experience" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check-input-label ml-3">
                                    <input type="checkbox" class="form-check-input" value="Bookkeeping NC III" id="book_checkbox"
                                           onchange="toggleExperienceInputBook(this)">
                                    <label class="form-check-input-label" for="book_checkbox">
                                        Bookkeeping NC III
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group first">
                                    <input required type="text" class="form-control" placeholder="e.g. 1" name="book_experience"
                                           id="book_experience" disabled>
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="Next" class="btn px-5 btn-primary" id="submitButton">

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

<script>
    function toggleExperienceInputEnglish(checkbox) {
        var experienceInput = document.getElementById('expeng');
                if (checkbox.checked) {
            experienceInput.disabled = false;
        } else {
            experienceInput.disabled = true;
            experienceInput.value = ''; // Reset the input value when unchecked
        }
    }

    function toggleExperienceInputMath(checkbox) {
        var experienceInput = document.getElementById('math');
                if (checkbox.checked) {
            experienceInput.disabled = false;
        } else {
            experienceInput.disabled = true;
            experienceInput.value = ''; // Reset the input value when unchecked
        }
    }

    function toggleExperienceInputScience(checkbox) {
        var experienceInput = document.getElementById('science');
        if (checkbox.checked) {
            experienceInput.disabled = false;
        } else {
            experienceInput.disabled = true;
            experienceInput.value = ''; // Reset the input value when unchecked
        }
    }

    function toggleExperienceInputGuitar(checkbox) {
        var experienceInput = document.getElementById('guitar_experience');
        if (checkbox.checked) {
            experienceInput.disabled = false;
        } else {
            experienceInput.disabled = true;
            experienceInput.value = ''; // Reset the input value when unchecked
        }
    }

    function toggleExperienceInputPsm(checkbox) {
        var experienceInput = document.getElementById('psm_experience');
                if (checkbox.checked) {
            experienceInput.disabled = false;
        } else {
            experienceInput.disabled = true;
            experienceInput.value = ''; // Reset the input value when unchecked
        }
    }

    function toggleExperienceInputBook(checkbox) {
        var experienceInput = document.getElementById('book_experience');
                if (checkbox.checked) {
            experienceInput.disabled = false;
        } else {
            experienceInput.disabled = true;
            experienceInput.value = ''; // Reset the input value when unchecked
        }
    }
</script>

</body>
</html>
