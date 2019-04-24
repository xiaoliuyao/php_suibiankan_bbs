<?php

// 防止被别的网站恶意调用，定义一个常量即可
if(!defined('INC')) {
	exit('ACCESS DENIED!');
}

// 弹框并返回函数
function _alert_back($info) {
	echo "<script type='text/javascript'>alert('$info');history.back();</script>";
	exit();
}

// 检查code
function _check_code($input_code) {
	$code = $_SESSION['code'];
	if($input_code != $code) {
		_alert_back('验证码不正确！');
	}
}

// 判断登录状态
function _check_login_state($info){
	if(isset($_COOKIE['username'])) {
		_alert_back($info);
	}
}





// 定义数据库连接
// define('DB_HOST','localhost');
// define('DB_USER','root');
// define('DB_PWD','123');
// define('DB_DATABASE','php_bbs');

// $sqllink = @mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE) or die('数据库连接错误!'.mysqli_connect_error());

// 封装到mysql.func.php中
require $_SERVER['DOCUMENT_ROOT'].'/include/mysql.func.php';




?>