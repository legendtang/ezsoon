<?php
require_once "./php/linkDB.php";
session_start();

if(isset($_SESSION["uid"])){
	$uid = $_SESSION["uid"];
	$sql = mysql_query("SELECT * FROM user WHERE id='$uid' LIMIT 1");
	$user = mysql_fetch_array($sql);
	$address = $user["address"];
	$phone = $user["phone"];
	$name = isset($user["name"])?$user["name"]:'匿名';
	echo '<script language="javascript">uid = '.$uid.';phone = '.$phone.';name = "'.$name.'";</script>';
	echo '<script language="javascript">login = 1;</script>';
}else{
	echo '<script language="javascript">window.location.href = "./index.php";</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>随便送</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<link rel="stylesheet" type="text/css" href="css/cart.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/cart.js"></script>
	<script type="text/javascript" src="js/base.js"></script>
</head>
<body>
	<div id="navbar">
		<div class="welcome left">欢迎您来到 <b>随便送！</b> 服务热线：027-87345370 13871390741</div>
		<div class="range right">目前配送范围：华科附中，华科韵苑，SBI创业街</div>
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
		</div>
		<div id="main">
			<div id="orderView">
				<ul id="orderNav">
					<li style="width:235px;">购物车商品</li>
					<li style="width:160px;">数量</li>
					<li style="width:120px;">删除</li>
					<li style="width:108px;">积分</li>
					<li style="width:140px;">单价</li>
					<li style="width:145px;">金额</li>
				</ul>
				<div id="list">
					<?php
						$total = 0;
						if(isset($_SESSION["cart"])&&count($_SESSION["cart"])){
							$cart = $_SESSION["cart"];
							echo '<script language="javascript">cart = eval('.json_encode($cart).');</script>';
							$i = 0;
							foreach($cart as $v){
								echo '<ul id="list'.$i.'" class="orderList">';
								echo '<div  class="name" id="order_'.$v[0].'" title="'.$v[1].'">'.$v[1].'</div>';
								echo '<div class="num">';
								echo '<input type="text" value="'.$v[2].'">';
								echo '<div class="changeNumL"><img name="'.$v[0].'" class="up click" src="./images/up.png"><img name="'.$v[0].'" class="down click" src="./images/down.png"></div></DIV>';
								echo '<div class="del click" name="'.$v[0].'"><img src="./images/delete.png"></div>';
								echo '<div class="credits">0</div>';
								echo '<div class="price">￥'.$v[3].'</div>';
								echo '<div class="cost">￥'.$v[2]*$v[3].'</div>';
								echo '</ul>';
								$total += $v[2]*$v[3];
								$i ++;
							}
						}else{
							echo '<script language="javascript">window.location.href = "./index.php"</script>';
						}
					?>
				</div>
				<div id="orderResult">
					<div id="orderMore" class="click"></div>
					<div id="resultView">
						<div class="finalPrice">合计：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥<?php echo $total;?></div>
						<div class="finalPrice">运费：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥2.00</div>
						<div class="finalPrice">总计：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>￥<?php echo $total+2;?></span></div>
					</div>
				</div>
				<div id="clear"></div>
			</div>
			
			<div id="orderInfo">
				<div id="infoNav">订餐信息</div>
				 <?php
					echo '<div class="addressInfo">请选择<span>送餐地址</span>/address:</div>';
					/* $address = explode(";",$address);
					echo '<script language="javascript">addressLength = '.count($address).';</script>';
					if(count($address)){
						
						for($i = 0;$i<count($address);$i++){
							echo '<label class="radio addressInfo">';
							echo	'<input type="radio" name="optionsRadios" id="R'.$i.'" value="'.$address[$i].'" checked>';
							echo	$address[$i];
							echo '</label>';
						}
						echo '<div class="addressInfo">或输入<span>送餐地址</span>/address(如果填写将以本地址为准):</div>';
					}else{
						echo '<div class="addressInfo">请输入<span>送餐地址</span>/address:</div>';
					} */
				?> 
				<div class="addressInfo">
					<select id="zone">
						<option>华科韵苑</option>
						<option>华科附中</option>
						<option>光谷创业街</option>
					</select>
					<select id="add">
					</select>
					<input type="text" id="address" placeholder="送餐地址" x-webkit-speech x-webkit-grammar="bUIltin:search"/>
				</div>
				<div class="addressInfo">请选择送出时间/time:
				<select id="sendTime">
					<?php
						date_default_timezone_set("Asia/Shanghai");
						$hour = Date("G");
						$min = intval(Date("i"))>30?1:0;
						$timeSection = $hour*2+$min;
						$timeArray = array('<option value = "21">10:30</option>','<option value = "22">11:00</option>','<option value = "23">11:30</option>','<option value = "24">12:00</option>','<option value = "25">12:30</option>','<option value = "26">13:00</option>','<option value = "27">13:30</option>','<option value = "28">14:00</option>','<option value = "29">14:30</option>','<option value = "30">15:00</option>','<option value = "31">15:30</option>','<option value = "32">16:00</option>','<option value = "33">16:30</option>','<option value = "34">17:00</option>','<option value = "35">17:30</option>','<option value = "36">18:00</option>','<option value = "37">18:30</option>','<option value = "38">19:00</option>','<option value = "39">19:30</option>','<option value = "40">20:00</option>');
						
						for($i = ($timeSection-20);$i < count($timeArray);$i++){
							echo $timeArray[$i];
						}
					?>
				</select>
				</div>
				<div id="phone" class="addressInfo">联系电话:<?php echo $phone;?></div>
				<div id="confirm">
					<textarea id="otherInfo" placeholder="备注信息"></textarea> 
					<div id="submit" class="click"></div>
				</div>
				<div id="clear"></div>
			</div>
		</div>
		<div id="footer">
			<div id="leftfooter">
				<p class="flashlight"><span>关注EZ：</span>即将上线</p>
			</div>
			<div id="rightfooter"><!--div><a href="#">加入我们</a></div><div class="divider2"></div><div><a href="agreement.html">服务协议</a></div--></div>
			<div id="copyright"><p>Copyright © 2013 Ezsoon.All Rights Reserved. 版权所有 鄂ICP备13007093号</p></div>
		</div>
		<div id="clear"></div>
	</div>
	<!--<div id="area_chosen">
		<div id="ac_nav">
			<div class="ac_img"></div>
		</div>
		<div id="nav_frame">
			<div class="ac_close"></div>
			<div class="area_1"></div>
			<div class="area_2"></div>
			<div class="area_3"></div>			
		</div>
	</div>-->
	<div id="personal_center_bg" class="hidePC"></div>
	<div id="view_order_bg"></div>
	<div id="personal_center">
		<div id="pc_nav">
			<div id="pi" class="click">个人信息</div>
			<div id="ho" class="click">历史订单</div>
			<div id="co" class="click">当前订单</div>
			<div id="cp" class="click">修改密码</div>
		</div>
		<div id="personal_info"></div>
		<div id="history_order" class="disabled"></div>
		<div id="current_order" class="disabled"></div>
		<div id="change_password" class="disabled">
		</div>
	</div>
	<div id="view_order">
	</div>
</body>
</html>