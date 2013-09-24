<?php
require_once "../php/linkDB.php";
if(isset($_POST["id"])&&isset($_POST["order"])){
	$id = $_POST["id"];
	$order = $_POST["order"];
	$sql = mysql_query("SELECT * FROM temp_order WHERE ID='$id'");
	if($row = mysql_fetch_array($sql)){
		$orders = explode(";",$row["orders"]);
		$food = $orders[$order];
		$nums = explode(";",$row["num"]);
		$num = $nums[$order];
		$uid = $row["user_id"];
		$note = $row["note"];
		$address = $row["address"];
		$aim_zone = $row["aim_zone"];
		$orderTime = $row["order_time"];
		$sendTime = $row["time_section"];
		$state = explode(";",$row["state"]);
		array_splice($state,$order,1,4);
		$state = implode(";",$state);
		if(mysql_query("INSERT INTO cache_order (o_id,orders,num,user_id,note,address,aim_zone,order_time,time_section) VALUES ('$id','$food','$num','$uid','$note','$address','$aim_zone','$orderTime','$sendTime')")){
			mysql_query("UPDATE temp_order SET state='$state' WHERE	ID='$id'");
			echo 1;
		}else{
			echo 2;
		}
	}else{
		echo 3;
	}
}else{
	echo 4;
}
?>