<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['export'])) {
    $exportName = "Cash Advance (Pending Applications)";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$queryCashAdvance = "SELECT * FROM `cash_advances` WHERE `status` IN ('accepted','pending');";
$sqlCashAdvance = mysqli_query($connection, $queryCashAdvance);

$rowCashAdvance = "";

while ($row = mysqli_fetch_array($sqlCashAdvance)) {


    if(preg_match('/final_approved/',$row['status'])) { 
        $status = "Approved";
     }else if(preg_match('/accepted/',$row['status'])){ 
        $status = "Pending"; 
     }else if(preg_match('/rejected/',$row['status'])){ 
        $status = "Denied";
     }else{ 
        $status = "Pending";
     } 

    $rowCashAdvance = $rowCashAdvance.'
        <tr>
            <td>CARF No.'.$row['id'].'</td>
            <td>'.$row['requested_by'].'</td>
            <td>'.$row['amount'].'</td>
            <td>'.date("M d, Y", strtotime($row['applied_at'])).'</td>
            <td>'.ucwords($row['purpose']).'</td>
            <td>'.$status.'</td>
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
            <th>PURPOSE</th>
            <th>STATUS</th>
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

