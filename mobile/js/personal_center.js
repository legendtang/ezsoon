$(document).ready(function(){
	$("body").on('click',"#update_info",function(){
		var mail = $("#mail").val();
		var name = $("#name").val();
		var phone = $("#phone").val();
		var gender = $("#gender").val();
		var zone = $("#zone").val();
		var address = $("#address").val();
		$.ajax({
			type:"post",
			url:"./php/personal_info.php",
			data:"&type=changeInfo&mail="+mail+"&name="+name+"&gender="+gender+"&phone="+phone+"&zone="+zone+"&address="+address,
			success:
			function(returnKey){
				if(returnKey == 1){
					alert("个人信息修改成功");
				}else{
					alert("个人信息修改失败");
				}
			}
		});
	});
});