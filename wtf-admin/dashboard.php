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
	<title>功能选择</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	<div style="width:500px;margin:auto;">
		<h3>商户管理界面</h3>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-info btn-large " onclick="window.location.href='./add_shop_info.php';">添加新的商家</button>
				<button class="btn btn-info btn-large" onclick="window.location.href='./list_shop.php';">修改商家信息</button>
			</div>
		</div>
		<h3>产品管理界面</h3>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-info btn-large " onclick="window.location.href='./add_product_info.php';">添加新的产品</button>
				<button class="btn btn-info btn-large" onclick="window.location.href='./list_product.php';">修改产品信息</button>
			</div>
		</div>
		<h3>用户管理界面</h3>
		<div class="control-group">
			<div class="controls">
			<button class="btn btn-info btn-large" onclick="window.location.href='./list_client.php';">用户信息列表</button>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-danger" onclick="window.location.href='../php/logout.php?type=admin';">登出</button>
			</div>
		</div>
	</div>
</body>
</html>
