<?php
require_once "../php/linkDB.php";
session_start();
if(!isset($_SESSION["aid"])){
	 echo "<script>window.location.href='./index.php';</script>";
}
//从数据库获取数据
if($_GET["id"]){
	$id = $_GET["id"];
	$sql = mysql_query("SELECT * FROM user WHERE id='$id' LIMIT 1");
	$user = mysql_fetch_array($sql);
	$mail = $user["mail"];
	$password = $user["password"];
	$phone = $user["phone"];
	$address = $user["address"];
	$name = $user["name"];
	$gender = $user["gender"];
}else{
	echo '用户信息读取错误';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>修改用户信息商户--随便送</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	<button class="btn btn-danger" onclick="window.location.href='./dashboard.php';">返回面板</button>
	<form class="form-horizontal" action="./update_client.php" method="POST" style="width:700px;margin:auto;">
		<h1> 用户编号:<?php echo $id ?></h1>
		<input name="id" value="<?php echo $id ?>"  type="hidden">
		<div class="control-group">
			<label class="control-label" >Email</label>
			<div class="controls">
				<input type="text" name="mail" placeholder="Email" value="<?php echo $mail ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Password</label>
			<div class="controls">
				<input type="password" id="inputPassword" name="password" placeholder="Password" value="<?php echo $password; ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >姓名</label>
			<div class="controls">
				<input type="text" name="name" placeholder="name" value="<?php echo $name ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >电话号码</label>
			<div class="controls">
				<input type="text" name="phone" placeholder="phone number" value="<?php echo $phone ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >地址</label>
			<div class="controls">
				<input type="text" name="address" placeholder="address" value="<?php echo $address ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >性别</label>
			<div class="controls">
				<input type="text" name="gender" placeholder="gender" value="<?php echo $gender ?>">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn">提交修改</button>
			</div>
		</div>
	</form>

</body>
</html>
