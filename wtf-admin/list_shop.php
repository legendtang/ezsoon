<?php 
require_once "../php/linkDB.php";
session_start();
if(!isset($_SESSION["aid"])){
	 echo "<script>window.location.href='./index.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf8">
	<title>检视商户信息--随便送</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	<div class="bs-docs-example">
	<button class="btn btn-danger" onclick="window.location.href='./dashboard.php';">返回面板</button>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>店铺名称</th>
				<th>电话</th>
				<th>店铺区块</th>
				<th>店铺描述</th>
				<th>店铺图片</th>
				<th>电子邮箱</th>
				<th>营业时间</th>
				<th>起送价</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = mysql_query("SELECT * FROM restaurant ORDER BY ID");
				while($row = mysql_fetch_array($sql)){
				  $ID = $row["ID"];
				  $mail = $row["mail"];
				  $phone = $row["phone"];
				  $name = $row["name"];
				  $description = $row["description"];
				  $big_img = $row["big_img"];
				  $zone = $row["zone"];
				  $time = $row["time"];
				  $min_spend = $row["min_spend"];
				
					echo '<tr onclick="window.location.href = \'./edit_shop.php?id='.$ID.'\';">';
					echo '<th>'.$ID.'</th>';
					echo '<th>'.$name.'</th>';
					echo '<th>'.$phone.'</th>';
					echo '<th>'.$zone.'</th>';
					echo '<th>'.$description.'</th>';
					echo '<th>'.$big_img.'</th>';
					echo '<th>'.$mail.'</th>';
					echo '<th>'.$time.'</th>';
					echo '<th>'.$min_spend.'</th>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
	</div>
</body>
</html>
 