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
	<title>检视产品信息--随便送</title>
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
				<th>产品名称</th>
				<th>价格</th>
				<th>种类</th>
				<th>状态</th>
				<th>商户ID</th>
				<th>制作时间</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = mysql_query("SELECT * FROM product ORDER BY ID");
				while($row = mysql_fetch_array($sql)){
				  $ID = $row["ID"];
				  $name = $row["name"];
				  $price = $row["price"];
				  $type = $row["type"];
				  $state = $row["state"];
				  $shop_id = $row["shop_id"];
				  $time = $row["time"];
				
					echo '<tr onclick="window.location.href = \'./edit_product.php?id='.$ID.'\';">';
					echo '<th>'.$ID.'</th>';
					echo '<th>'.$name.'</th>';
					echo '<th>'.$price.'</th>';
					echo '<th>'.$type.'</th>';
					echo '<th>'.$state.'</th>';
					echo '<th>'.$shop_id.'</th>';
					echo '<th>'.$time.'</th>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
	</div>
</body>
</html>
 