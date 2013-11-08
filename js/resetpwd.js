window.onload = function(){
	$("body").on("click","#submit_password",function(){
		event.preventDefault();
		find_password();
	});
	//$(function() {
		//	$(".noTextClear").textClear();
		//});
		$(document).ready(function(){
			$("body").on("click",".home",function(){home();});
		});
}
function find_password(){
	var new_password = $("#new_password").val();
	var new_password_c = $("#new_password_c").val();
	if(new_password != ""&&new_password_c != ""){
		if(new_password == new_password_c){
			$.ajax({
				type: "POST",
				url: "../php/resetpassword.php", 
				data:"newpassword="+new_password+"&uid="+uid,
				success: 
				function(returnKey){
					if(returnKey == 1){
						alert("密码已经修改成功了,请不要再忘记了哟~");
						window.location.href = "../index.php"
					}else{
						alert(returnKey);
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