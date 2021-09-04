<?php 
     require('./conn.php');
    $name = $_SESSION['name'];
    $queryCashAdvance = "SELECT * FROM `cash_advances` WHERE `requested_by` = '$name' ORDER BY `requested_at` DESC;";
    $sqlCashAdvance = mysqli_query($connection, $queryCashAdvance);
    
    $queryLeave = "SELECT * FROM `leaves` WHERE `requested_by` = '$name' ORDER BY `requested_at` DESC;";
    $sqlLeave = mysqli_query($connection, $queryLeave);

    $queryOB = "SELECT * FROM `official_businesses` WHERE `requested_by` = '$name' ORDER BY `requested_at` DESC;";
    $sqlOB = mysqli_query($connection, $queryOB);

    $queryOvertime = "SELECT * FROM `overtimes` WHERE `requested_by` = '$name' ORDER BY `requested_at` DESC;";
    $sqlOvertime = mysqli_query($connection, $queryOvertime);

    $queryUndertime = "SELECT * FROM `undertimes` WHERE `requested_by` = '$name' ORDER BY `requested_at` DESC;";
    $sqlUndertime = mysqli_query($connection, $queryUndertime);

    $querySub = "SELECT * FROM `substitutions` WHERE `requested_by` = '$name' ORDER BY `requested_at` DESC;";
    $sqlSub = mysqli_query($connection, $querySub);
     
?>