<?php 
require('./conn.php');
session_start();
?>

<?php
if (isset($_POST['update'])) 
{
   
     $id=$_POST['newId'];
     $deptName=$_POST['dname'];
    
    
    $sql="UPDATE `ncst-departments` SET `department`='$deptName' where id=$id;";
    $query=mysqli_query($connection,$sql);
       
    if($query){
      echo '<script>alert("Updated Successfully");</script>';
      echo '<script>window.location.href = "/k/Admin-department.php"</script>';
    }
         
}
?>