window.onload = function(){
	$("#index_register").bind('click',function(event){
		event.preventDefault();
		index_register();
	});
}
function index_register(){
	var username = $("#reg_phone").val().replace(/\s/g, '');
	var mail = $("#reg_mail").val().replace(/\s/g, '');
	var password = $("#reg_password").val();
	var password_c = $("#reg_password_c").val();
	if(username&&mail&&password&&password_c){
		var reg_phone = /^((13[0-9])|(15[0-9])|(18[0-9])|(14[0-9]))+\d{8}$/; 
	    if (!(reg_phone.test(username))) {
	        alert("请输入正确的天朝大陆手机号码!");
	    }else{
			var reg_mail  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!reg_mail.test(mail)){
				alert("请输入正确的邮箱地址!");
			}else {
				if(password == password_c){
					$.ajax({
						type: "POST",
						url: "./php/register.php", 
						data: "&username="+username+"&mail="+mail+"&password="+password,
						success: 
						function(returnKey){
							if(returnKey == 1){
								window.location.href = "./home.php";
							}else if(returnKey == 2){
								alert("您的手机号已经在本站注册过了~")
								$("#reg_phone,#reg_mail,#reg_password,#reg_password_c").val('');
							}else{
								alert(returnKey);
							}
						}
					});
				}else{
					$("#reg_password,#reg_password_c").val('');
					alert("请确保两次输入密码完全一致");
				}
			}
		}
	}else{
		alert('请输入必要信息');
	}
}