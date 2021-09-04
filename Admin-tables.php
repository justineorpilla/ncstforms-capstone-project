<?php
    require('conn.php');
    session_start();
    $realName = $_SESSION['name'];

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

<?php require('./Admin-sidebar-form-reports.php'); ?>


<?php require('./Admin-navbar.php'); ?>


<!-- Begin Page Content -->
      


<div class="container">

  <div class="row mt-2">
            
        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-primary text-center">
             
              <div class="card-block">
                   <img class="card-img-top" src="img/1.jpg" alt="Cash Advance" class="responsive">
                <h4 class="card-title mt-2">Cash Advance</h4>
                <p class="card-text"><small>NCST Forms</small></p>
                <div class="card-footer"><a href="Admin-tables-CashAdvance.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>


        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/2.jpg" alt="Leave" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Leave</h4>
                <p class="card-text"><small>NCST Forms</small></p>
                <div class="card-footer"><a href="Admin-tables-Leave.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>

        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-info text-center">
              <img class="card-img-top" src="img/3.jpg" alt="Official Business" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Official Business</h4>
                <p class="card-text"><small>NCST Forms</small></p>
                <div class="card-footer"><a href="Admin-tables-OB.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>

    </div>

     <div class="row mt-2">
            
        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-primary text-center">
              <img class="card-img-top" src="img/4.jpg" alt="Overtime" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Overtime</h4>
                <p class="card-text"><small>NCST Forms</small></p>
                <div class="card-footer"><a href="Admin-tables-overtime.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>


        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-success text-center">
              <img class="card-img-top" src="img/5.jpg" alt="Undertime" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Undertime</h4>
                <p class="card-text"><small>NCST Forms</small></p>
                 <div class="card-footer"><a href="Admin-tables-undertime.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>

        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-info text-center">
              <img class="card-img-top" src="img/6.jpg" alt="Substitution" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">Substitution</h4>
                <p class="card-text"><small>NCST Forms</small></p>
                 <div class="card-footer"><a href="Admin-tables-substitution.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>

        <div class="col-lg 3 col-md-3  col-sm-12 col-xs-12 mt-2">
            <div class="card card-inverse card-info text-center">
              <img class="card-img-top" src="img/7.jpg" alt="Substitution" class="responsive">
              <div class="card-block">
                <h4 class="card-title mt-2">IOM Form</h4>
                <p class="card-text"><small>NCST Forms</small></p>
                 <div class="card-footer"><a href="Admin-tables-iom.php"> View <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div>
            </div>
            </div>
        </div>

    </div>
</div>



<!-- End of Main Content -->
    </div>
<?php require('./Admin-footer.php'); ?>

</body>

</html>
