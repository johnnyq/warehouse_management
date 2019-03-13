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
    $password = $row['password'];
	}

?>
<section class="content-header">	    
  <h4>Edit User</h4>
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li><a href="users.php">Users</a></li>
  	<li class="active">Edit User</li>
  </ol>
</section>    
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      
      <div id="response"></div>

      <form id="ajaxEditForm" class="form col-md-4" autocomplete="off">
        <input type="hidden" name="edit_user">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">	     
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" value="<?php echo "$email"; ?>" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" value="<?php echo "$password"; ?>">
          <br>
          <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>