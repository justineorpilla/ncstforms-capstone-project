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
        header("Location: undertime.php?error=Signature is required. Please upload your Signature on My Account tab before submitting a form"); 
        exit();
      }else{

        $name = $realName;
        $date = $_POST['date'];
        $time_in = $_POST['time_in'];
        $time_out = $_POST['time_out'];
        $reason = $_POST['reason'];
        $dept = $realDepartment;
        $eid = $realEmployeeID;
        $sick = $_POST['sick'];
        $sign = $realSignature;
        
        $query = "INSERT INTO `undertimes` (`id`, `requested_by`, `requested_at`, `date`, `time_in`, `time_out`, `reason`, `approved_at`, `approved_by`, `status`,`department`,`employee_id`,`sick`,`emp_signature`) 
        VALUES (NULL, '$name', CURRENT_TIMESTAMP, '$date', '$time_in', '$time_out', '$reason', NULL, NULL, 'pending','$dept','$eid','$sick','$sign');";

        if(performQuery($query)){
          // echo "<script>alert('Your Undertime Request is now pending for approval. Thank you ')</script>";
          $_SESSION['status'] = "Undertime Successfully Applied!";
          $_SESSION['status_code'] = "success";
          header('Location: undertime.php');
          exit(0);
        }else{
          // echo "<script>alert('Unknown error occured')</script>";
          $_SESSION['status'] = "Error Occured";
          $_SESSION['status_code'] = "error";
          header('Location: undertime.php');
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
            <h1 class="h3 mb-0 text-gray-800">UNDERTIME FORM</h1>
        </div>
            
<form method="post">
<?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
  <div class="col-md-6 col-form-label">
    <label for="InputName">Name</label>
    <input type="text" class="form-control" name="name" placeholder="<?php echo ucwords($realName)?>" disabled>
  </div>
  <div class="col-md-6 col-form-label">
    <label for="InputDept">Department</label>
    <input type="text" class="form-control" name="dept" placeholder="<?php echo $realDepartment?>" disabled>
  </div>
  <div class="col-md-6 col-form-label">
    <label for="InputDate">Date of Undertime</label>
    <input type="date" class="form-control" placeholder="" name="date" required>
  </div>
  <div class="row col-md-6 col-form-label">
  <div class="col-md-6 col-form-label">
    <label for="InputAmount">Time In</label>
    <input type="time" class="form-control" name="time_in" required></input>
  </div>
  <div class="col-md-6 col-form-label">
    <label for="InputAmount">Time Out</label>
    <input type="time" class="form-control" name="time_out" required></input>
  </div>
  </div>
  <!-- <div class="col-sm-2 col-form-label">
    <label for="InputDate">Total No. of Hours</label>
    <input type="number" class="form-control" id="caDate" name="hours" placeholder="">
  </div> -->

  <fieldset class="form-group col-md-4">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Sick</legend>
      <div class="col-sm-6">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sick" id="gridRadios1" value="no" checked>
            <label class="form-check-label" for="gridRadios1">
              No
            </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sick" id="gridRadios2" value="yes">
          <label class="form-check-label" for="gridRadios2">
            Yes
          </label>
        </div>
       
      </div>
    </div>
  </fieldset>

  <div class="col-sm-6 col-form-label">
    <label for="InputAmount">Reasons</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="reason" rows="2" placeholder="" required></textarea>
    <!-- Please provide a detailed explanation of why you are requesting undertime, and what you plan to achieve in this time period. -->
  </div>
  
  
  <button type="submit" name="apply" class="btn btn-primary">Submit</button>
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
