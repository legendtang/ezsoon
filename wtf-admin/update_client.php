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
		$address = $_POST["address"];
		$gender = $_POST["gender"];
		//商户信息写入数据库
		if(mysql_query("UPDATE user SET mail = '$mail',password = '$password',name = '$name',phone = '$phone',address = '$address',gender = '$gender' WHERE ID = '$id'")){
			echo "更新成功";
		}else{
			echo "更新失败!数据库查询错误!";
		}
	}else{
		echo "更新失败!必要信息不完全!";
	}
}else{
	echo "更新失败!未找到用户!";
}
echo '<form action="./list_client.php">';
echo  	'<button type="submit" class="btn">返回列表页面</button>';
echo '</form>';

?>