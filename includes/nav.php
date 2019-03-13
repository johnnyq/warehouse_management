<header class="main-header">
<nav class="navbar navbar-default">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php"><?php echo "$config_app_icon $config_app_name"; ?></a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="items.php">Items</a></li>
      <li><a href="locations.php">Locations</a></li>
      <li><a href="users.php">Users</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo "$session_email"; ?></a>
        <ul class="dropdown-menu">
          <li><a href="update_password.php"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
</header>
<div class="content-wrapper">