<?php // PENDING-5.PHP FOR PENDING UNDERTIME TO ENDORSED (USER LEVEL: NURSE)
require('./functions.php');
require('./conn.php');
session_start();

if (empty($_SESSION['id']) && empty($_SESSION['user_name'])) {
  echo "<script>window.open('index.php', '_self')</script>";
}elseif($_SESSION['position']!='School Nurse'){
  echo "<script>window.open('index.php', '_self')</script>";
}else{
  $realName = $_SESSION['name'];
  $realPositon = $_SESSION['position'];
  $realSignature = $_SESSION['signature'];
}
    
?>


<?php //APPROVE BUTTON 
if (isset($_POST['approve'])) 
{
    $approve_id = $_POST['accept_id'];
    $approve="UPDATE `undertimes` SET `status` = 'endorsed', `recommended_at` = CURRENT_TIMESTAMP, `recommended_by` = '$realName', `endorser_position` = '$realPositon', `reco_signature` = '$realSignature' WHERE `id` = '$approve_id';";
    $approveQuery=mysqli_query($connection,$approve);
       
    if($approveQuery){
      $_SESSION['status'] = "Undertime has been Endorsed!";
      $_SESSION['status_code'] = "success";
      header('Location: pending-5.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Error Occured";
      $_SESSION['status_code'] = "error";
      header('Location: pending-5.php');
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
      header('Location: pending-5.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Error Occured";
      $_SESSION['status_code'] = "error";
      header('Location: pending-5.php');
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
          Process: Endorsed | Final Approved: Administrator</h6>

<!--=====================================================================================================================-->             
<!-- CASH ADVANCE TAB BODY ================================================================================================-->
<!--=====================================================================================================================-->

           <div class="tab-content mt-3">
            <div class="tab-pane active" id="leave" role="tabpanel">
              <!-- Start -->
<?php
$query = "SELECT * FROM `undertimes` WHERE `status` = 'pending' AND `sick` = 'yes';";
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
                      <th>No.</th>
                      <th>Undertime Request Information</th>
                      <th>Status</th>
                      <th>Reason</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Undertime Request Information</th>
                      <th>Status</th>
                      <th>Reason</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   
  <?php 
      while($row = mysqli_fetch_array($sql)) {  

        // if(preg_match('/Yes/',$row['sick'])) {
        //     $pay = '<span class="badge badge-warning">Yes</span>';
        // }else{
        //     $pay = '<span class="badge badge-warning">No</span>';;
        // }
  ?>

    <tr>
      <td><?php echo $row['id']; ?></td> <!-- TD#1 -->
      <td>
          Employee: <b><?php echo ucwords($row['requested_by']);?> <?php echo "(".$row['employee_id'].")";?></b>
          <p class="">Department: <b><?php echo $row['department']; ?></b></p>
          <p class="ex1">Time in: <b><?php echo empty(date($row['time_in'])) ? "N/A" : date("h:i:sa",strtotime($row['time_in'])); ?></b></p>
          <p class="ex1">Time out: <b><?php echo empty(date($row['time_out'])) ? "N/A" : date("h:i:sa",strtotime($row['time_out'])); ?></b></p>
          <p class="ex1">Date Filed: <?php echo empty(date($row['requested_at'])) ? "N/A" : date("M d, Y",strtotime($row['requested_at'])); ?></p>
          <p class="ex1">Sick: <?php echo $row['sick']; ?></p>
        </td>
      <td><center><span class="badge badge-secondary">Pending</span></center></td>
      <td><center><?php echo ucwords($row['reason']); ?></center></td>
      <td><center>
          <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#approve<?php echo $row['id']; ?>">
          Endorsed</button>
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
      <form action="pending-5.php" method="post">
        <div class="container-fluid">
        <input type="hidden" name="accept_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
          <h5>Are you sure want to endorse this Undertime?</h5>
          <small><p style="color:green;">(This form will be sent to the Administrator for final approval)</p></small>
            </div>
        </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" id="approve" name="approve" value="Endorse">
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
      <form action="pending-5.php" method="post">
        <div class="container-fluid">
        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
            <h6 style="float: left;">Are you sure you want to reject this form request?</h6>
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
