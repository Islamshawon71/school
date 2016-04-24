<?php
	if(isset($_GET['page']))
	{
		$path="_private/scripts/".$_GET['page'].".php";
		$qs_info="SELECT * FROM menu WHERE id='".$_GET['page']."' ";
		$q_info=mysql_query($qs_info);
		if(mysql_num_rows($q_info)>0)
		{
			$q_pagevisit=mysql_query("INSERT INTO user_menu VALUES('".date("Y-m-d H:i:s")."','".$cu_id."','".$_GET['page']."')");
			$d_info=mysql_fetch_assoc($q_info);
			$title=$d_info['display'];
			$description=$d_info['description'];
		}
	}
	else
    {
		$path="_private/scripts/1.php";
    }
?>