<?php 
include "config.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Enquiry Form </title>

    <?php 
	$error_message = "";$success_message = "";

	// Register user
	if(isset($_POST['addenquiry'])){
		$fname = trim($_POST['firstname']);
		$lname = trim($_POST['lastname']);
		$email = trim($_POST['email']);	
        $eventdate = trim($_POST['eventdate']);
        $mobile = trim($_POST['mobile']);
        $organization = trim($_POST['organization']);	
        $typeofevent = trim($_POST['typeofevent']);
        $placerequired = trim($_POST['placerequired']);  
        $food = trim($_POST['food']);
        $decoration = trim($_POST['decoration']);
        $eventmanabymesse = trim($_POST['eventmanabymesse']);

		$isValid = true;

		// Check fields are empty or not
		if( $eventdate=='' || $fname == '' || $lname == '' || $email == '' || $mobile ==''|| $organization=='' || $typeofevent=='' || $placerequired=='' || $food =='' || $decoration =='' || $eventmanabymesse==''){
			$isValid = false;
			$error_message = "Please fill all fields.";
		}

		

		// Check if Email-ID is valid or not
		if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  	$isValid = false;
		  	$error_message = "Invalid Email-ID.";
		}

     
        

		// Insert records
		if($isValid){
			$insertSQL = "INSERT INTO enquiry(eventdate,fname,lname,email,mobile,organization,typeofevent,placerequired,food,decoration, eventmanabymesse ) values(?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $con->prepare($insertSQL);
			$stmt->bind_param("sssssssssss",$eventdate ,$fname,$lname,$email,$mobile,$organization,$typeofevent ,$placerequired,$food,$decoration ,$eventmanabymesse);
			$stmt->execute();
		    $stmt->close();

			$success_message = "Enquiry Submitted successfully.";
		}
	}
	?>
  </head>

<style>

    body{
        margin-top:20px;
        background:#eee;
    }
    .gradient-brand-color {
        background-image: -webkit-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
        background-image: -ms-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
        color: #fff;
    }
    .contact-info__wrapper {
        overflow: hidden;
        border-radius: .625rem .625rem 0 0
    }

    @media (min-width: 1024px) {
        .contact-info__wrapper {
            border-radius: 0 .625rem .625rem 0;
            padding: 5rem !important
        }
    }
    .contact-info__list span.position-absolute {
        left: 0
    }
    .z-index-101 {
        z-index: 101;
    }
    .list-style--none {
        list-style: none;
    }
    .contact__wrapper {
        background-color: #fff;
        border-radius: 0 0 .625rem .625rem
    }

    @media (min-width: 1024px) {
        .contact__wrapper {
            border-radius: .625rem 0 .625rem .625rem
        }
    }
    @media (min-width: 1024px) {
        .contact-form__wrapper {
            padding: 5rem !important
        }
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(132,138,163,0.1) !important;
    }

  </style>
  <body>
    
    <div class="container">
        <div class="contact__wrapper shadow-lg mt-n9">
            <div class="row no-gutters">
                <div class="col-lg-5 contact-info__wrapper gradient-brand-color p-5 order-lg-2">
                    <img src="https://messeglobalpune.com/wp-content/uploads/2022/11/MESSGLOBAL_-300x57.png" alt="">
                    <h3 class="color--white  text-center">Enquiry Form</h3>
        
                    <ul class="contact-info__list list-style--none position-relative z-index-101">
                        <li class="mb-2 pl-4">
                            <span class="position-absolute"><i class="fas fa-envelope"></i></span> pune@exhicongroup.com
                        </li>
                        <li class="mb-2 pl-4">
                            <span class="position-absolute"><i class="fas fa-phone"></i></span> 1800 258 8103
                        </li>
                        <li class="mb-2 pl-4">
                            <!-- <span class="position-absolute"><i class="fas fa-map-marker-alt"></i></span> -->                            
                            <br> 133, next to Magarpatta, Magarpatta, Hadapsar, Pune, Maharashtra 411013
                           

        
                    <figure class="figure position-absolute m-0 opacity-06 z-index-100" style="bottom:0; right: 10px">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="444px" height="626px">
                            <defs>
                                <linearGradient id="PSgrad_1" x1="0%" x2="81.915%" y1="57.358%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(255,255,255)" stop-opacity="1"></stop>
                                    <stop offset="100%" stop-color="rgb(0,54,207)" stop-opacity="0"></stop>
                                </linearGradient>
        
                            </defs>
                            <path fill-rule="evenodd" opacity="0.302" fill="rgb(72, 155, 248)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                            <path fill="url(#PSgrad_1)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                        </svg>
                    </figure>
                </div>
        
                <div class="col-lg-7 contact-form__wrapper p-5 order-lg-1">
                    <div class="class">
                    <?php 
					// Display Error message
					if(!empty($error_message)){
					?>
						<div class="alert alert-danger">
						  	<strong>Error!</strong> <?= $error_message ?>
						</div>

					<?php
					}
					?>

					<?php 
					// Display Success message
					if(!empty($success_message)){
					?>
						<div class="alert alert-success">
						  	<strong>Success!</strong> <?= $success_message ?>
						</div>

					<?php
					}
					?>
				
                    </div>
                    <form method='post' action=''>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="firstName">Event Date</label>
                                    <input type="Date" class="form-control" id="datepicker" name="eventdate" placeholder="Event date" required>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <!-- <label class="required-field" for="firstName">Event Date</label>
                                    <input type="Date" class="form-control" id="datepicker" name="date" placeholder="Event date"> -->
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstname" placeholder="Shri" value="Shrishail" required>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Bagale" value="Bagale" required>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="email">Email-ID</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="shribaagale3@gmaail.com" required>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">Enter Mobile Number</label>
                                    <input type="tel" class="form-control" id="phone" name="mobile" placeholder="+91 1234567890" value="8888988708" required>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Organization</label>
                                    <input type="text" class="form-control" id="lastName" name="organization" placeholder="Organization"  required>
                                </div>
                            </div>

                           <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Type of Event</label>
                                    <select name="typeofevent" class="form-control" id="exampleFormControlSelect1" required>
                                        <option selected>--Select Event Type--</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Corporate Event">Corporate Event</option>
                                        <option value="Exhibition(B2B)">Exhibition(B2B)</option>
                                        <option value="Exhibition(B2C)">Exhibition(B2C)</option>
                                        <option value="Seminar">Seminar</option>
                                        <option value="Other">Other</option>
                                      </select>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Place Required</label>
                                    <select class="form-control" name="placerequired" id="exampleFormControlSelect1" required>
                                        <option selected>-Select Place-</option>
                                        <option value="Messe Global Hall (35000-sq ft)">Messe Global Hall (35000-sq ft)</option>
                                        <option value="Blossom Hall (6000sq ft) + Lown-2 (1400 sq ft)">Blossom Hall (6000sq ft) + Lown-2 (1400 sq ft)</option>
                                        <option value="Lawn-1 (87000sq ft)">Lawn-1 (87000sq ft)</option>
                                        <option value="Lown-3 (85000sq ft)">Lown-3 (85000sq ft)</option>                                       
                                      </select>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Food & Breakfast </label>
                                    <select class="form-control" name="food" id="exampleFormControlSelect1" required>
                                        <option selected>-Select Food-</option>
                                        <option value="Veg">Veg</option>
                                        <option value="Non-Veg">Non-Veg</option>
                                        <option value="Veg and Non-Veg">Veg and Non-Veg</option>
                                        <option value="None">None</option>                                                                              
                                      </select>
                                </div>
                            </div>
                           

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Decoration</label>
                                    <select class="form-control" name="decoration" id="exampleFormControlSelect1">                                        
                                        <option>--Decoration--</option>
                                        <option value="Stage">Stage</option>
                                        <option value="Sound">Sound</option>
                                        <option value="Light">Light</option>                                                                              
                                        <option value="Decor">Decor</option>                                                                              
                                        <option value="Furniture">Furniture</option>                                                                              
                                        <option value="Generator">Generator</option>                                                                              
                                      </select>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <div class="form-group">                                    
                                    <label for="lastName">Event Management by Messe Global:-</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="eventmanabymesse" id="inlineRadio1" value="YES">
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="eventmanabymesse" id="inlineRadio2" value="NO">
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                      </div>
                                </div>
                            </div>                            
                                                 
                            
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="lastName">If No, Then Client's Event Agency Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Agency Name">
                                </div>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Reference</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Reference">
                                </div>
                            </div>

                            <!-- <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Follow up date</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Follow Up date">
                                </div>
                            </div>                           

                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="message">Remark</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder=""></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <div class="form-group">                                    
                                    <label for="lastName">Status: </label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Conirmed</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Tentative</label>
                                      </div>
                                </div>
                            </div>                            -->
                            
                           
        
                            <div class="col-sm-12 mb-3">
                                <button type="submit" name="addenquiry" class="btn btn-primary">Submit</button>
                            </div>
        
                        </div>
                    </form>
                </div>
                <!-- End Contact Form Wrapper -->
        
            </div>
        </div>
    </div>    

    <script>
        const dateInput = document.getElementById('date');

// ✅ Using the visitor's timezone
dateInput.value = formatDate();

console.log(formatDate());

function padTo2Digits(num) {
  return num.toString().padStart(2, '0');
}

function formatDate(date = new Date()) {
  return [
    date.getFullYear(),
    padTo2Digits(date.getMonth() + 1),
    padTo2Digits(date.getDate()),
  ].join('-');
}

    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>