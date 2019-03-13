<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['user_id'])){
      $user_id = $_GET['user_id'];
      $sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_id = $user_id");
      $row = mysqli_fetch_array($sql);
      $email = $row['email'];
  }

?>
	    
<section class="content-header">
  <h3>User Details</h3>
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li><a href="users.php">Users</a></li>
  	<li class="active">User Details</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <p class="form-control-static"><?php echo "$email"; ?></p>
        </div>
      </div>
      <div class="form-group col-sm-12">
        <a class="btn btn btn-default" href="users.php">Back</a>
      </div>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>