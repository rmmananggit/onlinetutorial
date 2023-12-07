<?php
 include('./includes/authentication.php');
 include('./includes/header.php');
 include('./includes/topnav.php');
 ?>
<style>
    body{

    background-color: #eee;
}

.container{

    height: 100%;
    margin-top: 100px;

}


.card{
    border:none;
}

.form-control {
    border-bottom: 2px solid #eee !important;
    border: none;
    font-weight: 600
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #8bbafe;
    outline: 0;
    box-shadow: none;
    border-radius: 0px;
    border-bottom: 2px solid blue !important;
}



.inputbox {
    position: relative;
    margin-bottom: 20px;
    width: 100%
}

.inputbox span {
    position: absolute;
    top: 7px;
    left: 11px;
    transition: 0.5s
}

.inputbox i {
    position: absolute;
    top: 13px;
    right: 8px;
    transition: 0.5s;
    color: #3F51B5
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0
}

.inputbox input:focus~span {
    transform: translateX(-0px) translateY(-15px);
    font-size: 12px
}

.inputbox input:valid~span {
    transform: translateX(-0px) translateY(-15px);
    font-size: 12px
}

.card-blue{

    background-color: #492bc4;
}

.hightlight{

    background-color: #5737d9;
    padding: 10px;
    border-radius: 10px;
    margin-top: 15px;
    font-size: 14px;
}

.yellow{

    color: #fdcc49; 
}

.decoration{

    text-decoration: none;
    font-size: 14px;
}

.btn-success {
    color: #fff;
    background-color: #492bc4;
    border-color:#492bc4;
}

.btn-success:hover {
    color: #fff;
    background-color:#492bc4;
    border-color: #492bc4;
}


.decoration:hover{

    text-decoration: none;
    color: #fdcc49; 
}
</style>

<div class="container px-5">

            <div class="mb-4">

                <h2>Add Payment</h2>
            <span>Please make the payment and wait for the administrator to approved the payment to use this system.</span>
                
            </div>

        <div class="row">

            <div class="col-md-8">
                
            <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off" autocapitalize="on">

                <div class="card p-3">

                    <h6 class="text-uppercase">Payment details</h6>
                    <div class="row">

                        <div class="col-md-12">

                            <div class="inputbox mt-3 mr-2"> <input type="text" name="reference" class="form-control" required="required"><span>Reference Number</span> 
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                                <select name="mop" required class="form-control">
                                    <option value="" disabled selected>Mode of Payment</option>
                                    <option value="Gcash">Gcash</option>
                                    <option value="Palawan Express">Palawan Express</option>
                                    <option value="PNB">PNB</option>
                                </select>
                            </div>

                



                    </div>

                    <div class="col-xl-12">
                    <div class="row">
                        <span class="mb-2"><b>Select Subscription</b></span>
                        <div class="col-md-6">
                        <div class="form-check">
                    <input class="form-check-input" type="radio" name="subscriptiontype"  value="Monthly">
                    <label class="form-check-label">
                       Monthly (₱100/month)
                    </label>
                    </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-check">
                    <input class="form-check-input" type="radio" name="subscriptiontype"  value="Yearly">
                    <label class="form-check-label">
                        Yearly (₱1,000/year)
                    </label>
                    </div>
                        </div>
                    </div>
                    </div>
                    
                    <hr/>
                    <div class="col-xl-12 mt-1">
                        <label for="formFile" class="form-label">Receipt</label>
                        <input class="form-control" type="file" name="receipt" id="formFile" accept="image/*">
                    </div>


                </div>


                <div class="mt-4 mb-4 d-flex" style="float: right;">


                            <input type="submit" name="submit_payment" value="Submit" class="btn px-5 btn-primary">

                 </div>
            </form>
            </div>



            
<div class="col-md-4">

<div class="">
<h5 class="mb-3">Where to send payment?</h5>
<div class="d-flex mb-2">
<span> <img src="./img/gcash.png" width="60"></span>

<div class="ml-2">
<h6><b>Edrick Windell Carmelo</b></h6>
<h6><b>09123456789</b></h6>
</div>
</div>

<div class="d-flex mb-2">
<span> <img src="./img/palawan1.png" width="60"></span>

<div class="ml-2">
<h6><b>Edrick Windell Carmelo</b></h6>
<h6><b>09123456789</b></h6>
</div>
</div>

<div class="d-flex mb-2">
<span> <img src="./img/pnb.png" width="60"></span>

<div class="ml-2">
<h6><b>Edrick Windell Carmelo</b></h6>
<h6><b>413310115291</b></h6>
</div>
</div>

</div>
                
            </div>
            
        </div>
          

      </div>





<?php
 include('./includes/footer.php');
 ?>
