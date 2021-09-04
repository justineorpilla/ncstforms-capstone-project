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

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<style> 
.bg-login-pic{background: url(images/nc6.jpg);background-position:center;background-size:cover} 
.bg-login-backg{background: url(images/q1.jpg);background-position:center;background-size:cover} 

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
<!-- background-color: #333333 | body class="bg-gradient-dark"-->
<body class="bg-login-backg">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body
                        col-lg-6 d-none d-lg-block bg-login-pic
                        col-lg-6
                         -->
                        <div class="row">
                            <div class=""></div>
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="form-group text-center">
                                        <!-- <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1> -->
                                        <img src="images/NCST.png" alt="NCST logo" width="85" height="80">
                                    </div>
                                    <form class="user" action="login.php" method="POST">
                                        <div class="form-group">
                                        <!-- ERROR POP UP-->
                                        <?php if (isset($_GET['error'])) { ?>
                                            <p class="error"><?php echo $_GET['error']; ?></p>
                                        <?php } ?>
                                        <!-- ERROR POP UP -->
                                            <input type="text" class="form-control form-control-user" name="username"
                                                id="" placeholder="Employee ID">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        
                                        <input type="submit" value="Login" name="login" class="btn btn-primary btn-user btn-block">
                                        </input>
                                        
                                     
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                      
                                        <a class="small" href="sbregister.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                         <!-- <a class="small" href="forgot-password.html">Forgot Password?</a> -->
                                         <a class="small" href="index.php">Go Back</a>
                                    </div>
                                </div>
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

</body>

</html>