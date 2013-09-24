<?php
	session_start();
	if(isset($_SESSION["uid"])){
		echo '<script language="javascript">window.location.href = "./home.php";</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>随便送</title>
	<!--[if lt IE 9]>
		<meta http-equiv="Refresh" content="0; url='noie6.html'">  
		<script src="js/html5shiv.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
	<script type="text/javascript" src="js/base.js"></script>
	<script type="text/javascript" charset="utf-8">
		//$(function() {
		//	$('.noTextClear').textClear();
		//});
		$(function() {
			$('input, textarea').placeholder();
		});
		$(document).ready(function() { 
			$(".light").click(function(){
				$(".front-signin").fadeOut(800);
				$(".front-signup").fadeIn(800);
			});
			$(".btn-return").click(function(){
				$(".front-signup").fadeOut(800);
				$(".front-signin").fadeIn(800);
			});
		});
	</script>
</head>
<body>
	<div id="navbar">
		<div class="welcome left">欢迎您来到 <b>随便送！</b> 服务热线：027-87345370 13871390741</div>
		<div class="range right">目前配送范围：华科附中，华科韵苑，SBI创业街</div>
	</div>
	<div id="front-bg">
		<img src="images/frontbg2.jpg" />
	</div>
	<div id="front-card">
		<div class="front-welcome">
			<div class="front-logo"></div>
		</div>
		<div class="front-signup" style="display:none">
			<h2>开启您的订餐之旅！</h2>
			<form action="#" class="signup" method="post">
				<input type="tel" id="reg_phone" class="noTextClear" placeholder="手机号码" pattern="^((13[0-9])|(15[0-9])|(18[0-9])|(14[0-9]))+\d{8}$" required name/>
				<input id="reg_mail" type="email" class="noTextClear" placeholder="邮箱地址" required name/>
				<input id="reg_password" type="password" class="noTextClear" placeholder="密码" required name/>
				<input id="reg_password_c" type="password" class="noTextClear" placeholder="再次输入密码" required name/>
				<button id="index_register" class="btn btn-signup"></button>
				<button class="btn btn-return"></button>
			</form>
		</div>
		<div class="front-signin">
			<h2>开启您的订餐之旅！</h2>
			<form action="#" class="signin" method="post">
				<input type="tel" id="login_phone" class="noTextClear" placeholder="手机号码" pattern="^((13[0-9])|(15[0-9])|(18[0-9])|(14[0-9]))+\d{8}$" required name/>
				<input id="login_password" type="password" class="noTextClear" placeholder="密码" required name/>
				<p class="abs grey" onclick="javascript: window.location = ('./temp.php')">忘记密码?</p>
				<div style="margin-top:20px;">
					<button type="submit" id="index_login" class="in-bl btn btn-signin"></button>
					<label>
						<input class="in-bl" type="checkbox" name="rememberme" value="0">
						<p class="in-bl grey">记住我</p>
					</label>
					<div class="in-bl divider-small"></div>
					<p class="in-bl light">免费注册</p>
				</div>
			</form>
		</div>
		<div class="front-forgotpw"style="display:none"></div>
	</div>
	<div id="front-footer">
		<a class="gohome" href="home.php" title="随便逛逛"></a>
	</div>
</body>
</html>