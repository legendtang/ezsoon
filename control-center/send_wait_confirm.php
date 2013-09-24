<?php
require_once "../php/linkDB.php";
if(isset($_POST["id"])&&isset($_POST["type"])){
	$id = $_POST["id"];
	if($_POST["type"] == 'normal'){
		$sql = mysql_query("SELECT * FROM temp_order WHERE ID = '$id'");
		if($order = mysql_fetch_array($sql)){
			$state = explode(";",$order["state"]);
			for($i = 0;$i < count($state);$i++){
				if($state[$i] > 0)
					$state[$i] = 5;
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
	}else if($_POST["type"] == 'cache'){
		$sql = mysql_query("SELECT * FROM cache_sender WHERE ID = '$id'");
		if($order = mysql_fetch_array($sql)){
			$state = explode(";",$order["state"]);
			for($i = 0;$i < count($state)-1;$i++){
				if($state[$i] == 1)
					$state[$i] = 2;
			}
			$state = implode(";",$state);
			if(mysql_query("UPDATE cache_sender SET state = '$state' WHERE ID = '$id'")){
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 3;
		}
	}
}else{
	echo 2;
}
?>