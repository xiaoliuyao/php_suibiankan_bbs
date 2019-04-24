<?php
// 防止被别的网站恶意调用，定义一个常量即可
if(!defined('INC')) {
    exit('ACCESS DENIED!');
}

require $_SERVER['DOCUMENT_ROOT'].'/include/mysql.func.php';

function _get_writers($sql) {
    
}


?>