var cart = new Array();//0:id 1:name 2:num 3:price
$(document).ready(function(){
	//select_add();
	change_sendTime();
	bind_event();
	$("#orderView").on('click',".del",function(){delOrderL($(this).attr("name"))});
	$("#orderView").on('click',".up",function(){upL($(this).attr("name"));});
	$("#orderView").on('click',".down",function(){downL($(this).attr("name"))});
	$("#orderMore").bind("click",function(){
		window.location.href = "./home.php";
	});
	$("#submit").bind("click",function(){
		if(check_time()){
			confirm_order();
		}else{
			alert("有菜品在您选择的时段无法送餐,请更换送餐时间或菜品!");
			var a=$("#orderNav").offset();
			$("html,body").animate({scrollTop:a.top},500);
		}
	});
	$("#zone").change(function(){select_add();change_sendTime();});
	$("#sendTime").change(function(){check_time();});
	$("#view_order").on("click","#change_submit",function(event){
		$("#view_order,#view_order_bg").css("display","none");
	});
	$("#view_order").on("click","#confirm_submit",function(event){
		event.preventDefault();
		submit();
	});
});
function delOrderL(id){
	$.ajax({
		type: "POST",
		url: "./php/order.php", 
		data: "&del_order="+id,
		success: 
		function(returnKey){
			cart = eval(returnKey);//array
			showList(cart);
		}
	});
}
function upL(id){
	$.ajax({
		type: "POST",
		url: "./php/order.php", 
		data: "&order="+id,
		success: 
		function(returnKey){
			cart = eval(returnKey);//array
			showList(cart);
		}
	});
}
function downL(id){
	$.ajax({
		type: "POST",
		url: "./php/order.php", 
		data: "&cancell="+id,
		success: 
		function(returnKey){
			cart = eval(returnKey);//array
			showList(cart);
		}
	});
}
function showList(cart){
	if(cart.length>0){
		var str = '';
		var total = 0;
		for(var i in cart){
			str += '<div  id="list'+i+'" class="orderList">';
			str += '<div class="name" id="order_'+cart[i][0]+'">'+cart[i][1]+'</div>';
			str += '<div class="num">';
			str += '<input type="text" value="'+cart[i][2]+'">';
			str += '<div class="changeNumL"><img name="'+cart[i][0]+'" class="up click" src="./images/up.png"><img name="'+cart[i][0]+'" class="down click" src="./images/down.png"></div></DIV>';
			str += '<div class="del click" name="'+cart[i][0]+'"><img src="./images/delete.png"></div>';
			str += '<div class="credits">0</div>';
			str += '<div class="price">￥'+cart[i][3]+'</div>';
			str += '<div class="cost">￥'+cart[i][2]*cart[i][3]+'</div></div>';
			total += cart[i][2]*cart[i][3];
		}
		
		$("#list").html(str);
		$("#resultView").html('<div class="finalPrice">合计：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥'+total+'</div><div class="finalPrice">运费：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥2.00</div><div class="finalPrice">总计：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>￥'+(total+2)+'</span></div>');
		check_time();
	}else{
		window.location.href = "./home.php";
	}
}
function confirm_order(){
	var str = '';
	var sendAdd = $("#zone").val()+$("#add").val()+$("#address").val();
	var total = 0;
	var hour = Math.floor($("#sendTime").val()/2);
	var half = $("#sendTime").val()%2?'30':'00';
	str += '<div id="order-card"><p class="order-title">订餐人信息:</p>';
	str += '<p class="order-address">'+name+'，'+sendAdd+'，'+phone+'</p><hr />';
	str += '<p class="order-title">送出时间:<span>'+hour+':'+half+'</span></p><hr />';
	str += '<p class="order-title">订餐清单</p>';
	str += '<table><thead><tr><td>购物车商品</td><td>数量</td><td>单价</td><td>金额</td></tr></thead><tbody>';
	for(var i in cart){
		str += '<tr><td>'+cart[i][1]+'</td><td>'+cart[i][2]+'</td><td>'+cart[i][3]+'</td><td>'+cart[i][2]*cart[i][3]+'</td></tr>';
		total += cart[i][2]*cart[i][3];
	}
	str += '</tbody></table><div id="resultView"><div class="finalPrice">合计：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥'+total;
	str += '</div><div class="finalPrice">运费：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥2.00</div><div class="finalPrice">总计：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>￥'+(total+2)+'</span></div>';
	str += '<button id="change_submit" type="button">再去改改</button><button id="confirm_submit">确认订单</button>';
	$("#view_order").html(str);
	$("#view_order,#view_order_bg").css("display","block");
}
function submit(){
	var sendTime = $("#sendTime").val();
	var sendAdd,zone;
	/* if($("#address").val() == ''){
		for(var i = 0;i<addressLength;i++){
			if($("#R"+i).attr("checked") == "checked"){
				sendAdd = $("#R"+i).val();
			}
		}
	}else{ */
		sendAdd = $("#zone").val()+$("#add").val()+$("#address").val();
	//}
	switch($("#zone").val()){
		case "光谷软件园":
			zone = 0;
			break;
		case "华科附中":
			zone = 1;
			break;
		case "光谷创业街":
			zone = 2;
			break;
	}
	$.ajax({
		type:"POST",
		url:"./php/deal.php",
		data:"&time="+sendTime+"&address="+sendAdd+"&zone="+zone,
		success:
		function(returnKey){
			if(returnKey == 1){
				var hour = Math.floor($("#sendTime").val()/2);
				var half = $("#sendTime").val()%2?'30':'00';
				var str = '<p>完成订单</p><p>您的订单已下达,我们将于'+hour+':'+half+'准时送出.</p><p>请保持您的电话通畅,感谢您的使用!</p>想查看您的订单?请去<span class="showPC click">个人中心</span>查看!<span class="home click">返回首页</span></p>'
				$("#main").html(str);
				$("#view_order,#view_order_bg").css("display","none");
			}else{
				alert(returnKey);
			}
		}
	});
}
function select_add(){
	var add = new Array();
	add['华科韵苑'] = ['一栋','二栋','三栋','四栋','五栋','六栋','七栋','八栋','九栋','十栋','十一栋','十二栋','十三栋','十四栋','十五栋','十六栋','十七栋','十八栋','十九栋','二十栋','二十一栋','二十二栋','二十三栋','二十四栋','二十五栋','二十六栋','二十七栋','二十八栋'];
	add['华科附中'] = ['初一','初二','初三','高一','高二','高三','老师'];
	add['光谷创业街'] = ['一栋','二栋','三栋','五栋','六栋','七栋','八栋'];
	var zone=$("#zone").val(); 
    $("#add").html("");  
    for(var i=0;i < add[zone].length;i ++){  
        $("#add").append("<option>"+add[zone][i]+"</option>");     
    } 
}
function change_sendTime(){
	var today = new Date();
	var h = today.getHours();
	var half = today.getMinutes()>30?1:0;
	var timeSection = h*2+half; 
	$("#sendTime").html("");
	if(zone == "华科附中"){
		var fz_timeSection = ['<option value = "23">11:30</option>','<option value = "35">17:30</option>'];
		var i =0;
		if(timeSection >= 23){
			i = 1;
		}else if(timeSection >= 35){
			i = 2;
		}
		
		for(;i<fz_timeSection.length;i++)
			$("#sendTime").append(fz_timeSection[i]);
	}else{
		var other_timeSection = ['<option value = "21">10:30</option>','<option value = "22">11:00</option>','<option value = "23">11:30</option>','<option value = "24">12:00</option>','<option value = "25">12:30</option>','<option value = "26">13:00</option>','<option value = "27">13:30</option>','<option value = "28">14:00</option>','<option value = "29">14:30</option>','<option value = "30">15:00</option>','<option value = "31">15:30</option>','<option value = "32">16:00</option>','<option value = "33">16:30</option>','<option value = "34">17:00</option>','<option value = "35">17:30</option>','<option value = "36">18:00</option>','<option value = "37">18:30</option>','<option value = "38">19:00</option>','<option value = "39">19:30</option>','<option value = "40">20:00</option>'];
		for(var i = timeSection-20;i < other_timeSection.length;i++){
			$("#sendTime").append(other_timeSection[i]);
		}
	}
}
function check_time(){
	var order_time = $("#sendTime").val();
	var flag1 = 0;
	for(var i = 0 ;i < cart.length;i++){
		var flag2 = 0;
		var run_time =  cart[i][4].split(";");
		for(var j = 0;j < run_time.length;j++){
			if(run_time[j] == order_time){
				flag2 = 1;
			}
		}
		if(flag2 == 0){
			flag1 = 1;
			wrong_time(i);
		}else{
			right_time(i);
		}
	}
	if(flag1 == 1)
		return 0
	else
		return 1;
}
function wrong_time(id){
	$("#list"+id+" div").css("background","#E51400");
	$("#list"+id+" div").css("color","#fff");
}
function right_time(id){
	$("#list"+id+" div").css("background","#fff");
	$("#list"+id+" .credits,.price,.cost").css("color","#a9580b");
	$("#list"+id+" .name").css("color","#000");
}