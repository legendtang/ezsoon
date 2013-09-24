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
$timeSection = $hour*2+$min+1;

$num_sql = mysql_query("SELECT COUNT(*) FROM temp_order WHERE time_section='$timeSection'");
if($row=mysql_fetch_array($num_sql)){
	$order_num = $row[0];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>时间段:<?php echo $timeSection; echo $zone; ?>号配餐区--随便送</title>
	<script src="../js/cater.js" type="text/javascript"></script>
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
	<?php echo '<script language="javascript">var order_num = '.$order_num.';</script>'?>
</head>

<body>
	
	<button class="btn btn-primary" onclick='window.location.href="./control_center.php"' style="margin:30px;">返回区域选择</button>
	<button class="btn btn-info" id="news" onclick='window.location.href="./cater.php?zone=<?php echo $zone?>"' style="margin:30px;"><?php echo "时间:  ".$hour.":".Date("i")."---";?>0个新订单</button>
	
	<div style="position:absolute;left:10px;top:60px;">
		<h3>当前订单</h3>
		<div style="overflow:auto;width:500px;height:600px;border:1px solid;">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>单号</th>
					<th>店铺</th>
					<th>订单</th>
					<th>数量</th>
					<th>分拣点</th>
					<th>暂缓</th>
					<th>确认</th>
				</tr>
			</thead>
			<tbody id="cater">
				<?php
					$sql = mysql_query("SELECT * FROM temp_order ");//去除时间限制WHERE time_section='$timeSection'
					while($row = mysql_fetch_array($sql)){
						$ID = $row["ID"];
						$user_id = $row["user_id"]; 
						$aim_zone = $row["aim_zone"]; 
						$orders = explode(";",$row["orders"]);
						$num = explode(";",$row["num"]);
						$state = explode(";",$row["state"]);
						$order_time = $row["order_time"];
						$time_section = $row["time_section"];
						for($i = 0;$i<count($orders);$i++){
							if($state[$i] == 1){
								$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
								$product = mysql_fetch_array($sql_order);
								$food_name = $product["name"];
								$shop_id = $product["shop_id"];
								
								$sql_shop = mysql_query("SELECT * FROM restaurant WHERE ID='$shop_id'");
								$shop = mysql_fetch_array($sql_shop);
								$shop_zone = $shop["zone"];
								$name = $shop["name"];
								if($shop_zone == $zone){
									echo '<script language="javascript">cater.push(["'.$ID.'_'.$i.'","'.$order_time.'","'.$name.'","'.$food_name.'",'.$num[$i].','.$aim_zone.',1]);</script>';
									echo '<tr name="'.$ID.'_'.$i.'" id="'.$ID.'_'.$i.'">';
									echo '<th>'.$ID.'</th>';
									echo '<th>'.$name.'</th>';
									echo '<th>'.$food_name.'</th>';
									echo '<th>'.$num[$i].'</th>';
									echo '<th>'.$aim_zone.'</th>';
									echo '<th><div class="cache btn btn-warning" name="'.$ID.'_'.$i.'">暂缓</div></th>';
									echo '<th><div class="ready btn btn-success" name="'.$ID.'_'.$i.'">发送</div></th>';
									echo '</tr>';
								}
							}
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
					<th>店铺</th>
					<th>订单</th>
					<th>数量</th>
					<th>分拣点</th>
					<th>暂缓</th>
					<th>确认</th>
				</tr>
			</thead>
			<tbody id="wait_cater">
				<?php
					$sql = mysql_query("SELECT * FROM temp_order ORDER BY ID");
					while($row = mysql_fetch_array($sql)){
						$ID = $row["ID"];
						$user_id = $row["user_id"]; 
						$aim_zone = $row["aim_zone"]; 
						$orders = explode(";",$row["orders"]);
						$num = explode(";",$row["num"]);
						$state = explode(";",$row["state"]);
						$order_time = $row["order_time"];
						$time_section = $row["time_section"];
						for($i = 0;$i<count($orders);$i++){
							if($state[$i] == 2){
								$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders[$i]'");
								$product = mysql_fetch_array($sql_order);
								$food_name = $product["name"];
								$shop_id = $product["shop_id"];
								
								$sql_shop = mysql_query("SELECT * FROM restaurant WHERE ID='$shop_id'");
								$shop = mysql_fetch_array($sql_shop);
								$shop_zone = $shop["zone"];
								$name = $shop["name"];
								if($shop_zone == $zone){
									echo '<script language="javascript">wait_cater.push(["'.$ID.'_'.$i.'","'.$order_time.'","'.$name.'","'.$food_name.'",'.$num[$i].','.$aim_zone.']);</script>';
									echo '<tr name="'.$ID.'_'.$i.'" id="'.$ID.'_'.$i.'">';
									echo '<th>'.$ID.'</th>';
									echo '<th>'.$name.'</th>';
									echo '<th>'.$food_name.'</th>';
									echo '<th>'.$num[$i].'</th>';
									echo '<th>'.$aim_zone.'</th>';
									echo '<th><div class="cache btn btn-warning" name="'.$ID.'_'.$i.'">暂缓</div></th>';
									echo '<th><div class="n_confirm btn btn-success" name="'.$ID.'_'.$i.'">收货</div></th>';
									echo '</tr>';
								}
							}
						}
					}
				$sql = mysql_query("SELECT * FROM cache_order ORDER BY ID");
					while($row = mysql_fetch_array($sql)){
						$ID = $row["ID"];
						$o_id = $row["o_id"];
						$user_id = $row["user_id"]; 
						$aim_zone = $row["aim_zone"]; 
						$orders = $row["orders"];
						$num = $row["num"];
						$order_time = $row["order_time"];
						$time_section = $row["time_section"];
						$state = $row["state"];
						
						if($state == 2){
							$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders'");
							$product = mysql_fetch_array($sql_order);
							$food_name = $product["name"];
							$shop_id = $product["shop_id"];
								
							$sql_shop = mysql_query("SELECT * FROM restaurant WHERE ID='$shop_id'");
							$shop = mysql_fetch_array($sql_shop);
							$shop_zone = $shop["zone"];
							$name = $shop["name"];
							if($shop_zone == $zone){
								echo '<script language="javascript">cater.push(["'.$o_id.'_'.$ID.'","'.$order_time.'","'.$name.'","'.$food_name.'",'.$num.','.$aim_zone.',1]);</script>';
								echo '<tr name="'.$o_id.'_'.$ID.'" id="'.$o_id.'_'.$ID.'">';
								echo '<th>'.$o_id.'</th>';
								echo '<th>'.$name.'</th>';
								echo '<th>'.$food_name.'</th>';
								echo '<th>'.$num.'</th>';
								echo '<th>'.$aim_zone.'</th>';
								echo '<th><div class="btn disabled" name="'.$o_id.'_'.$ID.'">暂缓</div></th>';
								echo '<th><div class="c_confirm btn btn-success" name="'.$o_id.'_'.$ID.'">收货</div></th>';
								echo '</tr>';
							}
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
					<th>店铺</th>
					<th>订单</th>
					<th>数量</th>
					<th>分拣点</th>
					<th>确认</th>
				</tr>
			</thead>
			<tbody id="cache_cater">
				<?php
					$sql = mysql_query("SELECT * FROM cache_order ORDER BY ID");
					while($row = mysql_fetch_array($sql)){
						$ID = $row["ID"];
						$o_id = $row["o_id"];
						$user_id = $row["user_id"]; 
						$orders = $row["orders"];
						$num = $row["num"];
						$order_time = $row["order_time"];
						$time_section = $row["time_section"];
						$state = $row["state"];
						
						if($state == 1){
							$sql_order = mysql_query("SELECT * FROM product WHERE ID='$orders'");
							$product = mysql_fetch_array($sql_order);
							$food_name = $product["name"];
							$shop_id = $product["shop_id"];
								
							$sql_shop = mysql_query("SELECT * FROM restaurant WHERE ID='$shop_id'");
							$shop = mysql_fetch_array($sql_shop);
							$shop_zone = $shop["zone"];
							$name = $shop["name"];
							if($shop_zone == $zone){
								$sql_user = mysql_query("SELECT * FROM user WHERE ID='$user_id'");
								$user = mysql_fetch_array($sql_user);
								$aim_zone = $user["zone"];
								echo '<script language="javascript">cater.push(["'.$o_id.'_'.$ID.'","'.$order_time.'","'.$name.'","'.$food_name.'",'.$num.','.$aim_zone.',1]);</script>';
								echo '<tr name="'.$o_id.'_'.$ID.'" id="'.$o_id.'_'.$ID.'">';
								echo '<th>'.$o_id.'</th>';
								echo '<th>'.$name.'</th>';
								echo '<th>'.$food_name.'</th>';
								echo '<th>'.$num.'</th>';
								echo '<th>'.$aim_zone.'</th>';
								echo '<th><div class="ready btn btn-success" name="'.$o_id.'_'.$ID.'">发送</div></th>';
								echo '</tr>';
							}
						}
					}
				?>
			</tbody>
		</table>
		</div>
	</div>
	
	
</body>
</html>
 