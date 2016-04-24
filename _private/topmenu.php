<abbr title="Home"><a href="index.php"><img src="images/home.png"/></a></abbr>
<abbr title="Menu"><a><img src="images/menu-icon.png" onclick="menus('250','menu');"/></a></abbr>
<abbr title="Recently Visited OR History"><a><img src="images/history.png" onclick="menus('250','history');"/></a></abbr>
<abbr title="Personal Menu"><a><img src="images/mymenu.png" onclick="menus('250','mymenu');"/></a></abbr>

<?php echo "<abbr title='".$description."'><big>".$title."</big></abbr>";?>
<div id='search'>
<?php
	include("_private/searchform.php");
?>
</div>
<a href="logout.php"><abbr title="Logout"><img src="images/logout.png" alt="X"/></abbr></a>