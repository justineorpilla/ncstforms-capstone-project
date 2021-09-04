<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['pdf'])) {
$id = $_POST['pdf_id'];
$exportName = "Leave";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$querySub = "SELECT * FROM `leaves` WHERE `id` = '$id';";
$sqlSub = mysqli_query($connection, $querySub);

$table1 = "";



while ($row = mysqli_fetch_array($sqlSub)) {

//==============================================================================

        if (empty($row['receiving_date'])) {
            $receiving_date = "N/A";
        }else{
            $receiving_date = date("F d, Y", strtotime($row['receiving_date']));
        }

//==============================================================================
        if(preg_match('/accepted/',$row['status'])) {
            $status = "Approved";
        }else if(preg_match('/campus/',$row['status'])){
            $status = "Pending for Final Approval";
        }else if(preg_match('/endorsed/',$row['status'])){
            $status = "Endorsed for First Approval";
        }else if(preg_match('/recommended/',$row['status'])){
            $status = "Recommended";
        }else if(preg_match('/rejected/',$row['status'])){
            $status = "Denied";
        }else{
            $status = "Pending";
        }
//==============================================================================

    $table1 = $table1.'
        <tr>
            <td colspan="2"><small>Employee Name: </small><br><br><b>'.ucwords($row['requested_by']).'</b></td>
            <td><small>Serial No: </small><br><br><b style="color:red">ALF No.'.$row['id'].'</b></td>
        </tr>
        <tr>
            <td colspan="2"><small>Department/Section: </small><br><br><b>'.$row['department'].'</b></td>
            <td><small>Date Filed: </small><br><br><b>'.date("F j, Y", strtotime($row['requested_at'])).'</b></td>
            
        </tr>
        <tr>
           <td><small>Employment Status: </small><br><br><b>'.$row['employment'].'</b></td>
            <td><small>FROM (DATE): </small><br><br><b>'.date("M j, Y", strtotime($row['date_from'])).'</b></td>
            <td><small>TO (DATE): </small><br><br><b>'.date("M j, Y", strtotime($row['date_to'])).'</b></td>
        </tr>
        <tr>
            <td><small>Leave Code: </small><br><br><b>'.ucwords($row['type']).'</b></td>
            <td><small>With / Without Pay:</small><br><br><b>'.$row['withpay'].'</b></td>
            <td><small>Status: </small><br><br><b>'.$status.'</b></td>
        </tr>
        <tr>
            <td colspan="3"><small>Reason: </small><br><br><b>'.ucwords($row['reason']).'</b></td>
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
    if (empty($row['endorser_signature'])) { 
        $endorser_sig = "";
    }else{
        $endorser_sig = '<img src="img/signatura/'.$row['endorser_signature'].'" width="110" height="90">';
    }
//==============================================================================
    if (empty($row['approver_signature'])) { 
        $manager_sig = "";
    }else{
        $manager_sig = '<img src="img/signatura/'.$row['approver_signature'].'" width="110" height="90">';
    }
//==============================================================================
    if (empty($row['final_signature'])) {
        $final_sig = "";
    }else{
        $final_sig = '<img src="img/signatura/'.$row['final_signature'].'" width="110" height="90">';
    }
//==============================================================================
    if (empty($row['reject_signature'])) {
        $reject_sig = "";
    }else{
        $reject_sig = '<img src="img/signatura/'.$row['reject_signature'].'" width="110" height="90">';
    }
//==============================================================================


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
                    <td>Recommended by: <br><br>'.$recommendor_sig.'<br><b>'.ucwords($row['recommended_by']).'</b><small>, College Dean</small>
                        <br><small>Date: '.date("M j, Y g:i A", strtotime($row['recommended_at'])).'</small>
                    </td>
                </tr>
            ';
    }else if($row['status']==='endorsed'){
        $table2 = $table2.'
            <tr>
                <td>Endorsed by: <br><br>'.$endorser_sig.'<br><b>'.ucwords($row['endorsed_by']).'</b><small>, College Dean</small>
                    <br><small>Date: '.date("M j, Y g:i A", strtotime($row['endorsed_at'])).'</small>
                </td>
            </tr>
        ';
    }else if($row['status']==='accepted' && $row['type']==='Sick Leave'){
            $table2 = $table2.'
            <tr>
            <td>Recommended by: <br><br>'.$recommendor_sig.'<br><b>'.ucwords($row['recommended_by']).'</b><small><br> '.$row['recommendor_position'].'</small>
                <br><small>Date: '.date("M j, Y g:i A", strtotime($row['recommended_at'])).'</small>
            </td>
            <td>Endorsed by: <br><br>'.$endorser_sig.'<br><b>'.ucwords($row['endorsed_by']).'</b><small><br> '.$row['endorser_position'].'</small>
                <br><small>Date: '.date("M j, Y g:i A", strtotime($row['endorsed_at'])).'</small>
            </td>
            <td>First Approval by: <br><br>'.$manager_sig.'<br><b>'.ucwords($row['approve_manager']).'</b><small><br> College Dean</small>
                <br><small>Date: '.date("M j, Y g:i A", strtotime($row['approve_manager_at'])).'</small>
            </td>
            <td>Final Approved by: <br><br>'.$final_sig.'<br><b>'.ucwords($row['approved_by']).'</b><small><br> Administrator</small>
                <br><small>Date: '.date("M j, Y g:i A", strtotime($row['approved_at'])).'</small>
            </td>
            </tr>
        ';
    }else{ //APPROVED SHOW TABLE 2
            $table2 = $table2.'
            <tr>
            <td>Recommended by: <br><br>'.$recommendor_sig.'<br><b>'.ucwords($row['recommended_by']).'</b><small><br> '.$row['recommendor_position'].'</small>
                <br><small>Date: '.date("M j, Y g:i A", strtotime($row['recommended_at'])).'</small>
            </td>
            <td>First Approval by: <br><br>'.$manager_sig.'<br><b>'.ucwords($row['approve_manager']).'</b><small><br> College Dean</small>
                <br><small>Date: '.date("M j, Y g:i A", strtotime($row['approve_manager_at'])).'</small>
            </td>
            <td>Final Approved by: <br><br>'.$final_sig.'<br><b>'.ucwords($row['approved_by']).'</b><small><br> Administrator</small>
                <br><small>Date: '.date("M j, Y g:i A", strtotime($row['approved_at'])).'</small>
            </td>
            </tr>
             ';
    }
//==============================================================================
            $empTable = $empTable.'
                <tr>
                    <td>Employee Signature: <br><br>'.$emp_sig.'<br>'.ucwords($row['requested_by']).'</td>
                </tr>
            ';
}

//==============================================================================
//==============================================================================

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
        <tr><th colspan="3" style="text-align:center; padding:20px;">APPLICATION OF LEAVE</th></tr>
        '.$table1.'
        '.$remarks.'
    </table>

    <table style="margin-top: 20px; margin-top: 20px;
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
    header("Location: Admin-tables-leave.php");
}
?>

