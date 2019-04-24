<?php

require $_SERVER['DOCUMENT_ROOT'].'/include/common.inc.php';


// 判断函数是否存在
if(!function_exists('_alert_back')) {
	exit('函数_alert_back不存在，请检查');
}


// 检查用户名
function checkName($name) {
	// 去两端空格
	$name = trim($name);

	// 长度不小于几位，不大于几位
	if(strlen($name) < 2 || strlen($name) > 60) {
		_alert_back('用户名长度不得小于2位，或者大于60位！');
	}

	// 敏感字符限制
	$forbiden_char = '/[<>\*\.\$\^\?\\\|\(\)\[\]\{\}]/';
	if(preg_match($forbiden_char, $name)) {
		_alert_back('用户名不得包含敏感字符！');
	}

	// 防止数据库注入，进行转义
	$name = addslashes($name);	//在某些字符前加上了反斜线,单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）。 

	return $name;

}



// 检查密码和确认密码
function checkPwd($pwd, $confirmpwd) {
	if(strlen($pwd) < 6) {
		_alert_back('密码不得小于6位！');
	}

	if($pwd != $confirmpwd) {
		_alert_back('两次密码输入不一致！');
	}

	return md5($pwd);
}


// 检查邮箱
function checkMail($mail) {
	$mail = trim($mail);
	if(!preg_match('/^[\w\.]+@\w+.\w+$/',$mail)) {
		_alert_back('邮箱格式不正确');
	}

	return $mail;
}

// 检查头像
function checkPortrait($url) {
	if($url == '') {
		_alert_back('请选择一个头像！');
	}
	// return $url;
	return preg_replace('/^https?:\/\/[\w:\.]+\//','',$url);
}

?>