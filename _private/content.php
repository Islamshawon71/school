<?php
	if(file_exists($path))
	{
		include($path);
	}
	else
	{
		include("_private/scripts/default.php");
	}
?>