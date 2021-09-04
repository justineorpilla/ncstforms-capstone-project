<?php 
session_start();
require('./conn.php');
require('./functions.php'); 
?>
<?php
    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    // Para Maiwasan ma BYPASS yung home.php ireredirect sila sa INDEX pag walang session 
    $realName = $_SESSION['name'];
    $realDepartment = $_SESSION['department'];
    $realEmployeeID = $_SESSION['employee_id'];
    $realSignature = $_SESSION['signature'];
    }else{
      header("Location: index.php");
      exit();
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
    
  <title>NCST</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php 
  if(isset($_POST['apply'])){

    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
      $signature = validate($realSignature);
    
      if (empty($signature)) {
        header("Location: iom.php?error=Signature is required. Please upload your Signature on My Account tab before submitting a form"); 
        exit();
      }else{

        $name = $realName;
        $date = $_POST['date'];
        $priority = $_POST['priority'];
        $priority2 = $_POST['priority2'];
        $to = $_POST['to'];
        $from = $realDepartment;
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $sign = $realSignature;
        
        $query = "INSERT INTO `ioms` (`id`, `name`, `department`, `date`, `priority`, `priority2`, `dept_to`, `dept_from`, `subject`, `message`, `date_filed`, `emp_signature`, `status`) 
        VALUES (NULL, '$name', '$from', '$date', '$priority', '$priority2', '$to', '$from', '$subject', '$message', CURRENT_TIMESTAMP, '$sign', 'pending');";

        if(performQuery($query)){
          // echo "<script>alert('Your Official Business Request is now pending for approval. Thank you ')</script>";
          $_SESSION['status'] = "IOM Request is now pending for approval!";
          $_SESSION['status_code'] = "success";
          header('Location: iom.php');
          exit(0);
        }else{
          // echo "<script>alert('Unknown error occured')</script>";
          $_SESSION['status'] = "Error Occured";
          $_SESSION['status_code'] = "error";
          header('Location: iom.php');
        }
    }
  }
?>   
<style>
.rad1{
    border: 2px solid darkgray;
    border-radius: 15px;
}
.rad2{
    margin-left: 10px;
    margin-top: 10px;
    border: 2px solid darkgray;
    border-radius: 15px;
}
.error {
    background: #F2DEDE;
    color: #A94442;
    padding: 10px;
    width: 95%;
    border-radius: 5px;
    font-size: 15px;
    margin: 15px auto;
}
</style>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php require('./Sidebar.php'); ?>

<?php require('./User-navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">INTER-OFFICE MEMORANDUM</h1>
        </div>
            
        <form method="post">
<?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
        <div class="form-row col-md-8">
        <div class="col-md-4 col-form-label">
            <label for="InputName">Employee Name</label>
            <input type="text" class="form-control" placeholder="<?php echo ucwords($realName); ?>" disabled>
        </div>
        <div class="col-md-4 col-form-label">
            <label for="InputName">Department</label>
            <input type="text" class="form-control" placeholder="<?php echo $realDepartment;?>" disabled>
        </div>
        <div class="col-md-4 col-form-label">
            <label for="InputName">Date of IOM</label>
            <input type="date" name="date" class="form-control" id="" placeholder="" required>
        </div>
        </div>
        
        
<!--CHECKBOX -->
<br>

    <div class="row col-md-12">
<!-- 1ST -->
<div class="rad1 col col-md-4">

    <label for="transport">PRIORITY</label><br>

  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="priority"  value="Routine" checked>
    <label class="form-check-label" for="exampleRadios1">
      Routine
    </label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="priority" value="Urgent">
    <label class="form-check-label" for="exampleRadios2">
      Urgent
    </label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="priority" value="RUSH">
    <label class="form-check-label" for="exampleRadios3">
      RUSH
    </label>
  </div>
</div>
<!-- 2ND -->
<div class="rad1 col col-md-4">
   <div class="row">
      <div class="col">

          <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="priority2"  value="For your info" checked>
            <label class="form-check-label" for="exampleRadios4">
                For your info
            </label>
          </div>
          
          <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="priority2" value="For your signature">
            <label class="form-check-label" for="exampleRadios5">
                 For your signature
            </label>
         </div>
        
         <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="priority2" value="For your approval">
            <label class="form-check-label" for="exampleRadios5">
                 For your approval
           </label>
      </div>
      <div class="col">
           
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="priority2"  value="For action" checked>
                <label class="form-check-label" for="exampleRadios4">
                For action
            </label>
          </div>
     <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="priority2" value="For comments">
            <label class="form-check-label" for="exampleRadios5">
                 For comments
           </label>
      </div>
      <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="priority2" value="Request">
            <label class="form-check-label" for="exampleRadios5">
                 Request
           </label>
      </div>
    
     </div>
      
    </div>

</div>
      
</div>
</div> <!-- end row -->      

<!-- =============================================================================================================================== -->
<!-- =============================================================================================================================== -->
<div class="form-group row">

  <div class="form-row col-md-6"> 

    <div class="col-md-4 col-form-label">
               <?php 

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
            <!-- <select class="form-control" name="dept" required>  -->
            <label for="InputName">To</label>
            <select name="to" class="form-select form-control" required>
               <!-- <option hidden="true" value="" disabled selected>Please Select Here</option> -->
               <option value="" selected disabled hidden>Choose Department</option>
               <?php foreach ($results as $output) { ?>
               <option> <?php echo $output["department"] ?> </option>
               <?php } ?>
            </select>

    </div>

<!-- =============================================================================================================================== -->
<!-- =============================================================================================================================== -->
        <div class="col-md-4 col-form-label">
            <label for="InputName">From</label>
            <input type="text" class="form-control" name="from" placeholder="<?php echo $realDepartment;?>" disabled>
        </div>
    </div> 
  <div class="form-row col-md-12">
        <div class="col-md-4 col-form-label">
            <label for="InputName">Subject RE:</label>
            <input type="text" class="form-control" name="subject" placeholder="" required>
        </div>
  </div> 
  <div class="form-row col-md-12">
        <div class="form-group col-md-4 col-form-label">
          <label for="exampleFormControlTextarea1">Message:</label>
          <textarea class="form-control" name="message" rows="4" required></textarea>
        </div>
  </div> 
</div>
    
  <br>
  <button type="submit" name="apply" class="btn btn-primary">Submit</button>
</form>
          
            
             
      <!-- End of Main Content -->

<?php require('./Footer.php'); ?>

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
