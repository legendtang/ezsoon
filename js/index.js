window.onload = function(){
	$("#index_login").bind('click',function(event){
		event.preventDefault();
		index_login();
	});
	$("#index_register").bind('click',function(event){
		event.preventDefault();
		index_register();
	});
}

//首页登录
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
						$(".front-signin").fadeOut(800);
						$(".front-signup").fadeIn(800);
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
//首页注册
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


/* fix for placeholder*/
eval(function(d,e,a,c,b,f){b=function(a){return(a<e?"":b(parseInt(a/e)))+(35<(a%=e)?String.fromCharCode(a+29):a.toString(36))};if(!"".replace(/^/,String)){for(;a--;)f[b(a)]=c[a]||b(a);c=[function(a){return f[a]}];b=function(){return"\\w+"};a=1}for(;a--;)c[a]&&(d=d.replace(RegExp("\\b"+b(a)+"\\b","g"),c[a]));return d}(";(7(M,f,$){4 k='1'K f.N('2');4 s='1'K f.N('o');4 D=$.12;4 q=$.q;4 t=$.t;4 g;4 1;6(k&&s){1=D.1=7(){c 9};1.2=1.o=u}l{1=D.1=7(){4 $9=9;$9.Y((k?'o':':2')+'[1]').Z('.1').w({'v.1':n,'R.1':p}).b('1-z',u).11('R.1');c $9};1.2=k;1.o=s;g={'X':7(5){4 $5=$(5);4 $j=$5.b('1-m');6($j){c $j[0].3}c $5.b('1-z')&&$5.B('1')?'':5.3},'13':7(5,3){4 $5=$(5);4 $j=$5.b('1-m');6($j){c $j[0].3=3}6(!$5.b('1-z')){c 5.3=3}6(3==''){5.3=3;6(5!=f.P){p.U(5)}}l 6($5.B('1')){n.U(5,u,3)||(5.3=3)}l{5.3=3}c $5}};6(!k){q.2=g;t.3=g}6(!s){q.o=g;t.3=g}$(7(){$(f).1e('1d','1f.1',7(){4 $F=$('.1',9).r(n);1g(7(){$F.r(p)},10)})});$(M).w('14.1',7(){$('.1').r(7(){9.3=''})})}7 J(H){4 y={};4 L=/^O\\d+$/;$.r(H.1b,7(i,a){6(a.15&&!L.17(a.A)){y[a.A]=a.3}});c y}7 n(S,3){4 2=9;4 $2=$(2);6(2.3==$2.a('1')&&$2.B('1')){6($2.b('1-m')){$2=$2.Q().18().T().a('8',$2.x('8').b('1-8'));6(S===u){c $2[0].3=3}$2.v()}l{2.3='';$2.E('1');2==f.P&&2.1a()}}}7 p(){4 $h;4 2=9;4 $2=$(2);4 8=9.8;6(2.3==''){6(2.C=='m'){6(!$2.b('1-I')){19{$h=$2.1h().a({'C':'G'})}1c(e){$h=$('<2>').a($.1i(J(9),{'C':'G'}))}$h.x('A').b({'1-m':$2,'1-8':8}).w('v.1',n);$2.b({'1-I':$h,'1-8':8}).16($h)}$2=$2.x('8').Q().W().a('8',8).T()}$2.V('1');$2[0].3=$2.a('1')}l{$2.E('1')}}}(9,f,O));",
62,81," placeholder input value var element if function id this attr data return   document hooks replacement  passwordInput isInputSupported else password clearPlaceholder textarea setPlaceholder valHooks each isTextareaSupported propHooks true focus bind removeAttr newAttrs enabled name hasClass type prototype removeClass inputs text elem textinput args in rinlinejQuery window createElement jQuery activeElement hide blur event show call addClass prev get filter not  trigger fn set beforeunload specified before test next try select attributes catch form delegate submit setTimeout clone extend".split(" "),
0,{}));
/* ===================================================
 * textClear.js v0.0.3
 * jQuery Plugin to clear input field text on fly - like as provided in Internet Explorer 10
 *==========================================================================================
 * The MIT License (MIT)
 * 
 * Copyright(c)2013 Exex Zian
 *


$(function() {
  $.fn.textClear = function() {
		$(this).on({
			'keypress' : function(e) {
				$(this).addClass('crossClear');
			},
			'focusout' : function() {
				$(this).removeClass('crossClear');
			},
			'click' : function(e) {
				if (($(this).hasClass('crossClear'))) {
					var mousePosInElement = e.pageX - $(this).position().left;

					if (mousePosInElement > $(this).width()) {
						$(this).removeClass('crossClear');
						$(this).val('');
					}
				}
			}
		});
	}
});

* textClear End */
