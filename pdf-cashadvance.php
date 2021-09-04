<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['pdf'])) {
$id = $_POST['pdf_id'];
$exportName = "Cash Advance";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$queryCashAdvance = "SELECT * FROM `cash_advances` WHERE `id` = '$id';";
$sqlCashAdvance = mysqli_query($connection, $queryCashAdvance);

$table = "";



while ($row = mysqli_fetch_array($sqlCashAdvance)) {

//==============================================================================    
        if(preg_match('/Official/',$row['type'])) {
            $type = "<small>OFFICIAL <br> - For Liquidation</small>";
        }else{
            $type = "<small>PERSONAL <br> - For Salary Deduction</small>";
        }
//==============================================================================

        if (empty($row['receiving_date'])) {
            $receiving_date = "N/A";
        }else{
            $receiving_date = date("F d, Y", strtotime($row['receiving_date']));
        }

//==============================================================================
        if(preg_match('/final_approved/',$row['status'])) {
            $status = "Approved";
        }else if(preg_match('/accepted/',$row['status'])){
            $status = "Pending for Final Approval";
        }else if(preg_match('/rejected/',$row['status'])){
            $status = "Denied";
        }else{
            $status = "Pending";
        }
//==============================================================================


        $table = $table.'
            <tr>
                <td><small>Employee Name:</small><br><br><b>'.$row['requested_by'].'</b></td>
                <td><small>Date Applied:</small><br><br><b>'.date("F d, Y", strtotime($row['requested_at'])).'</b></td>
                <td><small>Serial No:</small><br><br><b style="color:red">CARF No.'.$row['id'].'</b></td>
            </tr>
            <tr>
                <td><small>Amount Applied:</small><br><br><b>P'.$row['amount'].'</b></td>
                <td><small>Date Needed:</small><br><br><b>'.date("F d, Y", strtotime($row['applied_at'])).'</b></td>
                <td><b>'.$type.'</b></td>
            </tr>
            <tr>
                <td><small>Amount Approved:</small><br><br><b>P'.$row['approved_amount'].'</b></td>
                <td><small>Date Released:</small><br><br><b>'.$receiving_date.'</b></td>
                <td><small>Status:</small><br><br><b>'.$status.'</b></td>
            </tr>
            <tr>
                <td colspan="3" style="padding:20px;">
                    <small>Purpose:</small><br><br><b>'.ucwords($row['purpose']).'</b>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="padding:20px;">
                    <small>For Office Use: Remarks & Notes: </small><br><br><b>'.ucwords($row['remarks']).'</b>
                </td>
            </tr>
        ';


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
        if (empty($row['approver_signature'])) { //IF NO SIGNATURE PRINT WALA, ELSE PAG MERON DISPLAY MO UNG SIGNATURE
            $sig = "";
        }else{
            $sig = '<img src="img/signatura/'.$row['approver_signature'].'" width="110" height="90">';
        }
//==============================================================================
        if (empty($row['final_signature'])) {
            $sig2 = "";
        }else{
            $sig2 = '<img src="img/signatura/'.$row['final_signature'].'" width="110" height="90">';
        }
//==============================================================================
        if (empty($row['reject_signature'])) {
            $sig3 = "";
        }else{
            $sig3 = '<img src="img/signatura/'.$row['reject_signature'].'" width="110" height="90">';
        }
//==============================================================================
        if($row['status']==='pending'){ //BACK END NG ILALABAS NA TABLE KUNG PENDING, RECOMMENDED O APPROVE
            $table2 = "";
        }else if($row['status']==='rejected'){
            $table2 = $table2.'
                <tr>
                    <td>Rejected by: <br><br>'.$sig3.'<br><b>'.ucwords($row['approved_by']).'</b><small></small>
                        <br><small>Date: '.date("F j, Y g:i A", strtotime($row['approved_at'])).'</small>
                    </td>
                </tr>
            ';
        }else if($row['status']==='accepted'){
            $table2 = $table2.'
                <tr>
                    <td>Approved by: <br><br>'.$sig.'<br><b>'.ucwords($row['approved_by']).'</b><small>, Administrator</small>
                        <br><small>Date: '.date("F j, Y g:i A", strtotime($row['approved_at'])).'</small>
                    </td>
                </tr>
            ';
        }else{
            $table2 = $table2.'
            <tr>
                <td>Approved by: <br><br>'.$sig.'<br><b>'.ucwords($row['approved_by']).'</b><small>, Administrator</small>
                    <br><small>Date: '.date("F j, Y g:i A", strtotime($row['approved_at'])).'</small>
                </td>
                <td>Final Approved by: <br><br>'.$sig2.'<br><b>'.ucwords($row['final_approved_by']).'</b><small>, Director of Administration</small>
                    <br><small>Date: '.date("F j, Y g:i A", strtotime($row['final_approved_at'])).'</small>
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
        <tr><th colspan="3" style="text-align:center; padding:20px;">CASH ADVANCE REQUEST FORM</th></tr>
        '.$table.'
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
    echo '<script>window.location.href = "Admin-tables-CashAdvance3.php"</script>';
}
?>

