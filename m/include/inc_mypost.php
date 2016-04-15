<?php
define('CURSCRIPT','mypost');

$userid = isset($_GET['userid']) ? mhtmlspecialchars($_GET['userid']) : '';
if(!$row = $db -> getRow("SELECT * FROM `{$db_mymps}member` WHERE userid = '$userid'")){
	errormsg('The user you requested either does not exist or have not yet passed the revision!');
}
$row['prelogo'] = $row['prelogo'] ? $row['prelogo'] : '/images/noavatar_small.gif';
$row['prelogo'] = $mymps_global['SiteUrl'].$row['prelogo'];
$info_list = mymps_get_info_list(10,1,'',$userid);
$info_list = is_array($info_list) ? $info_list : array();
include mymps_tpl('member_mypost');
?>