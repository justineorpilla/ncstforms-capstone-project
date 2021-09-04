<?php 
require('./conn.php');
session_start();
date_default_timezone_set("Asia/Manila");

if (empty($_SESSION['id']) && empty($_SESSION['user_name'])) {
  echo "<script>window.open('index.php', '_self')</script>";
}elseif($_SESSION['type']!='hr'){
  echo "<script>window.open('index.php', '_self')</script>";
}else{
  $realName = $_SESSION['name'];
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

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<!-- SIDE BAR START ============================================================================================== -->
   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="Admin-home.php">
  <div class="sidebar-brand-icon">
     <img class="sidebar-logo" src="img/NCST.png">
  </div>
    <div class="sidebar-brand-text mx-3" style="color:yellow">NCST <sup style="color:midnightblue">ADMIN</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="Admin-home.php">
    <i class="fas fa-fw fa-home"></i>
    <span>Dashboard</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="Admin-charts.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Charts</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Manage</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Manage:</h6>
      
        <a class="collapse-item" href="Admin-pendingEmployees.php"><i class="fas fa-user-clock"></i> Pending Users</a>
        <a class="collapse-item" href="Admin-employees.php"><i class="fas fa-fw fa-users"></i> Employees</a>
        <a class="collapse-item" href="Admin-users.php"><i class="fas fa-user-lock"></i> Users</a>
        <a class="collapse-item" href="Admin-department.php"><i class="fa fa-list"></i> Departments</a>
        <a class="collapse-item" href="Admin-position.php"><i class="fas fa-briefcase"></i> Positions</a>
    </div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<!-- <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Settings</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Settings:</h6> -->
<!--      <a class="collapse-item" href=""><i class="fas fa-fw fa-file-export"></i> Leave Type</a>-->
            <!-- <a class="collapse-item" href=""><i class="fas fa-fw fa-user"></i> My Account</a>
    </div>
  </div>
</li> -->

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  SERVICES
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-clock"></i>
    <span> Pending Forms</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Forms:</h6>
      <?php require("sidebar-pendingForms.php"); ?>
     <div class="collapse-divider"></div>
    </div>
  </div>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="Admin-tables.php">
          <i class="fas fa-fw fa-table"></i>
    <span>Form Reports</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- END SIDE BAR ============================================================================================== -->
<?php require('./Admin-navbar.php'); ?>


         <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Good Morning, </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $realName; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coffee fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) PENDING USER Card Example -->
<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'm';

    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    foreach($conn->query('SELECT COUNT(*) FROM `pending-user`') as $row) { ?>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "<b>" . $row['COUNT(*)'] . "</b>";?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    <?php     } ?>
       
            <!-- Earnings (Monthly) TOTAL EMPLOYEES Card Example -->

<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'm';

    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    foreach($conn->query('SELECT COUNT(*) FROM `user`') as $users) { ?>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Employees</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "<b>" . $users['COUNT(*)'] . "</b>";?></div>
                        </div>
                        <!-- <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

     <?php     } ?>

            <!-- DATE Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Today is,</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo date("l") . "<br>"; ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-2x fa-clock text-gray-300"></i> -->
                      <i class="fas fa-2x fa-calendar-alt text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
<!-- ======================================================================================================= -->

<div class="container">
<h6 class="h5 mb-0 text-gray-800">Pending Form Applications: </h6>
  <div class="row mt-2">
        
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `cash_advances` WHERE `status` = 'pending'") as $count1) { 
  $value1 = $count1['COUNT(*)'];
  if($value1>0){
  }else {
    $value1 = "No ";
  }
  ?>
        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-primary text-center">
              <div class="card-block">
                   <img class="card-img-top" src="img/1.jpg" alt="Cash Advance" class="responsive">
                <h4 class="card-title mt-2">Cash Advance</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value1 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="Admin-1.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>


<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `leaves` WHERE `status` = 'campus'") as $count2) { 
  $value2 = $count2['COUNT(*)'];
  if($value2>0){
  }else {
    $value2 = "No ";
  }
?>
        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/2.jpg" alt="Leave" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Leave</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value2 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="Admin-2.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>


<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `official_businesses` WHERE `status` = 'recommended'") as $count3) { 
  $value3 = $count3['COUNT(*)'];
  if($value3>0){
  }else {
    $value3 = "No ";
  }
?>
        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-info text-center">
              <img class="card-img-top" src="img/3.jpg" alt="Official Business" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Official Business</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value3 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="Admin-4.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

    </div>

     <div class="row mt-2">


<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `overtimes` WHERE `status` = 'recommended'") as $count4) { 
  $value4 = $count4['COUNT(*)'];
  if($value4>0){
  }else {
    $value4 = "No ";
  }
?>
        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-primary text-center">
              <img class="card-img-top" src="img/4.jpg" alt="Overtime" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Overtime</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value4 . "</b>"; ?> Pending Request</span></p>
                <div class="card-footer"><a href="Admin-5.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>


<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
foreach($conn->query("SELECT COUNT(*) FROM `undertimes` WHERE `status` IN ('recommended','endorsed');") as $count5) { 
  $value5 = $count5['COUNT(*)'];
  if($value5>0){
  }else {
    $value5 = "No ";
  }
?>
        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/5.jpg" alt="Undertime" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Undertime</h4>
                <p class="card-text"><span class="badge badge-primary"><?php echo "<b>" . $value4 . "</b>"; ?> Pending Request</span></p>
                 <div class="card-footer"><a href="Admin-3.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>
<?php } ?>

<!-- SUBSTITUTION FORM ========= HIDE MUNA KASI DI SYA KASAMA SA ADMIN-->
        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-info text-center">
              <img class="card-img-top" src="img/6.jpg" alt="Substitution" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Substitution</h4>
                <p class="card-text"><small>NCST Form (View Only)</small></p>
                 <div class="card-footer"><a href="Admin-tables-substitution.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>

    </div>
</div>


<!-- ======================================================================================================= -->            
      <!-- End of Main Content -->

<?php require('./Admin-footer.php'); ?>

</body>

</html>
