<?php

!defined('WAP') && exit('FORBIDDEN');



$keywords = isset($_GET['keywords']) ? addslashes($_GET['keywords']) : '';

if($keywords != '' && strlen($keywords) < 7) redirectmsg('Please input the correct mobile phone or landline number!','index.php?mod=delete');

$timestamp = time();



define(CURSCRIPT,'delete');



$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;

$page = isset($_GET['page']) ? intval($_GET['page']) : '';

$page = empty($page) ? 1 : $page;

$where = " WHERE a.info_level > 0 ";

$where .= $keywords ? " AND (tel LIKE '%".$keywords."%') " : "";



$rows_num = $db -> getOne("SELECT COUNT(a.id) FROM `{$db_mymps}information` AS a {$where}");

$totalpage = ceil($rows_num/$perpage);

$num = intval($page-1)*$perpage;

$param = setparams(array('mod','keywords'));

$info_list = $db -> getAll("SELECT a.* FROM `{$db_mymps}information` AS a {$where} ORDER BY a.id DESC LIMIT $num,$perpage");





include mymps_tpl('member_delete');

?>