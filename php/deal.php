<?php
require_once 'linkDB.php';

if(isset($_POST['time'])&&isset($_POST['address'])&&isset($_POST['zone'])){
	date_default_timezone_set("Asia/Shanghai");
	$orderTime = date("Y-m-d H:i:s");
	$sendTime = $_POST['time'];
	$address = $_POST['address'];
	$zone = $_POST['zone'];
	$note = null;
	session_start();
	$uid = $_SESSION["uid"];
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