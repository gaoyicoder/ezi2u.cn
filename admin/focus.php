<?php 
define('CURSCRIPT','focus');

require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

$part = $part ? $part : 'list' ;
$cityid = isset($admin_cityid) ? intval($admin_cityid) : intval($cityid);

(!in_array($typename,array('Site Homepage','News Homepage')) || !$typename) && $typename = 'Site Homepage';

!in_array($part,array('list','add','edit')) && $part = 'list';
require_once MYMPS_DATA.'/config.inc.php';

$tpl_index = $db->getOne("SELECT value FROM `{$db_mymps}config` WHERE type='tpl' AND description = 'tpl_set'");
$tpl_index = $tpl_index ? ($charset == 'utf-8' ? utf8_unserialize($tpl_index) : unserialize($tpl_index)) : $defaultset['classic'];

if(!submit_check(CURSCRIPT.'_submit')){

	if($part == 'list'){
		chk_admin_purview("purview_Focus List");
		$citylimit 	= $admin_cityid ? "AND cityid = '$admin_cityid'" : ($cityid ? "AND cityid = '$cityid'" : " AND cityid = '0'");
		$where 		= "WHERE typename = '$typename' {$citylimit} ORDER BY focusorder ASC";
		$sql		="SELECT * FROM `{$db_mymps}focus` {$where}";
		$rows_num	= mymps_count('focus',$where);
		$param		= setParam(array("part","typename","cityid"));
		$row		= page1($sql);
		$here 		= $typename." Update Focus Image";
	} elseif($part == 'add'){
		chk_admin_purview("purview_Upload a Picture");
		$here = "Add Focus Image";
		$maxorder = $db->getOne("SELECT MAX(focusorder) FROM {$db_mymps}focus");
		$maxorder = $maxorder + 1;
	} elseif($part == 'edit') {
		if(empty($id)){
			write_msg("You Have Not Designated ID");
		}
		$row = $db->getRow("SELECT * FROM {$db_mymps}focus WHERE id ='$id'");
		$here = " Update ".$row[typename]."Foucs Image";
	}
	include mymps_tpl(CURSCRIPT.'_'.$part);
} else {
	require_once MYMPS_INC."/upfile.fun.php";
	
	$limit = $typename == 'News Homepage' ? 'news': 'index';
	
	if($part == 'add'){
		$name_file = 'mymps_focus';
		if($_FILES[$name_file]['name']){
			check_upimage($name_file);
			$destination = "/focus/";
			$mymps_image = start_upload($name_file,$destination,0,$mymps_mymps['cfg_focus_limit'][$tpl_index['banmian']]['index']['width'],$mymps_mymps['cfg_focus_limit'][$tpl_index['banmian']]['index']['height']);
			unset($limit);
			$db->query("INSERT INTO `{$db_mymps}focus` (id,image,pre_image,words,url,pubdate,focusorder,typename,cityid)
					VALUES('','$mymps_image[0]','$mymps_image[1]','$words','$url','$timestamp','$focusorder','$typename','$cityid')");
			clear_cache_files('city_'.$cityid);
		}
	} elseif($part == 'edit'){
		$name_file = "mymps_focus";
		if($_FILES[$name_file]["name"]){
			check_upimage($name_file);
			$destination="/focus/";
			$mymps_image=start_upload($name_file,$destination,0,$mymps_mymps['cfg_focus_limit'][$tpl_index['banmian']]['index']['width'],$mymps_mymps['cfg_focus_limit'][$tpl_index['banmian']]['index']['height'],$image,$pre_image);
			unset($limit);
			$image = $mymps_image[0];
			$pre_image = $mymps_image[1];
		}
		$res = $db->query("UPDATE `{$db_mymps}focus` SET image='$image',pre_image='$pre_image',words='$words',url='$url',focusorder='$focusorder',cityid='$cityid' WHERE id = '$id'");
		clear_cache_files('city_'.$cityid);
	} elseif($part == 'list') {
		if(is_array($delids)){
			foreach ($delids as $kids => $vids){
				$delrow = $db->getRow("SELECT image,pre_image FROM `{$db_mymps}focus` WHERE id = '$vids'");
				@unlink(MYMPS_ROOT.$delrow['image']);
				@unlink(MYMPS_ROOT.$delrow['pre_image']);
				mymps_delete(CURSCRIPT,"WHERE id = ".$vids);
			}
		}
		if(is_array($displayorder)){
			foreach($displayorder as $key => $val){
				$db->query("UPDATE `{$db_mymps}focus` SET focusorder = '$val' WHERE id = ".$key);		
			}
			
		}
		clear_cache_files('city_'.$cityid);
	}
	write_msg("Focus image ".$typename." has successfully been updated or uploaded!","?part=list&typename=".$typename,"mymps");
}
is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit;
?>
