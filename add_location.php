<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
<section class="content-header">
  <h4>Add Location</h4>	    
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li><a href="locations.php">Locations</a></li>
  	<li class="active">Add Location</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">	    
      <div id="response"></div>

      <form id="ajaxAddForm" class="form col-md-4" autocomplete="off">
        <input type="hidden" name="add_location">
        <div class="form-group">
          <label>Location Name</label>
          <input type="text" class="form-control" name="location_name" required autofocus>
          <br>
          <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>