<?php
require_once "./php/linkDB.php";
session_start();

if(!isset($_SESSION["uid"])){
	echo '<script language="javascript">window.location.href = "./index.php";</script>';
}else{
	$uid = $_SESSION["uid"];
	$sql = mysql_query("SELECT * FROM user WHERE id='$uid' LIMIT 1");
	$user = mysql_fetch_array($sql);
	$address = $user["address"];
	$phone = $user["phone"];
	$mail = $user["mail"];
	$gender = $user["gender"];
	$zone = $user["zone"];
	$address = $user["address"];
	$name = isset($user["name"])?$user["name"]:'匿名';
}

?>
<!DOCTYPE html> 
<html> 
　<head> 
	<meta charset="utf-8">
　 	<title>个人中心--随便送</title> 
　	<meta name="viewport" content="width=device-width, initial-scale=1"> 
　 	<link rel="stylesheet" href="./css/jquery_mobile.css" />
　	<script src="./js/jquery.js"></script>
	<script src="./js/jquery_mobile.js"></script>
	
</head> 
<body>
	<section data-role="page">
		<div data-role="header" data-position="inline">
			<h1>个人中心</h1>
		</div>
		<div data-role="content" data-position="inline">
			<form action="update_info.php" method="post">
				<div data-role="fieldcontain">
					<label for="phone">您的账号(不可修改):</label>
					<input id="phone" placeholder="联系电话(您的账号)"  type="text" disabled="true" value="<?php echo $phone;?>">
				</div>
				<div data-role="fieldcontain">
					<label for="name">姓  名:</label>
					<input id="name" placeholder="姓名" type="text" value="<?php echo $name;?>">
				</div>
				<div data-role="fieldcontain">
					<label for="gender" class="select">性别:</label>
					<select id="gender" data-native-menu="false">
						<option value="1" <?php if($gender == 1)echo 'selected="selected"';?>>男</option>
						<option value="2" <?php if($gender == 2)echo 'selected="selected"';?>>女</option>
					</select>
				</div>
				<div data-role="fieldcontain">
					<label for="mail">您的电子邮箱(用于找密码):</label>
					<input id="mail" placeholder="电子邮箱" type="text" value="<?php echo $mail;?>">
				</div>
				<div data-role="fieldcontain">
					<label for="zone" class="select">送餐地址:</label>
					<select id="zone" data-native-menu="false">
						<option value="0" <?php if($zone == 0)echo 'selected="selected"';?>>喻园学生公寓</option>
						<option value="1" <?php if($zone == 1)echo 'selected="selected"';?>>华科大附中</option>
						<option value="2" <?php if($zone == 2)echo 'selected="selected"';?>>SBI送餐区</option>
					</select>
				</div>
				<div data-role="fieldcontain">
					<label for="address">详细送餐地址:</label>
					<input id="address" placeholder="详细送餐地址" type="text" value="<?php echo $address;?>">
				</div>
			</form>
		</div>
		<footer data-role="footer">
			<div data-role="navbar">
				<ul>
					<li><a data-rel="back" data-icon="back" >返回继续订餐</a></li>
					<li><a data-icon="check" id="update_info">确定</a></li>
				</ul>
			</div><!-- /navbar -->
			<h1>©2013 ezsoon 随便送(www.ezsoon.cn)</h1>
		</footer>
		<script type="text/javascript" src="./js/personal_center.js"></script>
	</section>
</body>
</html>