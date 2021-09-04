<?php // PENDING TABLES
require('./conn.php');
session_start();

if (empty($_SESSION['id']) && empty($_SESSION['user_name'])) {
  echo "<script>window.open('index.php', '_self')</script>";
}else{
  $realName = $_SESSION['name'];
  $realDepartment = $_SESSION['department'];
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
    
  <title>NCST Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<style>

</style>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
<!--=====================================================================================================================-->
<!-- SIDE BAR -->
<!--=====================================================================================================================-->         
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Home.php">
        <div class="sidebar-brand-icon">
           <img class="sidebar-logo" src="img/NCST.png">
        </div>
          <div class="sidebar-brand-text mx-3" style="color:yellow">NCST</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="Home.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        PROFILE
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="updateprofile.php">
           <i class="fas fa-fw fa-user"></i>
          <span>My account</span></a>
      </li>

     

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        SERVICES
      </div>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->

  <li class="nav-item active">
        <a class="nav-link" href="pending-tables.php">
        <i class="fas fa-fw fa-clock"></i>
        <!-- <i class="fas fa-file-alt"></i> -->
          <span>Pending Application</span></a>
      </li>


<!-- =================================================================================================================-->
<!-- =================================================================================================================-->


<?php if($_SESSION['position']=='Department Head') { ?>
  
      <li class="nav-item">
        <a class="nav-link" href="pending-iom.php">
        <i class="fas fa-drafting-compass"></i>
        <!-- <i class="fas fa-file-alt"></i> -->
          <span>IOM</span></a>
      </li>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->

<?php } ?>
   
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Forms</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Forms:</h6>
            <a class="collapse-item" href="cashadvance.php"><i class="fas fa-fw fa-wallet"></i>  Cash Advance</a> 
            <a class="collapse-item" href="leave.php"><i class="fas fa-fw fa-file-alt"></i> Leave</a>
            <a class="collapse-item" href="officialbusiness.php"><i class="fas fa-fw fa-building"></i>  Official Business</a>
            <a class="collapse-item" href="overtime.php"><i class="fas fa-fw fa-user-clock"></i>  Overtime</a>
              <a class="collapse-item" href="undertime.php"><i class="fas fa-fw fa-hourglass-half"></i>  Undertime</a>
            <a class="collapse-item" href="substitution.php"><i class="fas fa-fw fa-user-friends"></i>  Substitution</a>
            <a class="collapse-item" href="iom.php"><i class="fas fa-fw fa-drafting-compass"></i>  IOM</a>
            <div class="collapse-divider"></div>

          </div>
        </div>
      </li>

 

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="status.php">
        <!-- <i class="fas fa-fw fa-clock"></i> -->
        <i class="fas fa-fw fa-file-alt"></i>
          <span>Status</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

  
<!--=====================================================================================================================-->
<!-- END SIDE BAR -->
<!--=====================================================================================================================-->         

<?php require('./Admin-navbar.php'); ?>

<!--=====================================================================================================================-->
<!-- Begin Page Content =================================================================================================-->
<!--=====================================================================================================================-->
<?php if($_SESSION['position']=='Department Head') { ?>
  <div class="container">
<h6 class="h5 mb-0 text-gray-800">Pending Form Applications: </h6>
  <div class="row mt-2">
  
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `leaves` WHERE `status` = 'pending' AND `department` = '$realDepartment';") as $count2) { 
  $value2 = $count2['COUNT(*)'];
  if($value2>0){
  }else {
    $value2 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/2.jpg" alt="Leave" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Leave</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value2 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="pending-1.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>


<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `official_businesses` WHERE `status` = 'pending' AND `department` = '$realDepartment';") as $count3) { 
  $value3 = $count3['COUNT(*)'];
  if($value3>0){
  }else {
    $value3 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-info text-center">
              <img class="card-img-top" src="img/3.jpg" alt="Official Business" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Official Business</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value3 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="pending-6.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

    </div>

     <div class="row mt-2">


<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `overtimes` WHERE `status` = 'pending' AND `department` = '$realDepartment';") as $count4) { 
  $value4 = $count4['COUNT(*)'];
  if($value4>0){
  }else {
    $value4 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-primary text-center">
              <img class="card-img-top" src="img/4.jpg" alt="Overtime" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Overtime</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value4 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="pending-7.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>


<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `undertimes` WHERE `status` = 'pending' AND `sick` = 'no' AND `department` = '$realDepartment';") as $count5) { 
  $value5 = $count5['COUNT(*)'];
  if($value5>0){
  }else {
    $value5 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/5.jpg" alt="Undertime" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Undertime</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value5 . "</b>"; ?> Pending Request</span></p>
                 <div class="card-footer"><a href="pending-4.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>


<!-- ======================================================================================================= -->            

</div>
<?php } ?>



<!--=====================================================================================================================-->             
<!-- NURSE SESSION ================================================================================================-->
<!--=====================================================================================================================-->
<?php if($_SESSION['position']=='School Nurse') { ?>
<div class="container">
<h6 class="h5 mb-0 text-gray-800">Pending Form Applications: </h6>
  <div class="row mt-2">
  
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `leaves` WHERE `status` = 'recommended' AND `type` = 'Sick Leave';") as $count2) { 
  $value2 = $count2['COUNT(*)'];
  if($value2>0){
  }else {
    $value2 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/2.jpg" alt="Leave" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Leave</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value2 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="pending-2.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `undertimes` WHERE `status` = 'pending' AND `sick` = 'yes';") as $count5) { 
  $value5 = $count5['COUNT(*)'];
  if($value5>0){
  }else {
    $value5 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/5.jpg" alt="Undertime" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Undertime</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value5 . "</b>"; ?> Pending Request</span></p>
                 <div class="card-footer"><a href="pending-5.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

</div>
<?php } ?>



<!--=====================================================================================================================-->             
<!-- CAMPUS MANAGER SESSION ================================================================================================-->
<!--=====================================================================================================================-->
<?php if($_SESSION['position']=='Campus Manager') { ?>
  <div class="container">
<h6 class="h5 mb-0 text-gray-800">Pending Form Applications: </h6>
  <div class="row mt-2">
  
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `leaves`  WHERE `status` IN ('recommended','endorsed');") as $count2) { 
  $value2 = $count2['COUNT(*)'];
  if($value2>0){
  }else {
    $value2 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/2.jpg" alt="Leave" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Leave</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value2 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="pending-3.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

</div>
<?php } ?>


<!--=====================================================================================================================-->             
<!-- SUBSTITUTION: COLLEGE DEAN SESSION ================================================================================================-->
<!--=====================================================================================================================-->
<?php if($_SESSION['position']=='College Dean') { ?>
  <div class="container">
<h6 class="h5 mb-0 text-gray-800">Pending Form Applications: </h6>
  <div class="row mt-2">
  
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `substitutions`  WHERE `status` = 'pending';") as $count8) { 
  $value8 = $count8['COUNT(*)'];
  if($value8>0){
  }else {
    $value8 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/6.jpg" alt="Leave" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Substitution</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value8 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="pending-8.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

</div>
<?php } ?>


<!--=====================================================================================================================-->             
<!-- SUBSTITUTION: DEPARTMENT COORDINATOR SESSION ================================================================================================-->
<!--=====================================================================================================================-->
<?php if($_SESSION['position']=='Department Coordinator') { ?>
  <div class="container">
<h6 class="h5 mb-0 text-gray-800">Pending Form Applications: </h6>
  <div class="row mt-2">
  
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `substitutions`  WHERE `status` = 'recommended';") as $count9) { 
  $value9 = $count9['COUNT(*)'];
  if($value9>0){
  }else {
    $value9 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/6.jpg" alt="Leave" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Substitution</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value9 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="pending-9.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

</div>
<?php } ?>

<!--=====================================================================================================================-->             
<!-- SUBSTITUTION: DIRECTOR OF ADMINISTRATION SESSION ================================================================================================-->
<!--=====================================================================================================================-->
<?php if($_SESSION['position']=='Director of Administration') { ?>
  <div class="container">
<h6 class="h5 mb-0 text-gray-800">Pending Form Applications: </h6>
  <div class="row mt-2">
  
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `cash_advances`  WHERE `status` = 'accepted';") as $count10) { 
  $value10 = $count10['COUNT(*)'];
  if($value10>0){
  }else {
    $value10 = "No ";
  }
?>
        <div class="col-md-3  col-sm-6 col-xs-6 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/6.jpg" alt="Leave" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Cash Advance</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value10 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="pending-10.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

</div>
<?php } ?>

<!--=====================================================================================================================-->             
<!-- End of Main Content ================================================================================================-->
<!--=====================================================================================================================-->

<?php require('./Admin-footer.php'); ?>

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

<script>
$('#buang-list a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>

</body>
</html>
