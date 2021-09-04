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
        header("Location: officialbusiness.php?error=Signature is required. Please upload your Signature on My Account tab before submitting a form"); 
        exit();
      }else{

        $name = $realName;
        $employeeId = $realEmployeeID;
        $department = $realDepartment;
        $date = $_POST['date'];
        $designation = $_POST['designation'];
        $eta = $_POST['eta'];
        $etd = $_POST['etd'];
        $office = $_POST['office_to_visit'];
        $person = $_POST['person_to_visit'];
        $purpose = $_POST['purpose_of_visit'];
        $transport = $_POST['mode_of_transport'];
        $origin = $_POST['ob-origin'];
        $origin_etd = $_POST['origin_etd'];
        $destination = $_POST['ob-desti'];
        $desti_eta = $_POST['desti_eta'];
        $sign = $realSignature;
        
        $query = "INSERT INTO `official_businesses` (`id`, `requested_by`, `employee_id`, `department`, `date`, `designation`, `eta`, `etd`, `requested_at`, `office_to_visit`, `person_to_visit`, `purpose_of_visit`, `mode_of_transport`, `origin`, `origin_etd`, `destination`, `desti_eta`, `approved_at`, `approved_by`, `status`, `emp_signature`) 
        VALUES (NULL, '$name', '$employeeId', '$department', '$date', '$designation', '$eta', '$etd', CURRENT_TIMESTAMP, '$office', '$person', '$purpose', '$transport', '$origin', '$origin_etd', '$destination', '$desti_eta', NULL, NULL, 'pending', '$sign');";

        if(performQuery($query)){
          // echo "<script>alert('Your Official Business Request is now pending for approval. Thank you ')</script>";
          $_SESSION['status'] = "Official Business Successfully Applied!";
          $_SESSION['status_code'] = "success";
          header('Location: officialbusiness.php');
          exit(0);
        }else{
          // echo "<script>alert('Unknown error occured')</script>";
          $_SESSION['status'] = "Error Occured";
          $_SESSION['status_code'] = "error";
          header('Location: officialbusiness.php');
        }
    }
  }
?>   
<style>
.rad1{
    border: 2px solid darkgray;
    border-radius: 15px;
}
.rad2{
    margin-left: 10px;
    margin-top: 10px;
    border: 2px solid darkgray;
    border-radius: 15px;
}
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

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php require('./Sidebar.php'); ?>

<?php require('./User-navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">OFFICIAL BUSINESS</h1>
        </div>
            
        <form method="post">
<?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
        <div class="form-row col-md-12">
        <div class="col-md-4 col-form-label">
            <label for="InputName">Employee Name</label>
            <input type="text" class="form-control" name="name" placeholder="<?php echo ucwords($realName); ?>" disabled>
        </div>
        <div class="col-md-4 col-form-label">
            <label for="InputName">Department</label>
            <input type="text" class="form-control" name="dept" placeholder="<?php echo $realDepartment;?>" disabled>
        </div>
        </div>
        <div class="form-row col-md-12">
        <div class="col-md-4 col-form-label">
            <label for="InputDate">Date of Official Business</label>
            <input type="date" required name="date" class="form-control" id="" placeholder="">
        </div>
        <div class="col-md-4 col-form-label">
            <label for="InputDate">Designation</label>
            <input type="text" required name="designation" class="form-control" id="" placeholder="">
        </div>
        </div>
         <div class="form-row col-md-12">
         <div class="col-md-4 col-form-label">
            <label for="InputTime">Estimated Time of Arrival</label>
            <input type="time" required name="eta" class="form-control" id="" placeholder="">
        </div>
         <div class="col-md-4 col-form-label">
            <label for="InputTime2">Estimated Time of Departure</label>
            <input type="time" required name="etd" class="form-control" id="" placeholder="">
        </div>
         </div>
        <div class="form-row col-md-12">
            <div class="col col-sm-4">
            <label for="otv">Office to Visit</label>
            <input type="text" required name="office_to_visit" class="form-control" placeholder="">
            </div>
            <div class="col col-sm-4">
            <label for="otv">Person to Visit</label>
            <input type="text" required name="person_to_visit" class="form-control" placeholder="">
            </div>
            <div class="col col-sm-4">
            <label for="otv">Purpose of Visit</label>
            <input type="text" required name="purpose_of_visit" class="form-control" placeholder="">
            </div>
        </div>
        
<!--CHECKBOX -->
<br>

    <div class="row col-md-12">
<!-- 1ST -->
<div class="rad1 col col-md-4">

    <label for="transport">Mode of Transport</label><br>

  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="mode_of_transport" id="exampleRadios1"  value="Public Vehicle" checked>
    <label class="form-check-label" for="exampleRadios1">
      Public Vehicle
    </label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="mode_of_transport" id="exampleRadios2" value="School Vehicle">
    <label class="form-check-label" for="exampleRadios2">
      School Vehicle
    </label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="mode_of_transport" id="exampleRadios3" value="Personal Vehicle">
    <label class="form-check-label" for="exampleRadios3">
      Personal Vehicle
    </label>
  </div>
</div>
<!-- 2ND -->
<div class="rad1 col col-md-4">
   <div class="row">
      <div class="col-sm-6">
         <label for="ob-origin">Pre-OB Origin</label><br>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="ob-origin" id="exampleRadios4"  value="Home" checked>
    <label class="form-check-label" for="exampleRadios4">
      Home
    </label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="ob-origin" id="exampleRadios5" value="School">
    <label class="form-check-label" for="exampleRadios5">
      School
    </label>
  </div>
       </div>
       <div class="col-sm-6">
        <label for="">Estimated Time of Departure</label>
        <input type="time" class="form-control" placeholder="" name="origin_etd" required>
       </div>
   </div>
</div>
      
<!-- END 2ND -->

<!-- ============================================================================= 

3RD -->
<div class="rad1 col col-md-4">
   <div class="row">
      <div class="col-sm-6">
         <label for="ob-desti">Post-OB Destination</label><br>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="ob-desti" id="exampleRadios6"  value="Home" checked>
    <label class="form-check-label" for="exampleRadios6">
      Home
    </label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="ob-desti" id="exampleRadios7" value="School">
    <label class="form-check-label" for="exampleRadios7">
      School
    </label>
  </div>
       </div>
       <div class="col-sm-6">
        <label for="">Estimated Time of Arrival</label>
        <input type="time" class="form-control" placeholder="" name="desti_eta" required>
       </div>
   </div>
</div> <!-- END 3RD -->
        
</div> <!-- end row -->      
            
    
  <br>
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
