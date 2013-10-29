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
	<section id="page1" data-role="page">
	  <header data-role="header"  data-theme="b" ><h1>开始订餐</h1></header>
	  <div data-role="content" class="content">
		<p style="backg"><font color="#2EB1E8" >登录随便送</font></p>
			<form>
				<input type="text" id="login_phone" placeholder="手机号"/><br>
				<input type="password" id="login_password" placeholder="密码"/>
						<fieldset data-role="controlgroup" >
							<input type="checkbox" id="checkbox_login" class="custom" />
							<label for="checkbox_login">保持登录状态</label>
						</fieldset>
				<div class="ui-grid-a">
					<div class="ui-block-a"><a data-role="button" id="index_login" data-theme="b">登录</a></div>
					<div class="ui-block-b"><a href="./register.php" data-role="button" data-theme="e">注册</a></div>
				</div>
				<div class="ui-grid-a">
					<div class="ui-block-a"><a data-role="button"  data-theme="b" href="./register.php">忘记密码</a></div>
				</div>
			</form>
	  </div>
	  <footer data-role="footer" data-position="fixed"><div data-role="navbar">
				<ul>
					<li><a data-icon="info" href="./help.html">帮助</a></li>
				</ul>
			</div><!-- /navbar -->
			<h1>©2013 ezsoon 随便送(www.ezsoon.cn)</h1>
		</footer>
	  <script type="text/javascript" src="./js/base.js"></script>
	  <script type="text/javascript" src="./js/index.js"></script>
      <script type="text/javascript">
	    /* if (!checkMobile())
			location.href = "../"; //PC端 */
	  </script>
	</section>
</body>
</html>