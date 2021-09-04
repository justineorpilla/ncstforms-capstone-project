<?php
require('./conn.php');
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['export'])) {
$exportName = "Inter-Office Memorandum (Denied List)";
$currentDate = date("Y-m-d h:i:sA"); //Y-m-d h:m:s || F j, Y h:i:s A

$queryUT = "SELECT * FROM `ioms` WHERE MONTH(date_filed) = MONTH(CURRENT_DATE()) AND YEAR(date_filed) = YEAR(CURRENT_DATE());";
$sqlUT = mysqli_query($connection, $queryUT);

$rowUT = "";

while ($row = mysqli_fetch_array($sqlUT)) {
    $rowUT = $rowUT.'
        <tr>
            <td>ITO 080'.$row['id'].'</td>
            <td>'.ucwords($row['name']).'</td>
            <td>'.date("M d, Y", strtotime($row['date'])).'</td>
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
            <th>IOM REQUEST DATE</th>
            <th>STATUS</th>
        </tr>
        '.$rowUT.'
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

