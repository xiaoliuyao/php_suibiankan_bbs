<?php

	$code = '';

	//定义一个含有数字和字母的数组,array_merge()合并数组
	$arr1 = range(0, 9);
	$arr2 = range('a', 'z');
	$arr = array_merge($arr1,$arr2);
	// print_r($arr);

	//生成4位的验证码
	$code_length = 4;
	for($i = 0; $i < $code_length; $i++) {
		$code .= $arr[mt_rand(0,35)];
	}
	// echo $code;

	//存在session里
	session_start();
	$_SESSION['code'] = $code;
	// echo $_SESSION['code'][2];

	//创建图片
	$_w = 100;
	$_h = 28;
	$vimg = imagecreatetruecolor($_w, $_h);

	//指定背景色并填充
	$white = imagecolorallocate($vimg, 255, 255, 255);
	imagefill($vimg, 0, 0, $white);

	//添加黑色边框
	$black = imagecolorallocate($vimg, 0, 0, 0);
	// imagerectangle($vimg, 0, 0, $_w-1, $_h-1, $black);

	//添加几条随即线，干扰线
	for($i = 0; $i < 4; $i++){
		//随机颜色，150-255之间颜色浅
		$rand_color = imagecolorallocate($vimg, mt_rand(150,255), mt_rand(150,255), mt_rand(150,255));
		//划线
		imageline($vimg, mt_rand(0,$_w), mt_rand(0,$_h), mt_rand(0,$_w), mt_rand(0,$_h), $rand_color);
	}

	//生成雪花背景
	for($i=0; $i<40; $i++){
		$x = mt_rand(0,$_w-5);
		$y = mt_rand(0,$_h-5);
		$rand_color = imagecolorallocate($vimg, mt_rand(150,255), mt_rand(150,255), mt_rand(150,255));
		imagestring($vimg, 1, $x, $y, "*", $rand_color);
	}

	//画上随机码
	for($i=0; $i<strlen($_SESSION['code']); $i++) {
		$x = $_w/$code_length * $i + mt_rand(5,15);
		$y = mt_rand(2,$_h/2);
		// echo $x.':'.$y.'<br/>';
		$rand_color = imagecolorallocate($vimg, mt_rand(0,150), mt_rand(0,150), mt_rand(0,150));
		imagestring($vimg, 5, $x, $y, $_SESSION['code'][$i], $rand_color);
	}

	// imageline($vimg, 0, $_h/2, $_w, $_h/2, $black);
	// imagestring($vimg, 5, 0, $_h/2, 'string', $black);	//这里的5号字体不代表是5像素


	header('Content-type: image/png');	//必须要把其他输出语句注释，否则出错
	imagepng($vimg);
	imagedestroy($vimg);

?>