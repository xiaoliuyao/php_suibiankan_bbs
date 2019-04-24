<?php


/**
 * 退出登录
 */
function _logout(){
    setcookie('username','',time()-1,'/');
    header('Location:/index.php');
}

_logout();
?>