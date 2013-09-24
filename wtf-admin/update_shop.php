<?php
require_once "../php/linkDB.php";
if(isset($_POST["id"])){
	$id = $_POST["id"];
	if(isset($_POST["mail"])&&isset($_POST["password"])&&isset($_POST["name"])&&isset($_POST["phone"])){
		$mail = $_POST["mail"];
		$password = $_POST["password"];
		$name = $_POST["name"];
		$phone = $_POST["phone"];
		//unnecessary
		$description = $_POST["description"]?$_POST["description"]:"null";
		$big_img = $_POST["big_img"]?$_POST["big_img"]:"./images/shop/big_default.jpg";
		$logo = $_POST["logo"]?$_POST["logo"]:"./images/shop/default.jpg";
		$zone = $_POST["zone"]?$_POST["zone"]:"0";
		$time = $_POST["time"]?$_POST["time"]:"';;;";
		$min_spend = $_POST["min_spend"]?$_POST["min_spend"]:"0";
		$state = $_POST["state"]?$_POST["state"]:"0";
		//商户信息写入数据库
		if(mysql_query("UPDATE restaurant SET mail = '$mail',password = '$password',name = '$name',phone = '$phone',description = '$description',big_img = '$big_img',zone = '$zone',time = '$time',min_spend = '$min_spend',logo = '$logo',state = '$state' WHERE ID = '$id'")){
			echo "更新成功";
		}else{
			echo "更新失败!数据库查询错误!";
		}
	}else{
		echo "更新失败!必要信息不完全!";
	}
}else{
	echo "更新失败!未找到店铺!";
}
echo '<form action="./list_shop.php">';
echo  	'<button type="submit" class="btn">返回列表页面</button>';
echo '</form>';

?>