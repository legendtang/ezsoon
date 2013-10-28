<!DOCTYPE html>
<html>
<head>
<title>确定订单</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1" /> 
<link rel="stylesheet" href="./css/jquery_mobile.css" />
<script src="./js/jquery.js"></script>
<script src="./js/jquery_mobile.js"></script>
</head>
<body>
	<section dtat-role="page">
		<div data-role="header">
			<a data-rel="back" data-icon="back" >返回</a>
			<h2>订单提交</h2>
		</div>
		<div data-role="content" data-position="inline">
		<?php
		switch($_GET["result"]){
			case 1:
				echo '<p>您的订单<strong>已经提交</strong>,订单号为:<strong> '.$_GET["order_id"].' </strong>.请牢记订单号,我们将会在您设定的时间为您送出;</p>';
				break;
			case 2:
				echo '<p>订单提交错误,您可以尝试重新提交或者联系客服人员;</p>';
				break;
			case 3:
				echo '<p>您的地址信息不全,请在个人中心填写完全;</p>';
				break;
			case 4:
				echo '<p>空订单无法提交;</p>';
				break;
			case 5:
				echo '<p>不好意思,本时间段无法送餐;</p>';
				break;
			case 6:
				echo '<p>未登录用户;</p>';
				break;
			default:
				echo '<p>信息错误;!</p>';
		}
		?>
		</div>
	<div data-role="footer" data-position="fixed"><h4>2013 ezsoon.cn 随便送</h4></div>
	</section>
</body>
</html>