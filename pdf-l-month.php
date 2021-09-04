<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['export'])) {
    $exportName = "Leave (This Month)";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$queryLeave = "SELECT * FROM `leaves` WHERE MONTH(requested_at) = MONTH(CURRENT_DATE()) AND YEAR(requested_at) = YEAR(CURRENT_DATE());";
$sqlLeave = mysqli_query($connection, $queryLeave);

$rowLeave = "";

while ($row = mysqli_fetch_array($sqlLeave)) {
    $rowLeave = $rowLeave.'
        <tr>
            <td>ALF No.'.$row['id'].'</td>
            <td>'.ucwords($row['requested_by']).'</td>
            <td>'.$row['type'].'</td>
            <td>'.date("M d, Y", strtotime($row['date_from'])).'</td>
            <td>'.date("M d, Y", strtotime($row['date_to'])).'</td>
            <td>'.ucwords($row['status']).'</td>
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
            <th>LEAVE TYPE</th>
            <th>LEAVE FROM</th>
            <th>LEAVE TO</th>
            <th>STATUS</th>
        </tr>
        '.$rowLeave.'
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

