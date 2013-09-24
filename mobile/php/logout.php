<?php
session_start();
if($_GET['type']=='user'){
	if(isset($_SESSION["uid"])){
	  //登出 注销SESSION["uid"]
	  unset($_SESSION["uid"]);
	  unset($_SESSION["cart"]);
	}
	 echo 1;
}else if($_GET['type']=='admin'){
	if(isset($_SESSION["aid"])){
	  //登出 注销SESSION["aid"]
	  unset($_SESSION["aid"]);
	}
	echo "<script>window.location.href='../wtf-admin/index.php';</script>";
}else if($_GET['type']=='controler'){
	if(isset($_SESSION["cid"])){
	  //登出 注销SESSION["cid"]
	  unset($_SESSION["cid"]);
	}
	echo "<script>window.location.href='../control-center/index.php';</script>";
}
?>
