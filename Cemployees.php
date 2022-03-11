<?php
// Include config file
require_once "database/config.php";
 
// Define variables and initialize with empty values
// $name = $address = $salary = "";
// $name_err = $address_err = $salary_err = "";

$fname = $lname = $idno = $phone = $email = $designation = $salary = "";
$fname_err = $lname_err = $idno_err = $phone_err = $email_err = $designation_err = $salary_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    // $input_name = trim($_POST["name"]);
    // if(empty($input_name)){
    //     $name_err = "Please enter a name.";
    // } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     $name_err = "Please enter a valid name.";
    // } else{
    //     $name = $input_name;
    // }
    
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

      // Validate idno
    $input_idno= trim($_POST["idno"]);
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
        // Prepare an insert statement
        $sql = "INSERT INTO dkemployees (fname, lname, idno, phone, email, designation, salary) VALUES (:fname, :lname, :idno, :phone, :email, :designation, :salary)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fname", $param_fname);
            $stmt->bindParam(":lname", $param_lname);
            $stmt->bindParam(":idno", $param_idno);
            $stmt->bindParam(":phone", $param_phone);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":designation", $param_designation);
            $stmt->bindParam(":salary", $param_salary);
            
            // Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_idno = $idno;
            $param_phone = $phone;
            $param_email = $email;
            $param_designation = $designation;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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
                            <?php echo (!empty($designation_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $designation; ?>">
                            <span class="invalid-feedback"><?php echo $designation_err;?></span>
                        </div>

                    <!-- SALARY  -->

                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control 
                            <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="employees.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>