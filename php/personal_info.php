<?php
require_once "./linkDB.php";
session_start();

if(isset($_SESSION["uid"])){
	$uid = $_SESSION["uid"];
	$sql = mysql_query("SELECT * FROM user WHERE id='$uid' LIMIT 1");
	$user = mysql_fetch_array($sql);
	$mail = $user["mail"];
	$password = $user["password"];
	$zone = $user["zone"];
	$address = $user["address"];
	$phone = $user["phone"];
	$name = $user["name"];
	$gender = $user["gender"];

if(isset($_POST["type"])){
	switch($_POST["type"]){
		case "pi"://个人信息
			echo '<div id="pc_top" class="pi_top">个人中心</div><hr class="hr-top"/>';
			echo '<form>';
			echo	'<div class="pc_item"><label class="pi_name" for="pc_name">姓名:</label><input type="text" id="pc_name" value="'.$name.'"></input></div>';
			if($gender == 1){
				echo 	'<div class="pc_item"><label class="pi_name" for="pc_gender">性别:</label><select id="pc_gender"><option value = "1">男</option><option value = "2" >女</option></select></div>';
			}else if($gender == 2){
				echo 	'<div class="pc_item"><label class="pi_name" for="pc_gender">性别:</label><select id="pc_gender"><option value = "1" selected="selected">男</option><option value = "2" selected="select">女</option></select></div>';
			}
			echo 	'<div class="pc_item"><label class="pi_name" for="pc_zone">送餐区:</label><select id="pc_zone"><option value = "0"';
			if($zone == 0){echo 'selected="select"';}
			echo '>韵苑学生公寓</option><option value = "1" ';
			if($zone == 1){echo 'selected="select"';}
			echo '>华科附中</option><option value = "2" ';
			if($zone == 2){echo 'selected="select"';};
			echo '>光谷SBI</option></select></div>';
			echo	'<div class="pc_item"><label class="pi_name" for="pc_address">送餐地址:</label><input type="text" id="pc_address" value="'.$address.'"></input></div>';
			echo	'<div class="pc_item"><label class="pi_name" for="pc_email">邮箱:</label><input type="text" id="pc_email" value="'.$mail.'"></input></div>';
			echo 	'<div class="pc_item"><label class="pi_name" for="pc_phone">联系电话:</label><input type="text" id="pc_phone" value="'.$phone.'"></input></div>';
			echo	'<div class="pc_item"><input type="button" id="change_info_submit" value="确认修改" /></div>';
			echo    '</form>';
			break;
		case "co"://当前订单
			echo '<div id="pc_top" class="pi_top">当前订单</div><hr class="hr-top"/>';
			$current_order_sql = mysql_query("SELECT * FROM temp_order WHERE user_id = $uid ORDER BY ID DESC LIMIT 1");
			while($row = mysql_fetch_array($current_order_sql)){
				$orders = explode(";",$row["orders"]);
				$nums = explode(";",$row["num"]);
				$ID = $row["ID"];
				$address = $row["address"];
				$time = $row["time_section"];
				$hour = floor($time/2);
				$half = $time%2?'30':'00';
				$total = 0;
				echo '<div id="accordion2"><div class="accordion-inner">';
				echo '<p><span>订餐人信息:</span></p>';
				echo '<p>'.$address.'，'.$phone.'</p><hr class="hr-content"/>';
				echo '<p><span>送出时间：</span>'.$hour.':'.$half.'</p><hr class="hr-content"/>';
				echo '<p><span>订单号：</span>'.$ID.'</p>';
				echo '<table><thead class="fuckinClipart"><tr><td>购物车商品</td><td>数量</td><td>单价</td><td>金额</td></tr></thead><tbody>';
				for($i = 0;$i<count($orders)-1;$i++){
					$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
					$product = mysql_fetch_array($sql_order);
					$food_name = $product["name"];
					$price = $product["price"];
					echo '<tr><td>'.$food_name.'</td><td>'.$nums[$i].'</td><td>'.$price.'</td><td>'.$nums[$i]*$price.'</td></tr>';
					$total += $nums[$i]*$price;
				}
				echo '</tbody></table><p class="right">合计:￥'.$total;
				echo ' 运费:￥2 总价:<span>￥'.($total+2).'</span></p></div></div>';
			}
			break;
		case "ho"://历史订单
			echo '<script type="text/javascript" src="js/bootstrap.js"></script>';
			echo '<div id="pc_top" class="pi_top">历史订单</div><hr class="hr-top"/>';
			$order_sql = mysql_query("SELECT * FROM orders WHERE user_id = $uid");
			echo '<div class="accordion" id="accordion2">';
			$flag = 1;
			while($row = mysql_fetch_array($order_sql)){
				$orders = explode(";",$row["orders"]);
				$nums = explode(";",$row["num"]);
				$ID = $row["ID"];
				$address = $row["address"];
				$time = $row["order_time"];
				$total = 0;
				echo '<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#coll'.$ID.'">
									下单时间:'.$time.' 订单号:'.$ID.'
								</a>
							</div>';
				echo '<div id="coll'.$ID.'" class="accordion-body collapse';
				if ($flag == 1) {echo ' in';$flag ++;}
				echo '"><div class="accordion-inner"><table><thead><tr><td>购物车商品</td><td>数量</td><td>单价</td><td>金额</td></tr></thead><tbody>';
				for($i = 0;$i<count($orders)-1;$i++){
					$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
					$product = mysql_fetch_array($sql_order);
					$food_name = $product["name"];
					$price = $product["price"];
					echo '<tr><td>'.$food_name.'</td><td>'.$nums[$i].'</td><td>'.$price.'</td><td>'.$nums[$i]*$price.'</td></tr>';
					$total += $nums[$i]*$price;
				}
				echo '</tbody></table><p class="right">合计:￥'.$total;
				echo ' 运费:￥2 总价:<span>￥'.($total+2).'</span></p></div></div></div>';
			}
			echo '</div>';
			break;
		case "cp"://修改密码
			echo '<div id="pc_top" class="pi_top">修改密码</div><hr class="hr-top"/>';
			echo	'<div class="pc_item"><label class="pi_name" for="">你的账号:</label>'.$phone.'</div>';
			echo	'<div class="pc_item"><label class="pi_name" for="">您的密码:</label><input id="pc_password" type="password" name="password"></input></div>';
			echo	'<div class="pc_item"><label class="pi_name" for="">新的密码:</label><input type="password" id="newpassword"></input></div>';
			echo	'<div class="pc_item"><label class="pi_name" for="">确认密码:</label><input type="password" id="confirm_password"></input></idv>';
			echo	'<input type="button" id="change_password_submit" value="确认更改"/>';
			break;
		case "changeInfo"://更新个人信息
			if(isset($_POST["mail"])&&isset($_POST["gender"])&&isset($_POST["name"])&&isset($_POST["phone"])&&isset($_POST["zone"])&&isset($_POST["address"])){
				$mail = $_POST["mail"];
				$gender = $_POST["gender"];
				$name = $_POST["name"];
				$phone = $_POST["phone"];
				$zone = $_POST["zone"];
				$address = $_POST["address"];
				if(mysql_query("UPDATE user SET mail = '$mail',gender = '$gender',name = '$name',phone = '$phone',zone = '$zone',address = '$address' WHERE ID = $uid")){
					echo 1;
				}else{
					echo 2;
				}
			}else{
				echo 3;
			}
			break;
		case "changePassword":
			if(isset($_POST["password"])&&isset($_POST["newpassword"])){
				$pc_password = $_POST["password"];
				$newpassword = $_POST["newpassword"];
				if($pc_password == $password){
					if(mysql_query("UPDATE user SET password = '$newpassword' WHERE ID = $uid")){
						echo 1;
					}else{
						echo 2;
					}
				}else{
					echo 3;
				}
			}
			break;
	}
}
//检查是否登录
}else{
	echo "未登录!";
}
?>