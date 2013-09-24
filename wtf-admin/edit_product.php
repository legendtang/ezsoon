<?php
require_once "../php/linkDB.php";
session_start();
if(!isset($_SESSION["aid"])){
	 echo "<script>window.location.href='./index.php';</script>";
}
//从数据库获取数据
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$sql = mysql_query("SELECT * FROM product WHERE id='$id' LIMIT 1");
	$shop = mysql_fetch_array($sql);
	$name = $shop["name"];
	$price = $shop["price"];
	$type = $shop["type"];
	$state = $shop["state"];
	$shop_id = $shop["shop_id"];
	$time = $shop["time"];
}else{
	echo '商户信息读取错误';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>修改产品信息--随便送</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	<button class="btn btn-danger" onclick="window.location.href='./dashboard.php';">返回面板</button>
	<form class="form-horizontal" action="./update_product.php" method="POST" style="width:700px;margin:auto;">
		<h1> 产品编号:<?php echo $id ?></h1>
		<input name="id" value="<?php echo $id ?>"  type="hidden">
		<div class="control-group">
			<label class="control-label" >name</label>
			<div class="controls">
				<input type="text" name="name" placeholder="name" value="<?php echo $name ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >价格</label>
			<div class="controls">
				<input type="text" name="price" placeholder="price" value="<?php echo $price ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >种类编号</label>
			<div class="controls">
				<input type="text" name="type" placeholder="type number" value="<?php echo $type ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >状态</label>
			<div class="controls">
				<input type="text" name="state" placeholder="state" value="<?php echo $state ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >商户编码</label>
			<div class="controls">
				<input type="text" name="shop_id" placeholder="shop_id" value="<?php echo $shop_id ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >制作时间</label>
			<div class="controls">
				<input type="text" name="time" placeholder="time" value="<?php echo $time ?>">
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
