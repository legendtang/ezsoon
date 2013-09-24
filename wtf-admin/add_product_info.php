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
	<title>添加产品--随便送</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	
	<div style="margin:auto;width:700px;">
	<button class="btn btn-danger" onclick="window.location.href='./dashboard.php';">返回面板</button>
	<form class="form-horizontal" action="./add_product.php" method="POST">
		<div class="control-group">
			<label class="control-label" >产品名</label>
			<div class="controls">
				<input type="text" name="name" placeholder="name">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >价格</label>
			<div class="controls">
				<input type="text" name="price" placeholder="price">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >种类编码</label>
			<div class="controls">
				<input type="text" name="type" placeholder="type number">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >商户编码</label>
			<div class="controls">
				<input type="text" name="shop_id" placeholder="shop_id">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >制作时间</label>
			<div class="controls">
				<input type="text" name="time" placeholder="time">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >上传产品图片</label>
			<div class="controls">
			<input type="file" name="image"">
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
