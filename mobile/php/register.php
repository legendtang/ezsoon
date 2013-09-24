<?php
require_once "./linkDB.php";

if(isset($_POST["username"])&&isset($_POST["password"])){
	$username = $_POST["username"];
	$mail = $_POST["mail"];
	$password = $_POST["password"];
	$is_username = mysql_query("SELECT COUNT(*) FROM user WHERE phone = '$username' LIMIT 1");//验证是否注册过
	$is_username_in = mysql_fetch_array($is_username);
	if($is_username_in[0] == 0){
		//用户信息信息写入数据库
		if(mysql_query("INSERT INTO user (phone,mail,password) VALUES ('$username','$mail','$password')")){
			$key_row = mysql_query("SELECT * FROM user WHERE phone = '$username' LIMIT 1");
			$key = mysql_fetch_array($key_row);
			//登录
			$uid = $key["ID"];
			//此时把$uid保存到session里面作为登录用户的唯一标识
			session_start();
			$_SESSION["uid"] = $uid;
			echo 1;
		}else{
			echo "添加失败!数据库查询错误!";
		} 
	}else{
		echo 2;
	}
}else{
	echo "添加失败!请填写必填信息!";
}
?>