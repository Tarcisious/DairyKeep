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
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
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
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Cow Records</h2>
                        <a href="Ccows.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Cow</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "database/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM dkcows";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Cow Code</th>";
                                        echo "<th>Cow Image</th>";
                                        echo "<th>Cow Name</th>";
                                        echo "<th>Gender</th>";
                                        echo "<th>Breed</th>";
                                        echo "<th>Cow Type</th>";
                                        echo "<th>Damn</th>";
                                        echo "<th>Sire</th>";
                                        echo "<th>Lactation</th>";
                                        echo "<th>Date Of Birth</th>";
                                        echo "<th>cow Status</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['ccow'] . "</td>";
                                        echo "<td>" . $row['icow'] . "</td>";
                                        echo "<td>" . $row['cname'] . "</td>";
                                        echo "<td>" . $row['gender'] . "</td>";
                                        echo "<td>" . $row['breed'] . "</td>";
                                        echo "<td>" . $row['ctype'] . "</td>";
                                        echo "<td>" . $row['damn'] . "</td>";
                                        echo "<td>" . $row['sire'] . "</td>";
                                        echo "<td>" . $row['lactation'] . "</td>";
                                        echo "<td>" . $row['dob'] . "</td>";
                                        echo "<td>" . $row['cstatus'] . "</td>";
                                 echo "<td>";
                                            echo '<a href="Rcows.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"> <span><i class="align-middle" data-feather="eye"></i></span> </a>';
                                            echo '<a href="Ucows.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span><i class="align-middle" data-feather="edit"></i></span></a>';
                                            echo '<a href="Dcows.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span><i class="align-middle" data-feather="delete"></i></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
                </div>
            </div>        
        </div>
    </div>



			
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


