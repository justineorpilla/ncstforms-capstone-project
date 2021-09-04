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
    $querySubstitution = "SELECT * FROM `ioms` WHERE `status` = 'pending';";
    $sqlSubstitution = mysqli_query($connection, $querySubstitution);
    
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
    
  <title>IOM</title>

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
</style>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Form Reports</h1>
          <p class="mb-4">Go back to NCST <a href="Admin-tables.php">Forms Selector here</a>. In this tab of Substitution's, search and filter the results here. If there are any pending status in Substitution Forms, please go visit Pending forms <a href="Admin-substitution.php">Substitution</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Inter-Office Memorandum</h6>
            </div>
            <div class="card-body">
            <div style="margin-bottom: 20px;">
  Filter:
  <button type="button" class="btn btn-primary btn-sm" onclick="location.href='Admin-tables-iom.php';">Show All</button>
  <button type="button" class="btn btn-secondary btn-sm" onclick="location.href='Admin-tables-iom2.php';">Pending</button>
  <button type="button" class="btn btn-success btn-sm" onclick="location.href='Admin-tables-iom3.php';">Approve</button>
  <button type="button" class="btn btn-danger btn-sm" onclick="location.href='Admin-tables-iom4.php';">Rejected</button>
  <button type="button" class="btn btn-warning btn-sm" onclick="location.href='Admin-tables-iom5.php';">This Month</button>

  <!-- <button type="button" class="btn btn-primary" style="float:right;">Generate Report</button> -->
  <form action="pdf-i-pending.php" method="post">
    <input type="submit" name="export" value="Generate Report" class="btn btn-primary" style="float:right; margin-top: -30px;"> 
  </form>


  <hr>
</div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      <th>Form No.</th>
                      <th>IOM Request</th>
                      <th>Status</th>
                      <th>Message</th>
                      <th>Print</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Form No.</th>
                      <th>IOM Request</th>
                      <th>Status</th>
                      <th>Message</th>
                      <th>Print</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
        
  
          while($row = mysqli_fetch_array($sqlSubstitution)) { 
       
        if(preg_match('/accepted/',$row['status'])) {
            $status = "<button class='btn btn-success btn-sm' >". "<i class='fa fa-check pr-2'></i> Accepted</button>";
        }else if(preg_match('/rejected/',$row['status'])){
            $status = "<button class='btn btn-danger btn-sm' >". "<i class='fa fa-times pr-2'></i> Rejected</button>";
        }else if(preg_match('/noted/',$row['status'])){
            $status = "<button class='btn btn-success btn-sm' >". "<i class='fa fa-clock pr-2'></i> Noted</button>";
        }else{
            $status = "<button class='btn btn-secondary btn-sm' >". "<i class='fa fa-clock pr-2'></i> Pending</button>";
        }
        
      ?>
    <tr>
      <td style="color:red">ITO 080<?php echo $row['id']; ?></td>
      <td>
          Employee: <b><?php echo ucwords($row['name']);?> </b><br>
          Department: <b><?php echo ucwords($row['department']);?></b><br>
          IOM Date: <b><?php echo date("M d, Y",strtotime($row['date'])); ?></b><br>
          Priority: <b><?php echo $row['priority']; ?></b><br>
          <small>Date Filed: <b><?php echo date("M d, Y",strtotime($row['date_filed'])); ?></b></small>
      </td>
      <td><center><?php echo $status; ?></center></td>
      <td>
          Subject: <b><?php echo ucwords($row['subject']);?></b><br><br>
          Message: <b><?php echo ucwords($row['message']);?></b><br><br>
          Recipient: <b><?php echo ucwords($row['dept_to']);?></b>
      </td>
      
      <td>
        <form action="pdf-iom.php" method="post">
        <input type="hidden" name="pdf_id" value="<?php echo $row['id']?>">
        <input type="submit" name="pdf" value="Print" class="btn btn-primary btn-sm"> 
        </form>
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

</body>

</html>
