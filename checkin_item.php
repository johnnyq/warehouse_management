<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
<section class="content-header">
  <h4>Checkin Item</h4>	    
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li><a href="users.php">Items</a></li>
  	<li class="active">Checkin Item</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">	    
      <div id="response"></div>

      <form id="ajaxAddForm" class="form col-md-4" autocomplete="off">
        <input type="hidden" name="checkin_item">
        <div class="form-group">
          <label>Item</label>
          <input type="text" class="form-control" name="item" required autofocus>
        </div>
        <div class="form-group">
          <label>Container</label>
          <select class="form-control" name="container" required>
            <option>Box</option>
            <option>Bin</option>
            <option>Pallot</option>
            <option>Gaylord</option>
            <option>Naked</option>
          </select>
        </div>
        <div class="form-group">
          <label>QTY</label>
          <input type="number" class="form-control" name="qty" required>
        </div>
        <div class="form-group">
          <label>Location</label>
          <select class="form-control" name="bay_id" required>
            <option></option>
            <?php 
            $sql = mysqli_query($mysqli,"SELECT * FROM locations, aisles, levels, bays
                   WHERE locations.location_id = aisles.location_id
                   AND aisles.aisle_id = levels.aisle_id
                   AND levels.level_id = bays.level_id"
            );
            while($row = mysqli_fetch_array($sql)){
              $location_id = $row['location_id'];
              $location_name = $row['location_name'];   
              $aisle_id = $row['aisle_id'];
              $aisle_name = $row['aisle_name'];
              $level_id = $row['level_id'];
              $level_name = strtoupper($row['level_name']);
              $bay_id = $row['bay_id'];
              $bay_name = $row['bay_name'];
              $sql2 = mysqli_query($mysqli,"SELECT * FROM items WHERE bay_id = $bay_id");
              $row2 = mysqli_fetch_array($sql2);
              $container = $row2['container'];
              if($container == "Gaylord" || $container == "Pallot"){
                $info = "FILLED";
              }elseif($container == "Box" || $container == "Bin" || $container == "Naked"){
                $info = "PARTLY FILLED";
              }elseif($container == ''){
                $info = "EMPTY";
              }

              echo "<option value='$bay_id'>$location_name - Aisle $aisle_name - Level $level_name - Bay $bay_name | $info</option>";
            }
            ?>
          </select>
          <br>
          <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Checkin</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>