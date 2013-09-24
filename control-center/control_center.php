<?php
session_start();
if(!isset($_SESSION["cid"])){
	 echo "<script>window.location.href='./index.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>调度中心</title>
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>
<body>
	<div style="width:500px;margin:auto;">
		<h3>商户调度</h3>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-info btn-large " onclick="window.location.href='./shop_control.php';">商户菜单调度</button>
			</div>
		</div>
		<h3>配餐员调度</h3>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-info btn-large " onclick="window.location.href='./cater.php?zone=0';">配餐区   (一)</button>
				<button class="btn btn-info btn-large " onclick="window.location.href='./cater.php?zone=1';">配餐区   (二)</button>
			</div>
		</div>
		<h3>送餐员调度</h3>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-info btn-large " onclick="window.location.href='./sender.php?zone=0';">送餐区   (一)</button>
				<button class="btn btn-info btn-large " onclick="window.location.href='./sender.php?zone=1';">送餐区   (二)</button>
				<button class="btn btn-info btn-large " onclick="window.location.href='./sender.php?zone=2';">送餐区   (三)</button>
			</div>
		</div>
		<h3>订单整合按钮--危险</h3>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-warning btn-large " onclick="window.location.href='./check_cater_before.php';">整合当前时段订单</button>
				<button class="btn btn-danger btn-large " onclick="window.location.href='./record_order.php';">整合当天订单</button>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-danger" onclick="window.location.href='../php/logout.php?type=controler';">登出</button>
			</div>
		</div>
	</div>
</body>
</html>