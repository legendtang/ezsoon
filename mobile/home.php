<?php
	require_once "./php/linkDB.php";
	session_start();
	if(!isset($_SESSION["uid"])){
		echo '<script language="javascript">window.location.href = "./index.php";</script>';
	}
?>
<!DOCTYPE html> 
<html> 
　<head> 
	<meta charset="utf-8">
　 	<title>店铺页--随便送</title> 
　	<meta name="viewport" content="width=device-width, initial-scale=1"> 
　 	<link rel="stylesheet" href="./css/jquery_mobile.css" />
　	<script src="./js/jquery.js"></script>
	<script src="./js/jquery_mobile.js"></script>
	<script type="text/javascript" src="./js/home.js"></script>
	<script type="text/javascript" src="./js/base.js"></script>
</head> 
<body>
	<section data-role="page">
		<div data-role="header" data-position="inline">
			<a  data-icon="gear" href="./personal_center.php">个人中心</a>
			<h1>浏览店铺</h1>
			<a id="logout" data-icon="delete">注销</a>
		</div>
		<div data-role="content" data-position="inline">
			<ul data-role="listview" data-inset="true" data-filter="false">
			<?php
				$sql = mysql_query("SELECT * FROM restaurant ORDER BY ID");
				while($row = mysql_fetch_array($sql)){
					$id = $row["ID"];
					$name = $row["name"];
					$state = $row["state"];	
					if($state){
						echo '<li><a href="./shop.php?id='.$id.'" data-icon="arrow-r">'.$name.'</a></li>';
					}
				}
			?>
			</ul>
		</div>
		 <footer data-role="footer" >
			<div data-role="navbar">
				<ul>
					<li><a data-icon="info" href="./help.html">帮助</a></li>
					<li><a data-icon="star" href="./cart.php">购物车</a></li>
				</ul>
			</div><!-- /navbar -->
			<h1>©2013 ezsoon 随便送(www.ezsoon.cn)</h1>
		</footer>
	</section>
</body>
</html>