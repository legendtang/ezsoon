<?php
session_start();
if(!isset($_SESSION["aid"])){
	 echo "<script>window.location.href='./index.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>添加商户--随便送</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	
	<div style="margin:auto;width:700px;">
	<button class="btn btn-danger" onclick="window.location.href='./dashboard.php';">返回面板</button>
	<form class="form-horizontal" action="./add_shop.php" method="POST">
		<div class="control-group">
			<label class="control-label" >Email</label>
			<div class="controls">
				<input type="text" name="mail" placeholder="Email">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >用户名</label>
			<div class="controls">
				<input type="text" name="username" placeholder="username">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Password</label>
			<div class="controls">
				<input type="password" id="inputPassword" name="password" placeholder="Password">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >商铺名</label>
			<div class="controls">
				<input type="text" name="name" placeholder="name">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >电话号码</label>
			<div class="controls">
				<input type="text" name="phone" placeholder="phone number">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >店铺描述</label>
			<div class="controls">
				<input type="text" name="description" placeholder="discription">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >所在区块</label>
			<div class="controls">
				<input type="text" name="zone" placeholder="zone">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >营业时间</label>
			<div class="controls">
				<input type="text" name="time" placeholder="time">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >最低消费</label>
			<div class="controls">
			<input type="text" name="min_spend" placeholder="min_spend">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >上传店铺图片</label>
			<div class="controls">
			<input type="file" name="big-img" placeholder="upload">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-info">添加</button>
			</div>
		</div>
	</form>
	</div>
</body>
</html>
