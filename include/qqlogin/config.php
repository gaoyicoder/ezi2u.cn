<?php
define('QQLOGIN',1);
$data = NULL;
require_once 'config.inc.php';
$_SESSION["appid"]    = $data['appid'];
$_SESSION["appkey"]   = $data['appkey'];
$_SESSION["callback"] = $data['callback'];
$_SESSION["scope"] = $data['scope'] ? $data['scope'] : 'get_user_info';
unset($data);
?>
