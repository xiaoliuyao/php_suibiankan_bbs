<?php
// 防止被别的网站恶意调用，定义一个常量即可
if(!defined('INC')) {
    exit('ACCESS DENIED!');
}
    
// 定义数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','123');
define('DB_DATABASE','php_bbs');

/**
 * _connect_database
 */
function _connect_database(){
    // 声明为全局变量，否则外部无法用
    global $sqllink;
    $sqllink = @mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE) or die('数据库连接错误!'.mysqli_connect_error($sqllink));
}
_connect_database();


/**
 * _query   执行一次sql语句
 * param $sql   sql语句
 * return $result   结果集
 */
function _query($sqllink, $sql){
    if(!$result = mysqli_query($sqllink,$sql)) {
        exit("执行sql语句失败".mysqli_error($sqllink));
    }
    return $result;
}

/**
 * _fetch_array     
 */
// function _fetch_array($result){
//     return $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
// }
function _fetch_array($sqllink, $sql){
    return $row = mysqli_fetch_array(_query($sqllink, $sql),MYSQLI_ASSOC);
}

/**
 * _is_repeat   查看是否有数据，有数据则返回并提示     
 */
// function _is_repeat($row,$info) {
//     if($row) {
//         _alert_back($info);
//     }
// }
function _is_repeat($sqllink, $sql, $info) {
    if(_fetch_array($sqllink, $sql)) {
        _alert_back($info);
    }
}


?>