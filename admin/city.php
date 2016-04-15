<?php
@set_time_limit(0);
define('CURSCRIPT','city');
require_once(dirname(__FILE__)."/global.php");
require_once MYMPS_INC."/db.class.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$mympsdirectory = array('admin','api','attachment','backup','data','html','images','include','install','member','mypub','plugin','public','rewrite','template','uc_client');

if(!submit_check(CURSCRIPT.'_submit')){
	
	$here = "Add Sub Site";
	chk_admin_purview("purview_State-site");
	include(mymps_tpl("city"));
	exit();
	
} else {

	foreach($mympsdirectory as $k => $v){
		if($cfg_citiesdir == '/'.$v){
			write_msg('The directory you submitted is the same as a reserved directory by the system, so please try again with another directory');
			exit;
		}
	}
	mymps_delete("config","WHERE description = 'cfg_citiesdir'");
	mymps_delete("config","WHERE description = 'cfg_independency'");
	mymps_delete("config","WHERE description = 'cfg_redirectpage'");
	mymps_delete("config","WHERE description = 'cfg_cityshowtype'");
	if(is_array($independency)){
		foreach($independency as $k => $v){
			$cfg_independency .= $v.',';//与总站数据一致
		}
		$cfg_independency = substr($cfg_independency,0,-1);
	}
	$db->query("INSERT INTO `{$db_mymps}config` (description, value) VALUES ('cfg_independency', '$cfg_independency')");
	$db->query("INSERT INTO `{$db_mymps}config` (description, value) VALUES ('cfg_citiesdir', '$cfg_citiesdir')");
	$db->query("INSERT INTO `{$db_mymps}config` (description, value) VALUES ('cfg_redirectpage', '$cfg_redirectpage')");
	$db->query("INSERT INTO `{$db_mymps}config` (description, value) VALUES ('cfg_cityshowtype', '$cfg_cityshowtype')");
	update_config_cache();
	unset($admin_global);
	
	clear_cache_files('city_0');
	if($c = $db -> getAll("SELECT cityid FROM `{$db_mymps}city`")){
		foreach($c as $k => $v){
			clear_cache_files('city_'.$v['cityid']);
		}
	}
	
	clear_cache_files('allcities');
	clear_cache_files('changecity_cities');
	clear_cache_files('changeprovince_cities');
	write_msg('City sub-site settings had successfully been updated!','city.php','write_record');
}
?>
