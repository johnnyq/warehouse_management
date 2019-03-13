<?php
	
	$dbhost = "localhost";
	$dbusername = "root";
	$dbpassword = "password";
	$database = "admin_warehouse";

	$mysqli = mysqli_connect($dbhost, $dbusername, $dbpassword, $database);

	$config_date_format = "Y-m-d h:m:s";
	$config_app_name = "Warehouse Management";
	$config_app_icon = "<span class='fa fa-cube'></span>";
	$config_login_message = "Authorized Use Only!";
	$config_max_records_per_page = 10;
	$config_theme = "skin-blue";
?>
