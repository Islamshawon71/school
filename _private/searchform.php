<form method='POST' action='index.php?page=0'>
<?php
	input_text('searchword',NULL,'Search','searchword');
	echo "&nbsp;";
	input_select("table_id","search_table");
?>
 <input type='submit' value='GO'/>
<br/>
</form>
