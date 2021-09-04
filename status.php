<?php
    session_start();
    require('status-read.php');
//    echo $_SESSION['status'];
    $realName = $_SESSION['name'];
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

<?php require('./Sidebar.php'); ?>

<?php require('./User-navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Status</h1>
        </div>
      </div>
      
      <!-- Main Content -->      
     <div class="container-fluid">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Cash Advance</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Leave</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Official Business</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu3">Overtime</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu4">Undertime</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu5">Substitution</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
<!-- ========================================================================================================================================= -->   


<!-- START CASH ADVANCE START-->


    <div id="home" class="container tab-pane active"><br>
      <h3>CASH ADVANCE</h3>
    <div class="container-lg">
    <?php 
      
        echo 'Employee Name: '.$name ?>
        
        <div class="table-responsive">
      <table class="table" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Form no.</th>
      <th scope="col">Amount</th>
      <th scope="col">Requested Date</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
   
     
    </tr>
  </thead>
  <tbody>
      <?php 
        
  
          while($row = mysqli_fetch_array($sqlCashAdvance)) { 
       
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
      <td>P<?php echo $row['amount'] ?></td>
      <td><?php echo date("F d, Y", strtotime($row['requested_at'])) ?></td>
      <td><?php echo $status; ?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#md<?php echo $row['id']; ?>">
        View</button> <br>
          <form action="pdf-cashadvance.php" method="post">
                <input type="hidden" name="pdf_id" value="<?php echo $row['id']; ?>"> 
                <input type="submit" name="pdf" value="Print" class="btn btn-dark btn-sm"> 
          </form>
      </td>
    </tr>
      
            <!-- MODAL-->
        <div class="modal fade" id="md<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Approval Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- MODAL BODY-->
          <?php 
              
              $approver = $row['approved_by'];
              $stats = $row['status'];
              $approve_at = $row['approved_at'];
              
              
                    if(preg_match('/accepted/',$row['status'])) {

                    $stats = "<small>Status: </small><span style='color:green;'>".$stats."</span><br>";
                    }else if(preg_match('/rejected/',$row['status'])){
                    $stats = "<small>Status: </small><span style='color:red;'>".$stats."</span><br>";
                    }else{
                    $stats = "<small>Status: </small><span style='color:blue;'>".$stats."</span><br>";
                    }
              
              echo "<small>Form no. ".$row['id']."</small><br>"; 
              echo "<small>Approved by: </small>".$approver."<br>"; 
              echo $stats;
              echo "<small>".$approve_at."</small><br>";
          ?>
          <?php 
                if(preg_match('/pending/', $row['status'])){ ?>
                
                <a href="cancel.php?id=<?php echo $row['id']?>&type=cash_advance">cancel request</a>
          <?php
              }
          ?>
          
        <!--END MODAL BODY -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <!-- END #1 MODAL--> 
      
      <?php   } ?>
  </tbody>
</table>  
         </div>
        </div>
        
<!-- END CASH ADVANCE END-->
    </div>
<!-- ========================================================================================================================================= -->  


<!-- START LEAVE START-->
    <div id="menu1" class="container tab-pane fade"><br>
      <h3>LEAVE</h3>
      <div class="container-lg">
    <?php 
      
        echo 'Employee Name: '.$name ?>
        
        <div class="table-responsive">
      <table class="table" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Form no.</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col">Leave Type</th>
      <th scope="col">Date Filed</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
   
     
    </tr>
  </thead>
  <tbody>
      <?php 
        
  
          while($row = mysqli_fetch_array($sqlLeave)) { 
       
        if(preg_match('/accepted/',$row['status'])) {

            $status = "<button class='btn btn-success btn-sm' >". "<i class='fa fa-check pr-2'></i> Accepted</button>";
        }else if(preg_match('/rejected/',$row['status'])){
            $status = "<button class='btn btn-danger btn-sm' >". "<i class='fa fa-times pr-2'></i> Rejected</button>";
        }else{
            $status = "<button class='btn btn-secondary btn-sm' >". "<i class='fa fa-clock pr-2'></i> Pending</button>";
        }
        
      ?>
    <tr>
      <td style="color:red">ALF No.<?php echo $row['id']; ?></td>
      <td><?php echo date("M d, Y", strtotime($row['date_from'])) ?></td>
      <td><?php echo date("M d Y", strtotime($row['date_to'])) ?></td>
      <td><?php echo $row['type'] ?></td>
      <td>
        <?php echo date("F j, Y", strtotime($row['requested_at'])) ?><br>
        <?php echo date("h:i:s A", strtotime($row['requested_at'])) ?>
      </td>
      <td><?php echo $status; ?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#mdl<?php echo $row['id']; ?>">
          View</button> 
          <form action="pdf-leave.php" method="post">
                <input type="hidden" name="pdf_id" value="<?php echo $row['id']; ?>"> 
                <input type="submit" name="pdf" value="Print" class="btn btn-dark btn-sm"> 
          </form>
      </td>
    </tr>
      
            <!-- MODAL-->
        <div class="modal fade" id="mdl<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Approval Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- MODAL BODY-->
          <?php 
              
              $approver = $row['approved_by'];
              $stats = $row['status'];
              $approve_at = $row['approved_at'];
              $recommender = $row['recommended_by'];

                    if(preg_match('/accepted/',$row['status'])) {

                    $stats = "<small>Status: </small><span style='color:green;'>".$stats."</span><br>";
                    }else if(preg_match('/rejected/',$row['status'])){
                    $stats = "<small>Status: </small><span style='color:red;'>".$stats."</span><br>";
                    }else{
                    $stats = "<small>Status: </small><span style='color:blue;'>".$stats."</span><br>";
                    }
              
              echo "<small>Form no. ".$row['id']."</small><br>"; 
              echo "<small>Recommended by: </small>".$recommender."<br>";
              echo "<small>Approved by: </small>".$approver."<br>"; 
              echo $stats;
              echo "<small>".$approve_at."</small><br>";
          ?>
          <?php 
                if(preg_match('/pending/', $row['status'])){ ?>
                
                <a href="cancel.php?id=<?php echo $row['id']?>&type=leave">cancel request</a>
          <?php
              }
          ?>
          
        <!--END MODAL BODY -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <!-- END #2 MODAL--> 
      
      <?php   } ?>
  </tbody>
</table>  
         </div>
        </div>
<!-- END LEAVE END-->
    </div>
<!-- ========================================================================================================================================= -->  


<!-- START OFFICIAL BUSINESS START-->
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>OFFICIAL BUSINESS</h3>
      <div class="container-lg">
    <?php 
      
        echo 'Employee Name: '.$name ?>
        
        <div class="table-responsive">
      <table class="table" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Form no.</th>
      <th scope="col">Date of Visit</th>
      <th scope="col">Office to Visit</th>
      <th scope="col">Person to Visit</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
   
     
    </tr>
  </thead>
  <tbody>
      <?php 
        
  
          while($row = mysqli_fetch_array($sqlOB)) { 
       
        if(preg_match('/accepted/',$row['status'])) {

            $status = "<button class='btn btn-success btn-sm' >". "<i class='fa fa-check pr-2'></i> Accepted</button>";
        }else if(preg_match('/rejected/',$row['status'])){
            $status = "<button class='btn btn-danger btn-sm' >". "<i class='fa fa-times pr-2'></i> Rejected</button>";
        }else{
            $status = "<button class='btn btn-secondary btn-sm' >". "<i class='fa fa-clock pr-2'></i> Pending</button>";
        }
        
      ?>
    <tr>
      <td style="color:red">OBA No.<?php echo $row['id']; ?></td>
      <td><?php echo date("M d, Y", strtotime($row['date'])) ?></td>
      <td><?php echo $row['office_to_visit'] ?></td>
      <td><?php echo $row['person_to_visit'] ?></td>
      <td><?php echo $status; ?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#mdob<?php echo $row['id']; ?>">
          View</button> 
          <form action="pdf-obusiness.php" method="post">
                <input type="hidden" name="pdf_id" value="<?php echo $row['id']; ?>"> 
                <input type="submit" name="pdf" value="Print" class="btn btn-dark btn-sm"> 
          </form>
      </td>
    </tr>
      
            <!-- MODAL-->
        <div class="modal fade" id="mdob<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Approval Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- MODAL BODY-->
          <?php 
              
              $approver = $row['approved_by'];
              $stats = $row['status'];
              $approve_at = $row['approved_at'];
              $recommender = $row['recommended_by'];

                    if(preg_match('/accepted/',$row['status'])) {

                    $stats = "<small>Status: </small><span style='color:green;'>".$stats."</span><br>";
                    }else if(preg_match('/rejected/',$row['status'])){
                    $stats = "<small>Status: </small><span style='color:red;'>".$stats."</span><br>";
                    }else{
                    $stats = "<small>Status: </small><span style='color:blue;'>".$stats."</span><br>";
                    }
              
              echo "<small>Form no. ".$row['id']."</small><br>"; 
              echo "<small>Recommended by: </small>".$recommender."<br>";
              echo "<small>Approved by: </small>".$approver."<br>"; 
              echo $stats;
              echo "<small>".$approve_at."</small><br>";
          ?>
          <?php 
                if(preg_match('/pending/', $row['status'])){ ?>
                
                <a href="cancel.php?id=<?php echo $row['id']?>&type=official_business">cancel request</a>
          <?php
              }
          ?>
          
        <!--END MODAL BODY -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <!-- END #3 MODAL--> 
      
      <?php   } ?>
  </tbody>
</table>  
         </div>
        </div>
        
<!-- END OFFICIAL BUSINESS END-->
    </div>
<!-- ========================================================================================================================================= -->  


<!-- START OVERTIME START -->
    <div id="menu3" class="container tab-pane fade"><br>
      <h3>OVERTIME</h3>
      <div class="container-lg">
    <?php 
      
        echo 'Employee Name: '.$name ?>
        
        <div class="table-responsive">
      <table class="table" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Form no.</th>
      <th scope="col">Date Filed</th>
      <th scope="col">Requested Date</th>
      <th scope="col">No. of hours</th>
      <th scope="col">Reason</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
   
     
    </tr>
  </thead>
  <tbody>
      <?php 
        
  
          while($row = mysqli_fetch_array($sqlOvertime)) { 
       
        if(preg_match('/accepted/',$row['status'])) {

            $status = "<button class='btn btn-success btn-sm' >". "<i class='fa fa-check pr-2'></i> Accepted</button>";
        }else if(preg_match('/rejected/',$row['status'])){
            $status = "<button class='btn btn-danger btn-sm' >". "<i class='fa fa-times pr-2'></i> Rejected</button>";
        }else{
            $status = "<button class='btn btn-secondary btn-sm' >". "<i class='fa fa-clock pr-2'></i> Pending</button>";
        }
        
      ?>
    <tr>
      <td style="color:red">OT No.<?php echo $row['id']; ?></td>
      <td><?php echo date("M j, Y", strtotime($row['requested_at'])) ?></td>
      <td><?php echo date("M j, Y", strtotime($row['date'])) ?></td>
      <td><?php echo $row['hours'] ?></td>
      <td><?php echo $row['reason'] ?></td>
      <td><?php echo $status; ?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#mdo<?php echo $row['id']; ?>">
          View</button> 
          <form action="pdf-overtime.php" method="post">
                <input type="hidden" name="pdf_id" value="<?php echo $row['id']; ?>"> 
                <input type="submit" name="pdf" value="Print" class="btn btn-dark btn-sm"> 
          </form>
      </td>
    </tr>
      
            <!-- MODAL-->
        <div class="modal fade" id="mdo<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Approval Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- MODAL BODY-->
          <?php 
              
              $approver = $row['approved_by'];
              $stats = $row['status'];
              $approve_at = $row['approved_at'];
              $recommender = $row['recommended_by'];

                    if(preg_match('/accepted/',$row['status'])) {

                    $stats = "<small>Status: </small><span style='color:green;'>".$stats."</span><br>";
                    }else if(preg_match('/rejected/',$row['status'])){
                    $stats = "<small>Status: </small><span style='color:red;'>".$stats."</span><br>";
                    }else{
                    $stats = "<small>Status: </small><span style='color:blue;'>".$stats."</span><br>";
                    }
              
              echo "<small>Form no. ".$row['id']."</small><br>"; 
              echo "<small>Recommended by: </small>".$recommender."<br>";
              echo "<small>Approved by: </small>".$approver."<br>"; 
              echo $stats;
              echo "<small>".$approve_at."</small><br>";
          ?>
          <?php 
                if(preg_match('/pending/', $row['status'])){ ?>
                
                <a href="cancel.php?id=<?php echo $row['id']?>&type=overtime">cancel request</a>
          <?php
              }
          ?>
          
        <!--END MODAL BODY -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <!-- END #4 MODAL--> 
      
      <?php   } ?>
  </tbody>
</table>  
         </div>
        </div>
<!-- END OVERTIME END-->
    </div>
<!-- ========================================================================================================================================= -->  


<!-- START UNDERTIME START -->      
    <div id="menu4" class="container tab-pane fade"><br>
      <h3>UNDERTIME</h3>
      <div class="container-lg">
    <?php 
      
        echo 'Employee Name: '.$name ?>
        
        <div class="table-responsive">
      <table class="table" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Form no.</th>
      <th scope="col">Date Filed</th>
      <th scope="col">Requested Date</th>
      <th scope="col">Time In</th>
      <th scope="col">Time Out</th>
      <th scope="col">Reason</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
   
     
    </tr>
  </thead>
  <tbody>
      <?php 
        
  
          while($row = mysqli_fetch_array($sqlUndertime)) { 
       
        if(preg_match('/accepted/',$row['status'])) {

            $status = "<button class='btn btn-success btn-sm' >". "<i class='fa fa-check pr-2'></i> Accepted</button>";
        }else if(preg_match('/rejected/',$row['status'])){
            $status = "<button class='btn btn-danger btn-sm' >". "<i class='fa fa-times pr-2'></i> Rejected</button>";
        }else{
            $status = "<button class='btn btn-secondary btn-sm' >". "<i class='fa fa-clock pr-2'></i> Pending</button>";
        }
        
      ?>
    <tr>
      <td style="color:red">US No.<?php echo $row['id']; ?></td>
      <td><?php echo date("M j, Y", strtotime($row['requested_at'])) ?></td>
      <td><?php echo date("M j, Y", strtotime($row['date'])) ?></td>
      <td><?php echo date("h:i:s A", strtotime($row['time_in'])) ?></td>
      <td><?php echo date("h:i:s A", strtotime($row['time_out'])) ?></td>
      <td><?php echo $row['reason'] ?></td>
      <td><?php echo $status; ?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#mdu<?php echo $row['id']; ?>">
          View</button> 
          <form action="pdf-undertime.php" method="post">
                <input type="hidden" name="pdf_id" value="<?php echo $row['id']; ?>"> 
                <input type="submit" name="pdf" value="Print" class="btn btn-dark btn-sm"> 
          </form>
      </td>
    </tr>
      
            <!-- MODAL-->
        <div class="modal fade" id="mdu<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Approval Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- MODAL BODY-->
          <?php 
              
              $approver = $row['approved_by'];
              $stats = $row['status'];
              $approve_at = $row['approved_at'];
              $recommender = $row['recommended_by'];

                    if(preg_match('/accepted/',$row['status'])) {

                    $stats = "<small>Status: </small><span style='color:green;'>".$stats."</span><br>";
                    }else if(preg_match('/rejected/',$row['status'])){
                    $stats = "<small>Status: </small><span style='color:red;'>".$stats."</span><br>";
                    }else{
                    $stats = "<small>Status: </small><span style='color:blue;'>".$stats."</span><br>";
                    }
              
              echo "<small>Form no. ".$row['id']."</small><br>"; 
              echo "<small>Recommended by: </small>".$recommender."<br>";
              echo "<small>Approved by: </small>".$approver."<br>"; 
              echo $stats;
              echo "<small>".$approve_at."</small><br>";
          ?>
          <?php 
                if(preg_match('/pending/', $row['status'])){ ?>
                
                <a href="cancel.php?id=<?php echo $row['id']?>&type=undertime">cancel request</a>
          <?php
              }
          ?>
          
        <!--END MODAL BODY -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <!-- END #5 MODAL--> 
      
      <?php   } ?>
  </tbody>
</table>  
         </div>
        </div>
<!-- END UNDERTIME END-->
    </div>
<!-- ========================================================================================================================================= -->  


<!-- START SUBSTITUTION START -->       
    <div id="menu5" class="container tab-pane fade"><br>
      <h3>SUBSTITUTION</h3>
      <div class="container-lg">
    <?php 
      
        echo 'Employee Name: '.$name ?>
        
        <div class="table-responsive">
      <table class="table" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Form no.</th>
      <th scope="col">Date Filed</th>
      <th scope="col">Date of Substitution</th>
      <th scope="col">Substitute Instructor</th>
      <th scope="col">Subject</th>
      <th scope="col">Time</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
   
     
    </tr>
  </thead>
  <tbody>
      <?php 
        
  
          while($row = mysqli_fetch_array($sqlSub)) { 
       
        if(preg_match('/accepted/',$row['status'])) {

            $status = "<button class='btn btn-success btn-sm' >". "<i class='fa fa-check pr-2'></i> Accepted</button>";
        }else if(preg_match('/rejected/',$row['status'])){
            $status = "<button class='btn btn-danger btn-sm' >". "<i class='fa fa-times pr-2'></i> Rejected</button>";
        }else{
            $status = "<button class='btn btn-secondary btn-sm' >". "<i class='fa fa-clock pr-2'></i> Pending</button>";
        }
        
      ?>
    <tr>
      <td style="color:red">SF No.<?php echo $row['id']; ?></td>
      <td><?php echo date("M j, Y", strtotime($row['requested_at'])) ?></td>
      <td><?php echo date("M j, Y", strtotime($row['date'])) ?></td>
      <td><?php echo ucwords($row['instructor']) ?></td>
      <td><?php echo $row['subject'] ?></td>
      <td><?php echo $row['time'] ?></td>
      <td><?php echo $status; ?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#mds<?php echo $row['id']; ?>">
          View</button> 
          <form action="pdf-substitution.php" method="post">
                <input type="hidden" name="pdf_id" value="<?php echo $row['id']; ?>"> 
                <input type="submit" name="pdf" value="Print" class="btn btn-dark btn-sm"> 
          </form>
      </td>
    </tr>
      
            <!-- MODAL-->
        <div class="modal fade" id="mds<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Approval Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- MODAL BODY-->
          <?php 
              
              $approver = $row['approved_by'];
              $stats = $row['status'];
              $approve_at = $row['approved_at'];
              $recommender = $row['recommended_by'];

                    if(preg_match('/accepted/',$row['status'])) {

                    $stats = "<small>Status: </small><span style='color:green;'>".$stats."</span><br>";
                    }else if(preg_match('/rejected/',$row['status'])){
                    $stats = "<small>Status: </small><span style='color:red;'>".$stats."</span><br>";
                    }else{
                    $stats = "<small>Status: </small><span style='color:blue;'>".$stats."</span><br>";
                    }
              
              echo "<small>Form no. ".$row['id']."</small><br>"; 
              echo "<small>Noted by: </small>".$recommender."<br>";
              echo "<small>Approved by: </small>".$approver."<br>"; 
              echo $stats;
              echo "<small>".$approve_at."</small><br>";
          ?>
          <?php 
                if(preg_match('/pending/', $row['status'])){ ?>
                
                <a href="cancel.php?id=<?php echo $row['id']?>&type=overtime">cancel request</a>
          <?php
              }
          ?>
          
        <!--END MODAL BODY -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <!-- END #6 MODAL--> 
      
      <?php   } ?>
  </tbody>
</table>  
         </div>
        </div>
<!-- END SUBSTITUTION END --> 
    </div>
<!-- ========================================================================================================================================= -->  


  </div> <!-- END TAB PANES DIV -->
</div> <!-- END MAIN CONTENT DIV -->
      
      <!-- End OF MAIN CONTENT -->

<?php require('./Footer.php'); ?>
    </div>
</body>

</html>
