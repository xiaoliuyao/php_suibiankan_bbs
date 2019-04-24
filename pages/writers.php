<?php
// 定义常量INC，用来授权应用公共文件
define('INC', true);

require $_SERVER['DOCUMENT_ROOT'].'/include/mysql.func.php';
$writers = _query($sqllink, "SELECT userName,portrait FROM user ORDER BY registerTime DESC;");

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>作者列表-随便侃社区</title>
	<link rel="stylesheet" type="text/css" href="/css/common.css" />
	<link rel="stylesheet" type="text/css" href="/css/index.css" />
    <style>
    .poster {
        float: left;
        margin-right: 12px;
    }
    </style>
</head>
<body>

<?php
	define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
	// require '/include/header.inc.php';	//报错，Failed opening required。。。
	require ROOT_PATH.'/include/header.inc.php';
?>

<div class="main">
    <div class="sec-title2">作者们</div>
    <div class="posters-list">
        <ul>
            <?php while($writer = mysqli_fetch_array($writers)){ ?>
            <li class="poster">
                <img class="poster-head" src="/<?php echo $writer['portrait']; ?>" alt="" />
                <div class="poster-info">
                    <span class="poster-name"><?php echo $writer['userName']; ?></span>
                    <p class="poster-event">
                        <span>加好友</span>
                        <span>收藏</span>
                        <span>点赞</span>
                    </p>
                </div>
            </li>
            <?php }?>
        </ul>
    </div>
</div>

<?php
	require ROOT_PATH.'/include/foot.inc.php';
?>
</body>
</html>