<?php
require_once "../php/linkDB.php";
if(isset($_POST["id"])){
	$id = $_POST["id"];
	if(isset($_POST["name"])&&isset($_POST["price"])&&isset($_POST["type"])&&isset($_POST["shop_id"])&&isset($_POST["time"])&&isset($_POST["state"])){
		$name = $_POST["name"];
		$price = $_POST["price"];
		$type = $_POST["type"];
		$shop_id = $_POST["shop_id"];
		$time = $_POST["time"];
		$state = $_POST["state"];
		//产品信息写入数据库
		if(mysql_query("UPDATE product SET name = '$name',price = '$price',type = '$type',shop_id = '$shop_id',time = '$time',state = '$state' WHERE ID = '$id'")){
			echo "更新成功";
		}else{
			echo "更新失败!数据库查询错误!";
		}
	}else{
		echo "更新失败!必要信息不完全!";
	}
}else{
	echo "更新失败!未找到产品!";
}
echo '<form action="./list_product.php">';
echo  	'<button type="submit" class="btn">返回列表页面</button>';
echo '</form>';

?>