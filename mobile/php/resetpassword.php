<?php
require_once ('./linkDB.php');
/**
 * 用base64_decode解开$_GET['p']的值
*/
if(isset($_GET['token'])){
$p=$_GET['token'];
$array = explode('.',base64_decode($p));
//echo "<br>";
/**
 * 这时，我们会得到一个数组，$array，里面分别存放了用户名和我们需要一段字符串
 * $array[0] 为用户名
 * $array[1] 为我们生成的字符串
*/
//好了，我们开始进行匹配工作吧。

$sql = mysql_query("select password from user where phone = '".trim($array['0'])."'");
$rs=mysql_fetch_array($sql);

$password = $rs['password'];
/**
 * 产生配置码 
*/
 $checkCode = md5($array['0'].'+'.$password);
/**
 * 进行配置验证： => 
*/
if( $array['1'] === $checkCode ){
	echo $array['0'];
	echo '<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/index.js"></script>';
	echo '<input type="text" id="new_password"><input type="text" id="new_password_c"><button type="submit" id="submit_password">修改密码</button>';
}
}
?>