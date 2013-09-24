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
	<title>检视用户信息--随便送</title>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
	<div class="bs-docs-example">
	<button class="btn btn-danger" onclick="window.location.href='./dashboard.php';">返回面板</button>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>用户名称</th>
				<th>电话</th>
				<th>送货地址</th>
				<th>电子邮箱</th>
				<th>性别</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = mysql_query("SELECT * FROM user ORDER BY ID");
				while($row = mysql_fetch_array($sql)){
				  $ID = $row["ID"];
				  $mail = $row["mail"];
				  $phone = $row["phone"];
				  $name = $row["name"];
				  $address = $row["address"];
				  $gender = $row["gender"];
				
					echo '<tr onclick="window.location.href = \'./edit_client.php?id='.$ID.'\';">';
					echo '<th>'.$ID.'</th>';
					echo '<th>'.$name.'</th>';
					echo '<th>'.$phone.'</th>';
					echo '<th>'.$address.'</th>';
					echo '<th>'.$mail.'</th>';
					echo '<th>';
					switch($gender){
						case 1:
							echo '男';
							break;
						case 2:
							echo '女';
							break;
						case 3:
							echo '其他';
							break;
					}
					echo '</th>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
	</div>
</body>
</html>
 