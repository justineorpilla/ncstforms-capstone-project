<?php 
require('./conn.php');
session_start();
$realName = $_SESSION['name'];


    $name = $_SESSION['name'];
    $query = "SELECT * FROM `user`;";
    $sql = mysqli_query($connection, $query);
    
//    echo $_SESSION['status'];
if(!$_SESSION['user_name']) {
  echo "<script>window.open('index.php', '_self')</script>";
}elseif($_SESSION['type']!='hr'){
  echo "<script>window.open('index.php', '_self')</script>";
}else{
  // echo $pangalan=$_SESSION['name'];
  // echo "<br> Username: ";
  // echo $pangalan2=$_SESSION['user_name'];
  // echo "<br> Role: ";
  // echo $posisyon=$_SESSION['type'];
}
?>

<?php //UPDATE BUTTON 
if (isset($_POST['update'])) 
{

  $uid = $_POST['user_id'];
  $uname = $_POST['name'];
  $username = $_POST['user_name'];
  $upassword = $_POST['password'];
  $utype = $_POST['select'];
     
    $update="UPDATE `user` SET `user_name`='$username',`password`='$upassword',`role`='$utype',`name`='$uname' WHERE `id`='$uid';";
    $updateQuery=mysqli_query($connection,$update);
       
    if($updateQuery){
      $_SESSION['status'] = "Account Updated";
      $_SESSION['status_code'] = "success";
      header('Location: Admin-users.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Account Not Updated";
      $_SESSION['status_code'] = "error";
      header('Location: Admin-users.php');
    }   
}
?>

<?php //DELETE BUTTON 
if (isset($_POST['delete'])) 
{

     $deleteId=$_POST['delete_id'];
     
    $delete="DELETE FROM `user` WHERE id=$deleteId;";
    $deleteQuery=mysqli_query($connection,$delete);
       
    if($deleteQuery){
      $_SESSION['status'] = "Account has been Deleted!";
      $_SESSION['status_code'] = "success";
      header('Location: Admin-users.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Account Not Deleted";
      $_SESSION['status_code'] = "error";
      header('Location: Admin-users.php');
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
    
  <title>NCST Admin</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <!-- SIDE BAR ====================================================================================================-->
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
<li class="nav-item">
  <a class="nav-link" href="Admin-home.php">
    <i class="fas fa-fw fa-home"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Manage</span>
  </a>
  <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Manage:</h6>

        <a class="collapse-item" href="Admin-pendingEmployees.php"><i class="fas fa-user-clock"></i> Pending Users</a>
        <a class="collapse-item" href="Admin-employees.php"><i class="fas fa-fw fa-users"></i> Employees</a>
        <a class="collapse-item active" href="Admin-users.php"><i class="fas fa-user-lock"></i> Users</a>
        <a class="collapse-item" href="Admin-department.php"><i class="fa fa-list"></i> Departments</a>
        <a class="collapse-item" href="Admin-position.php"><i class="fas fa-briefcase"></i> Positions</a>
    </div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Settings</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Settings:</h6>
<!--      <a class="collapse-item" href=""><i class="fas fa-fw fa-file-export"></i> Leave Type</a>-->
            <a class="collapse-item" href=""><i class="fas fa-fw fa-user"></i> My Account</a>
    </div>
  </div>
</li>

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
<!-- END SIDE BAR ================================================================================================-->
  <!-- NAVBAR -->
  <?php require('./Admin-navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Employees</h1> -->
          <!-- <h5>Admin name: <?php echo $realName;?></h5>
          -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h4 m-0 font-weight-bold text-primary">User Accounts

              </h6>
            </div>

<style>
td {
  color: black;
}
</style>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   
  <?php 
      while($row = mysqli_fetch_array($sql)) {  
  ?>

    <tr>
      <td><b><?php echo ucwords($row['firstname']); echo " "; echo ucwords($row['lastname']); ?></b></td>
      <td><b><?php echo $row['user_name']; ?></b></td>
      <td>
      <center>
      <!-- EDIT BUTTON -->
          <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#edit<?php echo $row['id']; ?>">
          Action</button>
          <!-- START EDIT BTN MODAL================================================================================================== -->
  <div class="modal" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container-fluid">

      <form action="Admin-users.php" method="post">
        
        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
            <label style="float: left;">Name</label>
             <input class="form-control" type="text" name="name"  value="<?php echo $row['name']; ?>" required>
            </div>

            <div class="form-group">
            <label style="float: left;">Username</label>
             <input class="form-control" type="text" name="user_name"  value="<?php echo $row['user_name']; ?>" required>
            </div>

            <div class="form-group">
            <label style="float: left;">Password</label>
             <input class="form-control" type="password" name="password"  value="<?php echo $row['password']; ?>" required>
             <small style="float: left;"><i>Leave this field if you dont want to change the password.</i></small>
             <br>
            </div>

<?php 
if(preg_match('/hr/',$row['role'])) {
  $val = "Admin";
}else{
  $val = "Employee";
}
?>
<hr>
<div class="form-group">
<label style="float: left;"> Usertype</label>
<select class="form-select form-control" aria-label="Default select example" name="select">
<option hidden="true" value="" disabled selected><?php echo $val;?></option>
<option value="hr">Admin</option>
<option value="employee">Employee</option>
</select>
</div>

        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" id="update" name="update" value="Save changes">
        </form>
      </div>
    </div>
  </div>
</div>
          <!-- ENDING EDIT BTN MODAL================================================================================================== -->
         
         <!-- DELETE BUTTON-->
          <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#delete<?php echo $row['id']; ?>">
          <i class="fas fa-trash-alt"></i></button>
          <!-- START DELETE BTN MODAL ================================================================================================-->
<div class="modal" id="delete<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="Admin-users.php" method="post">
        <div class="container-fluid">
        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
            <h5>Are you sure you want to delete this Account?</h5>
            <small style="color: red;"><i>(Note: This will also remove the account from the Employees Tab)</i></small>
            </div>
        </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" id="delete" name="delete" value="Delete">
        </form>
      </div>
    </div>
  </div>
</div>
          <!-- ENDING DELETE BTN MODAL ================================================================================================-->
      </center>
      </td>
     
    </tr>
  <?php   } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>&copy; National College of Science and Technology 2020</span>
              
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
           <form action="/k/logout.php" method="post">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<!--          <a class="btn btn-primary" href="/k/login.php">Logout</a>-->
        
            
                <input class="btn btn-primary" type="submit" value="Logout"/>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  
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
