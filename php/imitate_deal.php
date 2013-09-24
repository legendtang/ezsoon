<?php
//模拟用户下单,多了一个phone参数,如非注册用户则uid为0
require_once 'linkDB.php';

if(isset($_POST['time'])&&isset($_POST['address'])&&isset($_POST['zone'])&&isset($_POST['phone'])){
	date_default_timezone_set("Asia/Shanghai");
	$orderTime = date("Y-m-d H:i:s");
	$sendTime = $_POST['time'];
	$address = $_POST['address'];
	$zone = $_POST['zone'];
	$phone = $_POST['phone'];
	$note = null;
	session_start();
	$is_username = mysql_query("SELECT COUNT(*) FROM user WHERE phone = '$phone' LIMIT 1");//验证是否注册过
	$is_username_in = mysql_fetch_array($is_username);
	if($is_username_in[0] == 0){
		mysql_query("INSERT INTO user (phone,mail,password) VALUES ('$phone','temp@ezsoon.cn','123456')");
	}
	$key_row = mysql_query("SELECT * FROM user WHERE phone = '$phone' LIMIT 1");
	$key = mysql_fetch_array($key_row);
	$uid = $key["ID"];
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
		if(mysql_query("INSERT INTO temp_order (orders,num,user_id,note,address,aim_zone,order_time,time_section,state) VALUES ('$order','$num','$uid','$note','$address','$zone','$orderTime','$sendTime','$state')")){
			unset($_SESSION["cart"]);
			echo 1;
		}else{
			echo 'error';
		} 
	}else{
		echo "无订单";
	}
}else{
	echo "信息不全";
}