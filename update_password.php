<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['session_user_id'])){
	  	$user_id = $_GET['session_user_id'];
	}

?>
	    
<section class="content-header">
	<h3>Update Password</h3>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-body">
		    <div id="response"></div>
		    <form id="ajaxEditForm" class="form col-md-4" autocomplete="off">
		      <input type="hidden" name="update_password">
		      <div class="form-group">
		        <label>New Password</label>
		        <input type="password" class="form-control" name="password" required>
		        <br>
		        <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Submit</button>
		      </div>
		    </form>
		</div>
	</div>
</section>
<?php include "includes/footer.php"; ?>