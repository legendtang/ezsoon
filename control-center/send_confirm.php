<?php
require_once "../php/linkDB.php";
if(isset($_POST["id"])&&isset($_POST["type"])){
	$id = $_POST["id"];
	$sql = mysql_query("SELECT * FROM temp_order WHERE ID = '$id'");
	if($order = mysql_fetch_array($sql)){
		$state = explode(";",$order["state"]);
		for($i = 0;$i < count($state);$i++){
			if($state[$i] > 0)
				$state[$i] = 7;
		}
		$state = implode(";",$state);
		if(mysql_query("UPDATE temp_order SET state = '$state' WHERE ID = '$id'")){
			if($_POST["type"] == 'cache'){
				mysql_query("DELETE FROM cache_sender WHERE ID='$id'");
			}
			echo 1;
		}else{
			echo 2;
		}
	}
}else{
	echo 2;
}
?>