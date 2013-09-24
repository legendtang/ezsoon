<?php
require_once "../php/linkDB.php";

date_default_timezone_set(PRC);
$hour = Date("G");
$min = intval(Date("i"))>30?1:0;
$timeSection = $hour*2+$min+1;
$time_sql = mysql_query("SELECT * FROM temp_order WHERE time_section <= '$timeSection'");
while($time = mysql_fetch_array($time_sql)){
	$id = $time["ID"];
	$orders = explode(";",$time["orders"]);
	$state = explode(";",$time["state"]);
	
	$flag = 0;
	$is_cache = 0;
	$cstate = array();
	for($i = 0;$i < count($orders)-1;$i++){
		if($state[$i] == 1||$state[$i] == 2){
			$is_cache = 1;
			$sql = mysql_query("SELECT * FROM temp_order WHERE ID='$id'");
			if($row = mysql_fetch_array($sql)){
				$orders = explode(";",$row["orders"]);
				$food = $orders[$i];
				$orders = implode(";",$orders);
				$nums = explode(";",$row["num"]);
				$num = $nums[$i];
				$nums = implode(";",$nums);
				$uid = $row["user_id"];
				$note = $row["note"];
				$address = $row["address"];
				$aim_zone = $row["aim_zone"];
				$orderTime = $row["order_time"];
				$sendTime = $row["time_section"];
				$state[$i] = 4;
				if(mysql_query("INSERT INTO cache_order (o_id,orders,num,user_id,note,address,aim_zone,order_time,time_section) VALUES ('$id','$food','$num','$uid','$note','$address','$aim_zone','$orderTime','$sendTime')")){
					echo 1;
				}
				
			}else{
				echo 3;
			}
		}
		if($state[$i] == 4){
			$is_cache = 1;
		}
		if($state[$i] == 3||$state[$i] == 5){
			$flag++;
		}
	}
	if($is_cache == 1){
		$sql = mysql_query("SELECT * FROM temp_order WHERE ID='$id'");
		if($row = mysql_fetch_array($sql)){
			$orders = $row["orders"];
			$nums = $row["num"];
			$uid = $row["user_id"];
			$note = $row["note"];
			$address = $row["address"];
			$aim_zone = $row["aim_zone"];
			$orderTime = $row["order_time"];
			$sendTime = $row["time_section"];
			for($h = 0;$h < count($state)-1;$h++){
				if($state[$h] == 3){
					$cstate[$h] = 1;
					$state[$h] = 6;
				}else{
					$cstate[$h] = 0;
				}
			}
			$cstate[$h] = '';
			$cstate = implode(";",$cstate);
			if(mysql_query("INSERT INTO cache_sender (ID,orders,num,user_id,note,address,aim_zone,order_time,time_section,state) VALUES ('$id','$orders','$nums','$uid','$note','$address','$aim_zone','$orderTime','$sendTime','$cstate')")){
				echo 'ok';
			}
		}
	}
	if($flag == (count($orders)-1)){
		$sql = mysql_query("SELECT * FROM temp_order WHERE ID='$id'");
		if($row = mysql_fetch_array($sql)){
			$orders = $row["orders"];
			$num = $row["num"];
			$uid = $row["user_id"];
			$note = $row["note"];
			$address = $row["address"];
			$aim_zone = $row["aim_zone"];
			$orderTime = $row["order_time"];
			$sendTime = $row["time_section"];
			for($k = 0;$k < count($state)-1;$k++){
				$state[$k] = 1;
			}
			$state = implode(";",$state);
			if(mysql_query("INSERT INTO cache_sender (ID,orders,num,user_id,note,address,aim_zone,order_time,time_section,state) VALUES ('$id','$orders','$num','$uid','$note','$address','$aim_zone','$orderTime','$sendTime','$state')")){
				$state = explode(";",$state);
				for($j = 0;$j < count($state)-1;$j++){
					$state[$j] = 6;
				}
			}
		}
	}
	
	$state = implode(";",$state);
	mysql_query("UPDATE temp_order SET state='$state' WHERE	ID='$id'");
}
echo '整合时段'.$timeSection.'之前订单成功';
echo '<button onclick=\'window.location.href="./control_center.php"\' style="margin:30px;">返回区域选择</button>';
?>