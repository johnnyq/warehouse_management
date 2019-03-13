<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>

	
    <!-- The Right Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Content of the sidebar goes here -->
</aside>
<!-- The sidebar's background -->
<!-- This div must placed right after the sidebar for it to work-->
<div class="control-sidebar-bg"></div>
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<button class="btn btn-default" data-toggle="control-sidebar">Toggle Right Sidebar</button>
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->


<?php include "includes/footer.php"; ?>