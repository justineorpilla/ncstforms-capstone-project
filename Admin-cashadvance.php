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
          
          <h1 class="h3 mb-2 text-gray-800">Cash Advance</h1>
          <p class="mb-4">Go to NCST <a href="Admin-tables-CashAdvance.php">Forms - Cash Advance</a> to see more information about Cash Advances, search and filter the results there. 
            <h5>Admin name: <?php echo $realName;?></h5>

            <main role="main">

<section class="jumbotron text-center">
<div class="container ">
    <?php 

        $query = "SELECT * FROM `cash_advances` WHERE `status` = 'pending';";
        if(count(fetchAll($query))>0){
            foreach(fetchAll($query) as $row){
                ?>
<div class="card text-center mx-auto mt-2">
  <div class="card-header bg-warning" style="color:white; font-size:25px;">
    Cash Advance
  </div>
  <div class="card-body">
    <h5 class="card-title"><strong><?php echo $row['requested_by']?></strong></h5>
    <p class="card-text"><?php echo $row['message']?></p>
<p>
        <a href="accept.php?id=<?php echo $row['id']?>&type=cash_advance" class="btn btn-success my-2">Accept</a>
        <a href="reject.php?id=<?php echo $row['id']?>&type=cash_advance" class="btn btn-secondary my-2">Reject</a>
     <br> <small><i><?php echo $row['requested_at'] ?></i></small>
</p>
  </div>
</div>
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
