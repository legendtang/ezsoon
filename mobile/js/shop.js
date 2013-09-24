window.onload = function(){
	$("body").on('click',"#logout",function(){logout();});
	
}
function order(id){
	$.ajax({
		type: "POST",
		url: "./php/order.php", 
		data: "&order="+id,
		success: 
		function(returnKey){
			//var cart = eval(returnKey);//array
			//showCart(cart);
			if(returnKey == 1){
				alert("餐品已加入购物车");
			}else{
				alert(returnKey);
			}
		}
	});
}
function logout(){
	$.ajax({
        type: "POST",
        url: "./php/logout.php?type=user", 
        success: 
		function(returnKey){
			if(returnKey == 1){
				window.location.href = './index.php';
			}else{
				alert(returnKey);
			}
		}
	});
	login = 0;
}