<?php
define('CURSCRIPT','data_replace');
require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = isset($part)  ? $part : 'default' ;

if($part == 'default') {

	$here = 'Data Content Replacement';
	chk_admin_purview("purview_Maintenance");
	include mymps_tpl('data_replace');
	
}  else if($part == 'do_action') {

	if($exptable == '' || $rpfield == ''){
		write_msg("Please designate data table as well as the field!", "olmsg");
		exit();
	}
	
	if($rpstring==''){
		write_msg("Please designate the contents to be replaced!", "olmsg");
		exit();
	}

	$rs = $db->query("UPDATE $exptable SET $rpfield=REPLACE($rpfield,'$rpstring','$tostring')");
	$db -> query("OPTIMIZE TABLE `$exptable`");
	
	if($rs){
		write_msg("Data replacement has successfully been done!", "olmsg","write_mymps_record");
		exit();
	}else{
		write_msg("Data replacement failed!", "olmsg","write_mymps_record");
		exit();
	}
	
}
?>
