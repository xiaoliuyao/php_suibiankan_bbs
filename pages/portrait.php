<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>选择头像</title>
	<link rel="stylesheet" type="text/css" href="../css/portrait.css" />
	<script type="text/javascript">
		window.onload = function() {
			var a = window.opener.document;
			var b = a.getElementById('choosehead_value');

			var imgs = document.getElementsByTagName('img');
			// alert(imgs.length);
			// alert(b);

			for(var i=0; i<imgs.length; i++) {
				imgs[i].onclick = function() {
					// alert(this.src);
					setOpenerPortrait(this.src);
				}
			}
		}
		function setOpenerPortrait(img_url){
			var a = window.opener.document;
			a.getElementById('choosehead_value').value = img_url;
			a.getElementById('choosehead').src = img_url;
		}

	</script>
</head>
<body>
<div class="wrap">
	<h3 class="title">选择头像</h3>
	<div class="head-imgs">
	<?php
		for($i=1; $i<=12; $i++) {
			echo "<img src=../images/portrait/$i.jpg />";
		}
	?>
	</div>
</div>
</body>
</html>