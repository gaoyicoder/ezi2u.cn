<?php
!defined('WAP') && exit('FORBIDDEN');
define('CURSCRIPT','zuixin');

$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$where = " WHERE a.info_level > 0 ";

$rows_num = $db -> getOne("SELECT COUNT(a.id) FROM `{$db_mymps}information` AS a {$where}");
$totalpage = ceil($rows_num/$perpage);
$num = intval($page-1)*$perpage;
$param = setparams(array('mod'));

$info_list = $db -> getAll("SELECT a.* FROM `{$db_mymps}information` AS a {$where} ORDER BY a.id DESC LIMIT $num,$perpage");

include mymps_tpl('newinfo');
?>