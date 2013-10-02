var box = getCookie("box_login");
var username = getCookie("phone_login");
function bind_event(){
	$("body").on("click",".home",function(){home();});
	$("body").on("click",".showPC",function(){showPersonalCenter();});
	$("body").on('click',"#logout",function(){logout();});
	$(".hidePC").bind("click",function(){hidePersonalCenter();});
	$("#pi").bind("click",function(){switchPannel('personal_info')});
	$("#ho").bind("click",function(){switchPannel('history_order')});
	$("#co").bind("click",function(){switchPannel('current_order')});
	$("#cp").bind("click",function(){switchPannel('change_password')});
	$("#personal_center").on("click","#change_info_submit",function(){change_info()});
	$("#personal_center").on("click","#change_password_submit",function(){change_password()});
}
if(box == 'yes'){
	$("#checkbox_login").attr("checked","checked");
	$("#login_phone").attr("value",username);
}
function SetCookie(name,value){//两个参数，一个是cookie的名子，一个是值
	var Days = 300; //此 cookie 将被保存 30 天
	var exp  = new Date();    //new Date("December 31, 9998");
	exp.setTime(exp.getTime() + Days*24*60*60*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function getCookie(name){//取cookies函数       
	var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
	 if(arr != null) return (arr[2]); return null;
}
function delCookie(name){//删除cookie
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval=getCookie(name);
	if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}

function login(){
	var username = $("#login_phone").val().replace(/\s/g, '');
	if($("#checkbox_login").attr("checked")){
		SetCookie("phone_login",username);
	SetCookie("box_login","yes");
	}else{
		delCookie("box_login");
	}
	if(username){
		var reg = /^((13[0-9])|(15[0-9])|(18[0-9])|(14[0-9]))+\d{8}$/; 
		if (!(reg.test(username))) {
			alert("请输入正确的天朝大陆手机号码！");
		}else{
			$.ajax({
				type: "POST",
				url: "./php/login.php?type=user",  
			data: "&username="+username,
				success: 
				function(returnKey){
					if(returnKey == 1){
					login = 1;
					$("#rightContent").html('<div id="iwannabe">购物车</div><div d="loginUI"><p>汝的购物车空空如也</p><div class="click" id="logout"></div></div>');
					}else if(returnKey == 2){
						$("#rightContent").html('<div id="iwannabe">我要订餐</div><div id="loginUI"><form><p class="inputips">请确认你的<span>手机号</span>/telephone</p><input type="text" id="phone" placeholder="phone number" value="'+username+'"/><p class="inputips">您是第一次登陆,请设置一个密码:</p><input type="password" id="password"/><p class="inputips">确认密码:</p><input type="password" id="confirm_psw"/><div class="click" id="register"></div><div class="click" id="back_login"></div></form></div>');
					}else{
						alert('登录失败');
					}
				}
			});
		}
	}else{
		alert('请输入手机号');
	}
}
function register(){
	var username = $("#phone").val().replace(/\s/g, '');
	var password = $("#password").val();
	var confirm = $("#confirm_psw").val();
	if(username&&password&&confirm){
		var reg = /^((13[0-9])|(15[0-9])|(18[0-9])|(14[0-9]))+\d{8}$/; 
	    if (!(reg.test(username))) {
	        alert("请输入正确的天朝大陆手机号码！");
	    }else{
			if(password == confirm){
				$.ajax({
					type: "POST",
					url: "./php/register.php", 
					data: "&username="+username+"&password="+password,
					success: 
					function(returnKey){
						if(returnKey == 1){
							login = 1;
							$("#rightContent").html('<div id="iwannabe">购物车</div><div id="loginUI"><p>汝的购物车空空如也</p><div class="click" id="logout"></div></div>');
						}else{
							alert(josn(returnKey));
						}
					}
				});
			}else{
				$("#password").val('');
				$("#confirm_psw").val('');
				alert("请确保两次输入密码完全一致");
			}
		}
	}else{
		alert('请输入必要信息');
	}
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
function backLogin(){
	$("#rightContent").html('<div id="iwannabe">我要订餐</div><div id="loginUI"><p class="inputips">请输入你的<span>手机号</span>/telephone</p><form><input type="text" id="phone" placeholder="phone number" x-webkit-speech x-webkit-grammar="bUIltin:search" value="'+$("#phone").val()+'"/></form><p><input type="checkbox" id="checkbox_login" x-webkit-speech x-webkit-grammar="bUIltin:search"/>记性不好</p><div class="click" id="login"></div>');
}
function order(id){
	if(login == 1){
		$.ajax({
			type: "POST",
			url: "./php/order.php", 
			data: "&order="+id,
			success: 
			function(returnKey){
				var cart = eval(returnKey);//array
				showCart(cart);
			}
		});
	}else{
		alert("请先登录");
	}
}
function delOrder(id){
	$.ajax({
		type: "POST",
		url: "./php/order.php", 
		data: "&del_order="+id,
		success: 
		function(returnKey){
			var cart = eval(returnKey);//array
			showCart(cart);
		}
	});
}
function up(id){
	$.ajax({
		type: "POST",
		url: "./php/order.php", 
		data: "&order="+id,
		success: 
		function(returnKey){
			var cart = eval(returnKey);//array
			showCart(cart);
		}
	});
}
function down(id){
	$.ajax({
		type: "POST",
		url: "./php/order.php", 
		data: "&cancell="+id,
		success: 
		function(returnKey){
			var cart = eval(returnKey);//array
			showCart(cart);
		}
	});
}
function showCart(cart){
	if(cart.length>0){
		var str = '<ul id="cart">';
		for(var i in cart){
			str += '<li><div class="orderTop"><div class="foodName" id="food_'+cart[i][0]+'">'+cart[i][1]+'</div>';
			str += '<div class="delN click" name="'+cart[i][0]+'"><img src="./images/delete.png"></div></div>';
			str += '<div class="orderBottom"><div class="foodCost">总价:'+cart[i][2]*cart[i][3]+'</div>';
			str += '<div class="foodNum"><lable id="num_'+cart[i][0]+'">数量</lable><input id="num_'+cart[i][0]+'" type="text" value="'+cart[i][2]+'">';
			str += '<div class="changeNum"><img name="'+cart[i][0]+'" class="up click" src="./images/up.png"><img name="'+cart[i][0]+'" class="down click" src="./images/down.png"></div>件</div></div></li>';
		}
		str += '</ul><div id="pay" class="click">结算</div><div class="click" id="logout"></div></div>';
		$("#loginUI").html(str);
	}else{
		$("#loginUI").html('<p>汝的购物车空空如也</p><div class="click" id="logout"></div></div>');
	}
}
function home(){
	window.location.href = "./home.php";
}
//个人中心
function switchPannel(id){
	$("#personal_info,#history_order,#current_order,#change_password").css("display","none");
	switch(id){
		case "personal_info":
			pi();
			break;
		case "current_order":
			co();
			break;
		case "history_order":
			ho();
			break;
		case "change_password":
			cp();
	}
}
function showPersonalCenter(){
	if(login){
		$("#personal_center,#personal_center_bg").css("display","block");
		pi();
	}else{
		alert("请先登录");
	}
}
function hidePersonalCenter(){
	$("#personal_center,#personal_center_bg").css("display","none");
}
function pi(){
	$("#personal_info").css("display","block");
	$.ajax({
		type: "POST",
		url: "./php/personal_info.php", 
		data:"&type=pi",
		success: 
		function(returnKey){
			$("#personal_info").html(returnKey);
		}
	});
}
function co(){
	$("#current_order").css("display","block");
	$.ajax({
		type: "POST",
		url: "./php/personal_info.php", 
		data:"&type=co",
		success: 
		function(returnKey){
			$("#current_order").html(returnKey);
		}
	});
}
function ho(){
	$("#history_order").css("display","block");
	$.ajax({
		type: "POST",
		url: "./php/personal_info.php", 
		data:"&type=ho",
		success: 
		function(returnKey){
			$("#history_order").html(returnKey);
		}
	});
}
function cp(){
	$("#change_password").css("display","block");
	$.ajax({
		type: "POST",
		url: "./php/personal_info.php", 
		data:"&type=cp",
		success: 
		function(returnKey){
			$("#change_password").html(returnKey);
		}
	});
}
function change_info(){
	var mail = $("#pc_email").val();
	var name = $("#pc_name").val();
	var phone = $("#pc_phone").val();
	var gender = $("#pc_gender").val();
	if(mail != ""&&phone != ""){
		$.ajax({
			type: "POST",
			url: "./php/personal_info.php", 
			data:"&type=changeInfo&mail="+mail+"&name="+name+"&gender="+gender+"&phone="+phone,
			success: 
			function(returnKey){
				if(returnKey == 1){
					alert("已更新个人信息");
				}else{
					alert(returnKey);
				}
			}	
		});
	}else{
		alert("请填写必要信息");
	}
}
function change_password(){
	var password = $("#pc_password").val();
	var newpassword = $("#newpassword").val();
	var c_password = $("#confirm_password").val();
	if(password != ""&&newpassword != ""){
		if(newpassword == c_password){
			$.ajax({
				type: "POST",
				url: "./php/personal_info.php", 
				data:"&type=changePassword&password="+password+"&newpassword="+newpassword,
				success: 
				function(returnKey){
					if(returnKey == 1){
						alert("已修改密码");
						$("#pc_password,#newpassword,#confirm_password").val('');
					}else if(returnKey == 3){
						alert("原密码错误！");
					}else{
						alert("修改失败！");
					}
				}	
			});
		}else{
			alert("两次输入密码不一致，请重新输入！");
			$("#newpassword,#confirm_password").val('');
		}
	}else{
		alert("请填写全部信息！");
	}
}
function checkMobile() {
	var pda_user_agent_list = new Array("2.0 MMP", "240320", "AvantGo", "BlackBerry", "Blazer",
		"Cellphone", "Danger", "DoCoMo", "Elaine/3.0", "EudoraWeb", "hiptop", "IEMobile", "KYOCERA/WX310K", "LG/U990",
		"MIDP-2.0", "MMEF20", "MOT-V", "NetFront", "Newt", "Nintendo Wii", "Nitro", "Nokia",
		"Opera Mini", "Opera Mobi",
		"Palm", "Playstation Portable", "portalmmm", "Proxinet", "ProxiNet",
		"SHARP-TQ-GX10", "Small", "SonyEricsson", "Symbian OS", "SymbianOS", "TS21i-10", "UP.Browser", "UP.Link",
		"Windows CE", "WinWAP", "Android", "iPhone", "iPod", "iPad", "Windows Phone", "HTC");
	var pda_app_name_list = new Array("Microsoft Pocket Internet Explorer");

	var user_agent = navigator.userAgent.toString();
	for (var i = 0; i < pda_user_agent_list.length; i++) {
		if (user_agent.indexOf(pda_user_agent_list[i]) >= 0) {
			return true;
		}
	}
	var appName = navigator.appName.toString();
	for (var i = 0; i < pda_app_name_list.length; i++) {
		if (user_agent.indexOf(pda_app_name_list[i]) >= 0) {
			return true;
		}
	}

	return false;
}