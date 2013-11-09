<?php
require_once "./php/linkDB.php";
session_start();

if(isset($_SESSION["uid"])){
	$uid = $_SESSION["uid"];
	$login = 1;
}else{
	$login = 0;
}
if($_GET["id"]){
	$id = $_GET["id"];
	$sql = mysql_query("SELECT * FROM restaurant WHERE id='$id' LIMIT 1");
	$shop = mysql_fetch_array($sql);
	$shop_name = $shop["name"];
	$logo = $shop["logo"];
	$big_img = $shop["big_img"];
	$phone = $shop["phone"];
	$description = $shop["description"];
	$shop_type = explode(";",$shop["type"]);
	$run_time = $shop["time"];
	//product
	$menu = array();
	$product = mysql_query("SELECT * FROM product WHERE shop_id='$id'");
	while($row = mysql_fetch_array($product)){
		$id = $row["ID"];
		$name = $row["name"];
		$image = $row["image"];
		$price = $row["price"];
		$type = $row["type"];
		$time = $row["time"];
		$food_description = $row["description"];
		$state = $row["state"];
		$menu[] = array($id,$name,$type,$price,$image,$state,$time,$food_description);
	}
}else{
	echo "<script>window.location.href='./index.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>商店名--随便送</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<link rel="stylesheet" type="text/css" href="css/shop.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/powerFloat.css" />
	<script src="js/jquery-powerFloat-min.js"></script>
	<script type="text/javascript" src="js/base.js"></script>
	<script type="text/javascript" src="js/shop.js"></script>
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
	<div id="return-home" class="home click"></div>
	<div id="content">
		<div id="topContent" style="position:relative;">
			<!--img src="./images/slide/1.jpg" alt=""/-->
			<img src="<?php echo $logo;?>" style="width: 960px; height: 411px; meigong: 死ぬ"/>
			<!--img id="shopLogo"src="<?php echo $logo;?>"/>
			<p><?php echo $description;
					echo "</br>";
					echo "<span>营业时间:".$run_time."</span>";
				?>
			</p-->
		</div>
		<div id="main">
			<div id="leftContent">
				<ul id="type-nav">
					<?php
						$nav_num = count($shop_type)>5?10:5;
						for($i = 0;$i<$nav_num;$i++){
							$flag = 0;
							echo '<li class="navBar';
							foreach($menu as $v){
								if($v[2] == $i&&$flag == 0){
									echo ' actBar';
									$flag = 1;
								}
							}
							echo '">';
							if(isset($shop_type[$i])){echo '<a href="#Nav'.($i+1).'">'.$shop_type[$i].'</a>';}
							echo '</li>';
						}
					?>
				</ul>
				
				<div id="customContainer" class="custom_container"></div>
				<div id="menu">
					<?php
						for($i = 0;$i<$nav_num;$i++){
							$title = 0;
							foreach($menu as $v){
								if($v[2] == $i){
									if($title == 0){
										echo '<ul><div id="Nav'.($i+1).'" class="subNav">'.$shop_type[$i].'</div>';
										$title = 1;
									}
									
									echo '<li id="f_'.$v[0].'" class="item ';
									if($v[5])echo 'available';
									echo '" name="'.$v[0].'"><p id="desrTrigger_'.$v[0].'" point="foodDesr_'.$v[0].'">'.$v[1].'</p><span>￥'.$v[3].'</span>'.'</li>';
									if($v[7] != null||$v[4] != null){
										echo '<div id="foodDesr_'.$v[0].'" class="shadow target_box dn">';
										if($v[4] != null)echo '<img src="'.$v[4].'"></img>';
										if($v[7] != null)echo '<p class="desr">'.$v[7].'</p>';
										echo '</div>';
										echo '<script type="text/javascript">
												$("#desrTrigger_'.$v[0].'").powerFloat({
													targetMode: null,
													targetAttr: "src",
													targetAttr: "point",
													container: $("#customContainer"),
													offsets:{x:20,y:20}
												});
											</script>';
									}
								}
							}
							echo '</ul>';
						}
					?>
				</div>
			</div>
			<div id="rightContent">
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
			<div id="rightfooter"><!--div><a href="#">加入我们</a></div><div class="divider2"></div><div><a href="agreement.html">服务协议</a></div--></div>
			<div id="copyright"><p>Copyright © 2013 Ezsoon.All Rights Reserved. 版权所有 鄂ICP备13007093号</p></div>
		</div>
		<div id="clear"></div>
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