<?php
	//本网站是为了模拟用户点餐,用于讲电话短信点餐用户统一归入网站调度管理
	require_once './php/linkDB.php';
	session_start();
	$temp_order = mysql_query("SELECT * FROM temp_order ORDER BY ID DESC LIMIT 1");
	if($last_order = mysql_fetch_array($temp_order)){
		$last_id = $last_order["ID"];
	}else{
		$last_id = 0;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>WT快捷模拟下单</title>
	<script src="./js/jquery.js" type="text/javascript"></script>
	<script src="./js/bootstrap.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"/>
	<style>
		body *{
			font-family: "Microsoft Yahei UI Light", "Microsoft JhengHei", STheiti, WenQuanYi Micro Hei, helvetica, arial, sans-serif;
		}
		.food{
			float:left;
			padding-left: 10px;
			width: 215px !important;
			height: 50px;
			font: 18px/50px "Microsoft Yahei UI Light", "Microsoft JhengHei", STheiti, WenQuanYi Micro Hei !important;
			cursor:pointer;
		}
		.order{
			cursor:pointer;
		}
		.food:hover,.order:hover{
			background:#c0c0c0;
		}
		p{
			float:left;
			clear:both;
			width:100%;
			font: 36px/50px "Microsoft Yahei UI Light", "Microsoft JhengHei", STheiti, WenQuanYi Micro Hei !important;
			border-bottom:1px solid #c0c0c0;
			
		}
		#infoBox{
			position:fixed;
			bottom:0;
			background:#c0c0c0;
			padding:20px;
			width:100%;
		}
		#sendInfo{
			float:left;
			width:50%;
		}
		#orderList{
			float:left;
			margin-left:5%;
			width:40%;
			height:100px;
			background:#fff;
			overflow:auto;
		}
	</style>
</head>
<body>
	<div style="margin:0 5%;margin-bottom:200px;">
	<h1>模拟用户下单(附中) 当前订单号:<?php echo ($last_id+1);?></h1>
	<?php
		echo '<ul class="nav nav-tabs">';
		$sql = mysql_query("SELECT * FROM restaurant ORDER BY ID");
		while($row = mysql_fetch_array($sql)){
			$shop_id = $row["ID"];
			$shop_name = $row["name"];
			echo	'<li><a href="#shop'.$shop_id.'" data-toggle="tab">'.$shop_name.'</a></li>';		
		}
		echo '</ul><div class="tab-content">';
		$sql_fuck = mysql_query("SELECT * FROM restaurant ORDER BY ID");
		
		while($row = mysql_fetch_array($sql_fuck)){
			$shop_id = $row["ID"];
			$shop_type = explode(";",$row["type"]);
			echo	'<div class="tab-pane" id="shop'.$shop_id.'">';
			$product = mysql_query("SELECT * FROM product WHERE shop_id='$shop_id' ORDER BY type");
			$type_before = '';
			while($row = mysql_fetch_array($product)){
				$food_id = $row["ID"];
				$food_name = $row["name"];
				$food_type = $row["type"];
				if(trim($food_type) != trim($type_before)){
					echo '<p>'.$shop_type[$food_type].'</p>';
					$type_before = $food_type;
				}
				echo '<div class="food" id="food'.$food_id.'" name="'.$food_id.'">'.$food_name.'</div>';
			}
			echo '</div>';
		}
		echo '</div>';
	?>
	<div style="clear:both;"></div>
	</div>
	<div id="infoBox">
		<div id="sendInfo">
			<select id="sendTime">
			<?php
				date_default_timezone_set("Asia/Shanghai");
				$hour = Date("G");
				$min = intval(Date("i"))>30?1:0;
				$timeSection = $hour*2+$min;
				$timeArray = array('<option value = "21">10:30</option>','<option value = "22">11:00</option>','<option value = "23">11:30</option>','<option value = "24">12:00</option>','<option value = "25">12:30</option>','<option value = "26">13:00</option>','<option value = "27">13:30</option>','<option value = "28">14:00</option>','<option value = "29">14:30</option>','<option value = "30">15:00</option>','<option value = "31">15:30</option>','<option value = "32">16:00</option>','<option value = "33">16:30</option>','<option value = "34">17:00</option>','<option value = "35">17:30</option>','<option value = "36">18:00</option>','<option value = "37">18:30</option>','<option value = "38">19:00</option>','<option value = "39">19:30</option>','<option value = "40">20:00</option>');
				for($i = ($timeSection-20);$i < count($timeArray);$i++){
					echo $timeArray[$i];
				}
			?>
			</select>
			<select id="zone">
				<option>华科附中</option>
				<option>华科韵苑</option>
				<option>光谷创业街</option>
			</select>
			<input type="text" id="address" placeholder="送餐地址" x-webkit-speech x-webkit-grammar="bUIltin:search" value="门口"/>
			<input type="text" id="phone" placeholder="电话号码" x-webkit-speech x-webkit-grammar="bUIltin:search"/>
			<button type="button" id="submitOrder">模拟下单</button>
		</div><!--end of sendInfo-->
		<div id="orderList">
		</div>
	</div>
	<script language="javascript">
		var cart = new Array();
		$(document).ready(function(){
			$(".food").on("click",function(){
				var id = $(this).attr("name");
				$.ajax({
					type: "POST",
					url: "./php/order.php", 
					data: "&order="+id,
					success: 
					function(returnKey){
						cart = eval(returnKey);//array
						showOrderList(cart);
					}
				});
			});
			$("#submitOrder").on("click",function(){
				if(cart.length > 0){
					var sendTime = $("#sendTime").val();
					var phone = $("#phone").val();
					var sendAdd,zone;
					sendAdd = $("#zone").val()+$("#address").val();
					switch($("#zone").val()){
						case "华科韵苑":
							zone = 0;
							break;
						case "华科附中":
							zone = 1;
							break;
						case "光谷创业街":
							zone = 2;
							break;
					}
					if(sendTime&&phone){
						$.ajax({
							type: "POST",
							url: "./php/imitate_deal.php", 
							data:"&time="+sendTime+"&address="+sendAdd+"&zone="+zone+"&phone="+phone,
							success: 
							function(returnKey){
								if(returnKey == 1){
									alert("已下单");
									window.location.href = "./wtf.php"; 
								}else{
									alert(returnKey);
								}
							}
						});
					}else{
						alert("信息不全");
					}
				}else{
					alert("无订单");
				}
			});
			$("#orderList").on("click",".order",function(){
				var id = $(this).attr("name");
				$.ajax({
					type: "POST",
					url: "./php/order.php", 
					data: "&del_order="+id,
					success: 
					function(returnKey){
						cart = eval(returnKey);//array
						showOrderList(cart);
					}
				});
			});
		});
		function showOrderList(list){
			var str = "";
			for(var i = 0;i<list.length;i++){
				str += '<div class="order" name="'+list[i][0]+'">'+list[i][1]+"×"+list[i][2]+'</div>';
			}
			$("#orderList").html(str);
			$("#orderList").animate({scrollTop:$("#orderList").offset().top},500);
		}
	</script>
</body>
</html>