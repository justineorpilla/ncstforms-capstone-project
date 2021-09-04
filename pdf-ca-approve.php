<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['export'])) {
    $exportName = "Cash Advance (Approved List)";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$queryCashAdvance = "SELECT * FROM `cash_advances` WHERE `status` = 'accepted';";
$sqlCashAdvance = mysqli_query($connection, $queryCashAdvance);

$rowCashAdvance = "";

while ($row = mysqli_fetch_array($sqlCashAdvance)) {
    $rowCashAdvance = $rowCashAdvance.'
        <tr>
            <td>CARF No.'.$row['id'].'</td>
            <td>'.ucwords($row['requested_by']).'</td>
            <td>'.$row['amount'].'</td>
            <td>'.date("M d, Y", strtotime($row['applied_at'])).'</td>
            <td>'.$row['approved_amount'].'</td>
            <td>'.$row['approved_by'].'</td>
            <td>'.date("M d, Y", strtotime($row['receiving_date'])).'</td>
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
        <tr>
            <th>SERIAL NO.</th>
            <th>EMPLOYEE NAME</th>
            <th>AMOUNT</th>
            <th>DATE NEEDED</th>
            <th>AMOUNT APPROVED</th>
            <th>APPROVED BY</th>
            <th>RECEIVING DATE</th>
        </tr>
        '.$rowCashAdvance.'
    </table>
';

$mpdf = new \Mpdf\Mpdf();
$mpdf->showImageErrors = true;
$mpdf->WriteHTML($html);
$mpdf->Output();

} else {
    echo '<script>window.location.href = "index.php"</script>';
}
?>

