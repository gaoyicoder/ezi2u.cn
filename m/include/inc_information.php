<?php
!defined('WAP') && exit('FORBIDDEN');
define('CURSCRIPT','information');
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
if(!$id) errormsg('Post theme ID cannot be empty!');

if(!$row = $db -> getRow("SELECT * FROM `{$db_mymps}information` WHERE id = '$id' AND info_level >= 1")){
	errormsg('This post theme either does not exist or have not yet passed the revision!');
}

$city = $db->getRow("SELECT * FROM `{$db_mymps}city` WHERE cityid = $row[cityid]");

$row['endtime']	 = get_info_life_time($row['endtime']);
$row['contactview'] = ($row['endtime'] == '<font color=red>Expired</font>' && $mymps_global['cfg_info_if_gq'] != 1) ? 0 : 1; 

$rowr = $db -> getRow("SELECT catid,parentid,catname,template_info,modid FROM `{$db_mymps}category` WHERE catid = '$row[catid]'");
$row['catid'] = $rowr['catid'];
$row['parentid'] = $rowr['parentid'];
$row['catname'] = $rowr['catname'];
$row['template_info'] = $rowr['template_info'];
$row['modid'] = $row['modid'];
$row['image'] = $row['img_count'] > 0 ? $db -> getAll("SELECT prepath,path FROM `{$db_mymps}info_img` WHERE infoid = '$id' ORDER BY id DESC") : false;

if($row['modid'] > 1){
	$extr = $db ->getRow("SELECT * FROM `{$db_mymps}information_{$row[modid]}` WHERE id ='$id'");
	if(is_array($extr)){
		$des = get_info_option_array();
		unset($extr['iid'],$extr['id'],$extr['content']);
		foreach($extr as $k =>$v){
			$val = get_info_option_titval($des[$k],$v);
			$arr['title'] = $val['title'];
			$arr['value'] = $val['value'];
			$row['extra'][]=$arr;
			$row[$k] = $v;
		}
		$des = NULL;
	}
}

$relevant = mymps_get_info_list(6,'','','',$row['catid'],'','','',false);
$parentcats = get_parent_cats('category',$row['catid']);
$parentcats = is_array($parentcats) ? array_reverse($parentcats) : '';
include mymps_tpl('info');
?>