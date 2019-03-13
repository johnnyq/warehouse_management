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

      <form id="ajaxAddForm" class="form form-inline col-md-12" autocomplete="off">
        <input type="hidden" name="checkin_item">
        <legend>Move Item</legend>
        <div class="form-group">
          <label>Item</label>
          <input type="text" class="form-control" name="item" required autofocus>
        </div>
        <div class="form-group">
          <label>Location</label>
          <input type="text" class="form-control" name="location" required>
        </div>          
        <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Move</button>
      </form>
    </div>
  </div>
  <div class="box box-primary">
    <div class="box-body">      
      <div id="response"></div>

      <form id="ajaxAddForm" class="form form-inline col-md-12" autocomplete="off">
        <input type="hidden" name="checkin_item">
        <legend>Bookin Item</legend>
        <div class="form-group">
          <label>Item</label>
          <input type="text" class="form-control" name="item" required autofocus>
        </div>
        <div class="form-group">
          <label>Location</label>
          <input type="text" class="form-control" name="location" required>
        </div>          
        <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Checkin</button>
      </form>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>