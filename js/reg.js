
window.onload = function() {

	//选择头像
	var choosehead = document.getElementById('choosehead');
	choosehead.addEventListener('click', function(){
		window.open('../pages/portrait.php','选择头像','width=400,height=600,top=20,left=20,');
	});

	// 切换验证码图片
	var codeimg = document.getElementById('codeimg');
	codeimg.onclick = function(){
		this.src = '../code.php?rand=' + Math.random();
	};

	//马上登录按钮
	var loginbtn = document.getElementById('loginbtn');
	loginbtn.addEventListener('click', function(e){
		e.preventDefault();
		alert('xxx');
	});

	//表单验证
	var fm = document.getElementById('regform');
	console.log(fm);
	fm.onsubmit = function(){
		// 用户名验证
		if(fm.elements['username'].value.length < 2 || fm.elements['username'].value.length > 60){
			alert('用户名长度不得小于2位，或者大于60位！');
			return false;
		}
		if(/[<>\*\.\$\^\?\\\|\(\)\[\]\{\}]/.test(fm.elements['username'].value)){
			alert('用户名不得包含敏感字符！');
			return false;
		}

		// 邮箱验证
		if(!/^[\w\.]+@\w+.\w+$/.test(fm.elements['email'].value)) {
			alert('邮箱格式不正确！');
			return false;
		}

		// 密码验证
		if(fm.elements['pwd'].value.length < 6) {
			alert('密码不得小于6位！');
			return false;
		}
		if(fm.elements['confirmpwd'].value != fm.elements['pwd'].value) {
			alert('两次密码输入不一致！');
			return false;
		}

		// 头像验证
		if(fm.elements['portrait'].value == '') {
			alert('请选择一个头像！');
			return false;
		}

		//验证码位数验证
		if(fm.elements['verify_code'].value.length != 4) {
			alert('验证码位数不正确！');
			return false;
		}
	}
}