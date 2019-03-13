<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
<section class="content-header">
  <h4>Add User</h4>	    
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li><a href="users.php">Users</a></li>
  	<li class="active">Add User</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">	    
      <div id="response"></div>

      <form id="ajaxAddForm" class="form col-md-4" autocomplete="off">
        <input type="hidden" name="add_user">
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" name="email" required autofocus>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" required>
          <br>
          <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>