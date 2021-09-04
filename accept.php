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

    if($_SESSION['type'] != 'hr'){
        echo "Sorry, only admins can accept or reject $display Requests.";
    }else{
        $query = "UPDATE `$table` SET `status` = 'accepted', `approved_at` = CURRENT_TIMESTAMP, `approved_by` = '$name' WHERE `id` = '$id';";
        if(performQuery($query)){
            echo "$display has been accepted.";
        }else{
            echo "Unknown error occured. Please try again.";
        }
    }
?>
<br><br>
<a href="Admin-<?php echo str_replace("_","",$_GET['type']) ?>.php">Take me back</a>

