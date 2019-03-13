<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	$items_in = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM items WHERE DATE(FROM_UNIXTIME(checked_in_date)) = CURDATE()"));
	$items_out = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM items WHERE DATE(FROM_UNIXTIME(checked_out_date)) = CURDATE()"));
	$items_total = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM items"));
	$locations_total = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM locations"));
?>

<section class="content-header">
  <h3>Dashboard</h3>	    
  <ol class="breadcrumb">
  	<li><a href="index.php">Home</a></li>
  	<li class="active">Dashboard</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="info-box">
		  <!-- Apply any bg-* class to to the icon to color it -->
			  <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Items In Today</span>
			    <span class="info-box-number"><?php echo $items_in; ?></span>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-md-3">
			<div class="info-box">
		  <!-- Apply any bg-* class to to the icon to color it -->
			  <span class="info-box-icon bg-blue"><i class="fa fa-star"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Items Out Today</span>
			    <span class="info-box-number"><?php echo $items_out; ?></span>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-md-3">
			<div class="info-box">
		  <!-- Apply any bg-* class to to the icon to color it -->
			  <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Total Items</span>
			    <span class="info-box-number"><?php echo $items_total; ?></span>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-md-3">
			<div class="info-box">
		  <!-- Apply any bg-* class to to the icon to color it -->
			  <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Number of Warehouses</span>
			    <span class="info-box-number"><?php echo $locations_total; ?></span>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
	</div>
	<div class="box box-default">
		<div class="box-body">
			<div class="row">
			<?php 
				$sql = mysqli_query($mysqli,"SELECT * FROM aisles"); 
				while($row = mysqli_fetch_array($sql)){
	                $aisle_id = $row['aisle_id'];
	                $aisle_name = $row['aisle_name'];          
	                echo "
	                	<div class='col-sm-3'>
	                		<table class='table table-bordered table-condensed'>
	                		<h3 class='text-center'>Aisle $aisle_name</h3>
	                		<thead>
	                			<tr>
                                    <th></th><th class='text-center' colspan='20'>Bays</th>
                                </tr>
	                ";
	                $sql2 = mysqli_query($mysqli,"SELECT * FROM levels WHERE aisle_id = $aisle_id ORDER BY level_id DESC" );
	                while($row2 = mysqli_fetch_array($sql2)){
	                	$level_id = $row2['level_id'];
	                	$level_name = strtoupper($row2['level_name']);
	                	echo "<td><strong>Level $level_name</strong></td>";
		                $sql3 = mysqli_query($mysqli,"SELECT * FROM bays WHERE level_id = $level_id");
		                while($row3 = mysqli_fetch_array($sql3)){
		                	$bay_id = $row3['bay_id'];
		                	$bay_name = $row3['bay_name'];
		                	$sql4 = mysqli_query($mysqli,"SELECT * FROM items WHERE bay_id = $bay_id");
		                	$row4 = mysqli_fetch_array($sql4);
	                		$container = $row4['container'];
		                	if($container == "Gaylord" || $container == "Pallot"){
		                		$color = "danger";
		                	}elseif($container == "Box" || $container == "Bin" || $container == "Naked"){
		                		$color = "warning";
		                	}elseif($container == ''){
		                		$color = "success";
		                	}
		                	echo "<td class='$color text-center'><strong>$aisle_name-$level_name-$bay_name</strong><br>$container</td>";
		                }
                        echo "</tr>";
		            }
	                echo "</table></div>";
			    }
			?>
			</div>
		</div>
	</div>
</section>

<?php include "includes/footer.php"; ?>