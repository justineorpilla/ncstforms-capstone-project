<?php //FILTER: REJECTED
require('./conn.php');
session_start();

//  if(!$_SESSION['user_name']) {
// kung WALANG SESSION mapupunta sa index.php, pag ang SESSION type ay hindi HR balik din sa index
// Else Pag merong session kunin yung name as $realName
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
   $queryCashAdvance = "SELECT * FROM `cash_advances` WHERE `status` = 'rejected';";
   $sqlCashAdvance = mysqli_query($connection, $queryCashAdvance);
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
    
  <title>Cash Advance</title>

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

  <?php require('./Admin-sidebar-form-reports.php'); ?>

  <?php require('./Admin-navbar.php'); ?>

  <style>
td {
  color: black;
}
p.ex0 { font-family: "Arial"; font-size: 11pt;}
p.ex1 {
  margin-top: -20px;
}
p.ex2 {
  font-family: "Arial"; font-size: 11pt;
  margin-top: -20px;
}
</style>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Cash Advance</h6>
            </div>
            <div class="card-body">

<div style="margin-bottom: 20px;">
  Filter:
  <button type="button" class="btn btn-primary btn-sm" onclick="location.href='Admin-tables-CashAdvance.php';">Show All</button>
  <button type="button" class="btn btn-secondary btn-sm" onclick="location.href='Admin-tables-CashAdvance2.php';">Pending</button>
  <button type="button" class="btn btn-success btn-sm" onclick="location.href='Admin-tables-CashAdvance3.php';">Approve</button>
  <button type="button" class="btn btn-danger btn-sm" onclick="location.href='Admin-tables-CashAdvance4.php';">Rejected</button>
  <button type="button" class="btn btn-warning btn-sm" onclick="location.href='Admin-tables-CashAdvance5.php';">This Month</button>

  <!-- <button type="button" class="btn btn-primary" style="float:right;">Generate Report</button> -->
  <form action="pdf-ca-reject.php" method="post">
    <input type="submit" name="export" value="Generate Report" class="btn btn-primary" style="float:right; margin-top: -30px;"> 
  </form>


  <hr>
</div>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="thead-dark">

                    <tr>
                      <th>Form No.</th>
                      <th>Cash Advance Info</th>
                      <th>Status</th>
                      <th>Action By</th>
                      <th>Remarks</th>
                      <th>Print</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Form No.</th>
                      <th>Cash Advance Info</th>
                      <th>Status</th>
                      <th>Action By</th>
                      <th>Remarks</th>
                      <th>Print</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php  while($row = mysqli_fetch_array($sqlCashAdvance)) {           

  if(preg_match('/accepted/',$row['status'])) {
      $status = "<button class='btn btn-success btn-sm' >". "<i class='fa fa-check pr-2'></i> Accepted</button>";
  }else if(preg_match('/rejected/',$row['status'])){
      $status = "<button class='btn btn-danger btn-sm' >". "<i class='fa fa-times pr-2'></i> Rejected</button>";
  }else{
      $status = "<button class='btn btn-secondary btn-sm' >". "<i class='fa fa-clock pr-2'></i> Pending</button>";
  }

  ?>     
    <tr>
      <td style="color:red">CARF No.<?php echo $row['id']; ?></td>
      <td>
        Employee: <b><?php echo $row['requested_by'] ?></b>
        <p class="ex0">Amount: ₱<b><?php echo $row['amount']; ?></b></p>
        <p class="ex1"><small>Date Needed: 
        <b><?php echo empty(date($row['applied_at'])) ? "N/A" : date("M d, Y",strtotime($row['applied_at'])); ?></b></small></p>
        <p class="ex1"><small>Date Applied: 
        <b><?php echo empty(date($row['requested_at'])) ? "N/A" : date("M d, Y | h:i:s A",strtotime($row['requested_at'])); ?></b></small></p>
      </td>
      <td><center><?php echo $status; ?></center></td>
      
      <!-- ACTION BY TD-->
      <?php if(preg_match('/accepted/',$row['status'])) { ?>
    <td>
        <b><?php echo is_null($row['approved_by']) ? "N/A" : $row['approved_by']; ?></b>
        <p class="ex0">Amount Approved: <b><?php echo empty($row['approved_amount']) ? "N/A" : '₱'.$row['approved_amount']; ?></b></p>   
        <p class="ex1"><small>Receiving Date: <b><?php echo empty($row['receiving_date']) ? "N/A" : date("M d, Y",strtotime($row['receiving_date'])); ?></b></small></p>
        <p class="ex1"><small>Approved By: <b><?php echo empty(date($row['approved_at'])) ? "N/A" : date("M d, Y | h:i:s A",strtotime($row['approved_at'])); ?></b></small></p>
     </td>
<?php }else if(preg_match('/rejected/',$row['status'])){ ?>
    <td>
        <b><?php echo is_null($row['approved_by']) ? "N/A" : $row['approved_by']; ?></b>
        <p class="ex0"><small>Action Date: <b><?php echo empty(date($row['approved_at'])) ? "N/A" : date("M d, Y | h:i:s A",strtotime($row['approved_at'])); ?></b></small></p>
     </td>
<?php }else{ ?>
     <td>Pending</td>
<?php } ?>
      <!-- END ACTION BY TD-->

       <td><?php echo ucwords($row['remarks']); ?></td> 
       <td>
       <form action="pdf-cashadvance.php" method="post">
       <input type="hidden" name="pdf_id" value=<?php echo $row['id']?>>
       <input type="submit" name="pdf" value="Print" class="btn btn-primary btn-sm"> 
       </form>
       </td> 
    </tr>
                      <?php   } ?>
                  </tbody>
                </table>
                <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Form Reports</h1> -->
          <p class="mb-4">In this tab of Cash Advances, search and filter the results here. If there are any pending status in Cash Advances, please go visit Pending forms <a href="Admin-1.php">Cash Advance</a>. </p>

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

</body>

</html>
