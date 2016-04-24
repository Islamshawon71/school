<?php
    session_start();
	date_default_timezone_set('Asia/Dhaka');
	error_reporting(0);// Set while coding
	// error_reporting(0); // While showing Client
    include("_private/security.php");
	$title="Dynamic Software 1.0";
	$description="Dynamic Software 1.0";
	include("_private/prep.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?=$title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/menus.js"></script>
	</head>
	<body>
		<center>
			<div id='topmenu'>
				<?php
					include("_private/topmenu.php");
				?>
			</div>
			<div id='infobar'>
				<?php
					include("_private/infobar.php");
				?>
			</div>
			<div id="menu" class="sidemenu">
				<?php
					include("_private/menu.php");
				?>
			</div>
			<div id="mymenu" class="sidemenu">
				<?php
					include("_private/mymenu.php");
				?>
			</div>
			<div id="history" class="sidemenu">
				<?php
					include("_private/history.php");
				?>
			</div>
			<div id='content' onclick="menus(250);">
				<?php
					include("_private/content.php");
				?>
			</div>
		</center>
	</body>
	<script type='text/javascript'>menus(0);</script>
</html>