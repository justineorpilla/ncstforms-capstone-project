<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

$exportName = "Cash Advance";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$queryCashAdvance = "SELECT * FROM `cash_advances` WHERE `id` = '18';";
$sqlCashAdvance = mysqli_query($connection, $queryCashAdvance);

$rowCashAdvance = "";



while ($row = mysqli_fetch_array($sqlCashAdvance)) {
    if(preg_match('/Official/',$row['type'])) {
        $type = "OFFICIAL - <small>For Liquidation</small>";
    }else{
        $type = "PERSONAL - <small>For Salary Deduction</small>";
    }

    $rowCashAdvance = $rowCashAdvance.'
        <tr>
            <td><small>Employee Name:</small><br><br><b>'.$row['requested_by'].'</b></td>
            <td><small>Date Applied:</small><br><br><b>'.date("F d, Y", strtotime($row['requested_at'])).'</b></td>
            <td><small>Serial No:</small><br><br><b>CARF No.'.$row['id'].'</b></td>
        </tr>
        <tr>
            <td><small>Amount Applied:</small><br><br><b>P'.$row['amount'].'</b></td>
            <td><small>Date Needed:</small><br><br><b>'.date("F d, Y", strtotime($row['applied_at'])).'</b></td>
            <td><b>'.$type.'</b></td>
        </tr>
        <tr>
            <td><small>Amount Approved:</small><br><br><b>P'.$row['approved_amount'].'</b></td>
            <td colspan="2"><small>Date Received:</small><br><br><b>'.date("F d, Y", strtotime($row['receiving_date'])).'</b></td>
       </tr>
        <tr>
            <td colspan="3" style="padding:20px;">
                <small>Purpose:</small><br><br><b>'.$row['purpose'].'</b>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding:20px;">
                <small>For Office Use: Remarks & Notes: </small><br><br><b>'.ucwords($row['remarks']).'</b>
            </td>
        </tr>
    ';

    $rowCashAdvance2 = $rowCashAdvance2.'
       <tr>
          <td><img src="img/signatura/'.$row['signature'].'" width="110" height="90"></td>
          <td><img src="img/signatura/'.$row['signature2'].'" width="110" height="90"></td>
       </tr>
       <tr>
          <td><small>Employee Signature: '.ucwords($row['requested_by']).'</small><br><br></td>
          <td><small>Approved by: '.ucwords($row['approved_by']).'<br> Date: '.date("F d, Y", strtotime($row['approved_at'])).' </small><br><br></td>
       </tr>

    
    ';
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
        '.$rowCashAdvance.'
    </table>

    <table style="margin-top: 40px; margin-top: 50px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #dddddd;">
         '.$rowCashAdvance2.'
    </table>
';

$mpdf = new \Mpdf\Mpdf();
$mpdf->showImageErrors = true;
$mpdf->WriteHTML($html);
$mpdf->Output();

?>

