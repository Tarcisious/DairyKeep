<?php
// Include config file
require_once "database/config.php";
 
// Define variables and initialize with empty values

$fname = $lname = $phone = $email = $message = "";

$fname_err = $lname_err = $phone_err = $email_err = $message_err = "";


 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    // Validate fname
    $input_fname = trim($_POST["fname"]);
    if(empty($input_fname)){
        $fname_err = "Please enter first name.";     
    } else{
        $fname = $input_fname;
    }

    

    // Validate lname
    $input_lname = trim($_POST["lname"]);
    if(empty($input_lname)){
        $lname_err = "Please enter last name.";     
    } else{
        $lname = $input_lname;
    }

    // Validate phone
    $input_phone = trim($_POST["phone"]);
    if(empty($input_phone)){
        $phone_err = "Please enter phone number.";     
    } else{
        $phone = $input_phone;
    }
    
     // Validate email
     $input_email = trim($_POST["email"]);
     if(empty($input_email)){
         $email_err = "Please enter email.";     
     } else{
         $email = $input_email;
     }

     // Validate message
    $input_message = trim($_POST["message"]);
    if(empty($input_message)){
        $message_err = "Please enter a message.";     
    } else{
        $message = $input_message;
    }
        
    // Check input errors before inserting in database
    if(empty($fname_err) 
    && empty($lname_err) 
    && empty($phone_err)
    && empty($email_err)
    && empty($message_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO dkcontacts (fname, lname, phone, email, message) VALUES (:fname, :lname, :phone, :email, :message)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fname", $param_fname);
            $stmt->bindParam(":lname", $param_lname);
            $stmt->bindParam(":phone", $param_phone);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":message", $param_message);

            // Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_phone = $phone;
            $param_email = $email;
            $param_message = $message;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                // header("location: index.php");
                echo "Your message is succefully submmitted.";

                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Dairy Keep</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/style.css" />

    
</head>
<body id="start">
      <!--Main Navigation-->
  <header>
    <style>
      /* Carousel styling */
      #introCarousel,
      .carousel-inner,
      .carousel-item,
      .carousel-item.active {
        height: 100vh;
      }

      .carousel-item:nth-child(1) {
        background-image: url('img/cow1.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .carousel-item:nth-child(2) {
        background-image: url('img/cow2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      .carousel-item:nth-child(3) {
        background-image: url('img/cow3.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #introCarousel {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;" >
      <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand nav-link" target="_blank" href="#start">
          <strong>DAIRY KEEP</strong>
        </a>

        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarExample01">
          <!-- RIGHT SIDE -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="#start">HOME</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#about_us" rel="nofollow"
                target="_blank">ABOUT US</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#features" target="_blank">DAIRY KEEP FEATURES</a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="#contact_us" target="_blank">CONTACT US</a>
            </li>
          </ul>

          <ul class="navbar-nav list-inline">
            <!-- LEFT SIDE -->
          
            <li class="">
              <a class="nav-link" href="reg.php" target="_blank">SIGN UP</a>
            </li>

            <li class="nav-link">
                
              <select id="" size="1" onchange="window.location.href=this.value;"  >
                    <option value="">Login</option>
                    <option value="adminlogin.php">Admin/Owner</option>
                    <option value="fmlogin.php">Farm Manager</option>
                    <option value="elogin.php">Employee</option>
                    <option value="clogin.php">Customer</option>
                </select>
            
            
            </li>

          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Carousel wrapper -->
    <div id="introCarousel" class="carousel slide carousel-fade shadow-2-strong" data-mdb-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="0" class="active"></li>
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="1"></li>
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="2"></li>
      </ol>

      <!-- Inner -->
      <div class="carousel-inner">
        <!-- Single item -->
        <div class="carousel-item active">
          <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h1 class="mb-3">DAIRY KEEP</h1>
                <h5 class="mb-4">Online Dairy Farm Management System</h5>

                <a class="btn btn-outline-light btn-lg m-2" href="reg.php"
                  role="button" rel="" target="_blank">Get Started</a>

                
              </div>
            </div>
          </div>
        </div>

        <!-- Single item -->
        <div class="carousel-item">
          <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h2>Your Dairy Farm At The Palms Of Your Hands</h2>
              </div>
            </div>
          </div>
        </div>

        <!-- Single item -->
        <div class="carousel-item">
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="text-white text-center">
                <h2>Simplified Dairy Record Keeping</h2>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Inner -->

      <!-- Controls -->
      <a class="carousel-control-prev" href="#introCarousel" role="button" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#introCarousel" role="button" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- Carousel wrapper -->
  </header>

<!--Main Navigation-->
<!--Main layout-->
<hr class="my-5" />
<!-- START ABOUT US -->
<section class="container-fluid" id="about_us">
  <div class="text-center">  
    <img src="img/dk2logo.png" class="img-fluid" />
      <h2 class="h1-responsive font-weight-bold text-center my-5">YOUR DAIRY DATA MANAGEMENT SOLUTION</h2>
        <div class="card card-image" style="background-image: url(img/cowbg.jpg);">
          <h1 class="card-title py-3 font-weight-bold"><strong>ABOUT US</strong></h1>
              <p class="pb-3 Display 3">
                <h2 class="h1-responsive font-weight-bold text-center my-5 text-dark"> 
                  Dairy Keep is an online Dairy Farm Management System, aimed at helping dairy farmers to be 
                  able to improve their milk production data handling methods as well as contribute to the 
                  numerous researches that take part in the country.
                  Dairy Keep eradicates the manual way of collecting data and also create a reference point 
                  to any future setbacks via its own data.
                  Dairy Keep will be resourceful to dairy farmers who are trying to make their own research 
                  and make analysis on various problems and 
                  issues affecting the dairy farming industry.
                </h2>
              </p>
       </div>
  </div>
</section>
<!-- END ABOUT US -->
<hr class="my-5" />
<!-- START DAIRY KEEP FEATURES  -->
  <div class="container my-5 p-5 z-depth-1">
  <!--Section: Content-->
    <section class="dark-grey-text" id="features" >
    <!-- Section heading -->
      <h2 class="text-center font-weight-bold mb-4 pb-2">
        DAIRY KEEP FEATURES
      </h2>
    <!-- Grid row -->
      <div class="row">
    <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-5">
    <!-- Grid row -->
      <div class="row">
    <!-- Grid column -->
      <div class="col-lg-2 col-md-3 col-2">
        <i class="fas fa-bullhorn blue-text fa-2x"></i>
      </div>
     <!-- Grid column -->
    
     <!-- Grid column -->
        <div class="col-lg-10 col-md-9 col-10">
          <h4 class="font-weight-bold">
            Simplified dairy data management
          </h4>
          <!-- LIST -->
          <ul style="list-style-type:square" class="font-weight-bold">
              <li>Cow Record Management </li>
              <li>Milk Record Management </li>
              <li>Feeds Record Management </li>
              <li>Vetinary Record Management </li>
              <li>Sales/Expenses Record Management </li>

          </ul>
        </div>
      <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-5">

      <!-- Grid row -->
        <div class="row">
      <!-- Grid column -->
        <div class="col-lg-2 col-md-3 col-2">
          <i class="fas fa-cogs pink-text fa-2x"></i>
        </div>
      <!-- Grid column -->

      <!-- Grid column -->
        <div class="col-lg-10 col-md-9 col-10">
          <h4 class="font-weight-bold"
          >Farm alerts and notifications
          </h4>
          <!-- LIST -->
            <ul style="list-style-type:square" class="font-weight-bold">
              <li>Deworming </li>
              <li>Breeding</li>
              <li>Dairy Events</li>
              <li>Feeds </li>
            </ul>
        </div>
      <!-- Grid column -->
        </div>
      <!-- Grid row -->
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4">
      <!-- Grid row -->
        <div class="row">
      <!-- Grid column -->
        <div class="col-lg-2 col-md-3 col-2">
          <i class="fas fa-tachometer-alt purple-text fa-2x"></i>
        </div>
      <!-- Grid column -->

      <!-- Grid column -->
        <div class="col-lg-10 col-md-9 col-10">
          <h4 class="font-weight-bold">
            Access t Quality farm inputs & Dairy feed
          </h4>
          <!-- LIST -->
          <ul style="list-style-type:square" class="font-weight-bold">
            <li>Vetinary Services</li>
            <li>Dairy Feeds </li>
            <li>Cow Suppliments</li>
            <li>AI services</li>
            <li>Dary Farm Machinary</li>
           </ul>
        </div>
      <!-- Grid column -->
        </div>
      <!-- Grid row -->

      </div>
      <!-- Grid column -->
    </div>
      <!-- Grid row -->
  </section>
  <!--Section: Content-->
</div>
<!-- END DAIRY KEEP FEATURES  -->
<hr class="my-5" />

<!-- START CONTACT US -->
<!--Section: Content-->
  <section class="mb-5" id="contact_us">
   <h4 class="mb-5 text-center"><strong>CONTACT US</strong></h4>
      <div class="row d-flex justify-content-center">
          <div class="col-md-6">



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


          <!-- 2 column grid layout with text inputs for the first and last names -->

          <!-- FIRST NAME INPUT -->

            <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <!-- <input type="text" name="fname"class="form-control"/> -->
                    <input type="text" name="fname" class="form-control 
                        <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>"
                         value="<?php echo $fname; ?>">
                        <span class="invalid-feedback"><?php echo $fname_err;?></span>
                        <label class="form-label">First name</label>
                  </div>
                </div>

              <!-- LAST NAME INPUT -->

                <div class="col">
                  <div class="form-outline">
                    <!-- <input type="text" name="lname" class="form-control" /> -->
                    <input type="text" name="lname" class="form-control 
                      <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
                      <span class="invalid-feedback"><?php echo $lname_err;?></span>
                      <label class="form-label">Last name</label>
                  </div>
                </div>
              </div>

              <!-- Phone number input -->
              <div class="form-outline mb-4">
                <!-- <input type="text" name="phone" class="form-control" /> -->
                <input type="text" name="phone" class="form-control 
                  <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                  <span class="invalid-feedback"><?php echo $phone_err;?></span>
                  <label class="form-label">Phone Number</label>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <!-- <input type="email"name="email" class="form-control" /> -->
                <input type="text" name="email" class="form-control 
                  <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                  <span class="invalid-feedback"><?php echo $email_err;?></span>
                   <label class="form-label">Email address</label>
              </div>
  
              <!-- Message input -->
              <div class="form-outline mb-4">
                <!-- <textarea class="form-control" name="message" rows="4"></textarea> -->
                <textarea name="message" class="form-control 
                  <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>">
                  <?php echo $message; ?></textarea>
                  <span class="invalid-feedback"><?php echo $message_err;?></span>
                <label class="form-label" >Message</label>
              </div>

              <!-- Submit button -->
              <!-- <button type="submit" class="btn btn-primary btn-block mb-4" value="Submit">Send</button> -->


              <input type="submit" class="btn btn-primary btn-block mb-4" value="Submit">
                        <!-- <a href="index.php" class="btn btn-secondary ml-2">Send</a> -->

          </form>
             
      </section>
      <!--Section: Content-->
    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    <div class="py-4 text-center">
     
    <hr class="m-0" />

    <div class="text-center py-4 align-items-center">
      

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2022 Copyright:
      <a class="text-dark" href="#start">WWW.DAIRYKEEP.COM</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>

