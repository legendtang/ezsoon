<?php
require_once "../php/linkDB.php";
if(isset($_POST["order"])){
	$order = explode("_",$_POST["order"]);
	$id = $order[1];
	$shop_id = $order[0];
	$sql = mysql_query("SELECT * FROM temp_order WHERE ID = '$id'");
	if($order = mysql_fetch_array($sql)){
		$orders = explode(";",$order["orders"]);
		$state = explode(";",$order["state"]);
		for($index = 0;$index < count($orders);$index++){
			$food_sql = mysql_fetch_array(mysql_query("SELECT * FROM product WHERE ID = '$orders[$index]'"));
			$from_id = $food_sql["shop_id"];
			if($shop_id == $from_id){
				$state[$index] = 1;
			}
		}
		$state = implode(";",$state);
		if(mysql_query("UPDATE temp_order SET state = '$state' WHERE ID = '$id'")){
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