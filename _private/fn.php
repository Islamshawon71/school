<?php
	function connect_database($db_user,$db_user_p,$db){
		$con=mysql_connect("localhost",$db_user,$db_user_p);
		if(!$con)
		{
			die("Server Connection Failed.");
		}
		$db=mysql_select_db($db);
		if(!$db)
		{
			die("Database Connection Failed.");
		}
	}
		
	function rep_br_sp($string){
		return str_ireplace("<br/>"," ",$string);
	}
	
	function dateconvert($date){
				if($date=="0000-00-00"||(!$date))
					return "";
				elseif($date==date("Y-m-d"))
					return "Today - ".date("d M Y (D)", strtotime($date));
				else
					return date("d M Y (D)", strtotime($date));
	}
	
	function getPostDate($p){
			    if(isset($_POST[$p.'_y'])&&isset($_POST[$p.'_m'])&&isset($_POST[$p.'_d']))
                  return $_POST[$p.'_y'].'-'.$_POST[$p.'_m'].'-'.$_POST[$p.'_d'];    
				else 
				   return 0;
    }
			
	function select_digit($name, $from , $to, $sel, $int=1){
                echo "<select name = '".$name."' > ";
                for($i=$from; $i<=$to; $i = $i + $int){
                    if($sel==$i)
                        echo "<option selected>".$i."</option>";
                    else
                        echo "<option >".$i."</option>";
                }
                echo "</select>";
    }
	
	function input_date($n, $t=NULL){
		if($t==NULL) $t=date("Y-m-d");
		if(getPostDate($n)!=0) $t=getPostDate($n);
		$texploded=explode('-',$t);
		$y=$texploded[0];
		$m=$texploded[1];
		$d=$texploded[2];
		$yless=date('Y')-15;
		$ymore=date('Y')+15;
		select_digit($n.'_d', 1, 31, $d);
		select_digit($n.'_m', 1, 12, $m);
		select_digit($n.'_y', $yless, $ymore, $y);
	}
	
	function bfn($num,$d=2){
	    $neg = false;
	    if($num<0){
			$neg = true;
		}
	    $num = abs($num);
		$num=sprintf("%.".$d."f",$num);
		$num_a=explode('.',$num);
		$num_h=$num_a[0];
		if(!empty($num_a[1])) $num_f=$num_a[1];	
		$num_s="";
		if($num_h){
			$m=3;
			for($i=(strlen($num_h)-1);$i>-1;$i--){
				$num_s=$num_h[$i].$num_s;
				if(($i==(strlen($num_h)-$m)) && $i!=0 ){
						$num_s=",".$num_s;
						$m=$m+2;
				}
			}
		}
		else
		{
			$num_s=$num_s."0";
		}
		if($d==0)
		{
			return $num_s;
		}
		$num_s=$num_s.".";
		$num_s=$num_s.$num_f;
		if($neg){
			$num_s="(-) ".$num_s;
		}
		return $num_s;
	}
	
	function compound_interest($p,$r,$t){
		$x=0;
		for($i=0;$i<$t;$i++){
				$y=(($p*$r)/100);
				$x=$x+$y;
				$p=$p+$x;
		}
		return $x;
	}
	
	function simple_interest($p,$r,$t){
		return ($p*$r*$t/100);
	}
	
	function compound_interest_details($p,$r,$t){
		echo "<h2>Compound Interest</h2>";
		echo "<table class='rb'>";
		$x=0;				
		$y=0;
			echo"<tr>
					<th>Time</th>
					<th>Interest</th>
					<th>Accumilated Interest</th>
					<th>Total</th>
				</tr>
				<tr>
					<td>0</td>
					<td class='r'>".bfn($y)."</td>
					<td class='r'>".bfn($x)."</td>
					<td class='r'>".bfn($p)."</td>
				</tr>";
			for($i=1;$i<=$t;$i++){
				$y=($p*$r/100);
				$x=$x+$y;
				$p=$p+$x;
				echo"<tr>
					<td>".$i."</td>
					<td class='r'>".bfn($y)."</td>
					<td class='r'>".bfn($x)."</td>
					<th class='r'>".bfn($p)."</th>
				</tr>";
			}
		echo "</table>";
	}

	function simple_interest_details($p,$r,$t){
		echo "<h2>Simple Interest</h2>";
		echo "<table class='rb'>";
			echo"<tr>
					<th>Time</th>
					<th>Interest</th>
					<th>Accumilated Interest</th>
					<th>Total</th>
				</tr>
				<tr>
					<td>0</td>
					<td class='r'>0</td>
					<td class='r'>0</td>
					<td class='r'>".bfn($p)."</td>
				</tr>";				
			$x=($p*$r)/100;
			$y=0;
			for($i=1;$i<=$t;$i++){
				$y=$y+$x;
				$p=$p+$x;
				echo "<tr>
					<td>".$i."</td>
						<td class='r'>".bfn($x)."</td>
						<td class='r'>".bfn($y)."</td>
						<th class='r'>".bfn($p)."</th>
					</tr>";
			}
		echo "</table>";
	}
	
	function input_text($name,$value=NULL,$placeholder=NULL,$class=NULL,$id=NULL){
		if($value==NULL&&isset($_REQUEST[$name])) $value=$_REQUEST[$name];
		echo "<input type='text' name='".$name."'";
		if($value) echo " value='".$value."' ";
		if($class) echo " class='".$class."' ";
		if($id) echo " id='".$id."' ";
		if($placeholder) echo " placeholder='".$placeholder."'";
		echo "/>";
	}

	function input_submit($name,$value=NULL){
		if($value==NULL&&isset($_REQUEST[$name])) $value=$_REQUEST[$name];
		echo "<input type='text' name='".$name."'";
			if($value) echo "value='".$value."' ";
		echo "/>";
	}
	
	function input_hidden($name,$value=NULL){
		if($value==NULL&&isset($_REQUEST[$name])) $value=$_REQUEST[$name];
		echo "<input type='hidden' name='".$name."' value='".$value."'/>";
	}
	
	function input_textarea($name,$value=NULL){
		if($value==NULL&&isset($_REQUEST[$name])) $value=$_REQUEST[$name];
		echo "<textarea name='".$name."'>".$value."</textarea>";
	}
	
	/*------------------------DB Dependent Scripts------------------------------------------*/
	
	function get_fixedtext($fixedtext_id){
		$q=mysql_query("SELECT fixedtext FROM fixedtext WHERE id='$fixedtext_id'");
		$ar=mysql_fetch_array($q);
		return $ar[0]; 
	}
	
	function input_select($name,$table,$selected=NULL,$value=NULL,$display=NULL,$active=1){
		if($value==NULL)$value='id';
		if($display==NULL)$display=$table;
		if($selected==NULL&&isset($_REQUEST[$name]))$selected=$_REQUEST[$name];
		$qs="SELECT * FROM ".$table;
		if($active!=NULL) $qs=$qs." WHERE active='".$active."'";
		$q=mysql_query($qs);
		echo "<select name='".$name."'>";
		echo "<option value='0'></option>";
		if($selected=="blank") echo "<option value='0'>None</option>";
		while($d=mysql_fetch_assoc($q)){
			echo "<option value='".$d[$value]."'";
				if($selected==$d[$value]) echo "selected";
			echo ">".$d[$display]."</option>";
		}
		echo "</select>";
	}
	
	function menu_gen($parent_id=0,$level=1){	
		$qs="SELECT * FROM menu WHERE level ='".$level."' AND parent_id='".$parent_id."' ";
		$q=mysql_query($qs);
		if(mysql_num_rows($q)>0)
		{
			echo "<ul>";
			while($d=mysql_fetch_assoc($q)){
				echo "<li><a href='index.php?page=".$d['id']."'><abbr title='".$d['description']."'>".$d['display']."</abbr></a>";
					menu_gen($d['id'],($level+1));
				echo "</li>";
			}
			echo "</ul>";
		}
	}
	
	function hmenu_gen($cu_id){
		$qs="SELECT DISTINCT
					menu.* FROM menu 
					LEFT JOIN  user_menu ON (menu.id=user_menu.menu_id)
					WHERE user_menu.user_id='".$cu_id."'
					ORDER BY user_menu.datetime DESC
					LIMIT 0,10
				";
		$q=mysql_query($qs);
		if(mysql_num_rows($q)>0)
		{
			echo "<ul>";
			while($d=mysql_fetch_assoc($q)){
				echo "<li><a href='index.php?page=".$d['id']."'><abbr title='".$d['description']."'>".$d['display']."</abbr></a>";
				echo "</li>";
			}
			echo "</ul>";
		}
	}

	function pmenu_gen($cu_id){
		$qs="
				SELECT DISTINCT
					* FROM menu 
					WHERE 
				";
		$qs2="SELECT * FROM user_pmenu WHERE user_id='".$cu_id."'";
		$d2=mysql_fetch_assoc(mysql_query($qs2));
		for($i=0;$i<10;$i++)
		{
			if($i==0)
				$qs=$qs." id='".$d2['menu_id_'.$i]."' ";
			else
				$qs=$qs."OR id='".$d2['menu_id_'.$i]."' ";
		}
		$qs=$qs." ORDER BY priority DESC";		
		$q=mysql_query($qs);
		if(mysql_num_rows($q)>0)
		{
			echo "<ul>";
			while($d=mysql_fetch_assoc($q)){
				echo "<li><a href='index.php?page=".$d['id']."'><abbr title='".$d['description']."'>".$d['display']."</abbr></a>";
				echo "</li>";
			}
			echo "</ul>";
		}
	}	
	
	function search_db($searchword,$table_id=NULL)
	{
		if(strlen($searchword)>0)
		{
			$total_num=0;
			$searchword_exploded=explode(" ",$searchword);
			$qs1="SELECT * FROM search_table WHERE active='1' ";
			if($table_id)
			{
				$qs1=$qs1." AND id='".$table_id."' ";
			}
			$qs1=$qs1." ORDER BY priority DESC";
			$q1=mysql_query($qs1);
			if(mysql_num_rows($q1)>0)
			{
					while($d1=mysql_fetch_assoc($q1)){
					$qs2="SELECT * FROM search_column WHERE active='1' AND search_table_id='".$d1['id']."' ORDER BY priority DESC";
					$q2=mysql_query($qs2);
					if(mysql_num_rows($q2)>0)
					{
						$qs3="SELECT ".$d1['table'].".* ";
						$qs6="SELECT * FROM search_display_join WHERE active='1' AND search_table_id='".$d1['id']."' ORDER BY priority DESC";
						$q6=mysql_query($qs6);
						if(mysql_num_rows($q6)>0){
							while($d6=mysql_fetch_assoc($q6)){
								$qs3=$qs3.", ".$d6['table'].".".$d6['column'];
							}
						}
						$qs3=$qs3." FROM ".$d1['table']." ";
						$q6=mysql_query($qs6);
						if(mysql_num_rows($q6)>0){
							while($d6=mysql_fetch_assoc($q6)){
								$qs3=$qs3." LEFT JOIN  ".$d6['table']." ON (".$d6['table'].".".$d1['table']."_id=".$d1['table'].".id)";
							}
						}
						$qs3=$qs3." WHERE ";
						$c=0;
						while($d2=mysql_fetch_assoc($q2)){
							for($i=0; isset($searchword_exploded[$i]); $i++)
							{
								if($c==0){
									$qs3=$qs3." ".$d1['table'].".".$d2['column']." LIKE '%".$searchword_exploded[$i]."%' ";
									$c=1;
								}
								else
								{
									$qs3=$qs3."OR ".$d1['table'].".".$d2['column']." LIKE '%".$searchword_exploded[$i]."%' ";
								}
							}
						}
						$q6=mysql_query($qs6);
						if(mysql_num_rows($q6)>0){
							while($d6=mysql_fetch_assoc($q6)){
								for($i=0; isset($searchword_exploded[$i]); $i++)
								{
									$qs3=$qs3." OR ".$d6['table'].".".$d6['column']." LIKE '%".$searchword_exploded[$i]."%' ";
								}
							}
						}
						//echo "<br/>".$qs3;
						$q3=mysql_query($qs3);
						$num3=mysql_num_rows($q3);
						$total_num=$total_num+$num3;
						if($num3>0){
							$qs5="SELECT * FROM search_link WHERE search_table_id='".$d1['id']."' ";
							$q5=mysql_query($qs5);
							if(mysql_num_rows($q5)>0){
								$d5=mysql_fetch_assoc($q5);
								$url="index.php?page=".$d5['menu_id']."&&".$d5['identifier']."=";
							}
							else{
								$url="index.php?page=";
							}
							echo "<h3>".$num3." ".$d1['search_table']." Result<small>(s)</small> Found</h3>";
							while($d3=mysql_fetch_assoc($q3)){
								echo "<a href='".$url.$d3['id']."'>";
								$qs4="SELECT * FROM search_display WHERE active='1' AND search_table_id='".$d1['id']."' ORDER BY priority DESC";
								$q4=mysql_query($qs4);
								if(mysql_num_rows($q4)>0){
									while($d4=mysql_fetch_assoc($q4)){
										echo "<".$d4['tag'].">".$d3[$d4['column']]."</".$d4['tag'].">";
										echo "&nbsp;";
									}
								}
								$q6=mysql_query($qs6);
								if(mysql_num_rows($q6)>0){
									while($d6=mysql_fetch_assoc($q6)){
										if($d3[$d6['column']]!=NULL)
										{
											echo "&nbsp;-&nbsp;";
											echo "<".$d6['tag'].">".$d3[$d6['column']]."</".$d6['tag'].">";
										}
									}
								}
								echo "</a><br/>";
							}
						}
					}
				}
			}
		}
		echo "<h3>Total ".$total_num." Results Found.</h3>";
	}
?>