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
    $realSignature =  $_SESSION['signature'];
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
        header("Location: leave.php?error=Signature is required. Please upload your Signature on My Account tab before submitting a form"); 
        exit();
      }else{

        $name = ucwords($realName);
        $dept = $realDepartment;
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        $reason = $_POST['reason'];
        $type = $_POST['type'];
        $employ = $_POST['employ'];
        $withPay = $_POST['pay'];
        $sign = $realSignature;
        
        $query = "INSERT INTO `leaves` (`id`, `requested_by`, `department`, `employment`, `requested_at`, `date_from`, `date_to`, `type`, `withpay`, `approved_at`, `approved_by`, `reason`, `status`, `emp_signature`) 
        VALUES (NULL, '$name', '$dept', '$employ', CURRENT_TIMESTAMP, '$date_from', '$date_to', '$type', '$withPay', NULL, NULL, '$reason', 'pending', '$sign');";

        if(performQuery($query)){
          // echo "<script>alert('Your Leave Request is now pending for approval. Thank you ')</script>";
          $_SESSION['status'] = "Your Leave Request is now pending for approval!";
          $_SESSION['status_code'] = "success";
          header('Location: leave.php');
          exit(0);
        }else{
          $_SESSION['status'] = "Error Occured";
          $_SESSION['status_code'] = "error";
          header('Location: leave.php');
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
            <h1 class="h3 mb-0 text-gray-800">APPLICATION OF LEAVE</h1>
        </div>
            
        <form method="POST">
<?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
  <div class="col-md-6 col-form-label">
    <label for="InputName">Name</label>
    <input type="text" class="form-control" id="leaveName" name="name" placeholder="<?php echo ucwords($realName)?>" disabled>
  </div>
  <div class="col-md-6 col-form-label">
    <label for="InputDepartment">Department</label>
    <input type="text" class="form-control" id="leaveDepartment" name="dept" placeholder="<?php echo $realDepartment?>" disabled>
  </div>
  <div class="form-group col-md-6">
      <label for="inputType">Employment Status</label>
      <select id="inputType" class="form-control" name="employ" required>
        <option value="Regular">Regular</option>
        <option value="Full-Time">Full-Time</option>
        <option value="Probationary">Probationary</option>
        <option value="Contractual">Contractual</option>
        <option value="Part-Time">Part-Time</option>
      </select>
    </div>
  <div class="form-group col-md-6">
      <label for="inputType">Type</label>
      <select id="inputType" class="form-control" name="type" required>
        <option value="Sick Leave">Sick Leave</option>
        <option value="Maternity Leave">Maternity Leave</option>
        <option value="Paternity Leave">Paternity Leave</option>
        <option value="Service Incentive Leave">Service Incentive Leave</option>
        <option value="Vacation Leave">Vacation Leave</option>
        <option value="Earned Leave">Earned Leave</option>
        <option value="Casual Leave">Casual Leave</option>
      </select>
    </div>
    <fieldset class="form-group col-md-6">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">With Pay</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pay" id="gridRadios1" value="No" checked>
          <label class="form-check-label" for="gridRadios1">
            No
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pay" id="gridRadios2" value="Yes">
          <label class="form-check-label" for="gridRadios2">
            Yes
          </label>
        </div>
       
      </div>
    </div>
  </fieldset>
  <div class="form-row col-md-6">
    <div class="form-group col-form-label">
      <label for="fromDate">From (Date)</label>
      <input required type="date" class="form-control" id="fromDate" name="date_from" placeholder="">
    </div>
    <div class="form-group col-form-label">
      <label for="toDate">To (Date)</label>
      <input required type="date" class="form-control" id="toDate" name="date_to" placeholder="">
    </div>
 </div>
    <div class="form-group col-md-6">
    <label for="LeaveReason">Leave Reason</label>
    <textarea required class="form-control" id="LeaveReason" name="reason" rows="2"></textarea>
  </div>
  <div class="form-group col-md-6">
  <button type="submit" name="apply" class="btn btn-primary">Apply</button>
  </div>
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
