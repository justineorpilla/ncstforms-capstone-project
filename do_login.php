<?php 
    require('conn.php');
    session_start();

    if(isset($_POST['login'])){
        $user_name=$_POST['username'];
        $pass=$_POST['password'];

       
        $sql="SELECT * FROM user WHERE user_name='$user_name' AND password='$pass'";
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
            if($type=="hr") {
                echo "<script>window.open('Admin-home.php', '_self')</script>";
            }
            // else if($type=="dephead"){
            //     echo "<script>window.open('Dephead-home.php', '_self')</script>";
            // }
            else{
                echo "<script>window.open('Home.php', '_self')</script>";
            }
        
        }else{
            echo "<script>alert('Invalid Username or Password');</script>";
            header('location:index.php');
        }
      
   
      }
    
?>
