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