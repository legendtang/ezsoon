<?php 
require_once "../php/linkDB.php";
session_start();
if(!isset($_SESSION["cid"])){
	echo "<script>window.location.href='./index.php';</script>";
} 
if(isset($_GET["zone"])){
	$zone = $_GET["zone"];
}else{
	echo "<script>window.location.href='./control_center.php';</script>";
}

date_default_timezone_set(PRC);
$hour = Date("G");
$min = intval(Date("i"))>30?1:0;
$timeSection = $hour*2+$min;
$num_sql = mysql_query("SELECT COUNT(*) FROM temp_order WHERE time_section='$timeSection'");
if($row=mysql_fetch_array($num_sql)){
	$order_num = $row[0];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title><?php echo $timeSection.'-';echo $zone; ?>号送餐区--随便送</title>
	<script src="../js/sender.js" type="text/javascript"></script>
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
	<?php echo '<script language="javascript">var order_num = '.$order_num.';</script>'?>
</head>

<body>
	<button class="btn btn-primary" onclick='window.location.href="./control_center.php"' style="margin:30px;">返回区域选择</button>
	<button class="btn btn-info" id="news" onclick='window.location.href="./sender.php?zone=<?php echo $zone;?>"' style="margin:30px;"><?php echo "时间:  ".$hour.":".Date("i")."---";?>0个新订单</button>
	<div style="position:absolute;left:10px;top:60px;">
		<h3>当前订单</h3>
		<div style="overflow:auto;width:500px;height:600px;border:1px solid;">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>单号</th>
					<th>订单</th>
					<th>信息</th>
					<th>暂缓</th>
					<th>确认</th>
				</tr>
			</thead>
			<tbody id="send">
				<?php
					$sql = mysql_query("SELECT * FROM temp_order WHERE aim_zone='$zone'");//去除时间限制 AND time_section='$timeSection'
					while($row = mysql_fetch_array($sql)){
						$flag = 0;
						$order = '';
						$txt = '';
						$cost = 0;
						$ID = $row["ID"];
						$u_id = $row["user_id"];
						$address = $row["address"]; 
						$orders = explode(";",$row["orders"]);
						$num = explode(";",$row["num"]);
						$state = explode(";",$row["state"]);
						//添加送出时间
						$time_section = $row["time_section"];
						$send_time = floor($time_section/2).":".($time_section%2?"30":"00");
						$order_time = $row["order_time"];
						foreach($state as $v){
							if($v == 3){
								$flag++;
							}
						}
						if($flag == (count($orders)-1)){
							for($i = 0;$i<count($orders)-1;$i++){
								$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
								$product = mysql_fetch_array($sql_order);
								$food_name = $product["name"];
								$food_price = $product["price"];
								$order = $order.$food_name."×".$num[$i].";";
								$txt = $txt.'￥'.$food_price*$num[$i].'	'.$food_name."×".$num[$i].";\\n";
								$cost +=$food_price*$num[$i];
							}
							$sql_user = mysql_query("SELECT * FROM user WHERE ID='$u_id'");
							$user = mysql_fetch_array($sql_user);
							$user_name = $user["name"];
							$phone = $user["phone"];
							echo '<script language="javascript">sendList.push(["'.$ID.'","'.$txt.'","'.$user_name.'","'.$phone.'","'.$order_time.'","'.$address.'","'.$cost.'",1]);</script>';
							echo '<tr name="'.$ID.'" id="'.$ID.'">';
							echo '<th>'.$ID.'</th>';
							echo '<th>'.$order.'</th>';
							echo '<th>地址:'.$address.'送出时间:'.$send_time.'</th>';
							echo '<th><div class="cache btn btn-warning" name="'.$ID.'">暂缓</div></th>';
							echo '<th><div class="ready btn btn-success" name="'.$ID.'">发送</div></th>';
							echo '</tr>';
						}
					}
					
				?>
			</tbody>
		</table>
		</div>
	</div>
	<div style="position:absolute;left:845px;top:60px;">
		<h3>待验订单</h3>
		<div style="overflow:auto;width:500px;height:600px;border:1px solid;">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>单号</th>
					<th>订单</th>
					<th>地址</th>
					<th>暂缓</th>
					<th>确认</th>
				</tr>
			</thead>
			<tbody id="wait_send">
				<?php
					$sql = mysql_query("SELECT * FROM temp_order WHERE aim_zone='$zone'");
					while($row = mysql_fetch_array($sql)){
						$flag = 0;
						$order = '';
						$ID = $row["ID"];
						$u_id = $row["u_id"];
						$address = $row["address"]; 
						$orders = explode(";",$row["orders"]);
						$num = explode(";",$row["num"]);
						$state = explode(";",$row["state"]);
						$order_time = $row["order_time"];
						foreach($state as $v){
							if($v == 5){
								$flag++;
							}
						}
						if($flag == (count($orders)-1)){
							for($i = 0;$i<count($orders);$i++){
								$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
								$product = mysql_fetch_array($sql_order);
								$food_name = $product["name"];
								$order = $order.$food_name."*".$num[$i].";";
							}
							$sql_user = mysql_query("SELECT * FROM user WHERE ID='$u_id'");
							$user = mysql_fetch_array($sql_user);
							$user_name = $user["name"];
							$phone = $user["phone"];
							echo '<tr name="'.$ID.'" id="'.$ID.'">';
							echo '<th>'.$ID.'</th>';
							echo '<th>'.$order.'</th>';
							echo '<th>'.$address.'</th>';
							echo '<th><div class="cache btn btn-warning" name="'.$ID.'">暂缓</div></th>';
							echo '<th><div class="n_confirm btn btn-success" name="'.$ID.'">送达</div></th>';
							echo '</tr>';
						}
					}
				$sql = mysql_query("SELECT * FROM cache_sender WHERE aim_zone='$zone'");
					while($row = mysql_fetch_array($sql)){
						$order = '';
						$ID = $row["ID"];
						$u_id = $row["u_id"];
						$address = $row["address"]; 
						$orders = explode(";",$row["orders"]);
						$num = explode(";",$row["num"]);
						$state = $row["state"];
						$order_time = $row["order_time"];
						if($state == 2){
							for($i = 0;$i<count($orders);$i++){
								$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
								$product = mysql_fetch_array($sql_order);
								$food_name = $product["name"];
								$order = $order.$food_name."*".$num[$i].";";
							}
							$sql_user = mysql_query("SELECT * FROM user WHERE ID='$u_id'");
							$user = mysql_fetch_array($sql_user);
							$user_name = $user["name"];
							$phone = $user["phone"];
							echo '<tr name="'.$ID.'" id="'.$ID.'">';
							echo '<th>'.$ID.'</th>';
							echo '<th>'.$order.'</th>';
							echo '<th>'.$address.'</th>';
							echo '<th>'.$order_time.'</th>';
							echo '<th><div class="btn disabled">暂缓</div></th>';
							echo '<th><div class="c_confirm btn btn-success" name="'.$ID.'">送达</div></th>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
		</div>
	</div>
	<div  style="position:fixed;top:0px;left:520px;">
		<h3>信息框:</h3>
		<pre id="infoBox" style="display:block;overflow:auto;width:300px;height:400px;border:1px solid;padding:10px;"></pre>
		<button id="cancel" class="btn btn-warning">撤销</button>
		<button id="clear" class="btn btn-danger">清空</button>
		<button id="copy" class="btn btn-success">复制</button>
	</div>
	<div style="position:absolute;left:10px;top:730px;">
		<h3>缓冲订单</h3>
		<div style="overflow:auto;width:500px;height:600px;border:1px solid;">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>单号</th>
					<th>订单</th>
					<th>地址</th>
					<th>下单时间</th>
					<th>确认</th>
				</tr>
			</thead>
			<tbody id="cache_send">
				<?php
					$sql = mysql_query("SELECT * FROM cache_sender WHERE aim_zone='$zone'");
					while($row = mysql_fetch_array($sql)){
						$flag = 0;
						$order = '';
						$txt = '';
						$cost = 0;
						$ID = $row["ID"];
						$u_id = $row["user_id"];
						$address = $row["address"]; 
						$orders = explode(";",$row["orders"]);
						$num = explode(";",$row["num"]);
						$state = explode(";",$row["state"]);
						$order_time = $row["order_time"];
						foreach($state as $v){
							if($v == 1){
								$flag++;
							}
						}
						if($flag == (count($orders)-1)){
							for($i = 0;$i<count($orders)-1;$i++){
								$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
								$product = mysql_fetch_array($sql_order);
								$food_name = $product["name"];
								$food_price = $product["price"];
								$order = $order.$food_name."×".$num[$i].";";
								$txt = $txt.'￥'.$food_price*$num[$i].'	'.$food_name."×".$num[$i].";\\n";
								$cost += $food_price*$num[$i];
							}
							$sql_user = mysql_query("SELECT * FROM user WHERE ID='$u_id'");
							$user = mysql_fetch_array($sql_user);
							$user_name = $user["name"];
							$phone = $user["phone"];
							echo '<script language="javascript">sendList.push(["'.$ID.'","'.$txt.'","'.$user_name.'","'.$phone.'","'.$order_time.'","'.$address.'","'.$cost.'",1]);</script>';
							echo '<tr name="'.$ID.'" id="'.$ID.'">';
							echo '<th>'.$ID.'</th>';
							echo '<th>'.$order.'</th>';
							echo '<th>'.$address.'</th>';
							echo '<th>'.$order_time.'</th>';
							echo '<th><div class="ready btn btn-success" name="'.$ID.'">发送</div></th>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
		</div>
	</div>
	
	
</body>
</html>
 