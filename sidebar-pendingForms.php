<!-- COLLAPSE - HEADER FORMS -->

<!-- ======================================================================================================================================-->
<!-- 1. CASH ADVANCE SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `cash_advances` WHERE `status` = 'pending'") as $count1) { 
              $value1 = $count1['COUNT(*)'];
              if($value1>0){
              $value1 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value1.'</span>';
              }else {
              $value1 = "";
              }
              ?>
<a class="collapse-item" href="Admin-1.php"><i class="fas fa-fw fa-wallet"></i>  Cash Advance <?php echo $value1; ?></a> 
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->


<!-- ======================================================================================================================================-->
<!-- 2. LEAVE SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `leaves` WHERE `status` = 'campus'") as $count2) { 
              $value2 = $count2['COUNT(*)'];
              if($value2>0){
              $value2 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value2.'</span>';
              }else {
              $value2 = "";
              }
              ?>
<a class="collapse-item" href="Admin-2.php"><i class="fas fa-fw fa-file-alt"></i> Leave <?php echo $value2; ?></a>
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->


<!-- ======================================================================================================================================-->
<!-- 3. OFFICIAL BUSINESS SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `official_businesses` WHERE `status` = 'recommended'") as $count3) { 
              $value3 = $count3['COUNT(*)'];
              if($value3>0){
              $value3 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value3.'</span>';
              }else {
              $value3 = "";
              }
              ?>
<a class="collapse-item" href="Admin-4.php"><i class="fas fa-fw fa-building"></i>  Official Business <?php echo $value3; ?></a>
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->



<!-- ======================================================================================================================================-->
<!-- 4. OVERTIME SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `overtimes` WHERE `status` = 'recommended'") as $count4) { 
              $value4 = $count4['COUNT(*)'];
              if($value4>0){
              $value4 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value4.'</span>';
              }else {
              $value4 = "";
              }
              ?>
<a class="collapse-item" href="Admin-5.php"><i class="fas fa-fw fa-user-clock"></i>  Overtime <?php echo $value4; ?></a>
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->



<!-- ======================================================================================================================================-->
<!-- 5. UNDERTIME SIDEBAR NOTIF==============================================================================================================-->
<!-- ======================================================================================================================================-->
<?php $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
              foreach($conn->query("SELECT COUNT(*) FROM `undertimes` WHERE `status` IN ('recommended','endorsed');") as $count5) { 
              $value5 = $count5['COUNT(*)'];
              if($value5>0){
              $value5 = '<span class="badge badge-danger"  style="vertical-align: top; font-size: 10px; margin-left:3px;">'.$value5.'</span>';
              }else {
              $value5 = "";
              }
              ?>
<a class="collapse-item" href="Admin-3.php"><i class="fas fa-fw fa-hourglass-half"></i>  Undertime <?php echo $value5; ?></a>
<?php } ?>
<!-- ======================================================================================================================================-->
<!-- ======================================================================================================================================-->