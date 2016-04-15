<?php
define('CURSCRIPT','lifebox');
require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = isset($part)  ? $part : 'list' ;
$id	  = isset($id)	  ? intval($id) : 0;

if(!submit_check(CURSCRIPT.'_submit')){
	
	$here = 'Useful Tools Settings';
	chk_admin_purview("purview_Useful Tools");
	require_once dirname(__FILE__)."/include/ifview.inc.php";
	$serv_type = array(
					   '2'=>'Internal Page Nesting',
					   '1'=>'Jump Directly'
					   );
	if($part == 'edit' && empty($id)) write_msg('You have not yet designated the ID of item to be edited!');
	$city_limit = $admin_cityid ? "WHERE cityid = '$admin_cityid'" : ($cityid ? "WHERE cityid = '$cityid'" : " WHERE cityid = '0'");
	$rows_num 	= mymps_count("lifebox",$city_limit);
	$param		= setParam(array("part","cityid"));
	$lifebox 	= page1("SELECT * FROM `{$db_mymps}lifebox` {$city_limit} ORDER BY displayorder DESC");
	include(mymps_tpl(CURSCRIPT));

} else {
	
	if(is_array($newlifename) && is_array($newlifeurl)) {
		foreach($newlifename AS $key => $q) {
			$lifename 		= trim($q);
			$lifeurl  		= mhtmlspecialchars(trim($newlifeurl[$key]));
			$cityid  		= mhtmlspecialchars(trim($newcityid[$key]));
			$typeid  		= mhtmlspecialchars(trim($newtypeid[$key]));
			$displayorder   = mhtmlspecialchars(trim($newdisplayorder[$key]));
			$if_view		= mhtmlspecialchars(trim($newif_view[$key]));
			if($lifename && $lifeurl) {
				$db->query("INSERT `{$db_mymps}lifebox` (lifename,lifeurl,typeid,cityid,displayorder,if_view)VALUES('$lifename','$lifeurl','$typeid','$cityid','$displayorder','$if_view')");
			}
		}
	}
	
	if(is_array($edit)){
		foreach($edit as $kedit => $vedit){
			$db->query("UPDATE `{$db_mymps}lifebox` SET lifename='$vedit[lifename]',cityid = '$vedit[cityid]' , lifeurl='$vedit[lifeurl]',typeid='$vedit[typeid]',displayorder='$vedit[displayorder]',if_view='$vedit[if_view]' WHERE id = '$kedit'");
		}
	}
	
	if(is_array($delids)){
		$db -> query("DELETE FROM `{$db_mymps}lifebox` WHERE ".create_in($delids,'id'));
	}
	
	clear_cache_files('city_'.$cityid);
	
	write_msg('Useful tools Settings have successfully been updated!','lifebox.php?cityid='.$cityid,'write_record');

}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit;

function get_servtype_options($typeid){
	global $serv_type;
	foreach($serv_type as $k=>$v){
	 	if($k == $typeid && $k != '') $serv_type_form .= "<option value='$k' selected style='background-color:#6EB00C;color:white'>$v</option>\r\n";
	 	else $serv_type_form .= "<option value='$k'>$v</option>\r\n";
	}
	return $serv_type_form;
}
?>
