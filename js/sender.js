var sendList = new Array();
var infoBox = new Array();
var cancelList = new Array();
window.onload = function(){
	$("body").on("click","#send tr,#cache_send tr",function(){
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
	$("body").on("click",".n_confirm",function(){
		confirm($(this).attr("name"),"normal");
	});
	$("body").on("click",".c_confirm",function(){
		confirm($(this).attr("name"),"cache");
	});
	$("body").on("click","#send tr .ready",function(){
		ready($(this).attr("name"),"normal");
	});
	$("body").on("click","#cache_send tr .ready",function(){
		ready($(this).attr("name"),"cache");
	});
	$("body").on("click",".cache",function(){
		cache($(this).attr("name"));
	});
	setInterval('refresh()',60000);
};
function creatInfo(order){
	for(v in sendList){
		if(sendList[v][0] == order&&sendList[v][7]){
			var temp = sendList[v];
			var str =  "#"+temp[0]+'   '+temp[1]+'  '+temp[5]+'  ￥'+(temp[6]*1+2)+'  '+temp[3];
			cancelList.push(order);
			infoBox.push(str);
			sendList[v][7] = 0;
			$("#infoBox").html('<p>'+infoBox.join("\n")+'</p>');
		}
	}
}
function cancel(){
	infoBox.pop();
	if(infoBox.length){
		$("#infoBox").html('<p>'+'\n'+infoBox.join("\n")+'</p>');
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
	for(v in sendList){
		if(sendList[v][0] == id){
			sendList[v][6] = 1;
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
		for(v in sendList){
			if(sendList[v][0] == id){
				sendList[v][6] = 1;
			}
		}
	}
	cancelList.length = 0;
}
function copy(){
 var text = document.getElementById("infoBox");
    if ($.browser.msie) {
        var range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if ($.browser.mozilla || $.browser.opera || $.browser.chrome) {
        var selection = window.getSelection();
        var range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    } else if ($.browser.safari) {
        var selection = window.getSelection();
        selection.setBaseAndExtent(text, 0, text, 1);
    }
}
function ready(id,type){
	$.ajax({
		type:"POST",
		url:"./send_wait_confirm.php",
		data:"&id="+id+"&type="+type,
		success:
		function(returnKey){
			if(returnKey == 1){
				$("#"+id).remove();
				for(v in sendList){
					if(sendList[v][0] == id){
						$("#wait_send").append('<tr name="'+id+'" id="'+id+'"><th>'+id+'</th><th>'+sendList[v][1]+'</th><th>'+sendList[v][5]+'</th><th>'+sendList[v][4]+'</th><th><div class="'+(type == "normal"?"cache btn btn-warning":"btn disabled")+'" name="'+id+'">暂缓</div></th><th><div class="'+(type == "normal"?"n_confirm":"c_confirm")+' btn btn-success" name="'+id+'">送达</div></th></tr>');
					}
				}
			}else{
				alert(returnKey);
			}
		}
	});
}
function cache(id){
	$.ajax({
		type:"POST",
		url:"./cache_send.php",
		data:"&id="+id,
		success:
		function(returnKey){
			if(returnKey == 1){
				$("#"+id).remove();
				for(v in sendList){
					if(sendList[v][0] == id){
						$("#cache_send").append('<tr name="'+id+'"  id="'+id+'"><th>'+id+'</th><th>'+sendList[v][1]+'</th><th>'+sendList[v][5]+'</th><th>'+sendList[v][4]+'</th><th><div class="ready btn btn-success" name="'+id+'">发送</div></th></tr>');
					}
				}
			}else{
				alert(returnKey);
			}
		}
	});
}
function confirm(id,type){
	$.ajax({
		type:"POST",
		url:"./send_confirm.php",
		data:"&id="+id+"&type="+type,
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
