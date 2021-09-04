<?php 
require('./conn.php');
session_start();

if (empty($_SESSION['id']) && empty($_SESSION['user_name'])) {
  echo "<script>window.open('index.php', '_self')</script>";
}elseif($_SESSION['type']!='hr'){
  echo "<script>window.open('index.php', '_self')</script>";
}else{
  $realName = $_SESSION['name'];
}
    
?>

<?php 
$name = $_SESSION['name'];
$query = "SELECT * FROM `user`;";
$sql = mysqli_query($connection, $query);
?>

<?php //ADD BUTTON
    if(isset($_POST['save'])){ 
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $name = $fname." ".$lname;
        $empId = $_POST['eid'];
        $user_name = $empId;
        $pass = $lname;
        $type = $_POST['roll'];
        $dept = $_POST['dept'];
        $pos = $_POST['pos'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $message = "This account was created by the Administrator.";

        $add = "INSERT INTO `user` (`firstname`,`lastname`,`name`,`user_name`,`password`,`role`,`department`,`position`,`email`,`employee_id`,`address`,`contact`,`created_msg`) 
        VALUES ('$fname','$lname','$name','$user_name','$pass','$type','$dept','$pos','$email','$empId','$address','$contact','$message')";
        $addQuery=mysqli_query($connection, $add);
        if($addQuery) {
            $_SESSION['status'] = "Account Successfully Created!";
            $_SESSION['status_code'] = "success";
            header('Location: Admin-employees.php');
            exit(0);
        }else{
            $_SESSION['status'] = "Account Not Successfully Created!";
            $_SESSION['status_code'] = "error";
            header('Location: Admin-employees.php');
        }
    }
?>

<?php //UPDATE BUTTON 
if (isset($_POST['edit'])) 
{

$e_id = $_POST['e_id']; //hidden user id
$edit_id = $_POST['edit_id']; //employee id
$edit_firstname = $_POST['edit_firstname'];
$edit_lastname = $_POST['edit_lastname'];
$edit_email = $_POST['edit_email'];
$edit_address = $_POST['edit_address'];
$edit_contact = $_POST['edit_contact'];
$edit_dept = $_POST['edit_dept'];
$edit_pos = $_POST['edit_pos'];
 
     
    $update="UPDATE `user` SET `employee_id`='$edit_id',`firstname`='$edit_firstname',`lastname`='$edit_lastname',`email`='$edit_email',`address`='$edit_address',`contact`='$edit_contact',`department`='$edit_dept',`position`='$edit_pos' WHERE `id`='$e_id';";
    $updateQuery=mysqli_query($connection,$update);
       
    if($updateQuery){
      $_SESSION['status'] = "Account Updated";
      $_SESSION['status_code'] = "success";
      header('Location: Admin-employees.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Account Not Updated";
      $_SESSION['status_code'] = "error";
      header('Location: Admin-employees.php');
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
      header('Location: Admin-employees.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Account Not Deleted";
      $_SESSION['status_code'] = "error";
      header('Location: Admin-employees.php');
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
        <a class="collapse-item active" href="Admin-employees.php"><i class="fas fa-fw fa-users"></i> Employees</a>
        <a class="collapse-item" href="Admin-users.php"><i class="fas fa-user-lock"></i> Users</a>
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
              <h6 class="h4 m-0 font-weight-bold text-primary">List of Employees
<!-- ADD EMPLOYEE BUTTON -->          
<span class="float:right"><button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#employeeModal">
<i class="fa fa-plus"></i> Add Employee
</button></span>
<!-- START ADD BTN MODAL ===============================================================================================================-->
<!--=====================================================================================================================================-->

<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
    <form action="Admin-employees.php" method="post">
        <div class="container-fluid">
        <div class="form-group">
        <h6>Employee ID</h6>
       <input class="form-control col-md-6" type="text" name="eid" placeholder="" required/><br>
        
       <div class="form-row">
    <div class="col">
    <h6>Firstname</h6>
      <input type="text" class="form-control" name="firstname" placeholder="" required/>
    </div>
    <div class="col">
    <h6>Lastname</h6>
      <input type="text" class="form-control" name="lastname" placeholder="" required/>
    </div>
  </div>

  <hr>
       
        <h6>Email Address</h6>
       <input class="form-control" type="email" name="email" required=""><br>

       <div class="form-row">
    <div class="col">
    <h6>Home Address</h6>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="2" required></textarea>
    </div>
    <div class="col">
    <h6>Contact No.</h6>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="contact" rows="2" required></textarea>
    </div>
  </div>
       
  <hr>

  <div class="form-row">
    <div class="col">
    <h6>Department</h6> 
               <?php 
               $host = 'localhost';
               $user = 'root';
               $password = '';
               $database = 'm';

               $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
               $sqlDepartment = "SELECT * FROM `ncst-departments`";
               try {
                  $stmt=$conn->prepare($sqlDepartment);
                  $stmt->execute();
                  $results=$stmt->fetchAll();
               }
               catch(Exception $ex){
                  echo ($ex-> getMessage() );
               }

            ?>
            <!-- END SELECT OPTION ON PHP MY SQL -->
            <select class="form-control" name="dept" required> 
               <option hidden="true" value="" disabled selected>Please Select Here</option>
               <?php foreach ($results as $output) { ?>
               <option> <?php echo $output["department"] ?> </option>
               <?php } ?>
            </select>

    </div>

    <div class="col">
    <h6>Position</h6> 
    <?php 
               
               $sqlPosition = "SELECT `position` FROM `ncst-positions`";
               try {
                  $stmt=$conn->prepare($sqlPosition);
                  $stmt->execute();
                  $results=$stmt->fetchAll();
               }
               catch(Exception $ex){
                  echo ($ex-> getMessage() );
               }

            ?>
          <select class="form-control" name="pos" required> 
               <option hidden="true" value="" disabled selected>Please Select Here</option>
               <?php foreach ($results as $output) { ?>
               <option> <?php echo $output["position"] ?> </option>
               <?php } ?>
            </select>
      
    </div>
  </div>

      
     <hr>   
        <h6>User Type</h6>
       <select class="form-control" name="roll"><option value="employee" selected>Employee</option>
        <option value="hr">Admin</option>
        <<br>
        </select>
        </div>  
        </div>
          
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save" name="save"/> 
      </div>
        
    </form>
        
    </div>
  </div>
</div>
    
<!-- ENDING ADD BTN MODAL ===============================================================================================================-->
<!--=====================================================================================================================================-->
<!-- ENDING ADD BTN MODAL =============================================================================================================-->
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
                      <th>Employee ID</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Position</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Employee ID</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Position</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   
  <?php 
      while($row = mysqli_fetch_array($sql)) {  
  ?>

    <tr>
      <td><b><?php echo $row['employee_id']; ?></b></td>
      <td><b><?php echo ucwords($row['lastname']); echo ", "; echo ucwords($row['firstname']); ?></b></td>
      <td><b><?php echo ucwords($row['department']); ?></b></td>
      <td><b><?php echo ucwords($row['position']); ?></b></td>
      <td>
         <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#view<?php echo $row['id']; ?>">
          View</button>
          <?php include("Admin-modal-Employee-View.php");?>
          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $row['id']; ?>">
          Edit</button>
<!-- START EDIT BTN MODAL =============================================================================================-->
<!-- ==================================================================================================================-->
<?php // EDIT BUTTON MODAL
    $emp = $row['employee_id'];
    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $name = $fname." ".$lname;
    $email = $row['email'];
    $home = $row['address'];
    $num = $row['contact'];
    $dept = $row['department'];
    $pos = $row['position'];
    $msg = $row['created_msg'];
    
?>
<div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
    <form action="Admin-employees.php" method="post">
        <div class="container-fluid">
        <div class="form-group">
        <input type="hidden" name="e_id" value="<?php echo $row['id']; ?>">
        <h6>Employee ID</h6>
       <input class="form-control col-md-6" type="text" name="edit_id"  value="<?php echo $emp; ?>" required><br>
        
       <div class="form-row">
    <div class="col">
    <h6>Firstname</h6>
      <input type="text" class="form-control" name="edit_firstname" value="<?php echo $fname; ?>" required>
    </div>
    <div class="col">
    <h6>Lastname</h6>
      <input type="text" class="form-control" name="edit_lastname" value="<?php echo $lname; ?>" required>
    </div>
  </div>

  <hr>
       
        <h6>Email Address</h6>
       <input class="form-control" type="email" name="edit_email" value="<?php echo $email; ?>" required><br>

       <div class="form-row">
    <div class="col">
    <h6>Home Address</h6>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="edit_address" rows="2" required=""><?php echo $home; ?></textarea>
    </div>
    <div class="col">
    <h6>Contact No.</h6>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="edit_contact" maxlength="11" rows="2" required=""><?php echo $num; ?></textarea>
    </div>
  </div>
       
  <hr>

  <div class="form-row">
    <div class="col">
    <h6>Department</h6>
             
                   
                   <?php 
                   $host = 'localhost';
                   $user = 'root';
                   $password = '';
                   $database = 'm';
    
                   $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
                   $sqlDepartment = "SELECT * FROM `ncst-departments`;";
                   try {
                      $stmt=$conn->prepare($sqlDepartment);
                      $stmt->execute();
                      $results=$stmt->fetchAll();
                   }
                   catch(Exception $ex){
                      echo ($ex-> getMessage() );
                   }
    
                ?>

                <!-- END SELECT OPTION ON PHP MY SQL -->
                <select class="form-control" name="edit_dept"> 
                   <option hidden="true" value="" disabled><?php echo $dept;?></option>
                   <?php foreach ($results as $output) { ?>
                   <option> <?php echo $output["department"] ?> </option>
                   <?php } ?>
                </select>
           
    </div>

    <div class="col">
    <h6>Position</h6> 
    <?php 
               
               $sqlPosition = "SELECT `position` FROM `ncst-positions`";
               try {
                  $stmt=$conn->prepare($sqlPosition);
                  $stmt->execute();
                  $results=$stmt->fetchAll();
               }
               catch(Exception $ex){
                  echo ($ex-> getMessage() );
               }

            ?>
          <select class="form-control" name="edit_pos"> 
               <option hidden="true" value="" disabled><?php echo $pos;?></option>
               <?php foreach ($results as $output) { ?>
               <option> <?php echo $output["position"] ?> </option>
               <?php } ?>
            </select>
      
    </div>
  </div>

      
        </div>  
        </div>
          
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save" name="edit"/> 
      </div>
        
    </form>    
    </div>
  </div>
</div>
<!-- ENDING EDIT BTN MODAL ============================================================================================ -->
<!-- ==================================================================================================================-->

          <!-- DELETE BUTTON -->
          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['id']; ?>">
          <i class="fas fa-trash-alt"></i></button>

          <!-- STARTING DELETE BTN MODAL ============================================================================================ -->
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
      <form action="Admin-employees.php" method="post">
        <div class="container-fluid">
        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
            <h5>Are you sure you want to delete this Account?</h5>
            <small style="color: red;"><i>(Note: This will also remove the account from the Users Tab)</i></small>
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
          <!-- ENDING DELETE BTN MODAL ============================================================================================ -->
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
