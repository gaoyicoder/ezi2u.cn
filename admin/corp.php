<?php
define('CURSCRIPT','corp');

require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = $part ? $part : 'list' ;

if(!submit_check(CURSCRIPT.'_submit')){
	
	if($part == 'list'){
		
		chk_admin_purview("purview_Sellers");
		
		$corp = cat_list('corp',0,0,false);
		$here = "Seller Category";
		include(mymps_tpl("corp_list"));
	} elseif($part == 'add'){
		
		chk_admin_purview("purview_Add a Category");
		
		$maxorder = $db->getOne("SELECT MAX(corporder) FROM {$db_mymps}corp");
		$maxorder = $maxorder + 1;
		$here = "Add Category";
		include(mymps_tpl("corp_add"));
	} elseif($part == 'edit'){
		$corp = $db->getRow("SELECT * FROM {$db_mymps}corp WHERE corpid = '$corpid'");
		$here = "Edit Seller Category";
		include(mymps_tpl("corp_edit"));
	} elseif($part == 'del'){
		if(empty($corpid)) write_msg('No Records Selected');
		
		mymps_delete("corp","WHERE corpid = '$corpid'");
		mymps_delete("corp","WHERE parentid = '$corpid'");
		
		clear_cache_files('corp_option_static');
		clear_cache_files('corp_pid_releate');
		write_msg("Seller category $corpid has successfully been deleted!","?part=list","Mymps_record");
	}
	
} else {
	
	if($part == 'add'){
		
		if(empty($corpname))write_msg("Please Enter Seller Category Name");
		
		$corpname  = explode('|',trim($corpname));
		
		if(empty($corporder)){
			$maxorder = $db->getOne("SELECT MAX(corporder) FROM {$db_mymps}corp");
			$corporder = $maxorder + 1;
		}
		
		if(is_array($corpname)){
			foreach ($corpname as $key => $value){
				$value = trim($value);
				$corporder ++;
				$len = strlen($value);
				if($len < 2 || $len > 30){
					write_msg("Category name must be between 2 and 30 characters in length!");
					exit();
				}
				$db->query("INSERT INTO {$db_mymps}corp (corpname,parentid,corporder) VALUES ('$value','$parentid','$corporder')");
			}

		}
		/*清除缓存*/
		foreach(array('option_static','pid_releate') as $range){
			clear_cache_files('corp_'.$range);
		}
		
		write_msg('Seller category has successfully been updated!','corp.php?part=list','write_record');
		
	} elseif($part == 'edit') {
		
		if(empty($corpname))write_msg("Please Enter Seller Category Name");
		$len = strlen($corpname);
		$corpid == $parentid && write_msg("A category must not subordinate itself!");
		if($len < 2 || $len > 30)write_msg("Category name must be between 2 and 30 characters in length!");
		
		$sql = "UPDATE {$db_mymps}corp SET corpname='$corpname',
		parentid='$parentid',
		corporder='$corporder'
		WHERE corpid = '$corpid'";
		$res = $db->query($sql);
		
		/*清除缓存*/
		foreach(array('option_static','pid_releate') as $range){
			clear_cache_files('corp_'.$range);
		}
		
		$nav_path = 'District Management &raquo Edit District';
		$message  = 'Seller Category Successfully Edited! '.$corpname;
		$after_action = "<a href='?part=add'><u>Continue Adding Seller Categories</u></a>
		&nbsp;&nbsp;<a href='?part=edit&corpid=$corpid'><u>Re-edit This Category</u></a>&nbsp;&nbsp;<a href='?part=list#$catid'><u>Manage Added Categories</u></a>";
		show_message($nav_path,$message,$after_action);
		
	} elseif($part == 'list' && is_array($corporder)) {
	
		foreach($corporder as $key => $value){
			$db->query("UPDATE `{$db_mymps}corp` SET corporder = '$value' WHERE corpid = ".$key);		
		}
		
		/*清除缓存*/
		foreach(array('option_static','pid_releate') as $range){
			clear_cache_files('corp_'.$range);
		}
		
		write_msg('Seller category has successfully been updated!','corp.php?part=list','write_record');
	
	}
	
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();
?>
