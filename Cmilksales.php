<?php
// Include config file
require_once "database/config.php";
 


$id = $mid = $customer = $litres = $plitre = $date = $total = "";

$id_err = $mid_err = $customer_err = $litres_err = $plitre_err = $date_err = $total_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    // Validate mid
    $input_mid = trim($_POST["mid"]);
    if(empty($input_mid)){
        $mid_err = "Please enter milk ID.";     
    } else{
        $mid = $input_mid;
    }

     // Validate customer
     $input_customer = trim($_POST["customer"]);
     if(empty($input_customer)){
         $customer_err = "Please enter customer name.";     
     } else{
         $customer = $input_customer;
     }

      // Validate litres
    $input_litres = trim($_POST["litres"]);
    if(empty($input_litres)){
        $litres_err = "Please enter amount of litres.";     
    } else{
        $litres = $input_litres;
    }

     // Validate plitre
     $input_plitre = trim($_POST["plitre"]);
     if(empty($input_plitre)){
         $plitre_err = "Please enter price per litre.";     
     } else{
         $plitre = $input_plitre;
     }

      // Validate date
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter date.";     
    } else{
        $date = $input_date;
    }

     
      // Validate total
      $input_total = trim($_POST["total"]);
      if(empty($input_total)){
          $total_err = "Please enter total.";     
      } else{
          $total = $input_total;
      }

    
    // Check input errors before inserting in database
    if(empty($mid_err) 
    && empty($customer_err) 
    && empty($litres_err) 
    && empty($plitre_err) 
    && empty($date_err) 
    && empty($total_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO dkmilksales (mid, customer, litres, plitre, date, total)
         VALUES  (:mid, :customer, :litres, :plitre, :date, :total)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":mid", $param_mid);
            $stmt->bindParam(":customer", $param_customer);
            $stmt->bindParam(":litres", $param_litres);
            $stmt->bindParam(":plitre", $param_plitre);
            $stmt->bindParam(":date", $param_date);
            $stmt->bindParam(":total", $param_total);
            
            // Set parameters
            $param_mid = $mid;
            $param_customer = $customer;
            $param_litres = $litres;
            $param_plitre = $plitre;
            $param_date = $date;
            $param_total = $total;
            
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: milksales.php");
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
    <title>Create Milk Record Sales</title>
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
                    <h2 class="mt-5">Create Milk Sales Record</h2>
                    <p>Please fill this form and submit to add milk sales record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <!-- milk ID -->

                        <div class="form-group">
                            <label>Milk ID</label>
                            <input type="text" name="mid" class="form-control 
                            <?php echo (!empty($mid_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $mid; ?>">
                            <span class="invalid-feedback"><?php echo $mid_err;?></span>
                        </div>

                    <!-- customer yield -->
                    <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="customer" class="form-control 
                            <?php echo (!empty($customer_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $customer; ?>">
                            <span class="invalid-feedback"><?php echo $customer_err;?></span>
                        </div>
                    <!-- litres -->

                    <div class="form-group">
                            <label>Litres</label>
                            <input type="text" name="litres" class="form-control 
                            <?php echo (!empty($litres_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $litres; ?>">
                            <span class="invalid-feedback"><?php echo $litres_err;?></span>
                        </div>

                    <!-- plitre  -->

                    <div class="form-group">
                            <label>Price Per Litre</label>
                            <input type="text" name="plitre" class="form-control 
                            <?php echo (!empty($plitre_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $plitre; ?>">
                            <span class="invalid-feedback"><?php echo $plitre_err;?></span>
                        </div>

                    <!-- date-->

                    <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="date" class="form-control 
                            <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>"
                             value="<?php echo $date; ?>">
                            <span class="invalid-feedback"><?php echo $date_err;?></span>
                        </div>

                    <!-- total  -->

                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="total" class="form-control 
                            <?php echo (!empty($total_err)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $total; ?>">
                            <span class="invalid-feedback"><?php echo $total_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="milksales.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>