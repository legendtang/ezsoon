var box = getCookie("box_login");
var username = getCookie("phone_login");

window.onload = function(){
	$("#index_login").bind('click',function(event){
		event.preventDefault();
		index_login();
	});
}
function index_login(){
	var username = $("#login_phone").val().replace(/\s/g, '');
	var password = $("#login_password").val();
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
				data: "&username="+username+"&password="+password,
				success: 
				function(returnKey){
					if(returnKey == 1){
						window.location.href = './home.php';
					}else if(returnKey == 2){
						window.location.href = './register.php';
					}else if(returnKey == 3){
						alert("wrong password");
					}else{
						alert(returnKey);
					}
				}
			});
		}
	}else{
		alert('请输入手机号');
	}
}
if(box == 'yes'){
	$("#checkbox_login").attr("checked","checked");
	$("#login_phone").attr("value",username);
}