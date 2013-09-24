<?php
require_once 'linkDB.php';
session_start();
if(!isset($_SESSION["uid"])){
	$result = 6;//未登录
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
	$name = $user["name"];
	if($address&&$zone){
		if(isset($_POST["time"])){
			date_default_timezone_set("Asia/Shanghai");
			$orderTime = date("Y-m-d H:i:s");
			$sendTime = $_POST['time'];
			$note = null;
			
			if(isset($_SESSION["cart"])){
				$cart = $_SESSION["cart"];
				$order = '';
				$num = '';
				$state = '';
				foreach($cart as $v){
					$order = $order.$v[0].';';
					$num = $num.$v[2].';';
					$state = $state.'0;';
				}
				switch($zone){
					case 0: 
						$add = "华科韵苑".$address;
						break;
					case 1: 
						$add = "华科附中".$address;
						break;
					case 2:
						$add = "光谷创业街".$address;
						break;
				}
				if(mysql_query("INSERT INTO temp_order (orders,num,user_id,note,address,aim_zone,order_time,time_section,state) VALUES ('$order','$num','$uid','$note','$address','$zone','$orderTime','$sendTime','$state')")){
					unset($_SESSION["cart"]);
					$result = 1;//成功
				}else{
					$result = 2;//错误
				} 
			}else{
				$result = 4;//无订单
			}
		}else{
			$result = 5;//不在送出时间内
		}
	}else{	
		$result = 3;//个人信息不全
	}
}//end of isset uid
echo $result;
?>