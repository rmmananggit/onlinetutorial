<?php
 include('./includes/header.php');
 include('./includes/topnav.php');
 include('./includes/sidenav.php');
 ?>


<div class="container-fluid px-4">
        <ol class="breadcrumb mb-2">    
            <li class="breadcrumb-item">Jobs</li>
            <li class="breadcrumb-item active">Create Job</li>
            
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Create Job
                        </h4>
                    </div>
                    <div class="card-body">

                        

                <form action="#" method="post" autocomplete="off" enctype="multipart/form-data">

                    <div class="row">

                    <div class="col-md-12 mb-3">
                    <input required type="text" Placeholder="Job Title *" name="title" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                    <textarea class="form-control" id="description" rows="7" placeholder="Description *"></textarea>
                    </div>
               
                    <div class="col-md-6 mb-3">
                    <input required type="text" Placeholder="Rate *" name="title" class="form-control">
                    </div>
                    

                    <div class="col-md-6 mb-3">
                                    <select name="rate_description" required class="form-control">
                                        <option value="" disabled selected >-- Select Rate Description--</option>
                                        <option value="">Per Hour</option>
                                        <option value="">Per Day</option>
                                    </select>
                    </div>

                    <div class="col-md-12 mb-3">
                                    <select name="rate_description" required class="form-control">
                                        <option value="" disabled selected >--Select Job Type--</option>
                                        <option value="">Part-time</option>
                                        <option value="">Full-time</option>
                                    </select>
                    </div>

                    <div class="col-md-6 mb-3">
                    <input required type="text" Placeholder="Tutor Experience Needed *" name="title" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                                    <select name="rate_description" required class="form-control">
                                        <option value="" disabled selected >-- Select Experience Description--</option>
                                        <option value="">Month/s</option>
                                        <option value="">Year/s</option>
                                    </select>
                    </div>

                    <div class="col-md-6 mb-3">
                    <input required type="text" Placeholder="Job Duration *" name="title" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                                    <select name="rate_description" required class="form-control">
                                        <option value="" disabled selected >-- Select Duration Description--</option>
                                        <option value="">Day/s</option>
                                        <option value="">Month/s</option>
                                        <option value="">Year/s</option>
                                    </select>
                    </div>

                    <div class="col-md-12 mb-3">
    <fieldset class="border p-2">
        <legend class="w-auto" style="font-size: 20px;"><u>Skills Required</u></legend>
        <legend class="w-auto" style="font-size: 14px;">Academic Skill:</legend>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="english" name="academicSkills[]" value="English">
            <label class="form-check-label" for="english">English</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="math" name="academicSkills[]" value="Math">
            <label class="form-check-label" for="math">Math</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="science" name="academicSkills[]" value="Science">
            <label class="form-check-label" for="science">Science</label>
        </div>

        <hr class="my-3">

        <legend class="w-auto" style="font-size: 14px;">None-Academic Skill:</legend>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="guitarLesson" name="nonAcademicSkills[]" value="Guitar Lesson">
            <label class="form-check-label" for="guitarLesson">Guitar Lesson</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="publicSpeaking" name="nonAcademicSkills[]" value="Public Speaking Masterclass">
            <label class="form-check-label" for="publicSpeaking">Public Speaking Masterclass</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="bookkeeping" name="nonAcademicSkills[]" value="Bookkeeping NC III">
            <label class="form-check-label" for="bookkeeping">Bookkeeping NC III</label>
        </div>
    </fieldset>
                    </div>




                     </div>   

                               <div class="text-right">
                                <a href="index.php" class="btn btn-danger">Back</a>
                                <button type="submit" name="create_job" class="btn btn-primary">Create</button>
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
