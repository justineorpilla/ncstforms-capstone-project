<?php 
require('conn.php');
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $user = validate($_POST['username']);
        $pass = validate($_POST['password']);

        if (empty($user)) {
            header("Location: sblogin.php?error=User Name is required"); 
            exit();
        }else if(empty($pass)){
            header("Location: sblogin.php?error=Password is required"); 
            exit();
        }else{
            // echo "Valid Input";

            $sql="SELECT * FROM user WHERE `user_name`='$user' AND `password`='$pass'";
            $q=mysqli_query($connection, $sql);
            $row=mysqli_fetch_array($q);
            $type=$row['role'];
            $name=$row['name'];
            $isexist=mysqli_query($connection, $sql);
            $check_user=mysqli_num_rows($isexist);

            if($check_user==1){
                $_SESSION["type"] = $row['role'];
                $_SESSION["user_name"] = $row['user_name'];
                $_SESSION["name"] = $row['name'];
                $_SESSION["password"] = $row['password'];
                $_SESSION["id"] = $row['id'];
                $_SESSION["department"] = $row['department'];
                $_SESSION["position"] = $row['position'];
                $_SESSION["employee_id"] = $row['employee_id'];
                $_SESSION["signature"] = $row['signature'];
                $_SESSION["lastname"] = $row['lastname'];
                if($type=="hr") {
                    // echo "<script>window.open('Admin-home.php', '_self')</script>";
                    header("Location: Admin-home.php");
                    exit();
                }
                // else if($type=="dephead"){
                //     echo "<script>window.open('Dephead-home.php', '_self')</script>";
                // }
                else{
                    // echo "<script>window.open('Home.php', '_self')</script>";
                    header("Location: Home.php");
                    exit();
                }
            
            }else{
                // echo "<script>alert('Invalid Username or Password');</script>";
                header("Location: sblogin.php?error=Incorrect Username or Password");
                exit();
            }
        }
}else{
    header("Location: sblogin.php"); 
    exit();  //Pag pinindot yung LOGIN ng no user and pass babalik lang sa login page
}