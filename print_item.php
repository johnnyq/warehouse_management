<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['item_id'])){
      $item_id = $_GET['item_id'];
      $sql = mysqli_query($mysqli,"SELECT * FROM items, locations, aisles, levels, bays, users
            WHERE locations.location_id = aisles.location_id
            AND aisles.aisle_id = levels.aisle_id
            AND levels.level_id = bays.level_id
            AND bays.bay_id = items.bay_id
            AND users.user_id = items.checked_in_by
            AND items.item_id = $item_id"
      );
      $row = mysqli_fetch_array($sql);
      $item_id = $row['item_id'];
      $item = $row['item'];
      $container = $row['container'];
      $qty = $row['qty'];
      $checked_in_by = $row['email'];
      $checked_in_date = date("Y-m-d",$row['checked_in_date']);
      $location_name = $row['location_name'];
      $aisle_name = $row['aisle_name'];
      $level_name = $row['level_name'];
      $bay_name = $row['bay_name'];
      $bay_id = $row['bay_id'];

  }

?>
	    
<section class="content-header">
  <h3>Print Item Paperwork</h3>
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li><a href="items.php">Items</a></li>
  	<li class="active">Print</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-body text-center">
      <strong class="printh1"><?php echo "$item"; ?></strong>
      <br>
      <strong class="printh3"><?php echo "QTY $qty"; ?></strong>
      <br>
      <strong class="printh2"><?php echo "$checked_in_date"; ?></strong>
      <br>
      <strong class="printh3"><?php echo "$checked_in_by"; ?></strong>
      <br>
      <img alt="item id" src="includes/barcode.php?text=<?php echo "$item_id"; ?>&print=true&size=150" />
  </div>
</section>

<?php include "includes/footer.php"; ?>