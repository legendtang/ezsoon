<?php
session_start();
if(isset($_SESSION["aid"])){
   echo "<script>window.location.href='./dashboard.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>管理员登陆--随便送</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	<form class="form-horizontal" action="../php/login.php?type=admin" method="post">
		<div class="control-group">
			<h3>登陆后台管理界面</h3>
			<label class="control-label" >用户名</label>
			<div class="controls">
				<input type="text" name="username" placeholder="username">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
				<input type="password" id="inputPassword" name="psw"">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn">登陆</button>
			</div>
		</div>
	</form>

</body>
</html>
