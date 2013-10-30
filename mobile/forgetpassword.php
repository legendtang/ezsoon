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
　 	<title>登录--随便送</title> 
　	<meta name="viewport" content="width=device-width, initial-scale=1"> 
　 	<link rel="stylesheet" href="./css/jquery_mobile.css" />
　	<script src="./js/jquery.js"></script>
	<script src="./js/jquery_mobile.js"></script>
</head> 
<body>
</head>
<body>
	<section id="page1" data-role="page">
		<header data-role="header"  data-theme="b" ><a data-rel="back" data-icon="back" >返回</a><h1>忘记密码</h1></header>
		<div data-role="content" class="content">
			<p style="backg"><font color="#2EB1E8" >填写必要信息找回密码</font></p>
			<form action="./php/mailto.php" method="post">
				<input type="text" id="find_password_username" name="username" placeholder="请输入用户名（手机号）">
				<input type="text" id="find_password_checkmail" name="mail" placeholder="请输入注册时填写的邮箱">
				<button id="find_password_submit" type="submit">找回密码</button>
			</form>
		</div>
		<footer data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
					<li><a data-icon="info" href="./help.html">帮助</a></li>
				</ul>
			</div><!-- /navbar -->
			<h1>©2013 ezsoon 随便送(www.ezsoon.cn)</h1>
		</footer>
		<script type="text/javascript" src="./js/base.js"></script>
		<script type="text/javascript">
	    /* if (!checkMobile())
			location.href = "../"; //PC端 */
	  </script>
	</section>
</body>
</html>