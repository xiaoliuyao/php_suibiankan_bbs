<?php
	// 防止被别的网站恶意调用，定义一个常量即可
	if(!defined('INC')) {
		exit('ACCESS DENIED!');
	}
?>

<div class="header">
	<div class="header-cont">
		<div class="header-logo-fl">
			<a href="/"><img src="/images/logo.png" /></a>
		</div>
		<div class="login-box-fr">
			<?php
				// print_r($_COOKIE);
				if(isset($_COOKIE['username'])){
					echo "<a class='alink-person' href='/pages/person.php'>".$_COOKIE['username']."·个人中心</a>";
					echo "<a href='/pages/logout.php'>退出</a>";
				} else {
					echo "<a href='/pages/login.php'>登录</a>";
					echo "<a href='/pages/register.php'>注册</a>";
				}

			?>
		</div>
		<div class="search-box-fr">
			<form action="/pages/search.php" method="post">
				<div class="search">
					<input class="search-text" type="text" name="key" />
					<button class="search-btn" type="submit"></button>
				</div>
			</form>
		</div>
	</div>
</div>