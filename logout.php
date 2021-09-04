<?php
session_start();
// unset($_SESSION['user_name']);
// header('location:index.php');
// die();
session_unset();
session_destroy();
header("Location: index.php");
?>