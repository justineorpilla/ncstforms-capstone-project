<?php 
session_start();
require('./conn.php');
require('./functions.php'); 
?>
<?php
    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    // Para Maiwasan ma BYPASS yung home.php ireredirect sila sa INDEX pag walang session 
    $realName = $_SESSION['name'];
    $realDepartment = $_SESSION['department'];
    $realEmployeeID = $_SESSION['employee_id'];
    $realSignature = $_SESSION['signature'];
    }else{
      header("Location: index.php");
      exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/NCST.png"/>
<!--===============================================================================================-->
    
  <title>NCST</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php 
  if(isset($_POST['apply'])){

    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
      $signature = validate($realSignature);
    
      if (empty($signature)) {
        header("Location: cashadvance.php?error=Signature is required. Please upload your Signature on My Account tab before submitting a form"); 
        exit();
      }else{

      $name = ucwords($realName);
      $amount = $_POST['amount'];
      $date = $_POST['date'];
      $salary = $_POST['salary'];
      $purpose = $_POST['purpose'];
      $message = "$name would like to request a Cash Advance.";
      $sign = $realSignature;

      $query = "INSERT INTO `cash_advances` (`id`, `requested_by`, `amount`, `requested_at`, `applied_at`, `approved_at`, `approved_by`, `message`, `status`, `type`, `purpose`,`emp_signature`) 
      VALUES (NULL, '$name', '$amount', CURRENT_TIMESTAMP, '$date', NULL, NULL, '$message', 'pending', '$salary','$purpose','$sign');";

      if(performQuery($query)){
        // echo "<script>alert('Your cash advance request is now pending for approval. Thank you ')</script>";
        $_SESSION['status'] = "Your Cash Advance Request is now pending for approval!";
        $_SESSION['status_code'] = "success";
        header('Location: cashadvance.php');
        exit(0);
    }else{
      // echo "<script>alert('Unknown error occured')</script>";
      $_SESSION['status'] = "Error Occured";
      $_SESSION['status_code'] = "error";
      header('Location: cashadvance.php');
    }
  }
}
?>   


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php require('./Sidebar.php'); ?>

<?php require('./User-navbar.php'); ?>

<style>
.error {
    background: #F2DEDE;
    color: #A94442;
    padding: 10px;
    width: 95%;
    border-radius: 5px;
    font-size: 15px;
    margin: 15px auto;
}
</style>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">CASH ADVANCE REQUEST FORM</h1>
            <!-- <img src="img/signatura/<?php echo $_SESSION['signature'];?>" alt=""> -->
        </div>
            
        <form method="POST">
<?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
  <div class="col-md-4 col-form-label">
    <label for="InputName">Employee Name</label>
    <input type="text" class="form-control" placeholder="<?php echo ucwords($realName);?>"disabled>
  </div>
  <div class="col-md-4 col-form-label">
    <label for="InputAmount">Amount</label>
    <input name="amount" type="number" class="form-control" id="inputAmount" placeholder="" required>
  </div>
   <div class="col-md-4 col-form-label">
    <label for="InputDate">Date Needed</label>
    <input name="date" type="date" class="form-control" id="inputDate" placeholder="" required>
  </div> 
  <fieldset class="form-group col-md-4">
    <div class="row">
      
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="salary" id="gridRadios1" value="Personal" checked>
          <label class="form-check-label" for="gridRadios1">
            PERSONAL - For Salary Deduction
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="salary" id="gridRadios2" value="Official">
          <label class="form-check-label" for="gridRadios2">
            OFFICIAL - For Liquidation
          </label>
        </div>
       
      </div>
    </div>
  </fieldset>
  <div class="form-group col-md-4">
    <label for="purpose">Purpose</label>
    <textarea required class="form-control" id="purpose" name="purpose" rows="3"></textarea>
  </div>
  <button name="apply" type="submit" class="btn btn-primary">Submit</button>
</form>
          
            
             
      <!-- End of Main Content -->

<?php require('./Footer.php'); ?>

<!-- SWEET ALERT -->
<script src="js/sweetalert.min.js"></script>
  <?php 
      if(isset($_SESSION['status']) && $_SESSION['status'] !='')
      {
        ?>
         <script>
        swal({
          title: "<?php echo $_SESSION['status']; ?>",
          // text: "You clicked the button!",
          icon: "<?php echo $_SESSION['status_code']; ?>",
          button: "Close",

        });
         </script>
  <?php 
      unset($_SESSION['status']);
      }
  ?>

</body>

</html>
