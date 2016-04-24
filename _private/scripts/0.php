<?php
	if(!empty($_REQUEST['searchword'])){
		$searchword=$_REQUEST['searchword'];
		$searchword= trim($searchword);
		echo "<h1>Search Results for ".$searchword."</h1>";
		if(isset($_POST['table_id'])){
			$table_id=$_POST['table_id'];
			search_db($searchword,$table_id);
		}
		else{
			search_db($searchword);
		}
	}
	else{
		echo "<h3>Please Insert Searchword</h3>";
		include("_private/searchform.php");
	}
?>
