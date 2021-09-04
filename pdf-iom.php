<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

// if (isset($_POST['pdf'])) {
// $id = $_POST['pdf_id'];
$exportName = "Inter-Office Memorandum";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$querySub = "SELECT * FROM `ioms` WHERE `id` = '3';";
$sqlSub = mysqli_query($connection, $querySub);

$table1 = "";



while ($row = mysqli_fetch_array($sqlSub)) {

//==============================================================================
if (empty($row['emp_signature'])) { 
    $emp_sig = "";
}else{
    $emp_sig = '<img src="img/signatura/'.$row['emp_signature'].'" width="110" height="90">';
}
//==============================================================================
if (empty($row['noter_signature'])) { 
    $noter_sig = "";
}else{
    $noter_sig = '<img src="img/signatura/'.$row['noter_signature'].'" width="110" height="90">';
}
//==============================================================================
if (empty($row['recipient_signature'])) { 
    $recipient_sig = "";
}else{
    $recipient_sig = '<img src="img/signatura/'.$row['recipient_signature'].'" width="110" height="90">';
}
//==============================================================================
if (empty($row['reject_signature'])) { 
    $reject_sig = "";
}else{
    $reject_sig = '<img src="img/signatura/'.$row['reject_signature'].'" width="110" height="90">';
}

//==============================================================================
//STATUS
//==============================================================================
if(preg_match('/accepted/',$row['status'])) {
    $status = "Approved";
}else if(preg_match('/noted/',$row['status'])){
    $status = "Noted - Pending for Approval";
}else if(preg_match('/rejected/',$row['status'])){
    $status = "Denied";
}else{
    $status = "Pending";
}
//==============================================================================
//==============================================================================
    $empTable = $empTable.'
    <tr>
        <td>Employee Signature: <br><br>'.$emp_sig.'<br><b>'.ucwords($row['name']).'</td>
    </tr>
    ';
//==============================================================================  
//============================================================================== 

    $table1 = $table1.'
        <tr>
            <td colspan="6">TO: <b>'.$row['dept_to'].'</b></td>
            <td colspan="6">FROM: <b>'.$row['dept_from'].'</b></td>
        </tr>
        <tr>
            <td colspan="9">RE: <b>'.ucwords($row['subject']).'</b></td>
            <td colspan="3">DATE: <b>'.date("M j, Y", strtotime($row['date'])).'</b></td>
        </tr>
        <tr>
            <td colspan="5">PRIORITY: <b>'.$row['priority'].'</b></td>
            <td colspan="4">STATUS: <b>'.$status.'</b></td>
            <td colspan="3">IOM Reference ID: <b style="color:red;">ITO 080'.$row[id].'</b></td>
        </tr>
        
        
    ';

//==============================================================================  
// MESSAGE
//============================================================================== 

    $message = $message.'
        <tr>
            <td>MESSAGE: <b>('.$row['priority2'].')</b><br><br><br>
            
            <b>'.ucwords($row['message']).'</b>
            </td>

        </tr>



    ';

//==============================================================================  
// REMARKS
//============================================================================== 

    if (empty($row['remarks'])) { //KUNG MY REMARKS ISHOW SA TABLE PAG WALA BLANK LNG
        $remarks = "";
    }else{
        $remarks = $remarks.'
            <tr>
            <td colspan="2">Remarks: <b>'.ucwords($row['remarks']).'</b></td>
            </tr>
        ';
    }


//==============================================================================  
// TABLE 2
//============================================================================== 
 

    if($row['status']==='pending'){ //BACK END NG ILALABAS NA TABLE KUNG PENDING, RECOMMENDED O APPROVE
            $table2 = "";
    }else if($row['status']==='rejected'){
            $table2 = $table2.'
                <tr>
                    <td>Rejected by: <br><br>'.$reject_sig.'<br><b>'.ucwords($row['reject_by']).'</b><small></small>
                        <br><small>Date: '.date("F j, Y g:i A", strtotime($row['reject_at'])).'</small>
                    </td>
                </tr>
            ';
    }else if($row['status']==='noted'){
            $table2 = $table2.'
                <tr>
                    <td>Noted by: <br><br>'.$noter_sig.'<br><b>'.ucwords($row['noted_by']).'</b><small><br> Department Head,<br>'.$row['dept_to'].'</small>
                    </td>
                </tr>
            ';
    }else{
            $table2 = $table2.'
            <tr>
                <td>Noted by: <br>'.$noter_sig.'<br><b>'.ucwords($row['noted_by']).'</b><small><br> Department Head,<br>'.$row['dept_to'].'</small>
                <br><small>Date: '.date("M j, Y g:i A", strtotime($row['noted_at'])).'</small>
                </td>
                <td>Approved by: <br>'.$recipient_sig.'<br><b>'.ucwords($row['recipient_name']).'</b><small><br> Department Head,<br>'.$row['dept_to'].'</small>
                    <br><small>Date: '.date("M j, Y g:i A", strtotime($row['recipient_date'])).'</small>
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
        <tr><th colspan="12" style="text-align:center; padding:20px;">INTER-OFFICE MEMORANDUM</th></tr>
        '.$table1.'
    </table>

    <table style="margin-top: 20px; margin-top: 20px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #000;">
        '.$message.'
        '.$remarks.'
    </table>

    <table style="margin-top: 20px; margin-top: 20px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;">
        '.$empTable.'
    </table>

    <table style="margin-top: 50px; margin-top: 60px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;">
        '.$table2.'
    </table>
';

$mpdf = new \Mpdf\Mpdf();
$mpdf->showImageErrors = true;
$mpdf->WriteHTML($html);
$mpdf->Output();

// } else {
//     header("Location: Admin-tables-iom.php");
// }
?>

