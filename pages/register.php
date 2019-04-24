<?php
// 定义常量授权允许引用公共文件
define('INC', true);
require $_SERVER['DOCUMENT_ROOT'].'/include/reg.func.php';

// 测试插入数据
// mysqli_query($sqllink, "INSERT INTO user (userName,sex,email,portrait,password,registerTime) VALUES ('xiaoliu', 2,'123@163.com','images/1.jpg','333333','2018-09-03 16:34:12');") or die("sql执行失败".mysqli_error($sqllink));

session_start();

// 判断是否已登录的用户
_check_login_state('您已登录！');

// 判断是否提交上来数据
if(isset($_GET['posted']) && $_GET['posted'] == 'check') {
	echo '表单提交了';
	// print_r($_POST);

	_check_code($_POST['verify_code']);

	$_clean = array();
	$_clean['name'] = checkName($_POST['username']);
	$_clean['pwd'] = checkPwd($_POST['pwd'],$_POST['confirmpwd']);
	$_clean['email'] = checkMail($_POST['email']);
	$_clean['portrait'] = checkPortrait($_POST['portrait']);
	$_clean['sex'] = $_POST['sex'];
	print_r($_clean);


	// 注册用户前需要验证用户名是否重复
	// if(!$result = mysqli_query($sqllink, "SELECT userName FROM user WHERE userName='{$_clean['name']}'")) {
	// 	echo "查询用户失败".mysqli_error($sqllink);
	// 	exit();
	// } else {
	// 	print_r($row = mysqli_fetch_array($result,MYSQLI_ASSOC));
	// 	if($row) {
	// 		_alert_back("有重复用户");
	// 	} else {
	// 		echo '没有重复用户';
	// 	}
	// };

	// // 在双引号里，直接放变量是可以的，但如果是数组，就必须加上{}，比如{$_clean['name']}
	// mysqli_query($sqllink, "INSERT INTO user (userName,sex,email,portrait,password,registerTime) VALUES (
	// 	'{$_clean['name']}',
	// 	{$_clean['sex']},
	// 	'{$_clean['email']}',
	// 	'{$_clean['portrait']}',
	// 	'{$_clean['pwd']}',
	// 	NOW()
	// 	);") or die("sql执行失败".mysqli_error($sqllink));


	// 使用封装起来的函数判断用户是否已注册
	// $result = _query($sqllink, "SELECT userName FROM user WHERE userName='{$_clean['name']}'");
	// $row = _fetch_array($result);
	// _is_repeat($row,'对不起，该用户已被注册');

	// 再次优化封装
	_is_repeat($sqllink, "SELECT userName FROM user WHERE userName='{$_clean['name']}'","对不起，该用户已被注册");

	// 使用封装起来的函数注册
	_query($sqllink,  "INSERT INTO user (userName,sex,email,portrait,password,registerTime) VALUES (
		'{$_clean['name']}',
		{$_clean['sex']},
		'{$_clean['email']}',
		'{$_clean['portrait']}',
		'{$_clean['pwd']}',
		NOW()
		);");
	echo "<script>alert('注册成功！');</script>";
	mysqli_close($sqllink);

	session_destroy();

	header('Location:/index.php');

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>注册</title>
	<link rel="stylesheet" type="text/css" href="../css/common.css" />
	<link rel="stylesheet" type="text/css" href="../css/login.css" />
	<script type="text/javascript" src="../js/reg.js"></script>
</head>
<body>
	<div class="logo">
		<a href="/"><img src="/images/logo.png" /></a>
	</div>
	<div class="register-box">
		<div class="register-box-fl">
			<!--提交给当前页面-->
			<form id="regform" action="register.php?posted=check" method="post" enctype="multipart/form-data">
				<div class="form-item">
					<label>用户名<span>*</span></label>
					<input type="text" name="username" />
				</div>
				<div class="form-item">
					<label>注册邮箱<span>*</span></label>
					<input type="text" name="email" />
				</div>
				<div class="form-item">
					<label>密码<span>*</span></label>
					<input type="password" name="pwd" />
				</div>
				<div class="form-item">
					<label>确认密码<span>*</span></label>
					<input type="password" name="confirmpwd" />
				</div>
				<div class="form-item">
					<label>性别<span>*</span></label>
					<input class="radio" type="radio" name="sex" value="1" checked="checked" />男
					<input class="radio" type="radio" name="sex" value="2" />女
					<input class="radio" type="radio" name="sex" value="3" />人妖
					<input class="radio" type="radio" name="sex" value="4" />未知
				</div>
				<div class="form-item form-item2">
					<label>选择头像<span>*</span></label>
					<!-- <input type="file" name="portrait" /> -->
					<input id="choosehead_value" type="hidden" name="portrait" value="" />
					<img id="choosehead" src="../images/icon_add.png" width="100" />
				</div>
				<div class="form-item">
					<label>验证码<span>*</span></label>
					<input class="verify-code" type="text" name="verify_code" />
					<img src="../code.php" id="codeimg" />
				</div>

				<div class="form-item">
					<button id="registerbtn">立即注册</button>
				</div>
			</form>
		</div>
		<div class="register-box-fr">
			<p>已经拥有帐号？</p>
			<button id="loginbtn">马上登录</button>
		</div>
	</div>
</body>
</html>