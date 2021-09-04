<?php
session_start();
require('conn.php');
    if(isset($_POST['register'])){
        $empId = $_POST['employee_id'];
        $contact = $_POST['contact_no'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $address = $_POST['address'];
        $dept = $_POST['department'];
        $pos = $_POST['position'];
        $email = $_POST['email'];
        $pass = $_POST['psw2'];
        
        

        $sql = "INSERT INTO `pending-user` (`firstname`,`lastname`,`employee_id`,`address`,`contact`,`email`,`password`,`department`,`position`) 
        VALUES ('$fname','$lname','$empId','$address','$contact','$email','$pass','$dept','$pos')";
        $q=mysqli_query($connection, $sql);
        if($q) {
          $_SESSION['status'] = "Success! Your account is waiting for administrator approval!";
          $_SESSION['status_code'] = "success";
          header('Location: sbregister.php');
          exit(0);
        }else{
          $_SESSION['status'] = "Account Not Successfully Created!";
          $_SESSION['status_code'] = "error";
          header('Location: sbregister.php');
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

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
.bg-register-pic{background: url(images/nc9.jpg);background-position:center;background-size:cover}
.bg-register-backg{background: url(images/q1.jpg);background-position:center;background-size:cover}
/* The message box is shown when the user clicks on the password field background-color: #FFC300*/ 
#message {
  display:none;
  /* background: #f1f1f1; | .bg-register-pic{background: url(images/nc9.jpg);background-position:center;background-size:cover}*/
  color: #000;
  position: relative;
  padding: 5px;
  margin-top: 10px;
  margin-bottom: 10px;
}

#repeatMessage {
  display:none;
  /* background: #f1f1f1; */
  color: #000;
  position: relative;
  padding: 5px;
  margin-top: 10px;
  margin-bottom: 10px;
}

#message p {
  padding: 0px 15px;
  font-size: 14px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -15px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -15px;
  content: "✖";
}

</style>
<body class="bg-register-backg">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body 
                col-lg-5 d-none d-lg-block bg-register-pic
                col-lg-7
                -->
                <div class="row">
                    <div class=""></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="sbregister.php" method="POST" >
                                 <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="" name="employee_id"
                                        placeholder="Employee ID" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="" name="contact_no"
                                            placeholder="Contact No." maxlength="11" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="" name="firstname"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="" name="lastname"
                                            placeholder="Last Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="" name="address"
                                        placeholder="Home Address" required></input>
                                </div>

                                <!-- <div class="form-group row">
                                <div class="col-sm-6 mb-sm-0 mt-2">
<select name="department" class="form-select form-control" aria-label="Default select example" required>
  <option selected disabled hidden>Department</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
                                </div>
                                    <div class="col-sm-6 mt-2">
<select name="position" class="form-select form-control" aria-label="Default select example">
  <option selected disabled hidden>Position</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
                                    </div>
                                </div>
                                -->

<div class="form-group row">
    <div class="col-sm-6 mb-sm-0 mt-2">
               <?php 
               $host = 'localhost';
               $user = 'root';
               $password = '';
               $database = 'm';

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
            <select name="department" class="form-select form-control" required>
               <!-- <option hidden="true" value="" disabled selected>Please Select Here</option> -->
               <option value="" selected disabled hidden>Department</option>
               <?php foreach ($results as $output) { ?>
               <option> <?php echo $output["department"] ?> </option>
               <?php } ?>
            </select>

    </div>

    <div class="col-sm-6 mt-2">
    <?php 
               
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
          <select name="position" class="form-select form-control" required>
          <option value="" selected disabled hidden>Position</option>
               <?php foreach ($results as $output) { ?>
               <option> <?php echo $output["position"] ?> </option>
               <?php } ?>
            </select>
      
    </div>
  </div>
                                
                    <hr> <!-- ========================== HORIZONTAL BREAK ============================-->
                  
                    <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="" name="email"
                                        placeholder="Email Address" required>
                                </div>

   <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" required>
                                    <!-- PASSWORD POP UP -->
<div id="message">
  <h6>Must contain the following:</h6>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
</div>

                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="psw2" name="psw2" title="Password must match" placeholder="Repeat Password" required>
                                    <!-- PASSWORD POP UP -->
<div id="repeatMessage">
  <p id="repeat" class="invalid"><b>Password</b> must match</p>
</div>
</div>

                                </div>
                     <hr> <!-- ========================== HORIZONTAL BREAK ============================-->
                                <input type="submit" value="Register" name="register" class="btn btn-primary btn-user btn-block">
                                </input>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="sblogin.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
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

    <script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

// ========================================================================================================

var repeatPassword = document.getElementById("psw2");
var repeat = document.getElementById("repeat");

// When the user clicks on the password field, show the message box
repeatPassword.onfocus = function() {
  document.getElementById("repeatMessage").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
repeatPassword.onblur = function() {
  document.getElementById("repeatMessage").style.display = "none";
}

// When the user starts to type something inside the password field
repeatPassword.onkeyup = function() {
  // Validate Password

            if ($('#psw').val() === $('#psw2').val()) {
            //  $('#repeat').html('Matching').css('color', 'green');
                repeat.classList.remove("invalid");
                repeat.classList.add("valid");
                repeatPassword.setCustomValidity('');
            } else {
                // $('#repeat').html('Not Matching').css('color', 'red');
                repeat.classList.remove("valid");
                repeat.classList.add("invalid");
                repeatPassword.setCustomValidity("Passwords Don't Match");
            }

        }
</script>


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