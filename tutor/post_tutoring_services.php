<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>


<div class="container-fluid px-4">
        <ol class="breadcrumb mb-2">    
            <li class="breadcrumb-item">Online Tutoring Services</li>
            <li class="breadcrumb-item active">Post Online Tutoring Services</li>
            
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Online Tutoring Services
                        </h4>
                    </div>
                    <div class="card-body">

                        

                <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">

                    <div class="row">

                    <div class="col-md-12 mb-3">
                    <input required type="text" Placeholder="Job Title *" name="title" class="form-control" maxlength="80">
                    </div>

                    <div class="col-md-12 mb-3">
                        <textarea class="form-control" name="description" rows="7" placeholder="Description *" maxlength="200"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                    <input required type="text" Placeholder="Rate *" name="rate" class="form-control">
                    </div>
                    

                    <div class="col-md-6 mb-3">
                                    <select name="rate_description" required class="form-control">
                                        <option value="" disabled selected >-- Select Rate Description--</option>
                                        <option value="Hour">Hour</option>
                                        <option value="Day">Day</option>
                                    </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="datetime">Preferred Date and Time:</label>
                        <input type="datetime-local" id="datetime" name="datetime" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                    <input required type="text" Placeholder="Tutoring Duration *" name="job_duration" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                                    <select name="job_description" required class="form-control">
                                        <option value="" disabled selected >-- Select Duration Description--</option>
                                        <option value="Hour">Hour</option>
                                        <option value="Day">Day</option>
                                        <option value="Month">Month</option>
                                        <option value="Year">Year</option>
                                    </select>
                    </div>

                    <div class="col-md-12 mb-3">
    <fieldset class="border p-2">
        <legend class="w-auto" style="font-size: 20px;"><u>Add Skill/s:</u></legend>
        <legend class="w-auto" style="font-size: 14px;">Academic Skill:</legend>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="english" name="skills[]" value="English">
            <label class="form-check-label" for="english">English</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="math" name="skills[]" value="Math">
            <label class="form-check-label" for="math">Math</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="science" name="skills[]" value="Science">
            <label class="form-check-label" for="science">Science</label>
        </div>

        <hr class="my-3">

        <legend class="w-auto" style="font-size: 14px;">None-Academic Skill:</legend>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="guitarLesson" name="skills[]" value="Guitar Lesson">
            <label class="form-check-label" for="guitarLesson">Guitar Lesson</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="publicSpeaking" name="skills[]" value="Public Speaking Masterclass">
            <label class="form-check-label" for="publicSpeaking">Public Speaking Masterclass</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="bookkeeping" name="skills[]" value="Bookkeeping NC III">
            <label class="form-check-label" for="bookkeeping">Bookkeeping NC III</label>
        </div>
    </fieldset>
                    </div>




                     </div>   

                               <div class="text-right">
                                <a href="index.php" class="btn btn-danger">Back</a>
                                <button type="submit" name="create_tutoring_services" class="btn btn-primary">Create</button>
                                </div>
                </form>




                    </div>
                </div>
            </div>
        </div>
    </div>








<?php
 include('./includes/footer.php');
 ?>
