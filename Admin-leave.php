<?php 
require('./functions.php');
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

<?php require('./Admin-sidebar.php'); ?>

<?php require('./Admin-navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Leave</h1>
        </div>
            <h5>Admin name: <?php echo $realName;?></h5>

            <main role="main">

<section class="jumbotron text-center">
<div class="container">
    <?php 

        $query = "SELECT * FROM `leaves` WHERE `status` = 'recommended';";
        
        if(count(fetchAll($query))>0){
            foreach(fetchAll($query) as $row){
                ?>
        <h1 class="jumbotron-heading"><?php echo $row['requested_by']?></h1>
        <p class="lead text-muted">
            <?php echo $row['requested_by']." would like to request for a leave (".$row['type']."), from ".$row['date_from']." to ".$row['date_to']. ". <br/> Reason : ".$row['reason'] ?></p>
        <p>
                <a href="accept.php?id=<?php echo $row['id']?>&type=leave" class="btn btn-primary my-2">Accept</a>
                <a href="reject.php?id=<?php echo $row['id']?>&type=leave" class="btn btn-secondary my-2">Reject</a>
        </p>
        <small><i><?php echo $row['requested_at'] ?></i></small>
      <?php 
            }
        }else{
            echo "No Pending Requests";
        }
      ?>
</div>
</section>
 </main>
      <!-- End of Main Content -->

<?php require('./Admin-footer.php'); ?>

</body>

</html>
