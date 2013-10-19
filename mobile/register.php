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
　 	<title>注册--随便送</title> 
　	<meta name="viewport" content="width=device-width, initial-scale=1"> 
　 	<link rel="stylesheet" href="./css/jquery_mobile.css" />
　	<script src="./js/jquery.js"></script>
	<script src="./js/jquery_mobile.js"></script>
	
</head> 
<body>
	<section data-role="page">
	   <header data-role="header"  data-theme="b" ><a data-rel="back" data-icon="back" >返回</a><h1>注册随便送</h1></header>
		<div data-role="content" class="content">
			<form action="" method="post">
				<label for="email">手机号</label>
				<input type="text" name="phone" id="reg_phone"/>
				<label for="email">邮 箱</label>
				<input type="text" name="email" id="reg_mail"/>
				<label for="password">密 码</label>
				<input type="password" name="password" id="reg_password"/>
				<label for="password_c">确认密码</label>
				<input type="password" name="password" id="reg_password_c"/>
				<center>
					<a data-role="button" id="index_register" data-theme="e">立即注册</a>
				</center>
			</form>
		</div>
		<footer data-role="footer" >
			<div data-role="navbar">
				<ul>
					<li><a data-icon="info" href="./help.html">帮助</a></li>
				</ul>
			</div><!-- /navbar -->
			<h1>©2013 ezsoon 随便送(www.ezsoon.cn)</h1>
			
		</footer>
		<script type="text/javascript" src="./js/register.js"></script>
	</section>
</body>
</html>