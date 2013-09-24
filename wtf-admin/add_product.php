<?php
require_once "../php/linkDB.php";

if(isset($_POST["name"])&&isset($_POST["price"])&&isset($_POST["type"])&&isset($_POST["shop_id"])&&isset($_POST["time"])){
	$name = $_POST["name"];
	$price = $_POST["price"];
	$type = $_POST["type"];
	$shop_id = $_POST["shop_id"];
	$time = $_POST["time"];
	//产品信息写入数据库
	if(mysql_query("INSERT INTO product (name,price,type,shop_id,time) VALUES ('$name','$price','$type','$shop_id','$time')")){
		echo 1;
	}else{
		echo "添加失败!数据库查询错误!";
	} 
}else{
	echo "添加失败!请填写必填信息!";
}
echo '<form action="./add_product_info.php">';
echo  	'<button type="submit" class="btn">返回添加页面</button>';
echo '</form>';

?>