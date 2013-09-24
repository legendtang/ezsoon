<?php
require_once 'linkDB.php';

if(isset($_POST['order'])){
	$id = $_POST['order'];
	$sql = mysql_query("SELECT * FROM product WHERE ID = '$id' LIMIT 1");
	$food = mysql_fetch_array($sql);
	$name = $food['name'];
	$price = $food['price'];
	$shop_id = $food['shop_id'];
	
	$shop_sql = mysql_query("SELECT * FROM restaurant WHERE ID = '$shop_id' LIMIT 1");
	$shop = mysql_fetch_array($shop_sql);
	$run_time = $shop["run_time"];
	session_start();
	if(isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
		$flag = 0;
		for($i = 0;$i < count($cart);$i++){
			if($cart[$i][0] == $id){
				$cart[$i][2] ++;
				$flag = 1;
			}
		}
		if($flag == 0){
			$cart[] = array($id,$name,1,$price,$run_time);
		}
		$_SESSION["cart"] = $cart;
		echo json_encode($cart);
	}else{
		$cart = array();
		$cart[] = array($id,$name,1,$price,$run_time);
		$_SESSION["cart"] = $cart;
		echo json_encode($cart);
	}
}else if(isset($_POST['del_order'])){
	$id = $_POST['del_order'];
	session_start();
	if(isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
		for($i = 0;$i < count($cart);$i++){
			if($cart[$i][0] == $id){
				array_splice($cart,$i,1);
			}
		}
		$_SESSION["cart"] = $cart;
		echo json_encode($cart);
	}else{
		echo 2;
	}
}else if(isset($_POST['cancell'])){
	$id = $_POST['cancell'];
	session_start();
	if(isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
		for($i = 0;$i < count($cart);$i++){
			if($cart[$i][0] == $id){
				$cart[$i][2]--;
				if($cart[$i][2] <= 0){
					array_splice($cart,$i,1);
				}
			}
		}
		$_SESSION["cart"] = $cart;
		echo json_encode($cart);
	}else{
		echo 2;
	}
}else{
	echo 2;
}

?>