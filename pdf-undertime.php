<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['pdf'])) {
$id = $_POST['pdf_id'];
$exportName = "Undertime";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$queryUndertime = "SELECT * FROM `undertimes` WHERE `id` = '$id';";
$sqlUndertime = mysqli_query($connection, $queryUndertime);

$table = "";


while ($row = mysqli_fetch_array($sqlUndertime)) {

       
        //==============================================================================
        if (empty($row['emp_signature'])) { 
        $emp_sig = "";
        }else{
        $emp_sig = '<img src="img/signatura/'.$row['emp_signature'].'" width="110" height="90">';
        }
        //==============================================================================
        if (empty($row['reco_signature'])) { 
        $recommendor_sig = "";
        }else{
        $recommendor_sig = '<img src="img/signatura/'.$row['reco_signature'].'" width="110" height="90">';
        }
        //==============================================================================
        if (empty($row['adm_signature'])) { 
        $approver_sig = "";
        }else{
        $approver_sig = '<img src="img/signatura/'.$row['adm_signature'].'" width="110" height="90">';
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
        }else if(preg_match('/endorsed/',$row['status'])){
        $status = "Endorsed";
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
        // REMARKS
        //==============================================================================
        if (empty($row['remarks'])) { //KUNG MY REMARKS ISHOW SA TABLE PAG WALA BLANK LNG
            $remarks = "";
        }else{
            $remarks = $remarks.'
                <tr>
                <td colspan="3"><small>Remarks: </small><br><br><b>'.ucwords($row['remarks']).'</b></td>
                </tr>
            ';
        }

        //==============================================================================
        // TABLE
        //==============================================================================
        $table = $table.'
            <tr>
                <td><small>Employee ID: </small><b>'.$row['employee_id'].'</b></td>
                <td><small>Date Applied:   </small><b>'.date("F d, Y", strtotime($row['requested_at'])).'</b></td>
                <td><small>Serial No: </small><b>US No.'.$row['id'].'</b></td>
            </tr>
            
            <tr><td colspan="3"><small>Employee Name: </small><b>'.ucwords($row['requested_by']).'</b></td></tr>
            <tr><td colspan="3"><small>Department: </small><b>'.ucwords($row['department']).'</b></td></tr>

            <tr>
                <td><small>Time In: </small><b>'.date("g:i A", strtotime($row['time_in'])).'</b></td>
                <td><small>Time Out: </small><b>'.date("g:i A", strtotime($row['time_out'])).'</b></td>
                <td><small>Status: </small><b>'.ucwords($row['status']).'</b></td>
            </tr>

            <tr>
                <td colspan="3"><small>Reason: </small><br><br><b>'.ucwords($row['reason']).'</b></td>
            </tr>
        ';


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
        }else if($row['status']==='endorsed'){
        $table2 = $table2.'
            <tr>
                <td>Endorsed by: <br><br>'.$recommendor_sig.'<br><b>'.ucwords($row['endorsed_by']).'</b><small><br> '.$row['endorser_position'].'</small>
                    <br><small>Date: '.date("F j, Y g:i A", strtotime($row['endorsed_at'])).'</small>
                </td>
            </tr>
        ';
        }else{
        $table2 = $table2.'
        <tr>
            <td>Endorsed by: <br><br>'.$recommendor_sig.'<br><b>'.ucwords($row['endorsed_by']).'</b><small><br> '.$row['endorser_position'].'</small>
                <br><small>Date: '.date("F j, Y g:i A", strtotime($row['endorsed_at'])).'</small>
            </td>
            <td>Approved by: <br><br>'.$approver_sig.'<br><b>'.ucwords($row['approved_by']).'</b><small>, Administrator</small>
                <br><small>Date: '.date("F j, Y g:i A", strtotime($row['approved_at'])).'</small>
            </td>
        </tr>
            ';
        }
        // $table2 = $table2.'
        //     <tr>
        //         <td>Endorsed By: <br><br>'.$sig.'<br><b>'.ucwords($row['recommended_by']).'</b>, <small>'.ucwords($row['endorser_position']).'</small></td>
        //         <td>Action By: <br><br>'.$admin_sig.'<br><b>'.ucwords($row['approved_by']).'</b>, <small>Administrator</small><br><small>Date: '.date("F j, Y g:i A", strtotime($row['approved_at'])).'</small></td>
        //     </tr>
        // ';


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
        <tr><th colspan="3" style="text-align:center; padding:20px;">UNDERTIME SLIP</th></tr>
        '.$table.'
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
    header("Location: Admin-tables-undertime.php");
}
?>

