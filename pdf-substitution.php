<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['pdf'])) {
$id = $_POST['pdf_id'];
$exportName = "Substitution";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$querySub = "SELECT * FROM `substitutions` WHERE `id` = '$id';";
$sqlSub = mysqli_query($connection, $querySub);

$table1 = "";



while ($row = mysqli_fetch_array($sqlSub)) {

//==============================================================================
//STATUS
//==============================================================================
if(preg_match('/accepted/',$row['status'])) {
$status = "Approved";
}else if(preg_match('/noted/',$row['status'])){
$status = "Noted";
}else if(preg_match('/rejected/',$row['status'])){
$status = "Denied";
}else{
$status = "Pending";
}

    $table1 = $table1.'
        <tr>
            <td>Serial No: <b style="color:red">SF No.'.$row['id'].'</b></td>
            <td>Date Applied: <b>'.date("F d, Y", strtotime($row['requested_at'])).'</b></td>
        </tr>
        <tr>
            <td colspan="2">Substitute Instructor:  <b>'.ucwords($row['instructor']).'</b></td>
        </tr>
        <tr>    
            <td>Subject: <b>'.$row['subject'].'</b></td>
            <td>Section: <b>'.$row['section'].'</b></td>
        </tr>
        <tr>    
            <td>Time: <b>'.date("g:i A", strtotime($row['time'])).'</b></td>
            <td>No. of Hours: <b>'.$row['hours'].'</b></td>
        </tr>
        <tr>
            <td>Absent Instructor:  <b>'.ucwords($row['absent_instructor']).'</b></td>
            <td>Status:  <b>'.$status.'</b></td>
        </tr>
    ';

    if (empty($row['remarks'])) { //KUNG MY REMARKS ISHOW SA TABLE PAG WALA BLANK LNG
        $remarks = "";
    }else{
        $remarks = $remarks.'
            <tr>
            <td colspan="2">Remarks: <b>'.ucwords($row['remarks']).'</b></td>
            </tr>
        ';
    }


    if (empty($row['noter_signature'])) { //IF NO SIGNATURE PRINT WALA, ELSE PAG MERON DISPLAY MO UNG SIGNATURE
        $sig = "";
    }else{
        $sig = '<img src="img/signatura/'.$row['noter_signature'].'" width="110" height="90">';
    }

    if (empty($row['approver_signature'])) {
        $sig2 = "";
    }else{
        $sig2 = '<img src="img/signatura/'.$row['approver_signature'].'" width="110" height="90">';
    }


    if($row['status']==='pending'){ //BACK END NG ILALABAS NA TABLE KUNG PENDING, RECOMMENDED O APPROVE
            $table2 = "";
    }else if($row['status']==='rejected'){
            $table2 = $table2.'
                <tr>
                    <td>Rejected by: <br><br>'.$sig2.'<br><b>'.ucwords($row['approved_by']).'</b><small></small>
                        <br><small>Date: '.date("F j, Y g:i A", strtotime($row['approved_at'])).'</small>
                    </td>
                </tr>
            ';
    }else if($row['status']==='recommended'){
            $table2 = $table2.'
                <tr>
                    <td>Noted by: <br><br>'.$sig.'<br><b>'.ucwords($row['noted_by']).'</b><small>, College Dean</small>
                        <br><small>Date: '.date("F j, Y g:i A", strtotime($row['noted_at'])).'</small>
                    </td>
                </tr>
            ';
    }else{
            $table2 = $table2.'
            <tr>
                <td>Noted by: <br><br>'.$sig.'<br><b>'.ucwords($row['noted_by']).'</b><small>, College Dean</small>
                    <br><small>Date: '.date("F j, Y g:i A", strtotime($row['noted_at'])).'</small>
                </td>
                <td>Approved by: <br><br>'.$sig2.'<br><b>'.ucwords($row['approved_by']).'</b><small>, Dept coordinator</small>
                    <br><small>Date: '.date("F j, Y g:i A", strtotime($row['approved_at'])).'</small>
                </td>
            </tr>
             ';
    }

}
// ====================================================================

//=====================================================================

$html = ' 
    <link rel="stylesheet" href="./pdf.css">

    <table class="head">
        <tr>
            <th><img src="img/logo.jpg" width="110" height="90"></th>
            <th>
            <h3>NATIONAL COLLEGE OF SCIENCE AND TECHNOLOGY </h3><br>
            <p>Amafel Bldg. Aguinaldo Highway, Dasmarinas, Cavite.</p>
            </th> 
        </tr>
    </table>
    

    <table>
        <tr>
            <td><b>Form: </b></td>
            <td>'.$exportName.'</td>
        </tr>
        <tr>
            <td><b>Date Exported: </b></td>
            <td>'.$currentDate.'</td>
        </tr>
    </table>

    <table class="accounts-table">
        <tr><th colspan="2" style="text-align:center; padding:20px;">SUBSTITUTION FORM</th></tr>
        '.$table1.'
        '.$remarks.'
    </table>

    <table style="margin-top: 40px; margin-top: 50px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #dddddd;">
        '.$table2.'
    </table>
';

$mpdf = new \Mpdf\Mpdf();
$mpdf->showImageErrors = true;
$mpdf->WriteHTML($html);
$mpdf->Output();

} else {
    header("Location: Admin-tables-substitution.php");
}
?>

