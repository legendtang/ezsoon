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
					$order_sql = mysql_query("SELECT * FROM temp_order ORDER BY ID DESC LIMIT 1");
					$o = mysql_fetch_array($order_sql);
					//登录
					$order_id = $o["ID"];
					unset($_SESSION["cart"]);
					$result = '{"status":1,"order_id":'.$order_id.'}';//成功
				}else{
					$result = '{"status":2,"order_id":-1}';//错误
				} 
			}else{
				$result = '{"status":4,"order_id":-1}';//无订单
			}
		}else{
			$result = '{"status":5,"order_id":-1}';//不在送出时间内
		}
	}else{	
		$result = '{"status":3,"order_id":-1}';//个人信息不全
	}
}//end of isset uid
echo $result;
?>