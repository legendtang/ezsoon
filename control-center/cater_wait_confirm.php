<?php
require_once "../php/linkDB.php";
if(isset($_POST["order"])&&isset($_POST["type"])){
	$order = explode("_",$_POST["order"]);
	$id = $order[0];
	$food = $order[1];
	if($_POST["type"] == 'normal'){
		$sql = mysql_query("SELECT * FROM temp_order WHERE ID = '$id'");
		if($order = mysql_fetch_array($sql)){
			$state = explode(";",$order["state"]);
			$state[$food] = 2;
			$state = implode(";",$state);
			if(mysql_query("UPDATE temp_order SET state = '$state' WHERE ID = '$id'")){
				echo 1;
			}else{
				echo 2;
			}
		}
	}else if($_POST["type"] == 'cache'){
		if(mysql_query("UPDATE cache_order SET	state='2' WHERE ID='$food'")){
			echo 1;
		}else{
			echo 2;
		}
	}
}else{
	echo 2;
}
?>