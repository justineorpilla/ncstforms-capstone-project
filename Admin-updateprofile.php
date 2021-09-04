<?php 
require('./conn.php');
session_start();

if (empty($_SESSION['id']) && empty($_SESSION['user_name'])) {
  echo "<script>window.open('index.php', '_self')</script>";
}elseif($_SESSION['type']!='hr'){
  echo "<script>window.open('index.php', '_self')</script>";
}else{
  $realName = $_SESSION['name'];
  $id = $_SESSION['id'];
  $userName= $_SESSION['user_name'];
  $Pass= $_SESSION['password'];
}
    
?>

<?php

if (isset($_POST['update'])) 
{
     $existingUsername= $_SESSION['user_name'];
     $signature = $_FILES["signature"]['name'];
     $newName=$_POST['newName'];
     $newPassword=$_POST['newPass'];
     $newAddress = $_POST['newAddress'];
     $newContact = $_POST['newContact'];
    
     $sql="UPDATE user SET `name`='$newName', `user_name`='$existingUsername', `password`='$newPassword', `address`='$newAddress', `contact`='$newContact', `signature`='$signature' WHERE `user_name`='$userName'";
     $query=mysqli_query($connection,$sql);
     
     if($query){
      move_uploaded_file($_FILES["signature"]["tmp_name"], "img/signatura/".$_FILES["signature"]["name"]);
      $_SESSION['status'] = "Successfully Updated!";
      $_SESSION['status_code'] = "success";
      header('Location: Admin-updateprofile.php');
      exit(0);
     }else{
      $_SESSION['status'] = "Error Occured";
      $_SESSION['status_code'] = "error";
      header('Location: Admin-updateprofile.php');
     }
      
         
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


<?php require('./Admin-navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Profile</h1>
         </div>
 <?php  
 $sqlUser="SELECT * FROM `user` WHERE `user_name`='$userName'";
 $queryUser=mysqli_query($connection,$sqlUser);
 while($row = mysqli_fetch_array($queryUser)) { ?>

 <form class="login-container" action="/k/updateprofile.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4 col-form-label">
          <label for="">Employee Name</label>
          <input type="text" class="form-control" name="newName" value="<?php echo ucwords($realName);?>">
        </div>
        <div class="col-md-4 col-form-label">
          <label for="">Employee ID</label>
          <input type="text" class="form-control" name="" value="<?php echo $row['employee_id'];?>" disabled>
        </div>
        <div class="col-md-4 col-form-label">
          <label for="">Department</label>
          <input type="text" class="form-control" name="" value="<?php echo $row['department'];?>" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-form-label">
          <label for="">Position</label>
          <input type="text" class="form-control" name="" value="<?php echo $row['position'];?>" disabled>
        </div>
        <div class="col-md-4 col-form-label">
          <label for="">Address</label>
          <input type="text" class="form-control" name="newAddress" value="<?php echo ucwords($row['address']);?>">
        </div>
        <div class="col-md-4 col-form-label">
          <label for="">Contact No.</label>
          <input type="text" class="form-control" name="newContact" value="<?php echo $row['contact'];?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-form-label">
          <label for="InputName">Username</label>
          <input type="text" class="form-control" name="existingUsername" placeholder="Your UserName" value="<?php echo $userName;?>" disabled>
        </div>
        <div class="col-md-4 col-form-label">
          <label for="InputName">Password</label>
          <input type="password" class="form-control" name="newPass" value="<?php echo $row['password'];?>">
          <small><i>Leave this field if you don't want to change password</i></small>
        </div>
    </div>
    <hr>
    <!-- <div class="col-md-4 col-form-label">
      <input type="password" class="form-control" placeholder="New Password" name="newPassword">
    </div> -->
    <p>Signature (Image file): </p>
    <div class="row">
        <div class="col-md-4 col-form-label custom-file mb-3">
          <input type="file" class="custom-file-input" id="customFile" name="signature" value="<?php echo $row['signature'];?>">
          <label class="custom-file-label" for="customFile">Upload Signature</label>
        </div>
        <div class="col-md-4 col-form-label">
          <?php if(empty($row['signature'])){ ?>
            <p>No Signature Uploaded</p>
          <?php } else { ?>
            <img src="img/signatura/<?php echo $row['signature']?>" height=100px width=100px />
        </div>
          <?php } ?>
    </div>

    <div>
      <input type="submit" name="update" class="btn btn-primary" value="Update">
    </div>
</form>
 <?php } ?>                     
          
            
             
      <!-- End of Main Content -->

<?php require('./Footer.php'); ?>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var signature = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(signature);
});
</script>


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
