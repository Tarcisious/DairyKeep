<?php
// Include config file
require_once "database/config.php";
 

$id = $cowid = $invoice = $price = $customerid = $remarks = "";

$id_err = $cowid_err = $invoice_err = $price_err = $customerid_err = $remarks_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    // Validate cowid
    $input_cowid = trim($_POST["cowid"]);
    if(empty($input_cowid)){
        $cowid_err = "Please enter cow ID.";     
    } else{
        $cowid = $input_cowid;
    }

     // Validate invoice
     $input_invoice = trim($_POST["invoice"]);
     if(empty($input_invoice)){
         $invoice_err = "Please enter invoice.";     
     } else{
         $invoice = $input_invoice;
     }

      // Validate price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter price.";     
    } else{
        $price = $input_price;
    }

     // Validate customerid
     $input_customerid = trim($_POST["customerid"]);
     if(empty($input_customerid)){
         $customerid_err = "Please enter customer ID.";     
     } else{
         $customerid = $input_customerid;
     }

      // Validate remarks
    $input_remarks = trim($_POST["remarks"]);
    if(empty($input_remarks)){
        $remarks_err = "Please enter remarks.";     
    } else{
        $remarks = $input_remarks;
    }
       
    // Check input errors before inserting in database
    if(empty($cowid_err) 
    && empty($invoice_err) 
    && empty($price_err) 
    && empty($customerid_err) 
    && empty($remarks_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO dkcowsales (cowid, invoice, price, customerid, remarks)
         VALUES  (:cowid, :invoice, :price, :customerid, :remarks)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":cowid", $param_cowid);
            $stmt->bindParam(":invoice", $param_invoice);
            $stmt->bindParam(":lpricr", $param_price);
            $stmt->bindParam(":customerid", $param_customerid);
            $stmt->bindParam(":remarks", $param_remarks);
            
            // Set parameters
            $param_cowid = $cowid;
            $param_invoice = $invoice;
            $param_price = $price;
            $param_customerid = $customerid;
            $param_remarks = $remarks;
            
          
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: cowsales.php");
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
                    <h2 class="mt-5">Create Cow Sales Record</h2>
                    <p>Please fill this form and submit to add cow sales record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <!-- cow ID -->

                        <div class="form-group">
                            <label>Cow ID</label>
                            <input type="text" name="cowid" class="form-control 
                            <?php echo (!empty($cowid_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $cowid; ?>">
                            <span class="invalid-feedback"><?php echo $cowid_err;?></span>
                        </div>

                    <!-- invoice-->
                    <div class="form-group">
                            <label>Invoice</label>
                            <input type="text" name="invoice" class="form-control 
                            <?php echo (!empty($invoice_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $invoice; ?>">
                            <span class="invalid-feedback"><?php echo $invoice_err;?></span>
                        </div>

                    <!-- price -->

                    <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control 
                            <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>

                    <!-- customerid -->

                    <div class="form-group">
                            <label>Customer ID</label>
                            <input type="text" name="customerid" class="form-control 
                            <?php echo (!empty($customerid_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $customerid; ?>">
                            <span class="invalid-feedback"><?php echo $customerid_err;?></span>
                        </div>

                    <!-- remarks-->

                    <div class="form-group">
                            <label>Remarks</label>
                            <input type="text" name="remarks" class="form-control 
                            <?php echo (!empty($remarks_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $remarks; ?>">
                            <span class="invalid-feedback"><?php echo $remarks_err;?></span>
                        </div>

                  

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="cowsales.php" class="btn btn-secondary ml-2">Cancel</a>
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



 
