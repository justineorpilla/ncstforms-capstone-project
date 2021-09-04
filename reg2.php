<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="https://ncst.edu.ph/favicon.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
    <title>Registration</title>
	<link rel="stylesheet" type="text/css" href="css/reg2.css">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
   
	<div class="container">
		<div class="bg-primary">
         <h1>Create Account <img src="img/NCST.png" class="img-responsive" style="width:15%" alt="Image" float="right"></h1>
      </div>
		<form id="registration_form" method="post">
			<div class="form-group">
				<input type="text" id="form_fname" name="firstname" required="">
				<span class="error_form" id="fname_error_message"></span>
				<label>
					Firstname
				</label>	
			</div>
			<div class="form-group">
				<input type="text" id="form_sname" name="lastname" required="">
				<span class="error_form" id="sname_error_message"></span>
				<label>
					Lastname
				</label>	
			</div>
			<div class="form-group">
				<input type="email" id="form_email" name="email" required="">
				<span class="error_form" id="email_error_message"></span>
				<label>Email</label>	
			</div>
			<div class="form-group">
				<input type="password" id="form_password" name="pw1" required="">
				<span class="error_form" id="password_error_message"></span>
				<label>Password</label>	
			</div>
			<div class="form-group">
				<input type="password" id="form_retype_password" name="pw2" required="">
				<span class="error_form" id="retype_password_error_message"></span>
				<label>Repeat Password</label>	
         </div>
         <div class="form-group">
            <label>DEPARTMENT: </label><br><br>
            <!-- SELECT OPTION ON PHP MY SQL -->
            <?php 
               $host = 'localhost';
               $user = 'root';
               $password = '';
               $database = 'm';

               $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
               $sqlDepartment = "SELECT `department` FROM `ncst-departments`";
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
            <select class="form-control" name="dept"> 
               <option>--CHOOSE DEPARTMENT--</option>
               <?php foreach ($results as $output) { ?>
               <option> <?php echo $output["department"] ?> </option>
               <?php } ?>
            </select>

            <br><br>
           
          </div>
          <div>
          <label>POSITION: </label><br><br>
          <?php 
               $host = 'localhost';
               $user = 'root';
               $password = '';
               $database = 'm';

               $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
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
          <select class="form-control" name="position"> 
               <option>--CHOOSE POSITION--</option>
               <?php foreach ($results as $output) { ?>
               <option> <?php echo $output["position"] ?> </option>
               <?php } ?>
            </select>
            
            <br><br>

          </div>
         <input type="submit" value="Register" name="save"><br>
         <h4><a href="index.php">Sign in</a></h4>
		</form>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script type="text/javascript">
      $(function() {

         $("#fname_error_message").hide();
         $("#sname_error_message").hide();
         $("#email_error_message").hide();
         $("#password_error_message").hide();
         $("#retype_password_error_message").hide();

         var error_fname = false;
         var error_sname = false;
         var error_email = false;
         var error_password = false;
         var error_retype_password = false;

         $("#form_fname").focusout(function(){
            check_fname();
         });
         $("#form_sname").focusout(function() {
            check_sname();
         });
         $("#form_email").focusout(function() {
            check_email();
         });
         $("#form_password").focusout(function() {
            check_password();
         });
         $("#form_retype_password").focusout(function() {
            check_retype_password();
         });

         function check_fname() {
            var pattern = /^[a-zA-Z]*$/;
            var fname = $("#form_fname").val();
            if (pattern.test(fname) && fname !== '') {
               $("#fname_error_message").hide();
               $("#form_fname").css("border-bottom","2px solid #34F458");
            } else {
               $("#fname_error_message").html("Should contain only Characters");
               $("#fname_error_message").show();
               $("#form_fname").css("border-bottom","2px solid #F90A0A");
               error_fname = true;
            }
         }

         function check_sname() {
            var pattern = /^[a-zA-Z]*$/;
            var sname = $("#form_sname").val()
            if (pattern.test(sname) && sname !== '') {
               $("#sname_error_message").hide();
               $("#form_sname").css("border-bottom","2px solid #34F458");
            } else {
               $("#sname_error_message").html("Should contain only Characters");
               $("#sname_error_message").show();
               $("#form_sname").css("border-bottom","2px solid #F90A0A");
               error_fname = true;
            }
         }

         function check_password() {
            var password_length = $("#form_password").val().length;
            if (password_length < 8) {
               $("#password_error_message").html("Atleast 8 Characters");
               $("#password_error_message").show();
               $("#form_password").css("border-bottom","2px solid #F90A0A");
               error_password = true;
            } else {
               $("#password_error_message").hide();
               $("#form_password").css("border-bottom","2px solid #34F458");
            }
         }

         function check_retype_password() {
            var password = $("#form_password").val();
            var retype_password = $("#form_retype_password").val();
            if (password !== retype_password) {
               $("#retype_password_error_message").html("Passwords Did not Matched");
               $("#retype_password_error_message").show();
               $("#form_retype_password").css("border-bottom","2px solid #F90A0A");
               error_retype_password = true;
            } else {
               $("#retype_password_error_message").hide();
               $("#form_retype_password").css("border-bottom","2px solid #34F458");
            }
         }

         function check_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#form_email").val();
            if (pattern.test(email) && email !== '') {
               $("#email_error_message").hide();
               $("#form_email").css("border-bottom","2px solid #34F458"); // COLOR GREEN
            } else {
               $("#email_error_message").html("Invalid Email");
               $("#email_error_message").show();
               $("#form_email").css("border-bottom","2px solid #F90A0A"); // COLOR RED - ERROR
               error_email = true;
            }
         }

         $("#registration_form").submit(function() {
            error_fname = false;
            error_sname = false;
            error_email = false;
            error_password = false;
            error_retype_password = false;

            check_fname();
            check_sname();
            check_email();
            check_password();
            check_retype_password();

            if (error_fname === false && error_sname === false && error_email === false && error_password === false && error_retype_password === false) {
              alert("Registration Successfull"); 
             // PHP CODE HERE
<?php
require('conn.php');
if(isset($_POST['save'])){
$name = $_POST['name'];
$user_name = $_POST['username'];
$pass = $_POST['pw2'];
$type = $_POST['roll'];
$dept = $_POST['dept'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$position = $_POST['position'];

$sql = "INSERT INTO user (name,user_name,password,role,department,position,firstname,lastname,email) 
VALUES ('$name','$user_name','$pass','employee','$dept','$position','$fname','$lname','$email')";
$q=mysqli_query($connection, $sql);
if($q) {


}
}
?>
            // END PHP CODE HERE 
				swal("Good job!", "You clicked the button!", "success");
            //   return true;
            } else {
               alert("Please Fill the form Correctly");
               return false;
            }


         });
      });
   </script>
</body>
</html>