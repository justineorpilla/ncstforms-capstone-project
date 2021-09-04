<?php //THIS IS FOR ADMIN-EMPLOYEES.PHP => ADD EMPLOYEE BUTTON AND DELETE BUTTON
require('conn.php');
    if(isset($_POST['save'])){ //ADD BUTTON
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $name = $fname." ".$lname;
        $empId = $_POST['eid'];
        $user_name = $empId;
        $pass = $lname;
        $type = $_POST['roll'];
        $dept = $_POST['dept'];
        $pos = $_POST['pos'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $message = "This account was created by the Administrator.";

        $add = "INSERT INTO `user` (`firstname`,`lastname`,`name`,`user_name`,`password`,`role`,`department`,`position`,`email`,`employee_id`,`address`,`contact`,`created_msg`) 
        VALUES ('$fname','$lname','$name','$user_name','$pass','$type','$dept','$pos','$email','$empId','$address','$contact')";
        $addQuery=mysqli_query($connection, $add);
        if($addQuery) {
            $_SESSION['status'] = "Account Successfully Created!";
            $_SESSION['status_code'] = "success";
            header('Location: Admin-employees.php');
            exit(0);
        }else{
            $_SESSION['status'] = "Account Not Successfully Created!";
            $_SESSION['status_code'] = "error";
            header('Location: Admin-employees.php');
        }
    }
?>

<?php //DELETE BUTTON 
if (isset($_POST['delete'])) 
{

     $deleteId=$_POST['delete_id'];
     
    $delete="DELETE FROM `user` WHERE id=$deleteId;";
    $deleteQuery=mysqli_query($connection,$delete);
       
    if($deleteQuery){
      $_SESSION['status'] = "Account has been Deleted!";
      $_SESSION['status_code'] = "success";
      header('Location: Admin-employees.php');
      exit(0);

    }else{
      $_SESSION['status'] = "Account Not Deleted";
      $_SESSION['status_code'] = "error";
      header('Location: Admin-employees.php');
    }   
}
?>
