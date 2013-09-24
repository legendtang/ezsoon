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
	$zone = $user["zone"];
	$phone = $user["phone"];
	$name = isset($user["name"])?$user["name"]:'匿名';
	//echo '<script language="javascript">uid = '.$uid.';phone = '.$phone.';name = "'.$name.'";</script>';
	echo '<script language="javascript">login = 1;</script>';
}

?>
<!DOCTYPE html> 
<html> 
　<head> 
	<meta charset="utf-8">
　 	<title>购物车--随便送</title> 
　	<meta name="viewport" content="width=device-width, initial-scale=1"> 
　 	<link rel="stylesheet" href="./css/jquery_mobile.css" />
　	<script src="./js/jquery.js"></script>
	<script src="./js/jquery_mobile.js"></script>
	
</head> 
<body>
	<section data-role="page">
		<div data-role="header" data-position="inline">
			<a  data-icon="gear" href="./personal_center.php">个人中心</a>
			<h1>购物车</h1>
			<a id="logout" data-icon="delete">注销</a>
		</div>
		<div data-role="content" data-position="inline">
			<ul data-role="listview" data-inset="true" data-filter="false">
				<?php
					if(!isset($_SESSION["cart"])||!count($_SESSION["cart"])){
						echo '<script language="javascript">window.location.href = "./home.php";</script>';
					}else{
						$cart = $_SESSION["cart"];
						echo '<script language="javascript">cart = eval('.json_encode($cart).');</script>';
						$i = 0;
						foreach($cart as $v){
							echo '<li><div class="ui-grid-d" id="list'.$i.'">';
							echo '<div class="ui-block-a" style="line-height:30px;">'.$v[1].'</div>';
							echo '<div class="ui-block-b" style="text-align:center;"><a  data-iconpos="notext" data-icon="minus" data-role="button" name="'.$v[0].'" class="down"></a></div>';
							echo '<div class="ui-block-c num" style="text-align:center;line-height:38px;">'.$v[2].'</div>';
							echo '<div class="ui-block-d" style="text-align:center;"><a  data-iconpos="notext" data-icon="plus" data-role="button" name="'.$v[0].'" class="up"></a></div>';
							echo '<div class="ui-block-d" style="text-align:center;line-height:38px;">价格:'.$v[3].'</div>';
							echo '</div></li>';
							$total += $v[2]*$v[3];
							$i ++;
						}
						
					}
					echo '<li><div class="ui-grid-b"><div class="ui-block-a" style="line-height:30px;">合计:￥'.$total.'</div><div class="ui-block-b" style="line-height:30px;">运费:￥2</div><div class="ui-block-c" style="line-height:30px;color:red;">总计:￥'.($total+2).'</div></div></li>';
				?>
				
			</ul>
			<?php
				date_default_timezone_set("Asia/Shanghai");
				$hour = Date("G");
				$min = intval(Date("i"))>30?1:0;
				$timeSection = $hour*2+$min;
				$timeArray = array('<option value = "21">10:30</option>','<option value = "22">11:00</option>','<option value = "23">11:30</option>','<option value = "24">12:00</option>','<option value = "25">12:30</option>','<option value = "26">13:00</option>','<option value = "27">13:30</option>','<option value = "28">14:00</option>','<option value = "29">14:30</option>','<option value = "30">15:00</option>','<option value = "31">15:30</option>','<option value = "32">16:00</option>','<option value = "33">16:30</option>','<option value = "34">17:00</option>','<option value = "35">17:30</option>','<option value = "36">18:00</option>','<option value = "37">18:30</option>','<option value = "38">19:00</option>','<option value = "39">19:30</option>','<option value = "40">20:00</option>');
				
			?>
			<div data-role="fieldcontain">
				<label for="zone" class="select">送出时间:</label>
				<select id="sendTime" data-native-menu="false">
				<?php
					if($zone == 2){
						if($timeSection < 24){
							echo '<option value = "23">11:30</option>';
						}
						if($timeSection < 36){
							echo '<option value = "35">17:30</option>';
						}
					}else{
						for($i = ($timeSection-20);$i < count($timeArray);$i++){
							echo $timeArray[$i];
						}
					}
				?>
				</select>
			</div>
			
		</div>
		<footer data-role="footer" >
			<div data-role="navbar">
				<ul>
					<li><a data-icon="back" href="./home.php" >继续订餐</a></li>
					<li><a data-icon="refresh" href="javascript:location.reload();" >刷新购物车</a></li>
					<li><a data-icon="check" id="submit">下单</a></li>
				</ul>
			</div><!-- /navbar -->
			<h1>©2012 ezsoon 随便送(www.ezsoon.cn)</h1>
		</footer>
		<script type="text/javascript" src="./js/cart.js"></script>
		<script type="text/javascript" src="./js/base.js"></script>
	</section>
	
</body>
</html>