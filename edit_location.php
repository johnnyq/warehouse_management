<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['location_id'])){
  	$location_id = $_GET['location_id'];
  	$sql = mysqli_query($mysqli,"SELECT * FROM locations WHERE location_id = $location_id");
  	$row = mysqli_fetch_array($sql);  
    $location_name = $row['location_name'];
	}

?>
<section class="content-header">	    
  <h4>Edit Location</h4>
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li><a href="locations.php">Locations</a></li>
  	<li class="active">Edit Location</li>
  </ol>
</section>    
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      
      <div id="response"></div>

      <form id="ajaxEditForm" class="form col-md-4" autocomplete="off">
        <input type="hidden" name="edit_location">
        <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">	     
        <div class="form-group">
          <label>Location</label>
          <input type="text" class="form-control" name="location_name" value="<?php echo "$location_name"; ?>" required>
          <br>
          <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>