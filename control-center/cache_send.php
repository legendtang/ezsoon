<?php
require_once "../php/linkDB.php";
if(isset($_POST["id"])){
	$id = $_POST["id"];
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
		$state = explode(";",$row["state"]);
		for($i = 0;$i < count($state);$i++){
			if($state[$i] > 2)
				$state[$i] = 1;
		}
		$state = implode(";",$state);
		if(mysql_query("INSERT INTO cache_sender (ID,orders,num,user_id,note,address,aim_zone,order_time,time_section,state) VALUES ('$id','$orders','$num','$uid','$note','$address','$aim_zone','$orderTime','$sendTime','$state')")){
			$state = explode(";",$state);
			for($i = 0;$i < count($state);$i++){
				if($state[$i] > 0)
					$state[$i] = 6;
			}
			$state = implode(";",$state);
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