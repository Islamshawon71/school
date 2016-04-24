<?php

	/*
		Status
			1	Active
			2	Suspended
			3	Terminated
		Type
			1	Super Admin
			2	Admin
			3	Website Editor
			4	Website Reporter
			5	Subscriber
			6	Database Viewer
			7	Database Operator
	*/
	
	$db='db';
	
	$checker='root';
	$checker_p='1234';
	
	function pre_connect($db_user,$db_user_p,$db){
		$con=mysql_connect("localhost",$db_user,$db_user_p);
		if(!$con)
			die("Server Connection Failed.");
		$db=mysql_select_db($db);
		if(!$db)
			die("Database Connection Failed.");
		if($con&&$db)
			return $con;
	}
	
	function checker_query($db_user,$db_user_p,$db,$euser,$epass){
		$con=pre_connect($db_user,$db_user_p,$db);
		return $q=mysql_query(
					"SELECT  
									user.id,
									user.user,
									user.email,
									user.fullname,
									user.status_id,
									user.type_id, 
									type.type, 
									type.db_user, 
									type.db_pass, 
									status.status  
						FROM user
						LEFT JOIN type ON (user.type_id=type.id)
						LEFT JOIN status ON (user.status_id=status.id)
						WHERE 
							user.enuser='".$euser."' 
							AND user.pass='".$epass."' ");
		mysql_close($con);
	}
	
	if(isset($_SESSION['enfn']) && isset($_SESSION['enuser'.$_SESSION['enfn']]) && isset($_SESSION['enpass'.$_SESSION['enfn']])){
		$e_username=$_SESSION['enuser'.$_SESSION['enfn']];
		$e_pass=$_SESSION['enpass'.$_SESSION['enfn']];
		$qc=checker_query($checker,$checker_p,$db,$e_username,$e_pass);
		if(mysql_num_rows($qc)==1)
		{
			$dcq=mysql_fetch_assoc($qc);
			$status_id=$dcq['status_id'];
			if($status_id==1)
			{
				$cu_id=$dcq['id'];
				$user=$dcq['user'];
				$email=$dcq['email'];
				$fullname=$dcq['fullname'];
				$status_id=$dcq['status_id'];
				$type_id=$dcq['type_id'];
				$type=$dcq['type'];
				$db_user=$dcq['db_user'];
				$db_pass=$dcq['db_pass'];
				
				include("_private/fn.php");
				connect_database($db_user,$db_pass,$db);
			}
			else
			{
				$status=$dcq['status'];
				$errormessage="<h1 class='red'>Sorry you are ".$status."</h1>";
				include("_private/loginform.php");
			}
		}
		else
		{
			$errormessage="<h1 class='red'>Wrong ID or Password</h1>";
			include("_private/loginform.php");
		}
	}
	elseif(isset($_POST['username'])&&isset($_POST['pass']))
	{
		$e_username=md5($_POST['username']);
		$e_pass=md5($_POST['pass']);
		$qc=checker_query($checker,$checker_p,$db,$e_username,$e_pass);
		if(mysql_num_rows($qc)==1)
		{
			$dcq=mysql_fetch_assoc($qc);
			$status_id=$dcq['status_id'];
			if($status_id==1)
			{
				$cu_id=$dcq['id'];
				$user=$dcq['user'];
				$email=$dcq['email'];
				$fullname=$dcq['fullname'];
				$status_id=$dcq['status_id'];
				$type_id=$dcq['type_id'];
				$type=$dcq['type'];
				$db_user=$dcq['db_user'];
				$db_pass=$dcq['db_pass'];
				
				$enfn=md5($fullname);
				$_SESSION['enfn']=$enfn;
				$_SESSION['enuser'.$enfn]=$e_username;
				$_SESSION['enpass'.$enfn]=$e_pass;
				
				include("_private/fn.php");
				connect_database($db_user,$db_pass,$db);
			}
			else
			{
				$status=$dcq['status'];
				$errormessage="<h1 class='red'>Sorry you are ".$status."</h1>";
				include("_private/loginform.php");
			}
		}
		else
		{
			$errormessage="<h1 class='red'>Wrong ID or Password</h1>";
			include("_private/loginform.php");
		}
	}
	else
	{
		if(isset($_GET['logout'])&&($_GET['logout']==1))
			$errormessage="<h1 class='green'>Loged out successfully</h1>";
		else
			$errormessage="<h1 class='blue'>Please Login</h1>";
		include("_private/loginform.php");
	}
?>