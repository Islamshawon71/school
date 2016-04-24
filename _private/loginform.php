<html  lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<title>ADOVA SOFT</title>	
	<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	<body>
		<center>
			<br/>
			<h1><i>Inventory Management Software</i></h1>
			<div id="loginform">
				<form method="POST">
					<?php echo $errormessage; ?>
					<table align="center" border="0px">
						<tr><td>User ID:</td><th><input type="text" name="username"/></th></tr>
						<tr><td>Password:</td><th><input type="password" name="pass"/></th></tr>
						<tr><td colspan="2" class="centerized"><input type="submit" name="login" value="Login"/></td></tr>
					</table>
				</form>
			</div>
			<br/>
			<br/>
			<small>Developed by <a href="http://adovasoft.com/" target="_blank">Adova Soft</a></small>
	</center>
  </body>
</html>
<?php
	die();
?>