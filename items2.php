<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

    if(isset($_GET['page'])){
	    $page = intval($_GET['page']);
	    $record_from = (($page)-1)*$config_max_records_per_page;
	    $record_to = $config_max_records_per_page;
	}else{
		$record_from = 0;
		$record_to = $config_max_records_per_page;
		$page = 1;
	}

    if(isset($_GET['query'])){
		$query = $_GET['query'];
	}

	
	$sql = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM items, locations, aisles, levels, bays, users
						WHERE locations.location_id = aisles.location_id
                   		AND aisles.aisle_id = levels.aisle_id
                   		AND levels.level_id = bays.level_id
                   		AND bays.bay_id = items.bay_id
						AND users.user_id = items.checked_in_by
						AND(item LIKE '%$query%'
						OR container LIKE '%$query%'
						OR location_name LIKE '%$query%'
						OR aisle_name LIKE '%$query%'
						OR level_name LIKE '%$query%'
						OR bay_name LIKE '%$query%'
						OR items.bay_id LIKE '%$query%'
						OR CONCAT(aisle_name,'-',level_name,'-',bay_name) LIKE '%$query%'
						OR email LIKE '%$query%')
		   				ORDER BY item_id DESC 
		   				LIMIT $record_from, $record_to");
	
	$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));
	$total_found_rows = $num_rows[0];
    $total_pages = ceil($total_found_rows / $config_max_records_per_page);

?>

<section class="content-header">
	<form autocomplete="off">
		<div class="row">
			<div class="col-sm-4 col-xs-8">
				<div class="input-group">
					<input type="text" class="form-control" name="query" value="<?php if(isset($query)){echo $query;} ?>" placeholder="Search" autofocus>
					<span class="input-group-btn">
						<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
			<div class="col-sm-8 col-xs-4">
				<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Checkin Item</a>
			</div>
		</div>
	</form>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-body">
		<div id="response"></div>
		<?php

		if($total_found_rows > 0) { 

		?>
		<div class="table-responsive">
			<table class="table table-hover">	
			    <thead>	
			        <tr>	
			            <th>ID</th>
						<th>Item</th>
						<th>Container</th>
						<th>QTY</th>
						<th>Checked In</th>
						<th>Location</th>
						<th>Action</th>
					</tr>
				</thead>
			    <tbody>
					
			        <?php

						while($row = mysqli_fetch_array($sql)){
			                $item_id = $row['item_id'];
			                $item = $row['item'];
			                $container = $row['container'];
			                $qty = $row['qty'];
			                $checked_in_by = $row['email'];
			                $checked_in_date = date($config_date_format,$row['checked_in_date']);
			                $location_name = $row['location_name'];
			                $aisle_name = $row['aisle_name'];
			                $level_name = strtoupper($row['level_name']);
			                $bay_name = $row['bay_name'];
			                $bay_id = $row['bay_id'];

			                echo "
								<tr>
									<td><img alt='item id' src='includes/barcode.php?text=$item_id' /></td>
									<td>$item</td>
									<td>$container</td>
									<td>$qty</td>
									<td>$checked_in_by<br>$checked_in_date</td>
									<td>$location_name<br>$aisle_name-$level_name-$bay_name</td>
									<td>
										<div class='btn-group'>
										    <a class='btn btn-default' href='edit_item.php?item_id=$item_id'><span class='glyphicon glyphicon-pencil'></span></a>
			                                <button class='btn btn-default delete_item' id='$item_id'><span class='glyphicon glyphicon-remove'></span></button>
			                                <a class='btn btn-default' href='item_details.php?item_id=$item_id'><span class='glyphicon glyphicon-eye-open'></span></a>
			                                <button class='btn btn-default checkout_item' id='$item_id'><span class='glyphicon glyphicon-truck'></span></button>
			                                <a class='btn btn-default' href='print_item.php?item_id=$item_id'><span class='glyphicon glyphicon-print'></span></a>
			                            </div>
									</td>
								</tr>
							";
						}
					?>
				
			    </tbody>
			</table>
		</div>

		<?php include("pagination.php"); ?>

		<?php

			}else{
				echo "<div class='alert alert-warning'>No records found.</div>";
			}
		?>
	</div>

</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Checkin Item</h4>
      </div>
      <form id="ajaxAddForm" class="form" autocomplete="off">
	      <div class="modal-body">    
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
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Checkin</button>
	      </div>
      </form>
    </div>
  </div>
</div>


<?php include "includes/footer.php"; ?>