<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<!--[if lt IE 9]>
		<meta http-equiv="Refresh" content="0; url='noie6.html'">  
	<![endif]-->
	<title>随便送</title>
	<link rel="stylesheet" type="text/css" href="../css/layout.css" />
	<script type="text/javascript">
	    if (checkMobile())
			location.href = "../mobile/";///移动端域名
	</script>
	<script language="javascript">
		//$(function() {
		//	$('.noTextClear').textClear();
		//});
		$(document).ready(function(){
			$("body").on("click",".home",function(){home();});
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
			background: url(../images/gpwicon.png) no-repeat -26px -285px;
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
		#submit_password{
			width: 152px;
			height: 38px;
			float: right !important;
			margin: 20px 40px 20px auto;
			background: url(../images/gpwicon.png) no-repeat -26px -193px;
			text-decoration: none;
			border: none;
		}
		#submit_password:hover{
			background: url(../images/gpwicon.png) no-repeat -26px -236px;
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
	<div id="return-home" class="home click"></div>
	<div id="content">
		<div id="infoframe">
			<div id="pwd-tips">
				<span>找回密码：</span>
				<div class="tips-img"></div>
			</div>
			<div id="form-area">
<?php
require_once ('./linkDB.php');
/**
 * 用base64_decode解开$_GET['p']的值
*/
if(isset($_GET['token'])){
	$p=$_GET['token'];
	$array = explode('.',base64_decode($p));
	//echo "<br>";
	/**
	 * 这时，我们会得到一个数组，$array，里面分别存放了用户名和我们需要一段字符串
	 * $array[0] 为用户名
	 * $array[1] 为我们生成的字符串
	*/
	//好了，我们开始进行匹配工作吧。

	$sql = mysql_query("select password from user where phone = '".trim($array['0'])."'");
	$rs=mysql_fetch_array($sql);

	$password = $rs['password'];
	/**
	 * 产生配置码 
	*/
	 $checkCode = md5($array['0'].'+'.$password);
	/**
	 * 进行配置验证： => 
	*/
	if( $array['1'] === $checkCode ){
		//echo '<div id="pwd-tips">您好，请确认您的手机号为：'.$array['0'].'</div>';
		echo '<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/index.js"></script>';
		echo '<label for="new_password">请输入新密码：</label><input type="text" id="new_password"><br /><label for="new_password_c">请确认新密码：</label><input type="text" id="new_password_c"><br /><button type="submit" id="submit_password"></button>';
	}
}
?>
			</div>
		</div>
		<div id="footer">
			<div id="leftfooter">
				<p class="flashlight"><span>关注EZ：</span>即将上线</p>
			</div>
			<div id="rightfooter"><!--div><a href="#">加入我们</a></div><div class="divider2"></div--><div><a href="../policies.html">服务协议</a></div></div>
			<div id="copyright"><p>Copyright © 2013 Ezsoon.All Rights Reserved. 版权所有 鄂ICP备13007093号</p></div>
		</div>
		<div id="clear"></div>
	</div>
</body>
</html>