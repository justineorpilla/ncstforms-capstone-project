<?php //UNDERTIME
require('./functions.php');
require('./conn.php');
session_start();

if (empty($_SESSION['id']) && empty($_SESSION['user_name'])) {
  echo "<script>window.open('index.php', '_self')</script>";
}elseif($_SESSION['type']!='hr'){
  echo "<script>window.open('index.php', '_self')</script>";
}else{
  $realName = $_SESSION['name'];
  $realSignature = $_SESSION['signature'];
}
    
?>


<?php //APPROVE BUTTON 
if (isset($_POST['approve'])) 
{
    $approve_id = $_POST['accept_id'];
  
    $approve="UPDATE `undertimes` SET `status` = 'accepted', `approved_at` = CURRENT_TIMESTAMP, `approved_by` = '$realName', `adm_signature` = '$realSignature' WHERE `id` = '$approve_id';";
    $approveQuery=mysqli_query($connection,$approve);
       
    if($approveQuery){
      $_SESSION['status'] = "Undertime has been Approved!";
      $_SESSION['status_code'] = "success";
      header('Location: Admin-3.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Error Occured";
      $_SESSION['status_code'] = "error";
      header('Location: Admin-3.php');
    }   
}
?>


<?php //REJECT BUTTON 
if (isset($_POST['reject'])) 
{
    $delete_id = $_POST['delete_id'];
    $remarks = $_POST['remarks'];

    $reject="UPDATE `undertimes` SET `status` = 'rejected', `approved_at` = CURRENT_TIMESTAMP, `approved_by` = '$realName', `reject_signature` = '$realSignature', `remarks` = '$remarks' WHERE `id` = '$delete_id';";
    $rejectQuery=mysqli_query($connection,$reject);
       
    if($rejectQuery){
      $_SESSION['status'] = "Undertime has been Rejected!";
      $_SESSION['status_code'] = "success";
      header('Location: Admin-3.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Error Occured";
      $_SESSION['status_code'] = "error";
      header('Location: Admin-3.php');
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
<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-clock"></i>
    <span> Pending Forms</span>
  </a>
  <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Forms:</h6>
<!-- ======================================================================================================================================-->
<!-- 1. CASH ADVANCE SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `cash_advances` WHERE `status` = 'pending'") as $count1) { 
              $value1 = $count1['COUNT(*)'];
              if($value1>0){
              $value1 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value1.'</span>';
              }else {
              $value1 = "";
              }
              ?>
<a class="collapse-item" href="Admin-1.php"><i class="fas fa-fw fa-wallet"></i>  Cash Advance <?php echo $value1; ?></a> 
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->
 

<!-- ======================================================================================================================================-->
<!-- 2. LEAVE SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `leaves` WHERE `status` = 'campus'") as $count2) { 
              $value2 = $count2['COUNT(*)'];
              if($value2>0){
              $value2 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value2.'</span>';
              }else {
              $value2 = "";
              }
              ?>
<a class="collapse-item" href="Admin-2.php"><i class="fas fa-fw fa-file-alt"></i> Leave <?php echo $value2; ?></a>
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->


<!-- ======================================================================================================================================-->
<!-- 4. OFFICIAL BUSINESS SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `official_businesses` WHERE `status` = 'recommended'") as $count3) { 
              $value3 = $count3['COUNT(*)'];
              if($value3>0){
              $value3 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value3.'</span>';
              }else {
              $value3 = "";
              }
              ?>
<a class="collapse-item" href="Admin-4.php"><i class="fas fa-fw fa-building"></i>  Official Business <?php echo $value3; ?></a>
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->



<!-- ======================================================================================================================================-->
<!-- 5. OVERTIME SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `overtimes` WHERE `status` = 'recommended'") as $count4) { 
              $value4 = $count4['COUNT(*)'];
              if($value4>0){
              $value4 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value4.'</span>';
              }else {
              $value4 = "";
              }
              ?>
<a class="collapse-item" href="Admin-5.php"><i class="fas fa-fw fa-user-clock"></i>  Overtime <?php echo $value4; ?></a>
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->



<!-- ======================================================================================================================================-->
<!-- 3. UNDERTIME SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `undertimes` WHERE `status` IN ('recommended','endorsed');") as $count5) { 
              $value5 = $count5['COUNT(*)'];
              if($value5>0){
              $value5 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value5.'</span>';
              }else {
              $value5 = "";
              }
              ?>
<a class="collapse-item  active" href="Admin-3.php"><i class="fas fa-fw fa-hourglass-half"></i>  Undertime <?php echo $value5; ?></a>
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->


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

<!--=====================================================================================================================-->
<!-- END SIDE BAR -->
<!--=====================================================================================================================-->         

<?php require('./Admin-navbar.php'); ?>

<!--=====================================================================================================================-->
<!-- Begin Page Content =================================================================================================-->
<!--=====================================================================================================================-->
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="buang-list" role="tablist">


          <li class="nav-item">  
          <a class="nav-link active" style="font-size: 14pt;" href="#cashadvance" role="tab" aria-controls="cashadvance" aria-selected="true">
          Undertime </a>
          </li>


          <!-- <li class="nav-item">
          <a class="nav-link"  href="#leave" role="tab" aria-controls="leave" aria-selected="false">Leave </a>      
          </li>


            <li class="nav-item">
              <a class="nav-link" href="#deals" role="tab" aria-controls="deals" aria-selected="false">Deals</a>
            </li> -->
          </ul>
        </div>

<!--=====================================================================================================================-->
<!-- TAB BODY -->
<!--=====================================================================================================================-->         

        <div class="card-body">
          <!-- <h5 class="card-title">Pending Application Form</h5> -->
          <h6 class="card-subtitle mb-2" style="font-size: 14px;">
          Form Process: 1. Pending | 2. Endorsed by: Dept.Head/School Nurse(if SL) | 3. Final Approval: Administrator</h6>

<!--=====================================================================================================================-->             
<!-- CASH ADVANCE TAB BODY ================================================================================================-->
<!--=====================================================================================================================-->

           <div class="tab-content mt-3">
            <div class="tab-pane active" id="leave" role="tabpanel">
              <!-- Start -->
<?php
$query = "SELECT * FROM `undertimes` WHERE `status` IN ('recommended','endorsed');";
$sql = mysqli_query($connection, $query);
?>
<style>
.table { color: black; }
p.ex0 { font-family: "Arial"; font-size: 11pt;}
p.ex1 { margin-top: -20px;}

</style>

              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" >
                  <thead class="thead-dark">
                    <tr>
                      <!-- <th style="width:5%">No.</th> -->
                      <th>Form No.</th>
                      <th>Undertime Request Information</th>
                      <th>Status</th>
                      <th>Reason</th>
                      <th>Endorsed By</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Form No.</th>
                      <th>Undertime Request Information</th>
                      <th>Status</th>
                      <th>Reason</th>
                      <th>Endorsed By</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   
  <?php 
      while($row = mysqli_fetch_array($sql)) {  

  ?>

<tr>
      <td style="color:red">US No.<?php echo $row['id']; ?></td> <!-- TD#1 -->
      <td>
          Employee: <b><?php echo ucwords($row['requested_by']);?> <?php echo "(".$row['employee_id'].")";?></b>
          <p class="">Department: <b><?php echo $row['department']; ?></b></p>
          <p class="ex1">Time in: <b><?php echo empty(date($row['time_in'])) ? "N/A" : date("h:i:sa",strtotime($row['time_in'])); ?></b></p>
          <p class="ex1">Time out: <b><?php echo empty(date($row['time_out'])) ? "N/A" : date("h:i:sa",strtotime($row['time_out'])); ?></b></p>
          <p class="ex1">Undertime Date: <b><?php echo empty(date($row['date'])) ? "N/A" : date("M d, Y",strtotime($row['date'])); ?></b></p>
          <p class="ex1">Date Filed: <b><?php echo empty(date($row['requested_at'])) ? "N/A" : date("M d, Y",strtotime($row['requested_at'])); ?></b></p>
          <p class="ex1">Sick: <b><?php echo ucwords($row['sick']); ?></b></p>
        </td>
      <td><center><span class="badge badge-secondary">Pending</span></center></td>
      <td><center><?php echo ucwords($row['reason']); ?></center></td>
      <td><b><?php echo $row['recommended_by']; ?></b><br> 
      <small><?php echo $row['endorser_position']; ?></small></td>
      <td><center>
          <button type="button" class="btn btn-success btn-md mb-2" data-toggle="modal" data-target="#approve<?php echo $row['id']; ?>">
          Approve</button>
<!-- START ACCEPT BTN MODAL ================================================================================================-->
<!-- =======================================================================================================================-->
  <div class="modal" id="approve<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="Admin-3.php" method="post">
        <div class="container-fluid">
        <input type="hidden" name="accept_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
      
          <h6>Are you sure you want to approve this Undertime?</h6>
            </div>
        </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" id="approve" name="approve" value="Approve">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ENDING ACCEPT BTN MODAL ============================================================================================================-->
<!-- =======================================================================================================================-->
<!-- DELETE REJECT TRIGGER -->
<button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#delete<?php echo $row['id']; ?>">
Reject</button>
<!-- START REJECT BTN MODAL  ====================================================================================================-->
<div class="modal" id="delete<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="Admin-3.php" method="post">
        <div class="container-fluid">
        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
            <h6 style="float: left;">Are you sure you want to reject this Undertime?</h6>
            <input class="form-control" type="text" name="remarks" placeholder="Why? please add a remark">
            </div>
        </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" id="reject" name="reject" value="Reject">
        </form>
      </div>
    </div>
  </div>
</div>
          <!-- ENDING DELETE BTN MODAL ================================================================================================== -->
      </center>
      </td>
     
    </tr>
  <?php   } ?>
                  </tbody>
                </table>
              
                
              <!-- End -->
            </div> <!-- end tab pane div -->
              </div>
<!--=====================================================================================================================-->             
<!-- ENDING CASH ADVANCE TAB BODY ================================================================================================-->
<!--=====================================================================================================================-->


            <div class="tab-pane" id="leave" role="tabpanel" aria-labelledby="leave-tab">  
              <p class="card-text">First settled around 1000 BCE and then founded as the Etruscan Felsina about 500 BCE, it was occupied by the Boii in the 4th century BCE and became a Roman colony and municipium with the name of Bononia in 196 BCE. </p>
              <a href="#" class="card-link text-danger">Read more</a>
            </div>
             
            <div class="tab-pane" id="deals" role="tabpanel" aria-labelledby="deals-tab">
              <p class="card-text">Immerse yourself in the colours, aromas and traditions of Emilia-Romagna with a holiday in Bologna, and discover the city's rich artistic heritage.</p>
              <a href="#" class="btn btn-danger btn-sm">Get Deals</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>    

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
