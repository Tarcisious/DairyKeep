<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "database/config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM dkmilk WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_cid);
        
        // Set parameters
        $param_cid = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $ccow = $row["ccow"];
                $icow = $row["morning"];
                $cname = $row["mday"];
                $gender = $row["evening"];
                $breed = $row["date"];
                $ctype = $row["mprice"];
                $damn = $row["total"];
                

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: milkerror.php");
    exit();
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
                    <h1 class="mt-5 mb-3">View Milk Record</h1>

                    <div class="form-group">
                        <label>Cow Insuarance Code</label>
                        <p><b><?php echo $row["ccow"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Morning Yield</label>
                        <p><b><?php echo $row["morning"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Mid-day Yield </label>
                        <p><b><?php echo $row["mday"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Evening Yield</label>
                        <p><b><?php echo $row["evening"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <p><b><?php echo $row["date"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Milk Price</label>
                        <p><b><?php echo $row["mprice"]; ?></b></p>
                    </div>

                    <div class="form-group">
                    <label>Total</label>
                        <p><b><?php echo $row["total"]; ?></b></p>
                    </div>

                    
                    <p><a href="milk.php" class="btn btn-primary">Back</a></p>
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

