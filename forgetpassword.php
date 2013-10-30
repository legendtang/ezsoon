
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>随便送</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript">
		//$(function() {
		//	$('.noTextClear').textClear();
		//});
		$(document).ready(function() { 
			//把下面这段代码加到index.js里的$(document).ready里面就行了,如果要改那几个表单的id这里也要改
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
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>
	<input type="text" id="find_password_username" placeholder="请输入用户名（手机号）">
	<input type="text" id="find_password_checkmail" placeholder="请输入注册时填写的邮箱">
	<button id="find_password_submit">找回密码</button>
	<p>填写正确并点击按钮后该邮箱将会收到找回密码邮件</p>
</body>
</html>