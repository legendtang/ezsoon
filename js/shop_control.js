var infoBox = new Array();
var cancelList = new Array();
var orders = new Array();
window.onload = function(){
	$("body").on("click","#order tr",function(){
		creatInfo($(this).attr("name"));
		$(this).hover(
			function(){
				$(this).css("background","#ff0000");
			},
			function(){
				$(this).css("background","#f89406");
			}
		);
	});
	$("body").on("click","#cancel",function(){cancel();});
	$("body").on("click","#clear",function(){clear();});
	$("body").on("click","#copy",function(){copy();});
	$("body").on("click",".ready",function(){
		ready($(this).attr("name"),"normal");
	});
	setInterval('refresh()',60000);
}
function creatInfo(order){
	for(v in orders){
		if(orders[v][0] == order&&orders[v][3]){
			var temp = orders[v];
			infoBox[0] = temp[2];
			var str =  "#"+temp[0].split('_')[1]+temp[1]+" 送出时间:"+temp[4];
			cancelList.push(order);
			infoBox.push(str);
			orders[v][3] = 0;
			$("#infoBox").html('<p>###'+infoBox.join("\n")+'</p>');
		}
	}
}
function ready(id){
	$.ajax({
		type:"POST",
		url:"./shop_informed.php",
		data:"&order="+id,
		success:
		function(returnKey){
			if(returnKey == 1){
				$("#"+id).remove();
			}else{
				alert(returnKey);
			}
		}
	});
}
function cancel(){
	infoBox.pop();
	if(infoBox.length > 1){
		$("#infoBox").html('<p>'+orders[0][5]+'\n'+infoBox.join("\n")+'</p>');
	}else{
		$("#infoBox").html('');
	}
	var id = cancelList.pop();
	$("#"+id).css("background","#fff");
	$("#"+id).hover(
		function(){
			$(this).css("background","#c5c5c5");
		},
		function(){
			$(this).css("background","#fff");
		}
	);
	for(v in orders){
		if(orders[v][0] == id){
			orders[v][3] = 1;
		}
	}
}
function clear(){
	infoBox.length = 0;
	$("#infoBox").html('');
	var id;
	for(c in cancelList){
		id = cancelList[c];
		$("#"+id).css("background","#fff");
		$("#"+id).hover(
			function(){
				$(this).css("background","#c5c5c5");
			},
			function(){
				$(this).css("background","#fff");
			}
		);
		for(v in orders){
			if(orders[v][0] == id){
				orders[v][3] = 1;
			}
		}
	}
	cancelList.length = 0;
}
function copy(){

}
function refresh(type){
	$.ajax({
		type:"POST",
		url:"./refresh.php",
		success:
		function(returnKey){
			if(order_num < returnKey){
				$("#news").html((returnKey-order_num)+"个新订单");
				order_num = returnKey;
			}
		}
	});
}