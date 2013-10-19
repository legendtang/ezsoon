$(document).ready(function(){
	$("body").on('click',"#logout",function(){logout();});
	$("body").on('click',"#submit",function(){
		if(check_time()){
			submit();
		}else{
			alert("有菜品在您选择的时段无法送餐,请更换送餐时间或菜品!");
		}
	});
	$("body").on('click',".up",function(){upL($(this).attr("name"));});
	$("body").on('click',".down",function(){downL($(this).attr("name"))});
});
function upL(id){
	$.ajax({
		type: "POST",
		url: "./php/order.php", 
		data: "&order="+id,
		success: 
		function(returnKey){
			location.reload();
			//cart = eval(returnKey);//array
			//showList(cart);
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
			location.reload();
			//$("[name="+id+"] .num").html($("[name="+id+"] .num").html()-1);
		}
	});
}

function submit(){
	var sendTime = $("#sendTime").val();
	$.ajax({
		type:"POST",
		url:"./php/deal.php",
		data:"&time="+sendTime,
		success:
		function(returnKey){
			eval('var data = '+returnKey);
			window.location.href = "./deal_result.php?result="+data["status"]+"&order_id="+data["order_id"];
		}
	});
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
	$("#list"+id).css("background","#E51400");
	$("#list"+id).css("color","#fff");
	$("#list"+id).css("text-shadow","none");
}
function right_time(id){
	$("#list"+id).css("background","none");
	//$("#list"+id+" .credits,.price,.cost").css("color","#a9580b");
	$("#list"+id).css("color","#000");
	$("#list"+id).css("text-shadow","0 1px 0 #fff;");
}