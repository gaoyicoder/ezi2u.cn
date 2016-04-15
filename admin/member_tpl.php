<?php
define('CURSCRIPT','member_tpl');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once dirname(__FILE__)."/include/ifview.inc.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

if(!submit_check(CURSCRIPT.'_submit')){
	
	chk_admin_purview("purview_Template Review");

	if($part == 'edit'){
		$here 	= 'Change Member Template Settings'; 
		if($edit = $db -> getRow("SELECT * FROM {$db_mymps}member_tpl WHERE id = ".$id)){
			include mymps_tpl(CURSCRIPT.'_edit');
		} else {
			write_msg('The template you have designated does not exist or is deleted!');
		}
	} else {
		$here		= 'Member Template Settings';
		$list		= $db->getAll("SELECT * FROM {$db_mymps}".CURSCRIPT." ORDER BY displayorder ASC");
		include mymps_tpl(CURSCRIPT);
	}
	
} else {
	
	if($part == 'edit'){
		
		$forward_url = '?part=edit&id='.$id;
		(empty($tpl_name) || empty($tpl_path) || empty($displayorder)) && write_msg('Template name and template directory cannot be empty!');
		$db->query("UPDATE `{$db_mymps}member_tpl` SET tpl_name='$tpl_name',tpl_path='$tpl_path',if_view='$isview',displayorder='$displayorder',edittime='".time()."' WHERE id = '$id'");
		$i =1;
	
	} else {
		
		if(is_array($delids)){
			$i=1;
			foreach ($delids as $kids => $vids){
				mymps_delete(CURSCRIPT,"WHERE id = ".$vids);
			}
		}
		if(is_array($displayorder)){
			$i=1;
			foreach ($displayorder as $keyorder => $vorder){
				$db->query("UPDATE `{$db_mymps}member_tpl` SET displayorder = '$vorder' WHERE id = ".$keyorder);		
			}
		}
		if(is_array($add) && $add[tpl_name] && $add[tpl_path]){
			$i=1;
			$do_insert = $db->query("INSERT INTO `{$db_mymps}member_tpl` (tpl_name,tpl_path,if_view,displayorder,edittime) VALUES ('$add[tpl_name]','$add[tpl_path]','$add[if_view]','$add[displayorder]','".time()."')");
			!$do_insert && write_msg('Adding member template failed!'); 
		}
	
	}
	if($i != 1 || !$i){
		write_msg('You have executed no operation!');
	}else{
		write_msg('Member template settings have successfully been updated!',$forward_url,'MympsRecord');
	}

}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();
?>
