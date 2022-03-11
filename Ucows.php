<?php
// Include config file
require_once "database/config.php";
 
// Define variables and initialize with empty values

$ccow = $icow = $cname = $gender = $breed = $ctype = $damn = $sire = $lactation = $dob = $cstatus = "";

$ccow_err = $icow_err = $cname_err = $gender_err = $breed_err = $ctype_err = $damn_err = $sire_err = $lactation_err = $dob_err = $cstatus_err = ""; 
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    

    // Validate ccow
    $input_ccow = trim($_POST["ccow"]);
    if(empty($input_ccow)){
        $ccow_err = "Please enter cow insuarance code.";     
    } else{
        $ccow = $input_ccow;
    }


    
    // Validate icow
    $input_icow = trim($_POST["icow"]);
    if(empty($input_icow)){
        $icow_err = "Please enter cow image.";     
    } else{
        $icow = $input_icow;
    }

   
    // Validate cname
    $input_cname = trim($_POST["cname"]);
    if(empty($input_cname)){
        $cname_err = "Please enter cow name.";     
    } else{
        $cname = $input_cname;
    }

     // Validate gender
     $input_gender = trim($_POST["gender"]);
     if(empty($input_gender)){
         $gender_err = "Please enter gender.";     
     } else{
         $gender = $input_gender;
     }


       // Validate breed
   $input_breed = trim($_POST["breed"]);
   if(empty($input_breed)){
       $breed_err = "Please enter breed.";     
   } else{
       $breed = $input_breed;
   }


     // Validate ctype
     $input_ctype = trim($_POST["ctype"]);
     if(empty($input_ctype)){
         $ctype_err = "Please enter cow type.";     
     } else{
         $ctype = $input_ctype;
     }


       // Validate damn
   $input_damn = trim($_POST["damn"]);
   if(empty($input_damn)){
       $damn_err = "Please enter damn.";     
   } else{
       $damn = $input_damn;
   }


     // Validate sire
     $input_sire = trim($_POST["sire"]);
     if(empty($input_sire)){
         $sire_err = "Please enter sire.";     
     } else{
         $sire = $input_sire;
     }

       // Validate lactation
   $input_lactation = trim($_POST["lactation"]);
   if(empty($input_lactation)){
       $lactation_err = "Please enter lactation.";     
   } else{
       $lactation = $input_lactation;
   }

     // Validate dob
     $input_dob = trim($_POST["dob"]);
     if(empty($input_dob)){
         $dob_err = "Please enter an date of birth.";     
     } else{
         $dob = $input_dob;
     }


       // Validate cstatus
   $input_cstatus = trim($_POST["cstatus"]);
   if(empty($input_cstatus)){
       $cstatus_err = "Please enter cow status.";     
   } else{
       $cstatus = $input_cstatus;
   }
   
    // Check input errors before inserting in database

    
    if(empty($ccow_err) 
    && empty($icow_err) 
    && empty($cname_err) 
    && empty($gender_err) 
    && empty($breed_err) 
    && empty($ctype_err) 
    && empty($damn_err) 
    && empty($sire_err) 
    && empty($lactation_err) 
    && empty($dob_err) 
    && empty($cstatus_err)){

        // Prepare an update statement
        $sql = "UPDATE dkcows SET ccow=:ccow, icow=:icow, cname=:cname, gender=:gender, breed=:breed, ctype=:ctype, damn=:damn, sire=:sire, lactation=:lactation, dob=:dob, cstatu:cstatus WHERE id=:id";

         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
         
            $stmt->bindParam(":ccow", $param_ccow);
            $stmt->bindParam(":icow", $param_icow);
            $stmt->bindParam(":cname", $param_cname);
            $stmt->bindParam(":gender", $param_gender);
            $stmt->bindParam(":breed", $param_breed);
            $stmt->bindParam(":ctype", $param_ctype);
            $stmt->bindParam(":damn", $param_damn);
            $stmt->bindParam(":sire", $param_sire);
            $stmt->bindParam(":lactation", $param_lactation);
            $stmt->bindParam(":dob", $param_dob);
            $stmt->bindParam(":cstatus", $param_cstatus);
            $stmt->bindParam(":id", $param_id);

            
            // Set parameters
            
            $param_ccow = $ccow;
            $param_icow = $icow;
            $param_cname = $cname;
            $param_gender = $gender;
            $param_breed = $breed;
            $param_ctype = $ctype;
            $param_damn = $damn;
            $param_sire = $sire;
            $param_lactation = $lactation;
            $param_dob = $dob;
            $param_cstatus = $cstatus;
            $param_id = $id; 
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: cows.php");
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM dkcows WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                $ccow = $row["ccow"];
                $icow = $row["icow"];
                $cname = $row["cname"];
                $gender = $row["gender"];
                $breed = $row["breed"];
                $ctype = $row["ctype"];
                $damn = $row["damn"];
                $sire = $row["sire"];
                $lactation = $row["lactation"];
                $dob = $row["dob"];
                $cstatus = $row["cstatus"];




                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: cowserror.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: cowserror.php");
        exit();
    }
}
?>


<!-- <?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}
?> -->
 
 <!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />
	<title>Admin : Dashboard : DairyKeep</title>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">

		<!-- START SIDE BAR -->
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">DairyKeep</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Cow Records
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="cows.php">
              <i class="align-middle" data-feather="gitlab"></i> <span class="align-middle">Cows</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-profile.html">
              <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">My Calendar</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-profile.html">
              <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Cow Sales</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-in.html">
              <i class="align-middle" data-feather="shuffle"></i> <span class="align-middle">Breeding</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.html">
              <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Cow Health</span>
            </a>
					</li>

				
					<li class="sidebar-header">
						Milk Records
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
              <i class="align-middle" data-feather="cloud-drizzle"></i> <span class="align-middle">Milk</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
              <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Milk Sales</span>
            </a>
					</li>

					<li class="sidebar-header">
						Feeds Records
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
              <i class="align-middle" data-feather="database"></i> <span class="align-middle">Feeds</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
              <i class="align-middle" data-feather="server"></i> <span class="align-middle">Feeds Consumption</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
              <i class="align-middle" data-feather="home"></i> <span class="align-middle">Store</span>
            </a>
					</li>


					<li class="sidebar-header">
						Employee Records
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Employees</span>
            </a>
					</li>


					<li class="sidebar-header">
						Accounts/Expenses Records
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
              <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Account</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
              <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Expenses</span>
            </a>
					</li>


					<li class="sidebar-header">
						Contacts
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">View Contacts</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
              <i class="align-middle" data-feather="edit-3"></i> <span class="align-middle">Reply Contacts</span>
            </a>
					</li>

				</ul>

			</div>
		</nav>


		<!-- END SIDE BAR -->


    <!-- START MAIN -->

		<div class="main">
      <!-- TOP NAV BAR -->
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>
				<div class="navbar-collapse collapse">

					<ul class="navbar-nav navbar-align">

          <li>
          <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">DairyKeep Admin: <?php echo htmlspecialchars($_SESSION["username"]); ?></a>

          </li>
						
						<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <span class="text-dark"><i class="align-middle me-1" data-feather="user"></i></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="reset-password.php"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>

				</div>
			</nav>

      <!-- END TOP NAV BAR -->

			<main class="content">
                <!--BEGIN HERE -->

                <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Cow Record</h2>
                    <p>Please edit the input values and submit to update the cow record.</p>

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                    <div class="form-group">
                            <label>Cow Insuarance Code</label>
                            <input type="text" name="ccow" class="form-control <?php echo (!empty($ccow_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ccow; ?>">
                            <span class="invalid-feedback"><?php echo $ccow_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Cow Image</label>
                            <input type="text" name="icow" class="form-control <?php echo (!empty($icow_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $icow ?>">
                            <span class="invalid-feedback"><?php echo $icow_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Cow Name</label>
                            <input type="text" name="cname" class="form-control <?php echo (!empty($cname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cname; ?>">
                            <span class="invalid-feedback"><?php echo $cname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <input type="text" name="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gender; ?>">
                            <span class="invalid-feedback"><?php echo $gender_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Breed</label>
                            <input type="text" name="breed" class="form-control <?php echo (!empty($breed_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $breed; ?>">
                            <span class="invalid-feedback"><?php echo $breed_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Cow Type</label>
                            <input type="text" name="ctype" class="form-control <?php echo (!empty($ctype_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ctype; ?>">
                            <span class="invalid-feedback"><?php echo $ctype_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Damn</label>
                            <input type="text" name="damn" class="form-control <?php echo (!empty($damn_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $damn; ?>">
                            <span class="invalid-feedback"><?php echo $damn_err;?></span>
                        </div>  

                        <div class="form-group">
                            <label>Sire</label>
                            <input type="text" name="sire" class="form-control <?php echo (!empty($sire_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sire; ?>">
                            <span class="invalid-feedback"><?php echo $sire_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Lactation Period</label>
                            <input type="text" name="lactation" class="form-control <?php echo (!empty($lactation_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lactation; ?>">
                            <span class="invalid-feedback"><?php echo $lactation_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="text" name="dob" class="form-control <?php echo (!empty($dob_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dob; ?>">
                            <span class="invalid-feedback"><?php echo $dob_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Cow Status</label>
                            <input type="text" name="cstatus" class="form-control <?php echo (!empty($cstatus_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cstatus; ?>">
                            <span class="invalid-feedback"><?php echo $cstatus_err;?></span>
                        </div>

                        
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="cows.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>


				<!-- END HERE -->

               


			
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
									<li class="list-inline-item">
									<a class="text-muted" href="#START" target="_blank">WWW.DAIRYKEEP.COM</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>

    <!-- END MAIN -->
	</div>




	

	<script src="js/app.js"></script>

</body>

</html>




    