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

	
	$sql = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM users WHERE email LIKE '%$query%' 
		   				ORDER BY user_id DESC 
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
					<input type="text" class="form-control" name="query" value="<?php if(isset($query)){echo $query;} ?>" placeholder="Search Users" autofocus>
					<span class="input-group-btn">
						<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
			<div class="col-sm-8 col-xs-4">
				<a class="btn btn-primary pull-right" href='add_user.php'><span class="glyphicon glyphicon-plus"></span> Add User</a>
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
			            <th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
			    <tbody>
					
			        <?php

						while($row = mysqli_fetch_array($sql)){
			                $user_id = $row['user_id'];
			                $email = $row['email'];          
			                echo "
								<tr>
									<td>$email</td>
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

			}else{
				echo "<div class='alert alert-warning'>No records found.</div>";
			}
		?>
	</div>
</section>

<?php include "includes/footer.php"; ?>