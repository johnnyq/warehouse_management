<?php

	include "config.php";
	include "includes/check_login.php";

	if(isset($_POST['add_user'])){
    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);
    mysqli_query($mysqli,"INSERT INTO users SET email = '$email', password = '$password'");
    echo "<div class='alert alert-warning'>User successfully added.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

	if(isset($_POST['edit_user'])){  
    $user_id = $_POST['user_id'];
    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);

    mysqli_query($mysqli,"UPDATE users SET email = '$email', password = '$password' WHERE user_id = $user_id");
    echo "<div class='alert alert-warning'>User successfully updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

	if(isset($_POST['delete_user'])){
    $user_id = $_POST['delete_user'];
    mysqli_query($mysqli,"DELETE FROM users WHERE user_id = $user_id");
  
  }

  if(isset($_POST['update_password'])){
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);
    mysqli_query($mysqli,"UPDATE users SET password = '$password' WHERE user_id = $user_id");
    echo "<div class='alert alert-warning'>Password successfully updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }
  if(isset($_POST['add_location'])){
    $location_name = mysqli_real_escape_string($mysqli,$_POST['location_name']);
    mysqli_query($mysqli,"INSERT INTO locations SET location_name = '$location_name'");
    echo "<div class='alert alert-warning'>Record successfully added.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }
  if(isset($_POST['edit_location'])){  
    $location_id = $_POST['location_id'];
    $location_name = mysqli_real_escape_string($mysqli,$_POST['location_name']);
    mysqli_query($mysqli,"UPDATE locations SET location_name = '$location_name' WHERE location_id = $location_id");
    echo "<div class='alert alert-warning'>User successfully updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }
  if(isset($_POST['delete_location'])){
    $location_id = $_POST['delete_location'];
    mysqli_query($mysqli,"DELETE FROM locations WHERE location_id = $location_id");
  
  }
  if(isset($_POST['checkin_item'])){
    $item = mysqli_real_escape_string($mysqli,$_POST['item']);
    $container = mysqli_real_escape_string($mysqli,$_POST['container']);
    $qty = $_POST['qty'];
    $bay_id = $_POST['bay_id'];
    mysqli_query($mysqli,"INSERT INTO items SET item = '$item', container = '$container', qty = $qty, checked_in_by = $session_user_id, bay_id = $bay_id, checked_in_date = UNIX_TIMESTAMP(now())");
    echo "<div class='alert alert-warning'>Item has been checked in.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }
  if(isset($_POST['checkout_item'])){  
    $checkout_item = $_POST['checkout_item'];
    mysqli_query($mysqli,"UPDATE items SET checked_out_by = $session_user_id, checked_out_date = UNIX_TIMESTAMP(now()) WHERE item_id = $checkout_item");
    echo "<div class='alert alert-warning'>Item successfully checked out!<button class='close' data-dismiss='alert'>&times;</button></div>";
  }
  if(isset($_POST['add_aisle'])){
    $aisle = mysqli_real_escape_string($mysqli,$_POST['aisle']);
    $num_of_levels = intval($_POST['num_of_levels']);
    $num_of_bays = mysqli_real_escape_string($mysqli,$_POST['num_of_bays']);
    $location_id = $_POST['location_id'];
    mysqli_query($mysqli,"INSERT INTO aisles SET aisle_name = '$aisle', location_id = $location_id");
    $aisle_id = mysqli_insert_id($mysqli);
    $i = 1;
    $level_name = 'a';
    while($i <= $num_of_levels)
    {
      $i2 = 0;
      mysqli_query($mysqli,"INSERT INTO levels SET level_name = '$level_name', aisle_id = $aisle_id");
      $i++;
      $level_name++;
      $level_id = mysqli_insert_id($mysqli);
      while($i2 < $num_of_bays)
      {
        $bay_name = $i2 + 1;  
        mysqli_query($mysqli,"INSERT INTO bays SET bay_name = $bay_name, level_id = $level_id");
        $i2++;    
      }
    }
    echo "<div class='alert alert-warning'>Aisle successfully added.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }
?>	