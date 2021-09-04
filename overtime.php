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
    $realPosition = $_SESSION['position'];
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
        header("Location: overtime.php?error=Signature is required. Please upload your Signature on My Account tab before submitting a form"); 
        exit();
      }else{

        $name = $realName;
        $dept = $realDepartment;
        $pos = $realPosition;
        $eid = $realEmployeeID;
        $otDate = $_POST['ot_date'];
        $hours = $_POST['hours'];
        $reason = $_POST['reason'];
        $sign = $realSignature;
        
        $query = "INSERT INTO `overtimes` (`id`, `requested_by`, `requested_at`, `date`, `hours`, `reason`, `approved_at`, `approved_by`, `status`, `department`, `position`,`employee_id`,`emp_signature`) 
        VALUES (NULL, '$name', CURRENT_TIMESTAMP, '$otDate', '$hours', '$reason', NULL, NULL, 'pending','$dept','$pos','$eid','$sign');";

        if(performQuery($query)){
          // echo "<script>alert('Your Overtime Request is now pending for approval. Thank you ')</script>";
          $_SESSION['status'] = "Overtime Successfully Applied!";
          $_SESSION['status_code'] = "success";
          header('Location: overtime.php');
          exit(0);
        }else{
          // echo "<script>alert('Unknown error occured')</script>";
          $_SESSION['status'] = "Error Occured";
          $_SESSION['status_code'] = "error";
          header('Location: overtime.php');
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
            <h1 class="h3 mb-0 text-gray-800">OVERTIME FORM</h1>
        </div>
            
        <form method="post">
<?php if (isset($_GET['error'])) { ?>
  <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
  <div class="col-md-4 col-form-label">
    <label for="InputName">Name</label>
    <input type="text" class="form-control" name="name" placeholder="<?php echo ucwords($realName)?>" disabled>
  </div>
  <div class="col-md-4 col-form-label">
    <label for="InputDept">Department</label>
    <input type="text" class="form-control" name="dept" placeholder="<?php echo $realDepartment?>" disabled>
  </div>
  <div class="col-md-4 col-form-label">
    <label for="InputPost">Position</label>
    <input type="text" class="form-control" id="" placeholder="<?php echo $realPosition?>" disabled>
  </div>
  <div class="col-md-4 col-form-label">
    <label for="InputDate">Date of Overtime</label>
    <input type="date" class="form-control" placeholder="" name="ot_date" required>
  </div>
  <div class="col-md-4 col-form-label">
    <label for="InputAmount">Number of OT Hours Requested</label>
    <input type="number" class="form-control" id="woto" placeholder="" name="hours" required>
  </div>
  <div class="col-md-4 col-form-label">
    <label for="InputAmount">Work to Accomplish</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="" name="reason" required></textarea>
    <!-- Please provide a detailed explanation of why you are requesting overtime, and what you plan to achieve in this time period. --> 
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
