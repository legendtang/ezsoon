<?php
require_once "./php/linkDB.php";
session_start();

if(isset($_SESSION["uid"])){
	$uid = $_SESSION["uid"];
	$sql = mysql_query("SELECT * FROM user WHERE id='$uid' LIMIT 1");
	$user = mysql_fetch_array($sql);
	$zone = $user["zone"];
	$login = 1;
	$zone_selected = 1;
}else{
	if(isset($_GET['zone'])){
		$zone = $_GET['zone'];
		$zone_selected = 1;
	}else{
		$zone = 0;
		$zone_selected = 0;
	}
	
	$login = 0;
}
switch($zone){
	case 0:
		$zone_name = '光谷软件园';
		break;
	case 1:
		$zone_name = '华科附中送餐区';
		break;
	case 2:
		$zone_name = '光谷SBI送餐区';
		break;
}

?>
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
	<link rel="stylesheet" type="text/css" href="css/home.css" />
	<script type="text/javascript" src="js/home.js"></script>
	<script type="text/javascript" src="js/base.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	    if (checkMobile())
			location.href = "mobile/";///移动端域名
	</script>
</head>
<body>
	<div id="navbar">
		<div class="welcome left">欢迎您来到 <b>随便送！</b> 服务热线：027-87345370 13871390741</div>
		<div class="range right">目前配送范围：华科附中，光谷软件园，SBI创业街</div>
	</div>
	<div id="background"></div>
	<div id="background-bottom"></div>
	<div id="title">
		<div id="logo" class="home click"></div>
		<?php if($login){
			echo'<div id="logout" class="logout click"></div>';
			echo'<div id="showPC" class="showPC click right"></div>';
		}?>
	</div>
	<div id="image-frame"></div>
	<div id="content">
		<div id="topContent" style="position:relative;">
			<div id="fader">
				<ul>
					<li><img  src="./images/slide/1.jpg" alt=""></li>
					<li><img  src="./images/slide/2.jpg" alt=""></li>
					<li><img  src="./images/slide/3.jpg" alt=""></li>
				</ul>
				<a href="#" id="preCircle" class="slide-btn" style="display: block;"> </a>
				<a href="#" id="nextCircle" class="slide-btn" style="display: block;"> </a>
			</div>
		</div>
		<div id="main">
			<div id="leftContent">
				<ul>
				<?php
					$sql = mysql_query("SELECT * FROM restaurant ORDER BY ID");
					while($row = mysql_fetch_array($sql)){
						$id = $row["ID"];
						$name = $row["name"];
						$to_zone = explode(";",$row["to_zone"]);
						$logo = $row["big_img"];
						$time = $row["time"];
						$short_info = $row["short_info"];
						$state = $row["state"];	
						for($i = 0;$i<count($to_zone);$i++){
							if($to_zone[$i] == $zone){
								echo '<li class="click shop" ';
								echo $state?'onclick="window.location.href = \'./shop.php?id='.$id.'\';">':'>';
								echo 	'<img class="shopImg" src="'.$logo.'"></img>';
								echo	'<div class="shopInfo red"><div class="shopView"><div class="shopText"><div><b>'.$name.'</b></div><div><div style="float:left;width:auto">类别：</div><div style="color:#cf5a03;float:left;width:auto">'.$short_info.'</div></div></div></div>';
								echo $state?"<div class=\"shopRun\"><div>营业中</div></div>":"<div class=\"shopPause\"><div>暂停</div></div>";
								echo '</div></li>';
							}
						}
				}
				?>
				</ul>
			</div>
			<div id="rightContent">
				<div class="click switch_area"><?php echo $zone_name;?>(点击切换送餐区域)</div>
				<?php 
					if($login){
						echo '<script language="javascript">login = 1;</script>';
						echo '<div id="iwannabe">购物车</div>';
						echo '<div id="loginUI" style="margin:0">';
						if(isset($_SESSION["cart"])&&count($_SESSION["cart"])){
							$cart = $_SESSION["cart"];
							echo '<ul id="cart">';
							foreach($cart as $v){
								echo '<li><div class="orderTop"><div class="foodName" id="food_'.$v[0].'">'.$v[1].'</div>';
								echo '<div class="delN click"><img src="./images/delete.png"></div></div>';
								echo '<div class="orderBottom"><div class="foodCost">总价:'.$v[2]*$v[3].'</div>';
								echo '<div class="foodNum"><lable id="num_'.$v[0].'">数量</lable><input id="num_'.$v[0].'" type="text" value="'.$v[2].'">';
								echo '<div class="changeNum"><img name="'.$v[0].'" id="up_'.$v[0].'" class="up click" src="./images/up.png"><img name="'.$v[0].'" id="down_'.$v[0].'" class="down click" src="./images/down.png"></div>件</div></div></li>';
							}
							echo '</ul><div id="pay" class="click">结算</div>';
						}else{
							echo '<div class="blank-cart"></div>';
						}
						echo '<div class="click" id="logout"></div></div>';
					}else{
						echo '<div id="iwannabe">我要订餐</div>';
						echo '<div id="loginUI">';
						echo '<div class="return-home"><a href="./">已有账号或有意注册？请点此返回首页</a></div>';
						echo '</div>';
					}	
				?>
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
	
	<div id="area_chosen"<?php if($zone_selected){echo 'style="display:none;"';}?>>
	<div id="ac_nav">
			<div class="ac_img"></div>
		</div>
		<div id="nav_frame">
			<div class="ac_close"></div>
			<div class="area_1"></div>
			<div class="area_2"></div>
			<div class="area_3"></div>			
		</div>
	</div>
	<div id="personal_center_bg" class="hidePC"></div>
	<div id="personal_center">
		<div id="pc_nav">
			<div id="pi" class="click"><div class="pc-img pi-img"></div>个人信息</div>
			<div id="ho" class="click"><div class="pc-img ho-img"></div>历史订单</div>
			<div id="co" class="click"><div class="pc-img co-img"></div>当前订单</div>
			<div id="cp" class="click"><div class="pc-img cp-img"></div>修改密码</div>
		</div>
		<div id="personal_info"></div>
		<div id="history_order" class="disabled"></div>
		<div id="current_order" class="disabled"></div>
		<div id="change_password" class="disabled">
		</div>
	</div>
</body>
</html>