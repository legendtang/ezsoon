<?php
require_once "../php/linkDB.php";
session_start();
if(!isset($_SESSION["aid"])){
	 echo "<script>window.location.href='./index.php';</script>";
}
//从数据库获取数据
if($_GET["id"]){
	$id = $_GET["id"];
	$sql = mysql_query("SELECT * FROM restaurant WHERE id='$id' LIMIT 1");
	$shop = mysql_fetch_array($sql);
	$mail = $shop["mail"];
	$password = $shop["password"];
	$name = $shop["name"];
	$phone = $shop["phone"];
	$description = $shop["description"];
	$zone = $shop["zone"];
	$time = $shop["time"];
	$min_spend = $shop["min_spend"];
	$logo = $shop["logo"];
	$state = $shop["state"];
}else{
	echo '商户信息读取错误';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>修改商户信息商户--随便送</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	<button class="btn btn-danger" onclick="window.location.href='./dashboard.php';">返回面板</button>
	<form class="form-horizontal" action="./update_shop.php" method="POST" style="width:700px;margin:auto;">
		<h1> 店铺编号:<?php echo $id ?></h1>
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
			<label class="control-label" >店铺名</label>
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
			<label class="control-label" >店铺描述</label>
			<div class="controls">
				<input type="text" name="description" placeholder="discription" value="<?php echo $description ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >所在区块</label>
			<div class="controls">
				<input type="text" name="zone" placeholder="zone" value="<?php echo $zone ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >营业时间</label>
			<div class="controls">
				<input type="text" name="time" placeholder="time" value="<?php echo $time ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >最低消费</label>
			<div class="controls">
			<input type="text" name="min_spend" placeholder="min_spend" value="<?php echo $min_spend ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >状态</label>
			<div class="controls">
			<input type="text" name="state" placeholder="state" value="<?php echo $state ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >上传店铺图片</label>
			<div class="controls">
			<input type="file" name="big-img" placeholder="upload">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >logo</label>
			<div class="controls">
			<input type="file" name="logo" placeholder="upload">
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
