<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Mintos I Calendar</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Calendar CSS -->
    <link href="vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS -->
    <link href="vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

    <!-- Toggles CSS -->
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
    
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">

        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" 
        href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="dashboard1.html">
            <span class="align-middle">DairyKeep</span>
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
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-light">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                <div class="sidebar-content js-simplebar">
			
				<ul class="sidebar-nav">
					<li class="sidebar-header">Cow Records</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="cows.php">
                        <i class="align-middle" data-feather="gitlab">
                        </i> <span class="align-middle">Cows</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="mycalendar.php">
                        <i class="align-middle" data-feather="calendar"></i> 
                        <span class="align-middle">My Calendar</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="cowsales.php">
                        <i class="align-middle" data-feather="trending-up"></i> 
                        <span class="align-middle">Cow Sales</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="shuffle"></i> 
                        <span class="align-middle">Breeding</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="activity"></i> 
                        <span class="align-middle">Cow Health</span>
                        </a>
					</li>

					<li class="sidebar-header">Milk Records</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="milk.php">
                        <i class="align-middle" data-feather="cloud-drizzle"></i> 
                        <span class="align-middle">Milk</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="milksales.php">
                        <i class="align-middle" data-feather="trending-up"></i> 
                        <span class="align-middle">Milk Sales</span>
                        </a>
					</li>

					<li class="sidebar-header">Feeds Records</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="database"></i> 
                        <span class="align-middle">Feeds</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="server"></i> 
                        <span class="align-middle">Feeds Consumption</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="home"></i>    
                        <span class="align-middle">Store</span>
                        </a>
					</li>


					<li class="sidebar-header">Employee Records</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="employees.php">
                        <i class="align-middle" data-feather="users"></i> 
                        <span class="align-middle">Employees</span>
                        </a>
					</li>


					<li class="sidebar-header">Accounts/Expenses Records</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="dollar-sign"></i> 
                        <span class="align-middle">Account</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="edit"></i> 
                        <span class="align-middle">Expenses</span>
                        </a>
					</li>

              
					<li class="sidebar-header">Contacts</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="contacts.php">
                        <i class="align-middle" data-feather="list"></i> 
                        <span class="align-middle">View Contacts</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="edit-3">
                        </i> <span class="align-middle">Reply Contacts</span>
                        </a>
					</li>

				</ul>

			</div>
                </div>
            </div>
        </nav>
        <!-- <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div> -->
        <!-- /Vertical Nav -->

       
        <!-- Main Content -->
        <div class="hk-pg-wrapper pb-0">
            <!-- Container -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 pa-0">
                        <div class="calendarapp-wrap">
                            <div class="calendarapp-sidebar">
                                <div class="nicescroll-bar">
                                    <a id="close_calendarapp_sidebar" href="javascript:void(0)" class="close-calendarapp-sidebar">
                                        <span class="feather-icon"><i data-feather="chevron-left"></i></span>
                                    </a>
                                    <div class="add-event-wrap">
                                        <div class="calendar-event alert alert-success alert-dismissible fade show" role="alert">
                                            <p>NYC Conference</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="calendar-event alert alert-primary alert-dismissible fade show" role="alert">
                                            <p>Family Lunch</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="calendar-event alert alert-danger alert-dismissible fade show" role="alert">
                                            <p>UX Meetup</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remove_event" checked>
                                        <label class="custom-control-label" for="remove_event">Remove after drop</label>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block mt-50 mb-20" data-toggle="modal" data-target="#exampleModalEmail">
                                        Add event
                                    </button>
                                </div>
                            </div>

                            <div class="calendar-wrap">
                                <div id="calendar"></div>
                            </div>
                            <!-- notification -->

                            <div class="modal fade" id="exampleModalEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalEmail" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-grey-dark-5">
                                            <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Add new event</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="inputEvent">Event name</label>
                                                    <input type="text" placeholder="Event" id="inputEvent" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDate">Date</label>
                                                    <input type="text" name="daterange" id="inputDate" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputTime">Time</label>
                                                    <input type="text" id="inputTime" class="form-control input-timepicker">
                                                </div>
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="all_day">
                                                    <label class="custom-control-label" for="all_day">All day event</label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputTime">Set Priority</label>
                                                    <select class="form-control custom-select">
                                                        <option selected>Important</option>
                                                        <option>Normal</option>
                                                        <option>Important</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button id="add_event" class="btn btn-primary btn-block mr-10" type="submit">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Compose email -->
                        </div>
                    </div>
                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fullcalendar JavaScript -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/jquery-ui.min.js"></script>
    <script src="vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="dist/js/fullcalendar-data.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="dist/js/feather.min.js"></script>

    <!-- Daterangepicker JavaScript -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="dist/js/daterangepicker-data.js"></script>

    <!-- Toggles JavaScript -->
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>

</body>

</html>