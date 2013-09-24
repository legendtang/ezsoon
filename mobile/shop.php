<?php
require_once "./php/linkDB.php";
session_start();

if(!isset($_SESSION["uid"])){
	echo '<script language="javascript">window.location.href = "./index.php";</script>';
}
if($_GET["id"]){
	$id = $_GET["id"];
	$sql = mysql_query("SELECT * FROM restaurant WHERE id='$id' LIMIT 1");
	$shop = mysql_fetch_array($sql);
	$shop_name = $shop["name"];
	$logo = $shop["logo"];
	$big_img = $shop["big_img"];
	$phone = $shop["phone"];
	$description = $shop["description"];
	$shop_type = explode(";",$shop["type"]);
	$run_time = $shop["time"];
	//product
	$menu = array();
	$product = mysql_query("SELECT * FROM product WHERE shop_id='$id'");
	while($row = mysql_fetch_array($product)){
		$id = $row["ID"];
		$name = $row["name"];
		$image = $row["image"];
		$price = $row["price"];
		$type = $row["type"];
		$time = $row["time"];
		$food_description = $row["description"];
		$state = $row["state"];
		$menu[] = array($id,$name,$type,$price,$image,$state,$time,$food_description);
	}
}else{
	echo "<script>window.location.href='./index.php';</script>";
}
?>
<!DOCTYPE html> 
<html> 
　<head> 
	<meta charset="utf-8">
　 	<title><?php echo $shop_name;?>--随便送</title> 
　	<meta name="viewport" content="width=device-width, initial-scale=1"> 
　 	<link rel="stylesheet" href="./css/jquery_mobile.css" />
　	<script src="./js/jquery.js"></script>
	<script src="./js/jquery_mobile.js"></script>
</head> 
<body>
	<section data-role="page">
		<script type="text/javascript" src="./js/shop.js"></script>
		<div data-role="header" data-position="inline">
			<a  data-icon="gear" href="./personal_center.php">个人中心</a>
			<h1><?php echo $shop_name;?></h1>
			<a id="logout" data-icon="delete">注销</a>
		</div>
		<div data-role="content" data-position="inline">
			<div data-role="collapsible-set">
			<?php
				$nav_num = count($shop_type)>5?10:5;
				echo $nac_num;
				for($i = 0;$i<$nav_num;$i++){
					$title = 0;
					foreach($menu as $v){
						if($v[2] == $i){
							if($title == 0){
								echo '<div data-role="collapsible"><h3>'.$shop_type[$i].'</h3><ul data-role="listview" data-inset="true" data-filter="false">';
								$title = 1;
							}
							echo '<li><a id="f_'.$v[0].'"';
							echo '" name="'.$v[0].'" class="item ';
							if($v[5])echo 'available';
							echo '">'.$v[1].'￥'.$v[3].'</a></li>';
						}
					}
					echo '</ul></div>';
				}
			?>
			</div>
		</div>
		<footer data-role="footer" >
			<div data-role="navbar">
				<ul>
					<li><a data-icon="back" href="./home.php" >返回店铺选择</a></li>
					<li><a data-icon="star" href="./cart.php">购物车</a></li>
				</ul>
			</div><!-- /navbar -->
			<h1>©2012 ezsoon 随便送(www.ezsoon.cn)</h1>
			
		</footer>
		<script language="javascript">$("body").on('click',".available",function(){order($(this).attr("name"))});</script>
	</section>
</body>
</html>