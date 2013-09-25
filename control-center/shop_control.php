<?php 
require_once "../php/linkDB.php";
session_start();
if(!isset($_SESSION["cid"])){
	echo "<script>window.location.href='./index.php';</script>";
} 
date_default_timezone_set(PRC);
$hour = Date("G");
$min = intval(Date("i"))>30?1:0;
$timeSection = $hour*2+$min+1;
$num_sql = mysql_query("SELECT COUNT(*) FROM temp_order WHERE time_section='$timeSection'");
if($row=mysql_fetch_array($num_sql)){
	$order_num = $row[0];
}
if(intval(Date("i"))>30){
	$send_time = ($hour+1).':00';
}else{
	$send_time = $hour.':30';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>时间段:<?php echo $timeSection;?>商铺调度--随便送</title>
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/shop_control.js" type="text/javascript"></script>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
	<?php echo '<script language="javascript">var order_num = '.$order_num.';</script>'?>
</head>

<body>
	<button class="btn btn-primary" onclick='window.location.href="./control_center.php"' style="margin:30px;">返回区域选择</button>
	<button class="btn btn-info" id="news" onclick='window.location.href="./shop_control.php"' style="margin:30px;"><?php echo "时间:  ".$hour.":".Date("i")."---";?>0个新订单</button>
	<div style="position:absolute;left:50px;top:60px;width:700px;">
		<?php
			$shop_sql = mysql_query("SELECT * FROM restaurant ORDER BY ID");
			while($shop = mysql_fetch_array($shop_sql)){
				$shop_id = $shop["ID"];
				$shop_name = $shop["name"];
				echo '<h3>'.$shop_name.'</h3>';
				echo '<div style="overflow:auto;width:700px;height:300px;border:1px solid;">';
				echo '<table class="table table-hover">';
				echo	'<thead>';
				echo		'<tr>';
				echo			'<th>单号</th>';
				echo			'<th>订单</th>';
				echo			'<th>信息</th>';
				echo			'<th>确认</th>';
				echo		'</tr>';
				echo	'</thead>';
				echo	'<tbody id="order">';
							$sql = mysql_query("SELECT * FROM temp_order");//去掉了时间限制WHERE time_section='$timeSection'
							while($row = mysql_fetch_array($sql)){
								$flag = 0;
								$order = '';
								$txt = '';
								$ID = $row["ID"];
								$user_id = $row["user_id"];
								$orders = explode(";",$row["orders"]);
								$num = explode(";",$row["num"]);
								$state = explode(";",$row["state"]);
								//覆盖send_time
								$time_section = $row["time_section"];
								$send_time = floor($time_section/2).":".($time_section%2?"30":"00");
								//获取用户信息确保非恶意下单
								$user_sql = mysql_query("SELECT * FROM user WHERE ID='$user_id'");
								$user = mysql_fetch_array($user_sql);
								$phone = $user["phone"];
								$address = $user["address"];
								for($i = 0;$i<count($orders);$i++){
									if($state[$i] == 0){
										$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
										$product = mysql_fetch_array($sql_order);
										$food_name = $product["name"];
										$from_id = $product["shop_id"];
										
										$sql_shop = mysql_query("SELECT * FROM restaurant WHERE ID='$from_id'");
										if($shop_id == $from_id){
											$flag = 1;
											$order = $order.$food_name."×".$num[$i].";";
											$txt = $txt.'	'.$food_name."×".$num[$i]."\\n";
										}
									}
								}
								if($flag){
									echo '<script language="javascript">orders.push(["'.$shop_id.'_'.$ID.'","'.$txt.'","'.$shop_name.'",1,"'.$send_time.'"]);</script>';
									echo '<tr name="'.$shop_id.'_'.$ID.'" id="'.$shop_id.'_'.$ID.'">';
									echo '<th>'.$ID.'</th>';
									echo '<th>'.$order.'</th>';
									echo '<th>电话:'.$phone.' 地址:'.$address.' 送出时间:'.$send_time.'</th>';
									echo '<th><div class="ready btn btn-success" name="'.$shop_id.'_'.$ID.'">发送</div></th>';
									echo '</tr>';
								}
							}
				echo	'</tbody>';
				echo '</table>';
				echo '</div>';
			}
		?>
	</div>
	<div  style="position:fixed;top:0px;left:800px;">
		<h3>信息框:</h3>
		<textarea id="infoBox" style="display:block;overflow:auto;width:300px;height:400px;border:1px solid;padding:10px;"></textarea>
		<button id="cancel" class="btn btn-warning">撤销</button>
		<button id="clear" class="btn btn-danger">清空</button>
		<button id="copy" class="btn btn-success">复制</button>
	</div>
	
	
</body>
</html>
 