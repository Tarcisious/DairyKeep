<?php
// Include config file
require_once "database/config.php";
 
// Define variables and initialize with empty values


$ccow = $morning = $mday = $evening = $date = $mprice = $total = "";

$ccow_err  = $morning_err  = $mday_err  = $evening_err  = $date_err  = $mprice_err  = $total_err  = "";
 
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


    
    // Validate morning yield
    $input_morning = trim($_POST["morning"]);
    if(empty($input_morning)){
        $morning_err = "Please enter morning yield.";     
    } else{
        $morning = $input_morning;
    }

   
    // Validate mid-day yield
    $input_mday = trim($_POST["mday"]);
    if(empty($input_mday)){
        $mday_err = "Please enter mid-day yield.";     
    } else{
        $mday = $input_mday;
    }

     // Validate evening yield
     $input_evening = trim($_POST["evening"]);
     if(empty($input_evening)){
         $evening_err = "Please enter evening yield.";     
     } else{
         $evening = $input_evening;
     }


       // Validate date
   $input_date = trim($_POST["date"]);
   if(empty($input_date)){
       $date_err = "Please enter date.";     
   } else{
       $date = $input_date;
   }


     // Validate mprice
     $input_mprice = trim($_POST["mprice"]);
     if(empty($input_mprice)){
         $mprice_err = "Please enter milk price.";     
     } else{
         $mprice = $input_mprice;
     }


       // Validate total
   $input_total = trim($_POST["total"]);
   if(empty($input_total)){
       $total_err = "Please enter total.";     
   } else{
       $total = $input_total;
   }


     
   
    // Check input errors before inserting in database

    
    if(empty($ccow_err) 
    && empty($morning_err) 
    && empty($mday_err) 
    && empty($evening_err) 
    && empty($date_err) 
    && empty($mprice_err) 
    && empty($total_err)){

        // Prepare an update statement
        $sql = "UPDATE dkmilk SET ccow=:ccow, morning=:morning, mday=:mday, evening=:evening, date=:date, mprice=:mprice, total=:total WHERE id=:id";

         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
         
            $stmt->bindParam(":ccow", $param_ccow);
            $stmt->bindParam(":morning", $param_morning);
            $stmt->bindParam(":mday", $param_mday);
            $stmt->bindParam(":evening", $param_evening);
            $stmt->bindParam(":date", $param_date);
            $stmt->bindParam(":mprice", $param_mprice);
            $stmt->bindParam(":total", $param_total);
            $stmt->bindParam(":id", $param_id);

            
            // Set parameters
            
            $param_ccow = $ccow;
            $param_morning = $morning;
            $param_mday = $mday;
            $param_evening = $evening;
            $param_date = $date;
            $param_mprice = $mprice;
            $param_total = $total;
            $param_id = $id; 
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: milk.php");
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
        $sql = "SELECT * FROM dkmilk WHERE id = :id";
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
                $morning = $row["morning"];
                $mday = $row["mday"];
                $evening = $row["evening"];
                $date = $row["date"];
                $mprice = $row["mprice"];
                $total = $row["total"];
                




                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: milkerror.php");
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
        header("location: milkerror.php");
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


					<li class="#">
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
                    <h2 class="mt-5">Update Milk Record</h2>
                    <p>Please edit the input values and submit to update the cow record.</p>

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                    <div class="form-group">
                            <label>Cow Insuarance Code</label>
                            <input type="text" name="ccow" class="form-control <?php echo (!empty($ccow_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ccow; ?>">
                            <span class="invalid-feedback"><?php echo $ccow_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Morning Yield</label>
                            <input type="text" name="morning" class="form-control <?php echo (!empty($morning_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $morning ?>">
                            <span class="invalid-feedback"><?php echo $morning_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Mid-day Yield</label>
                            <input type="text" name="mday" class="form-control <?php echo (!empty($mday_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mday; ?>">
                            <span class="invalid-feedback"><?php echo $mday_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Evening Yield</label>
                            <input type="text" name="evening" class="form-control <?php echo (!empty($evening_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $evening; ?>">
                            <span class="invalid-feedback"><?php echo $evening_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
                            <span class="invalid-feedback"><?php echo $date_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Milk Price</label>
                            <input type="text" name="mprice" class="form-control <?php echo (!empty($mprice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mprice; ?>">
                            <span class="invalid-feedback"><?php echo $mprice_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="total" class="form-control <?php echo (!empty($total_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $total; ?>">
                            <span class="invalid-feedback"><?php echo $total_err;?></span>
                        </div>  

                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="milk.php" class="btn btn-secondary ml-2">Cancel</a>
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



 
