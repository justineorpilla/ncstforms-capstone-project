<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['pdf'])) {
$id = $_POST['pdf_id'];
$exportName = "Official Business";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$querySub = "SELECT * FROM `official_businesses` WHERE `id` = '$id';";
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
if (empty($row['recommendor_signature'])) { 
    $recommendor_sig = "";
}else{
    $recommendor_sig = '<img src="img/signatura/'.$row['recommendor_signature'].'" width="110" height="90">';
}
//==============================================================================
if (empty($row['approver_signature'])) { 
    $approver_sig = "";
}else{
    $approver_sig = '<img src="img/signatura/'.$row['approver_signature'].'" width="110" height="90">';
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
}else if(preg_match('/recommended/',$row['status'])){
    $status = "Recommended";
}else if(preg_match('/rejected/',$row['status'])){
    $status = "Denied";
}else{
    $status = "Pending";
}
//==============================================================================
//==============================================================================
    $empTable = $empTable.'
    <tr>
        <td>Employee Signature: <br><br>'.$emp_sig.'<br>'.ucwords($row['requested_by']).'</td>
    </tr>
    ';
//==============================================================================  
//============================================================================== 

    $table1 = $table1.'
        <tr>
            <td colspan="4"><small>Employee Name/ Designation/ Department:</small><br><br><b>'
                .ucwords($row['requested_by']).'/ '.ucwords($row['designation']).'/ '.$row['department'].'
            </b></td>
            <td colspan="2"><small>OB Date: </small><br><br><b>'.date("F j, Y", strtotime($row['date'])).'</b></td>
            <td colspan="2"><small>Serial #: </small><br><br><b style="color:red">OBA No.'.$row['id'].'</b></td>
        </tr>
        <tr>
            <td><b><small>ESTIMATE TIME OF ARRIVAL <br>(ETA)</small></td>
            <td><b><small>ESTIMATE TIME OF DEPARTURE <br>(ETD)</small></td>
            <td colspan="2"><b><small>OFFICE TO VISIT</small></td>
            <td colspan="2"><b><small>PERSON TO VISIT</small></td>
            <td colspan="2"><b><small>PURPOSE OF VISIT</small></td>
        </tr>
        <tr>
            <td>'.date("g:i A", strtotime($row['eta'])).'</td>
            <td>'.date("g:i A", strtotime($row['etd'])).'</td>
            <td colspan="2">'.ucwords($row['office_to_visit']).'</td>
            <td colspan="2">'.ucwords($row['person_to_visit']).'</td>
            <td colspan="2">'.ucwords($row['purpose_of_visit']).'</td>
        </tr>
        <tr>    
        <td colspan="2"><small><b>OB MODE OF TRANSPORT</small><br><br>'.$row['mode_of_transport'].'</td>
        <td colspan="2"><small><b>PRE OB-ORIGIN/ ETD</small><br><br>'.$row['origin'].' / '.date("g:i A", strtotime($row['origin_etd'])).'</td>
        <td colspan="2"><small><b>POST OB-DESTINATION/ ETA</small><br><br>'.$row['destination'].' / '.date("g:i A", strtotime($row['desti_eta'])).'</td>
        <td colspan="2"><small><b>STATUS</small><br><br>'.$status.'</td>
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
                    <td>Rejected by: <br><br>'.$reject_sig.'<br><b>'.ucwords($row['approved_by']).'</b><small></small>
                        <br><small>Date: '.date("F j, Y g:i A", strtotime($row['approved_at'])).'</small>
                    </td>
                </tr>
            ';
    }else if($row['status']==='recommended'){
            $table2 = $table2.'
                <tr>
                    <td>Recommended by: <br><br>'.$recommendor_sig.'<br><b>'.ucwords($row['recommended_by']).'</b><small><br> Department Head</small>
                    </td>
                </tr>
            ';
    }else{
            $table2 = $table2.'
            <tr>
                <td>Recommended by: <br><br>'.$recommendor_sig.'<br><b>'.ucwords($row['recommended_by']).'</b><small><br> Department Head</small>
                </td>
                <td>Approved by: <br><br>'.$approver_sig.'<br><b>'.ucwords($row['approved_by']).'</b><small>, Administrator</small>
                    <br><small>Date: '.date("M j, Y g:i A", strtotime($row['approved_at'])).'</small>
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
        <tr><th colspan="8" style="text-align:center; padding:20px;">OFFICIAL BUSINESS AUTHORIZATION</th></tr>
        '.$table1.'
        '.$remarks.'
    </table>

    <table style="margin-top: 40px; margin-top: 50px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;">
        '.$empTable.'
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
    header("Location: Admin-tables-OB.php");
}
?>

