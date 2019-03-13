<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>
<section class="content-header">
  <h4>Add Aisle</h4>	    
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li><a href="aisles.php">Aisles</a></li>
  	<li class="active">Add Aisle</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">	    
      <div id="response"></div>

      <form id="ajaxAddForm" class="form col-md-4" autocomplete="off">
        <input type="hidden" name="add_aisle">
        <div class="form-group">
          <label>Aisle Name</label>
          <input type="text" class="form-control" name="aisle" value="<?php echo "$aisle_name"; ?>" required autofocus>
        </div>
        <div class="form-group">
          <label>Number of Levels</label>
          <input type="number" class="form-control" name="num_of_levels" required>
        </div>
        <div class="form-group">
          <label>Number of Bays per Level</label>
          <input type="number" class="form-control" name="num_of_bays" required>
        </div>
        <div class="form-group">
          <label>Location</label>
          <select class="form-control" name="location_id" required>
            <option></option>
            <?php 
            $sql = mysqli_query($mysqli,"SELECT * FROM locations");
            while($row = mysqli_fetch_array($sql)){
                      $location_id = $row['location_id'];
                      $location_name = $row['location_name'];   
              echo "<option value='$location_id'>$location_name</option>";
            }
            ?>
          </select>
          <br>
          <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Submit</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>