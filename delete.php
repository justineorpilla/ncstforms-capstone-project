<?php 
require('./conn.php');

$id = $_GET['id'];
$query = mysqli_query($connection, "DELETE FROM user WHERE id ='$id'");

header('location: Admin-employees.php?m=1');
?>