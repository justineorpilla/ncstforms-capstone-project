<!-- =================================================================================================== -->
<!-- VIEW MODAL -->
<?php 
$emp = $row['employee_id'];
$fname = $row['firstname'];
$lname = $row['lastname'];
$name = $fname." ".$lname;
$email = $row['email'];
$home = $row['address'];
$num = $row['contact'];
$dept = $row['department'];
$pos = $row['position'];
$msg = $row['created_msg'];
?>
<div class="modal fade" id="view<?php echo $row['id'];?>" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> <!-- MODAL BODY -->

      <div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-6">
				<p>Name: <b><?php echo ucwords($name) ?></b></p>
				<p>Address: <b><?php echo ucwords($home) ?></b></p>
        <p>Email: <b><?php echo $email ?></b></p>
				<p>Contact #: <b><?php echo $num ?></b></p>
			</div>
			<div class="col-md-6">
        <p>Employee ID: <b><?php echo $emp ?></b></p>
				<p>Department: <b><?php echo ucwords($dept) ?></b></p>
				<p>Position: <b><?php echo ucwords($pos) ?></b></p>
			</div>
		</div>
    </div>
    </div>
		<hr>
    <div class="col-lg-12">
    <div class="col">
        <!-- <p>Leave Balance: <b>10</b></p> -->
        <small style="color:blue;">Note: <b><?php echo $msg;?></b></i>
         Accounts that are created by the Admins are provided by a default password while the accounts that are created by the User are verified by the Admins</small>
			</div>
    </div>  
        
      </div> <!-- END DIV MODAL BODY -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        
    </form>
          
    </div>
  </div>
</div>
    
    
