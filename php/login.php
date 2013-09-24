<?php
require_once "./linkDB.php";
if($_GET["type"]=='user'){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$is_username = mysql_query("SELECT COUNT(*) FROM user WHERE phone = '$username' LIMIT 1");
	$is_username_in = mysql_fetch_array($is_username);
	if($is_username_in[0]>0){
		$user_row = mysql_query("SELECT * FROM user WHERE phone = '$username' LIMIT 1");
		$user = mysql_fetch_array($user_row);
		//登录成功
		$uid = $user["ID"];
		$key = $user["password"];
		if($password == $key){
			//此时把$uid保存到session里面作为登录用户的唯一标识
			session_start();
			$_SESSION["uid"] = $uid;
			echo 1;
		}else{
			echo 3;
		}
	}else{
		echo 2;
	}
}else if($_GET["type"]=='admin'){
	$username = $_POST["username"];
	$password = $_POST["psw"];
	$is_username = mysql_query("SELECT COUNT(*) FROM admin WHERE username = '$username' LIMIT 1");
	$is_username_in = mysql_fetch_array($is_username);
	if($is_username_in[0]>0){
	  $key_row = mysql_query("SELECT * FROM admin WHERE username = '$username' LIMIT 1");
	  $key = mysql_fetch_array($key_row);
	  if($key["password"] == $password){
		//登录成功
		$aid = $key["ID"];
		//此时把$aid保存到session里面作为登录管理员的唯一标识
		session_start();
		$_SESSION["aid"] = $aid;
		echo "<script>window.location.href='../wtf-admin/dashboard.php';</script>";
	  }else{
		echo "密码错误";
	  }
	}else{
	  echo "账号不存在";
	}
}else if($_GET["type"]=='controler'){
	$username = $_POST["username"];
	$password = $_POST["psw"];
	$is_username = mysql_query("SELECT COUNT(*) FROM controler WHERE username = '$username' LIMIT 1");
	$is_username_in = mysql_fetch_array($is_username);
	if($is_username_in[0]>0){
	  $key_row = mysql_query("SELECT * FROM controler WHERE username = '$username' LIMIT 1");
	  $key = mysql_fetch_array($key_row);
	  if($key["password"] == $password){
		//登录成功
		$cid = $key["ID"];
		//此时把$cid保存到session里面作为登录调度员的唯一标识
		session_start();
		$_SESSION["cid"] = $cid;
		echo "<script>window.location.href='../control-center/control_center.php';</script>";
	  }else{
		echo "密码错误";
	  }
	}else{
	  echo "账号不存在";
	}
}
?>