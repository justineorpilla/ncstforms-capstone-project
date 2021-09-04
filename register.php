<?php
require('conn.php');
    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $user_name = $_POST['username'];
        $pass = $_POST['password'];
        $type = $_POST['roll'];
        $dept = $_POST['dept'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];

        $sql = "INSERT INTO user (name,user_name,password,role,department,firstname,lastname,email) 
        VALUES ('$name','$user_name','$pass','$type','$dept','$fname','$lname','$email')";
        $q=mysqli_query($connection, $sql);
        if($q) {
            echo '<script> alert("Success")</script>';
            header('Location: Admin-employees.php');
        }else{
            echo '<script> alert("Registration Failed")</script>';
        }
    }
?>
