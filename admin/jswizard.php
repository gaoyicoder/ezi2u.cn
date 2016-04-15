<?php
define('CURSCRIPT','jswizard');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

$part 	= $part 	? trim($part) 	: 'default';
$action = $action 	? trim($action) : '';

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

if(!submit_check(CURSCRIPT.'_submit')) {

	chk_admin_purview("purview_Invoking Data");
	
	switch($part){
		case 'settings':
			$here = 'JS Data Invoking – Basic Settings';
			$query = $db -> query("SELECT * FROM `{$db_mymps}config` WHERE type = 'jswizard'");
				while($row = $db -> fetchRow($query)){
				$settings[$row['description']] = $row['value'];
			}
			include mymps_tpl(CURSCRIPT.'_'.$part);
		break;
		case 'add':
			$here = 'Add JS Invoking Project';
			include mymps_tpl(CURSCRIPT);
		break;
		case 'detail':
			if(empty($id)) write_msg('Unfortunately, there are no such JS invoking projects!');
			$paramete = $db -> getRow("SELECT * FROM `{$db_mymps}jswizard` WHERE id = '$id'");
			$flag = $paramete['flag'];
			$parameter = array();
			$parameter = $charset == 'utf-8' ? utf8_unserialize($paramete['parameter']) : unserialize($paramete['parameter']);

			$here 		 = 'JS Data Invoking – Invoking Project Management';
			include mymps_tpl(CURSCRIPT);
		break;
		case 'default':
			$randam = random(7);
			$here = 'JS Data Invoking';
			$rows_num 	= mymps_count("jswizard");
			$param		= setParam(array("part"));
			$pagi 	= page1("SELECT * FROM `{$db_mymps}jswizard`");
			foreach($pagi as $key => $val){
				$jswizard[$val['id']]['id'] = $val['id'];
				$jswizard[$val['id']]['flag'] = $val['flag'];
				$jswizard[$val['id']]['edittime'] = $val['edittime'];
				$jswizard[$val['id']]['parameter'] = $charset == 'utf-8' ? utf8_unserialize($val['parameter']) : unserialize($val['parameter']);
				$jswizard[$val['id']]['jscharset'] = $jswizard[$val['id']]['parameter']['jscharset'];
			}
			include mymps_tpl(CURSCRIPT.'_'.$part);
		break;
	}

} else {
	
	if(is_array($delids)){
		$db -> query("DELETE FROM `{$db_mymps}jswizard` WHERE ".create_in($delids,'id'));
		$string = 'Delete JS Invoking Project';
		write_jswizard_cache();
		write_msg('Success'.$string.'',$return_url ? $return_url : '?part=default','write_record');
		exit;
	}
	
	/*Jswizard系统配置*/
	if(is_array($settingsnew)){
		mymps_delete("config","WHERE type = 'jswizard'");
		foreach($settingsnew as $key => $val){
			$db -> query("INSERT INTO `{$db_mymps}config` (`description`,`value`,`type`)VALUES('".$key."','".$val."','jswizard')");
		}
		update_jswizard_settings();
		write_msg('Basic Settings on data invoking has successfully been updated!',$return_url,'write_record');
	}
	
	if(empty($id)){
		//添加调用
		if(empty($flag) || !is_array($parameter)) write_msg('The unique mark cannot be empty! The relevant configuration cannot be empty!');
		empty($parameter['jstemplate']) && write_msg('Content of template for data invoking must not be empty!');
		if($db -> getOne("SELECT count(id) FROM `{$db_mymps}jswizard` WHERE flag = '$flag'") > 0) write_msg('This unique mark already exists, so please use another mark!');
		
		$parameter = addslashes(serialize($parameter));
		$db -> query("INSERT INTO `{$db_mymps}jswizard` (`flag`,`parameter`,`edittime`)VALUES('$flag','$parameter','$timestamp')");
		$string = 'Add A JS Invoking';
		$return_url = '?part=detail&id='.$db -> insert_id();
		
	} else {
		//修改调用
		if(empty($flag) || !is_array($parameter)) write_msg('The unique mark cannot be empty! The relevant configuration cannot be empty!');
		$parameter = addslashes(serialize($parameter));
		$db -> query("UPDATE `{$db_mymps}jswizard` SET flag='$flag',parameter='$parameter',edittime = '$timestamp' WHERE id = '$id'");
		$string = 'Edit JS Invoking';
		$return_url = '?part=detail&id='.$id;
		clear_cache_files('javascript_'.$flag);
	}
	
	write_jswizard_cache();
	write_msg('Success'.$string.'',$return_url ? $return_url : '?part=default','write_record');

}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();

function get_special_subject($arr=''){
	require_once MYMPS_DATA.'/info_special.inc.php';
	foreach($specialarray as $key => $val){
		$mymps .= '<label for="'.$key.'">';
		$mymps .= '<input class="checkbox" ';
		$mymps .= is_array($arr) ? (in_array($key,$arr) ? 'checked ' : '') : '';
		$mymps .= 'type="checkbox" name="parameter[special][]" value="'.$key.'" id="'.$key.'">'.$val;
		$mymps .= '</label>';
		$mymps .= in_array($key,array(3,6)) ? '<hr style="height:1px; border:1px #C5D8E8 solid;">' : '';
	}
	return $mymps;
}
?>
