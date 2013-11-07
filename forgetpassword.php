<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<!--[if lt IE 9]>
		<meta http-equiv="Refresh" content="0; url='noie6.html'">  
	<![endif]-->
	<title>随便送</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<script type="text/javascript" src="js/base.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	    if (checkMobile())
			location.href = "mobile/";///移动端域名
	</script>
	<script language="javascript">
		//$(function() {
		//	$('.noTextClear').textClear();
		//});
		$(document).ready(function(){
			$("body").on("click","#find_password_submit",function(){
				var username = $("#find_password_username").val();
				var checkmail = $("#find_password_checkmail").val();
				$.ajax({
					type:"post",
					url:"./php/mailto.php",
					data:"&username="+username+"&mail="+checkmail,
					success:
					function(returnKey){
						alert(returnKey);
					}
				});
			});
		});
	</script>
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
	<style>
		#infoframe{
			width: 960px;
			height: 290px;
			margin: 50px auto 50px;
			border: 1px solid grey;
			border-radius: 5px;
		}
		#pwd-tips{
			width: 760px;
			height: 30px;
			margin: 40px 100px auto;
		}
		.tips-img{
			width: 670px;
			height: 26px;
			background: url(./images/gpwicon.png) no-repeat -26px -285px;
		}
		#form-area{
			width: 370px;
			height: 160px;
			margin: 20px 295px 40px;
		}
		#form-area > label{
			width: 128px;
			height: 50px;
			line-height: 50px;
		}
		#find_password_submit{
			width: 152px;
			height: 38px;
			float: right !important;
			margin: 20px 40px 20px auto;
			background: url(./images/gpwicon.png) no-repeat -26px -102px;
		}
		#find_password_submit:hover{
			background: url(./images/gpwicon.png) no-repeat -26px -149px;
		}
	</style>
</head>
<body>
	<div id="navbar">
		<div class="welcome left">欢迎您来到 <b>随便送！</b> 服务热线：027-87345370 13871390741</div>
		<div class="range right">目前配送范围：华科附中，华科韵苑，SBI创业街</div>
	</div>
	<div id="title">
		<div id="logo" class="home click"></div>
	</div>
	<div id="image-frame"></div>
	<div id="content">
		<div id="infoframe">
			<div id="pwd-tips">
				<span>找回密码：</span>
				<div class="tips-img"></div>
			</div>
			<div id="form-area">
				<label for="find_password_username">请输入手机号：</label><input type="text" id="find_password_username" placeholder="请输入手机号"><br />
				<label for="find_password_checkmail">请输入邮箱地址：</label><input type="text" id="find_password_checkmail" placeholder="请输入注册时填写的邮箱"><br />
				<div id="find_password_submit"></div>
			</div>
		</div>
		<div id="footer">
			<div id="leftfooter">
				<p class="flashlight"><span>关注EZ：</span>即将上线</p>
			</div>
			<div id="rightfooter"><!--div><a href="#">加入我们</a></div><div class="divider2"></div--><div><a href="policies.html">服务协议</a></div></div>
			<div id="copyright"><p>Copyright © 2013 Ezsoon.All Rights Reserved. 版权所有 鄂ICP备13007093号</p></div>
		</div>
		<div id="clear"></div>
	</div>
</body>
</html>