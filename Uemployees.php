<?php
// Include config file
require_once "database/config.php";
 
// Define variables and initialize with empty values
// $name = $address = $salary = "";
// $name_err = $address_err = $salary_err = "";

$fname = $lname = $idno = $phone = $email = $designation = $salary = "";

$fname_err = $lname_err = $idno_err = $phone_err = $email_err = $designation_err = $salary_err = "";

 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate fname
    $input_fname = trim($_POST["fname"]);
    if(empty($input_fname)){
        $fname_err = "Please enter first name.";
    } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
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

      // Validate idno
    $input_idno = trim($_POST["idno"]);
    if(empty($input_idno)){
        $idno_err = "Please enter ID Number.";     
    } else{
        $idno = $input_idno;
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
        $email_err = "Please enter an email.";     
    } else{
        $email = $input_email;
    }

    // Validate designation
    $input_designation = trim($_POST["designation"]);
    if(empty($input_designation)){
        $designation_err = "Please enter designation.";     
    } else{
        $designation = $input_designation;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($fname_err) 
    && empty($lname_err)
    && empty($idno_err)
    && empty($phone_err)
    && empty($email_err)
    && empty($designation_err)
    && empty($salary_err)){
        // Prepare an update statement
        $sql = "UPDATE dkemployees SET fname=:fname, lname=:lname, idno=:idno, phone=:phone, email=:email, designation=:designation, salary=:salary WHERE id=:id";

         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            // $stmt->bindParam(":name", $param_name);
            // $stmt->bindParam(":address", $param_address);
            // $stmt->bindParam(":salary", $param_salary);
            // $stmt->bindParam(":id", $param_id);


            $stmt->bindParam(":fname", $param_fname);
            $stmt->bindParam(":lname", $param_lname);
            $stmt->bindParam(":idno", $param_idno);
            $stmt->bindParam(":phone", $param_phone);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":designation", $param_designation);
            $stmt->bindParam(":salary", $param_salary);
            $stmt->bindParam(":id", $param_id);

            
            // Set parameters
            
            
            // $param_name = $name;
            // $param_address = $address;
            // $param_salary = $salary;
            // $param_id = $id;



            $param_fname = $fname;
            $param_lname = $lname;
            $param_idno = $idno;
            $param_phone = $phone;
            $param_email = $email;
            $param_designation = $designation;
            $param_salary = $salary;
            $param_id = $id;

            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: employees.php");
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
        $sql = "SELECT * FROM dkemployees WHERE id = :id";
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
                    $name = $row["fname"];
                    $name = $row["lname"];
                    $name = $row["idno"];
                    $name = $row["phone"];
                    $name = $row["email"];
                    $name = $row["designation"];
                    $salary = $row["salary"];


                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: employeeserror.php");
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
        header("location: employeeserror.php");
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
						<a class="sidebar-link" href="mycalendar.php">
              <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">My Calendar</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="cowsales.php">
              <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Cow Sales</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="shuffle"></i> <span class="align-middle">Breeding</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Cow Health</span>
            </a>
					</li>

				
					<li class="sidebar-header">
						Milk Records
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="milk.php">
              <i class="align-middle" data-feather="cloud-drizzle"></i> <span class="align-middle">Milk</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="milksales.php">
              <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Milk Sales</span>
            </a>
					</li>

					<li class="sidebar-header">
						Feeds Records
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="database"></i> <span class="align-middle">Feeds</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="server"></i> <span class="align-middle">Feeds Consumption</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="home"></i> <span class="align-middle">Store</span>
            </a>
					</li>


					<li class="sidebar-header">
						Employee Records
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="employees.php">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Employees</span>
            </a>
					</li>


					<li class="sidebar-header">
						Accounts/Expenses Records
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Account</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Expenses</span>
            </a>
					</li>


					<li class="sidebar-header">
						Contacts
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="contacts.php">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">View Contacts</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                       
                         <!-- FIRST NAME -->

                         <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control 
                            <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $fname; ?>">
                            <span class="invalid-feedback"><?php echo $fname_err;?></span>
                        </div>

                    <!-- LAST NAME -->
                    <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control 
                            <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $lname; ?>">
                            <span class="invalid-feedback"><?php echo $lname_err;?></span>
                        </div>
                    <!-- ID NUMBER -->

                    <div class="form-group">
                            <label>ID Number</label>
                            <input type="text" name="idno" class="form-control 
                            <?php echo (!empty($idno_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $idno; ?>">
                            <span class="invalid-feedback"><?php echo $idno_err;?></span>
                        </div>

                    <!-- PHONE NUMBER -->

                    <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control 
                            <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $phone; ?>">
                            <span class="invalid-feedback"><?php echo $phone_err;?></span>
                        </div>

                    <!-- EMAIL -->

                    <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control 
                            <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>

                    <!-- DESIGNATION -->

                    <div class="form-group">
                            <label>Designaion</label>
                            <input type="text" name="designation" class="form-control 
                            <?php echo (!empty($designation_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $designation; ?>">
                            <span class="invalid-feedback"><?php echo $designation_err;?></span>
                        </div>

                    <!-- SALARY  -->

                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control 
                            <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>



                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="employees.php" class="btn btn-secondary ml-2">Cancel</a>
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



 

<body>
    
</body>
