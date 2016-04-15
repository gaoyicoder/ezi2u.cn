<?php
define('CURSCRIPT','document');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once dirname(__FILE__)."/include/ifview.inc.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$docu_arr = array(
	'1'=>'Text Article',
	'2'=>'Article With Images'
);

function get_docuarr_options($arrid = ''){
	global $docu_arr;
	foreach ($docu_arr as $key => $value){
		$mymps .= '<option value='.$key.'';
		$mymps .= ($arrid == $key) ? ' style = "background-color:#6EB00C;color:white" selected>' : '>';
		$mymps .= $value.'</option>';
	}
	return $mymps;
}

$do = $do ? $do : 'type';

if(!submit_check(CURSCRIPT.'_submit')){
	
	if($do == 'type'){
		
		chk_admin_purview("purview_Member Files");
		
		$here = 'Member File Module Management';
		if($part == 'edit'){
			$typeid = intval($typeid);
			$edit = $db->getRow("SELECT * FROM `{$db_mymps}member_docutype` WHERE typeid = ".$typeid);
			include mymps_tpl(CURSCRIPT.'_'.$do.'_'.$part);
			exit;
		} else {
			
			$notice = '<li>If your original module is already in use, please be prudent in deleting the original module.</li>';
			$docu = $db -> getAll("SELECT * FROM `{$db_mymps}member_docutype` ORDER BY displayorder ASC");
		}
	} else {
		
		chk_admin_purview("purview_Member Files");
		$here = 'Member File Management';
		$doc_level = array('0'=>'Under Revision','1'=>'Normal'); 
		$rows_num = $db -> getOne("SELECT COUNT(*) FROM `{$db_mymps}member_docu`");
		$param	= setParam(array('do','part'));
		$docu = page1("SELECT * FROM `{$db_mymps}member_docu` ORDER BY pubtime DESC");
		
	}
	include $do == 'document' ? mymps_tpl(CURSCRIPT) : mymps_tpl(CURSCRIPT.'_type');

} else {
	
	if($part == 'edit'){
		
		$forward_url = '?part=edit&typeid='.$typeid;
		(empty($typeid) || empty($typename)) && write_msg('Please enter the complete information on the module!');
		$db->query("UPDATE `{$db_mymps}member_docutype` SET typename='$typename',arrid='$arrid',ifview='$ifview',displayorder='$displayorder' WHERE typeid = '$typeid'");
		$i = 1;
	
	} else {
		
		if(is_array($delids)){
			$i=1;
			foreach ($delids as $kids => $vids){
				if($do == 'type') {
					mymps_delete("member_docutype","WHERE typeid = ".$vids);
				} else {
					mymps_delete("member_docu","WHERE id = ".$vids);
					
				}
			}
		}
		
		if(is_array($displayorder)){
			$i=1;
			foreach ($displayorder as $keyorder => $vorder){
				$db->query("UPDATE `{$db_mymps}member_docutype` SET displayorder = '$vorder' WHERE typeid = ".$keyorder);		
			}
		}
		
		if(is_array($add) && $add[typename] && $add[displayorder]){
			$i=1;
			$do_insert = $db->query("INSERT INTO `{$db_mymps}member_docutype` (typename,arrid,ifview,displayorder) VALUES ('$add[typename]','$add[arrid]','$add[ifview]','$add[displayorder]')");
			!$do_insert && write_msg('Adding file template failed!'); 
		}
	
	}
	
	if($i != 1 || !$i){
		write_msg('You have not executed any operations!');
	}else{
		clear_cache_files('document_type');
		write_msg($do == 'type' ? 'Member file template settings have successfully been updated!' : 'Member files have successfully been updated!',$forward_url,'MympsRecord');
	}
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();
?>
