<?php
define('CURSCRIPT','mobile');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
	
if(!submit_check(CURSCRIPT.'_submit')){

	chk_admin_purview("purview_Mobile Settings");
	$here = 'Mobile Version Browsing Settings';
	
	$mobile = $db->getOne("SELECT value FROM `{$db_mymps}config` WHERE type='mobile' AND description = 'mobile'");
	$mobile = $mobile ? ($charset == 'utf-8' ? utf8_unserialize($mobile) : unserialize($mobile)) : array();
	include(mymps_tpl(CURSCRIPT));
	
}else{
	
	$db->query("DELETE FROM `{$db_mymps}config` WHERE description = 'mobile' AND type = 'mobile'");
	$db->query("INSERT INTO `{$db_mymps}config` (description,value,type) values ('mobile','".serialize($settings)."','mobile')");
	clear_cache_files('mobile');
	write_msg('Mobile version browsing settings has successfully been updated!','mobile.php','WriteRecord');
	
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();
?>
