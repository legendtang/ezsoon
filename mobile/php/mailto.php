<!DOCTYPE html>
<html>
<head>
<title>找回密码申请</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1" /> 
<link rel="stylesheet" href="../css/jquery_mobile.css" />
<script src="../js/jquery.js"></script>
<script src="../js/jquery_mobile.js"></script>
</head>
<body>
	<section dtat-role="page">
		<div data-role="header">
			<a data-rel="back" data-icon="back" >返回</a>
			<h2>找回密码申请</h2>
		</div>
		<div data-role="content" data-position="inline">
			<p>
<?php
require_once ('./linkDB.php');
require_once ('./email.class.php');
if(!isset($_POST['username'])||!isset($_POST['mail'])){
	echo '信息不全!';
	exit;
}
$username = trim($_POST['username']);
$check_mail = trim($_POST['mail']);

$sql=mysql_query("select * from user where phone='$username'");
$num=mysql_num_rows($sql);
$userinfo=mysql_fetch_array($sql);

$user_name = $userinfo['phone'];
$password = $userinfo['password'];
$user_email = $userinfo['mail'];
if($num<=0){
	echo "用户不存在";
	exit;
}else{
	if($user_email != $check_mail){
		echo "验证邮箱错误";
		exit;
	}else{
		$x = md5($username.'+'.$password);
		$string = base64_encode($username.".".$x);
		$smtpserver = "smtp.exmail.qq.com";//SMTP服务器
		$smtpserverport =25;//SMTP服务器端口
		$smtpusermail = "noreply@ezsoon.cn";//SMTP服务器的用户邮箱
		$smtpemailto =$user_email;//发送给谁
		$smtpuser = "noreply@ezsoon.cn";//SMTP服务器的用户帐号
		$smtppass = "suibian2013.";//SMTP服务器的用户密码
		$mailsubject = "[随便送--ezsoon.cn] 取回密码邮件 ";//邮件主题
		$mailbody = '尊敬的'.$username.'手机号使用者：<br />&nbsp;&nbsp;&nbsp;&nbsp;取回密码邮件<br />请点击下面的链接，按流程进行密码重设。<a href="http://localhost/ezsoon/php/resetpassword.php?token='.$string.'" mce_href="http://localhost/in-te/resetpassword.php?token='.$string.'">http://localhost/in-te/resetpassword.php?token='.$string.'</a><br>(如果上面不是链接形式，请将地址手工粘贴到浏览器地址栏再访问)
		上面的页面打开后，输入新的密码后提交，之后您即可使用新的密码登录了。<br><br>此邮件为系统邮件，请勿直接回复';
		//邮件内容
		$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
		$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = false;//是否显示发送的调试信息
		$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
		echo "邮件已发送,赶快去".$user_email."邮箱查收";
	}
}
?>
			</p>
		</div>
		<footer data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
					<li><a data-icon="info" href="./help.html">帮助</a></li>
				</ul>
			</div><!-- /navbar -->
			<h1>©2013 ezsoon 随便送(www.ezsoon.cn)</h1>
			
		</footer>
	</section>
</body>
</html>