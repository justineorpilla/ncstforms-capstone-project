    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Home.php">
        <div class="sidebar-brand-icon">
           <img class="sidebar-logo" src="img/NCST.png">
        </div>
          <div class="sidebar-brand-text mx-3" style="color:yellow">NCST</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="Home.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        PROFILE
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="updateprofile.php">
           <i class="fas fa-fw fa-user"></i>
          <span>My account</span></a>
      </li>

     

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        SERVICES
      </div>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
<?php if($_SESSION['position']=='Department Head') { ?>
  <li class="nav-item">
        <a class="nav-link" href="pending-tables.php">
        <i class="fas fa-fw fa-clock"></i>
        <!-- <i class="fas fa-file-alt"></i> -->
          <span>Pending Application</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pending-iom.php">
        <i class="fas fa-drafting-compass"></i>
        <!-- <i class="fas fa-file-alt"></i> -->
          <span>IOM</span></a>
      </li>

<?php } ?>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->


<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
<?php if($_SESSION['position']=='School Nurse') { ?>
  <li class="nav-item">
  <a class="nav-link" href="pending-tables.php">
  <i class="fas fa-fw fa-clock"></i>
  <!-- <i class="fas fa-file-alt"></i> -->
    <span>Pending Application</span></a>
</li>
<?php } ?>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->


<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
<?php if($_SESSION['position']=='Campus Manager') { ?>
  <li class="nav-item">
  <a class="nav-link" href="pending-tables.php">
  <i class="fas fa-fw fa-clock"></i>
  <!-- <i class="fas fa-file-alt"></i> -->
    <span>Pending Application</span></a>
</li>
<?php } ?>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->

<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
<?php if($_SESSION['position']=='College Dean') { ?>
  <li class="nav-item">
  <a class="nav-link" href="pending-tables.php">
  <i class="fas fa-fw fa-clock"></i>
  <!-- <i class="fas fa-file-alt"></i> -->
    <span>Pending Application</span></a>
</li>
<?php } ?>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
  

<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
<?php if($_SESSION['position']=='Department Coordinator') { ?>
  <li class="nav-item">
  <a class="nav-link" href="pending-tables.php">
  <i class="fas fa-fw fa-clock"></i>
  <!-- <i class="fas fa-file-alt"></i> -->
    <span>Pending Application</span></a>
</li>
<?php } ?>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
  
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
<?php if($_SESSION['position']=='Director of Administration') { ?>
  <li class="nav-item">
  <a class="nav-link" href="pending-tables.php">
  <i class="fas fa-fw fa-clock"></i>
  <!-- <i class="fas fa-file-alt"></i> -->
    <span>Pending Application</span></a>
</li>
<?php } ?>
<!-- =================================================================================================================-->
<!-- =================================================================================================================-->
  
   
   
   
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Forms</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Forms:</h6>
            <a class="collapse-item" href="cashadvance.php"><i class="fas fa-fw fa-wallet"></i>  Cash Advance</a> 
            <a class="collapse-item" href="leave.php"><i class="fas fa-fw fa-file-alt"></i> Leave</a>
            <a class="collapse-item" href="officialbusiness.php"><i class="fas fa-fw fa-building"></i>  Official Business</a>
            <a class="collapse-item" href="overtime.php"><i class="fas fa-fw fa-user-clock"></i>  Overtime</a>
            <a class="collapse-item" href="undertime.php"><i class="fas fa-fw fa-hourglass-half"></i>  Undertime</a>
            <a class="collapse-item" href="substitution.php"><i class="fas fa-fw fa-user-friends"></i>  Substitution</a>
            <a class="collapse-item" href="iom.php"><i class="fas fa-fw fa-drafting-compass"></i>  IOM</a>
            <!-- <i class="fas fa-drafting-compass"></i> -->
            <div class="collapse-divider"></div>

          </div>
        </div>
      </li>

 

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="status.php">
        <!-- <i class="fas fa-fw fa-clock"></i> -->
        <i class="fas fa-fw fa-file-alt"></i>
          <span>Status</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

  