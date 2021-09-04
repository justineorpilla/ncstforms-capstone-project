<?php 
    session_start();
    include('functions.php');

    if(!isset($_GET['type']) || !isset($_GET['id'])){
        echo "Error. Incomplete Parameters."; die;
    }

    $id = $_GET['id'];
    $name = $_SESSION['name'];

    $table = toPlural($_GET['type']);
    $display = snakeCaseToWords($_GET['type']);

    
        $query = "DELETE FROM `$table` WHERE `id` = '$id';";
        if(performQuery($query)){
            echo "$display has been cancelled.";
        }else{
            echo "Unknown error occured. Please try again.";
        }
    
?>
<br><br>
<a href="status.php">Take me back</a>