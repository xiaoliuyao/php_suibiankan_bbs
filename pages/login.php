<?php
// 定义常量授权允许引用公共文件
define('INC', true);
require $_SERVER['DOCUMENT_ROOT'].'/include/login.func.php';

session_start();

// 判断是否已登录的用户，防止已登录的用户再次打开这个页面
_check_login_state('您已登录！');

// 判断是否提交上来的
if(isset($_GET['action']) && $_GET['action'] == 'login') {
    _check_code($_POST['verify_code']);

    $_clean = array();
    $_clean['name'] = checkName($_POST['username']);
    $_clean['pwd'] = checkPwd($_POST['pwd']);
    
    print_r($_clean);

    //数据库查找用户
    if(_fetch_array($sqllink, "SELECT * FROM user WHERE userName='{$_clean['name']}' AND password='{$_clean['pwd']}'")) {
		// setcookie,
		// 第4个参数是Cookie 有效的服务器路径。设置成 '/' 时，Cookie 对整个域名 domain 有效。默认值是设置 Cookie 时的当前目录。 
		setcookie('username',$_clean['name'], time()+3600,'/');
		header('Location:../index.php');
        session_destroy();
    } else {
        echo '没有此用户或密码错误';
        session_destroy();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>登录</title>
	<link rel="stylesheet" type="text/css" href="../css/common.css" />
	<link rel="stylesheet" type="text/css" href="../css/login.css" />
	<script type="text/javascript" src="../js/login.js"></script>
</head>
<body>
	<div class="logo">
		<a href="/"><img src="/images/logo.png" /></a>
	</div>
    <div class="register-box">
        <div class="register-box-fl">
            <form id="loginform" action="login.php?action=login" method="post" enctype="multipart/form-data">
				<div class="form-item">
					<label>用户名<span>*</span></label>
					<input type="text" name="username" />
				</div>
				<div class="form-item">
					<label>密码<span>*</span></label>
					<input type="password" name="pwd" />
				</div>
				<div class="form-item">
					<label>验证码<span>*</span></label>
					<input class="verify-code" type="text" name="verify_code" />
					<img src="../code.php" id="codeimg" />
				</div>

				<div class="form-item">
					<button id="registerbtn">立即登录</button>
				</div>
			</form>
        </div>
        <div class="register-box-fr">
			<p>还没有帐号？</p>
			<button id="loginbtn">去注册</button>
		</div>
    </div>
</body>
</html>