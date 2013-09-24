<?php
require_once "../php/linkDB.php";
if(isset($_POST["order"])&&isset($_POST["type"])){
	$order = explode('_',$_POST["order"]);
	$id = $order[0];
	$food = $order[1];
	if($_POST["type"] == 'normal'){
		$sql = mysql_query("SELECT * FROM temp_order WHERE ID = '$id'");
		if($order = mysql_fetch_array($sql)){
			$state = explode(";",$order["state"]);
			$state[$food] = 3;
			$state = implode(";",$state);
			if(mysql_query("UPDATE temp_order SET state = '$state' WHERE ID = '$id'")){
				echo 1;
			}else{
				echo 2;
			}
		}
	}else if($_POST["type"] == 'cache'){
		$sql = mysql_query("SELECT * FROM cache_order WHERE ID = '$food'");
		if($row = mysql_fetch_array($sql)){
			$food_id = $row["orders"];
			$sql = mysql_query("SELECT * FROM temp_order WHERE ID = '$id'");
			if($row = mysql_fetch_array($sql)){
				$orders = explode(";",$row["orders"]);
				$state = explode(";",$row["state"]);
				for($i = 0;$i<count($orders);$i++){
					if($orders[$i] == $food_id){
						$state[$i] = 3;
						$state = implode(";",$state);
						if(mysql_query("UPDATE temp_order SET state='$state' WHERE ID='$id'")){
							mysql_query("DELETE FROM cache_order WHERE ID='$food'");
							echo 1;
						}else{
							echo 3;
						}
					}
				}
			}
			$s_sql = mysql_query("SELECT * FROM cache_sender WHERE ID = '$id'");
			if($c_sender = mysql_fetch_array($s_sql)){
				$orders = explode(";",$c_sender["orders"]);
				$state = explode(";",$c_sender["state"]);
				for($i = 0;$i<count($orders);$i++){
					if($orders[$i] == $food_id){
						$state[$i] = 1;
						$state = implode(";",$state);
						if(mysql_query("UPDATE cache_sender SET state='$state' WHERE ID='$id'")){
						}else{
							echo 2;
						}
					}
				}
			}
		}
	}
}else{
	echo 2;
}
?>