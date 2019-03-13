<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

    $date_from = $_GET['date_from'];
	$date_to = $_GET['date_to'];

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
	if(!empty($_GET['date_from']) or !empty($_GET['date_to']) or !empty($_GET['canned_date'])){	
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$canned_date = $_GET['canned_date'];
		if($canned_date == 'today'){
			$date_from = date("Y-m-d");
			$date_to = $date_from;
		}elseif($canned_date == "yesterday"){
			$date_from = date("Y-m-d",strtotime('yesterday'));
			$date_to = $date_from;
		}elseif($canned_date == "week_to_date"){
			$date_from = date("Y-m-d",strtotime('last monday'));
			$date_to = date("Y-m-d");
		}elseif($canned_date == "last_week"){
			$date_from = date("Y-m-d",strtotime('last week'));
			$date_to = date("Y-m-d",strtotime('last week + 7 days'));
		}elseif($canned_date == "month_to_date"){
			$date_from = date("Y-m-d",strtotime('first day of this month'));
			$date_to = date("Y-m-d");
		}elseif($canned_date == "last_month"){
			$date_from = date("Y-m-d",strtotime('first day of last month'));
			$date_to = date("Y-m-d",strtotime('last day of last month'));
		}elseif($canned_date == "year_to_date"){
			$date_from = date("Y-m-d",strtotime('first day of january this year'));
			$date_to = date("Y-m-d");
		}elseif($canned_date == "last_year"){
			$date_from = date("Y-m-d",strtotime('first day of january last year'));
			$date_to = date("Y-m-d",strtotime('last day of december last year'));
		}
		$sql = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM users WHERE email LIKE '%$query%' AND user_created BETWEEN UNIX_TIMESTAMP('$date_from') AND UNIX_TIMESTAMP('$date_to 23:59:59') ORDER BY user_id DESC LIMIT $record_from, $record_to");
	}else{
		$sql = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM users WHERE email LIKE '%$query%' 
		   				OR last_name LIKE '%$query%' 
		   				OR first_name LIKE '%$query%' 
		   				OR CONCAT(first_name,' ',last_name) LIKE '%$query%' 
		   				OR phone LIKE '%$query%' 
		   				ORDER BY user_id DESC 
		   				LIMIT $record_from, $record_to");
	}
	
	$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));
	$total_found_rows = $num_rows[0];
    $total_pages = ceil($total_found_rows / $config_max_records_per_page);

?>

<section class="content-header">
	<form class="form-inline" autocomplete="off">
		<div class="row">
			<div class="col-sm-10 col-xs-8">
				<select class="form-control" name="canned_date">
					<option>Custom</option>
					<option value="today" <?php if($canned_date == "today"){ echo "selected"; } ?>>Today</option>
					<option value="yesterday" <?php if($canned_date == "yesterday"){ echo "selected"; } ?>>Yesterday</option>
					<option value="week_to_date" <?php if($canned_date == "week_to_date"){ echo "selected"; } ?>>Week to Date</option>
					<option value="last_week" <?php if($canned_date == "last_week"){ echo "selected"; } ?>>Last Week</option>
					<option value="month_to_date" <?php if($canned_date == "month_to_date"){ echo "selected"; } ?>>Month to Date</option>
					<option value="last_month" <?php if($canned_date == "last_month"){ echo "selected"; } ?>>Last Month</option>
					<option value="year_to_date" <?php if($canned_date == "year_to_date"){ echo "selected"; } ?>>Year to Date</option>
					<option value="last_year"" <?php if($canned_date == "last_year"){ echo "selected"; } ?>>Last Year</option>
				</select>
				<input type="date" class="form-control" name="date_from" value="<?php if(isset($date_from)){echo $date_from;} ?>" placeholder="Date From">
				<input type="date" class="form-control" name="date_to" value="<?php if(isset($date_to)){echo $date_to;} ?>" placeholder="Date To">
				<div class="input-group">
					<input type="text" class="form-control" name="query" value="<?php if(isset($query)){echo $query;} ?>" placeholder="Search Users">
					<span class="input-group-btn">
						<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
			<div class="col-sm-2 col-xs-4">
				<a class="btn btn-primary pull-right" href='add_user.php'><span class="glyphicon glyphicon-plus"></span> Add User</a>
			</div>
		</div>
	</form>
</section>


<div id="response"></div>
<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<?php

			if($total_found_rows > 0) { 

			?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">	
				    <thead>	
				        <tr>	
				            <th>Name</th>
				            <th>Email</th>
				            <th>Phone</th>
							<th>Created</th>
							<th>Action</th>
						</tr>
					</thead>
				    <tbody>
						
				        <?php

							while($row = mysqli_fetch_array($sql)){
				                $user_id = $row['user_id'];
				                $first_name = $row['first_name'];
				                $last_name = $row['last_name'];
				                $email = $row['email'];
				                $phone = $row['phone'];
				                if(strlen($phone)>2){ $phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);}
				                $user_created = date($config_date_format,$row['user_created']);               
				                echo "
									<tr>
										<td>$first_name $last_name</td>
										<td>$email</td>
										<td>$phone</td>
										<td>$user_created</td>
										<td>
											<div class='btn-group'>
											    <a class='btn btn-default' href='edit_user.php?user_id=$user_id'><span class='glyphicon glyphicon-pencil'></span></a>
				                                <button class='btn btn-default delete_user' id='$user_id'><span class='glyphicon glyphicon-remove'></span></button>
				                                <a class='btn btn-default' href='user_details.php?user_id=$user_id'><span class='glyphicon glyphicon-eye-open'></span></a>
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
				echo "<div class='pull-right'><br>Total Records: $total_found_rows</div>";
				}else{
					echo "<div class='alert alert-warning'>No records found.</div>";
				}
			?>
		</div>
	</div>
</section>

<?php include "includes/footer.php"; ?>

?>