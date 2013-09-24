window.onload = function(){
	bind_event();
	$("#rightContent").on('click',"#login",function(){login()});
	$("#rightContent").on('click',"#register",function(){register()});
	$("#rightContent").on('click',"#back_login",function(){backLogin()});
	$(".available").bind('click',function(){order($(this).attr("name"))});
	$("#rightContent").on('click',".delN",function(){delOrder($(this).attr("name"))});
	$("#rightContent").on('click',".up",function(){up($(this).attr("name"))});
	$("#rightContent").on('click',".down",function(){down($(this).attr("name"))});
	$("#rightContent").on('click',"#pay",function(){
		window.location.href = './cart.php';
	});
	$( document ).tooltip();
}

