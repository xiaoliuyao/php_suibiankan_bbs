window.onload = function(){
    // 切换验证码图片
	var codeimg = document.getElementById('codeimg');
	codeimg.onclick = function(){
		this.src = '../code.php?rand=' + Math.random();
	};

	//马上登录按钮
	var loginbtn = document.getElementById('loginbtn');
	loginbtn.addEventListener('click', function(e){
		e.preventDefault();
		alert('register');
    });
    
    //验证表单
    var fm = document.getElementById('loginform');

    fm.onsubmit = function() {
        // 用户名验证
		if(fm.elements['username'].value.length < 2 || fm.elements['username'].value.length > 60){
			alert('用户名长度不得小于2位，或者大于60位！');
			fm.elements['username'].value == '';
			fm.elements['username'].focus();
			return false;
		}
		if(/[<>\*\.\$\^\?\\\|\(\)\[\]\{\}]/.test(fm.elements['username'].value)){
			alert('用户名不得包含敏感字符！');
			fm.elements['username'].value == '';
			fm.elements['username'].focus();
			return false;
        }
        
        //密码验证
        if(fm.elements['pwd'].value.length < 6) {
			alert('密码不得小于6位！');
			fm.elements['pwd'].value == '';
			fm.elements['pwd'].focus();
            return false;
        }

        //验证码位数验证
		if(fm.elements['verify_code'].value.length != 4) {
			alert('验证码位数不正确！');
			fm.elements['verify_code'].value == '';
			fm.elements['verify_code'].focus();
			return false;
		}
    }
}