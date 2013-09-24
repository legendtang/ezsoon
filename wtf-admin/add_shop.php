<?php
require_once "../php/linkDB.php";

if($_POST["mail"]&&$_POST["username"]&&$_POST["password"]&&$_POST["name"]&&$_POST["phone"]){
	$mail = $_POST["mail"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	//unnecessary
	$description = isset($_POST["description"])?$_POST["description"]:"null";
	$big_img = isset($_POST["big_img"])?$_POST["big_img"]:"./images/shop/default.jpg";
	$zone = isset($_POST["zone"])?$_POST["zone"]:"0";
	$time = isset($_POST["time"])?$_POST["time"]:"';;;";
	$min_spend = isset($_POST["min_spend"])?$_POST["min_spend"]:"0";


	//商户信息写入数据库
	if(mysql_query("INSERT INTO restaurant (mail,username,password,name,phone,description,big_img,zone,time,min_spend) VALUES ('$mail','$username','$password','$name','$phone','$description','$big_img','$zone','$time','$min_spend')")){
		echo 1;
	}else{
		echo "添加失败!数据库查询错误!";
	} 
}else{
	echo "添加失败!请填写必填信息!";
}
echo '<form action="./add_shop_info.php">';
echo  	'<button type="submit" class="btn">返回添加页面</button>';
echo '</form>';

?>