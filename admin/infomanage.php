<?php
define('CURSCRIPT','infomanage');
define('IN_AJAX',true);
require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

if(!submit_check(CURSCRIPT.'_submit') && $action != 'viewresult'){
	chk_admin_purview("purview_Batch Manage");
	$here = 'Batch Manage';
	include mymps_tpl(CURSCRIPT);
} else {
	
	if($step != 'submit' && !$catid && !$userid && !$cityid && !$starttime && !$endtime && !$ip && !$keywords && !$ismember && !istimed){
		write_msg('You have not yet designated any search criteria, so this operation cannot be executed!');
	}
	
	$where 	= " WHERE 1";
	$where .= $catid	? " AND ".get_children($catid,'a.catid') : "";
	$where .= $areaid	? " AND a.areaid IN (".get_area_children($areaid).")" : "";
	$where .= $tel		? " AND a.tel LIKE '%".$tel."%'" : "";
	
	if(in_array($istimed,array('yes','no'))){
		$where .= $istimed == 'yes' ? " AND a.endtime < '$timestamp' AND a.endtime != '0'" : " AND (a.endtime > '$timestamp' OR endtime = '0')";
	}
	
	if(in_array($ismember,array('yes','no'))){
		$where .= $ismember == 'yes' ? " AND a.ismember = '1'" : "";
	}
	
	if(trim($userid)) {
		$where .= " AND a.userid IN ('".str_replace(',', '\',\'', str_replace(' ', '', $userid))."')";
	}
	
	$starttime = $starttime ? strtotime($starttime) : 0;
	$where .= $starttime ? " AND a.begintime >= '$starttime'" : "";
	
	$where .= $info_level != '' ? " AND a.info_level = '$info_level'" : "";
	
	$endtime = $endtime ? strtotime($endtime) : 0;
	$where .= $endtime ? " AND a.begintime <= '$endtime'" : "";
	
	if($keywords != '') {
		$keyword = $keywords;
		$sqlkeywords = '';
		$or = '';
		$keywords = explode(',', str_replace(' ', '', $keywords));
		for($i = 0; $i < count($keywords); $i++) {
			if(preg_match("/\{(\d+)\}/", $keywords[$i])) {
				$keywords[$i] = preg_replace("/\\\{(\d+)\\\}/", ".{0,\\1}", preg_quote($keywords[$i], '/'));
				$sqlkeywords .= " $or a.title REGEXP '".$keywords[$i]."' OR a.content REGEXP '".$keywords[$i]."'";
			} else {
				$sqlkeywords .= " $or a.title LIKE '%".$keywords[$i]."%' OR a.content LIKE '%".$keywords[$i]."%'";
			}
			$or = 'OR';
		}
		$where .= " AND ($sqlkeywords)";
		$keywords = $keyword;
	}
	
	$where .= $ip != '' ? " AND a.ip LIKE '".str_replace('*', '%', $ip)."'" : "";
	
	if($lengthlimit != '') {
		$lengthlimit = intval($lengthlimit);
		$where .= " AND a.LENGTH(content) < $lengthlimit";
	}

	if($action == 'viewresult' && $detail == 'yes'){
		require_once MYMPS_DATA."/info.level.inc.php";
		$here = 'Manage Titles in Batches';
		$starttime  =  $starttime ? date('Y-m-d',$starttime) : '';
		$endtime 	=  $endtime   ? date('Y-m-d',$endtime)	 : '';
		$rows_num 	= $db -> getOne("SELECT COUNT(a.id) FROM `{$db_mymps}information` AS a $where");
		$param		= setParam(array("part","detail","action","istimed","ismember","userid","starttime","endtime","catid","cityid","ip","keywords","lengthlimit","info_level","tel"));
		
		$information= page1("SELECT a.*,b.dir_typename FROM `{$db_mymps}information` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.catid=b.catid $where ORDER BY a.id DESC",10);
		include mymps_tpl(CURSCRIPT);
	
	} else {
		
		if(empty($part)){
			write_msg('You have not yet designated any search criteria, so this operation cannot be executed!');
		}
		
		if(is_array($optionids) && $step == 'submit'){
			$count = count($optionids);
			empty($count) && write_msg('You have not yet selected any post record to be operated!');
			foreach($optionids as $key => $val){
				$ids .= $val.',';
			}
			$selectedids = substr($ids,0,-1);
		
		} elseif(!is_array($optionids) && $step != 'submit') {
			$count	=	$db -> getOne("SELECT count(id) FROM `{$db_mymps}information` $where");
			$query = $db->query("SELECT id FROM {$db_mymps}information $where");
			while($post = $db->fetchRow($query)) {
				$ids .= "$post[id],";
			}
			$selectedids = substr($ids,0,-1);
		} else {
			write_msg('You have not yet selected any post record to be operated!');
		}
		
		$starttime  =  $starttime ? date('Y-m-d',$starttime) : '';
		$endtime 	=  $endtime   ? date('Y-m-d',$endtime)	 : '';
		
		if(empty($selectedids) || $selectedids == ',') write_msg('No correspondent categorized posts matching search criteria are found!');
		
		switch ($part){
			case 'delinfo':
				$query = $db -> query("SELECT a.*,b.modid FROM `{$db_mymps}information` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.catid = b.catid WHERE a.id IN ($selectedids)");
				while($row = $db -> fetchRow($query)){
					$row[modid] > 1 && mymps_delete("information_".$row[modid],"WHERE id = '$row[id]'");
				}
				mymps_delete("information","WHERE id IN($selectedids)");
				$query = $db -> query("SELECT * FROM `{$db_mymps}info_img` WHERE infoid IN ($selectedids)");
				while($row = $db -> fetchRow($query)){
					@unlink(MYMPS_ROOT.$row['imgpath']);
					@unlink(MYMPS_ROOT.$row['pre_imgpath']);
				}
				mymps_delete("info_img","WHERE infoid IN ($selectedids)");
				mymps_delete("comment","WHERE typeid IN ($selectedids) AND type = 'information'");
				$act = 'Delete Post';
			break;
			case 'delcomment':
				$count = mymps_count("info_comment","WHERE infoid IN ($selectedids)");
				mymps_delete("info_comment","WHERE infoid IN ($selectedids)");
				$act = 'Delete Comment On Post';
			break;
			case 'delattach':
				$query = $db -> query("SELECT * FROM `{$db_mymps}info_img` WHERE infoid IN ($selectedids)");
				$count=0;
				while($row = $db -> fetchRow($query)){
					@unlink(MYMPS_ROOT.$row['imgpath']);
					@unlink(MYMPS_ROOT.$row['pre_imgpath']);
					$count++;
				}
				mymps_delete("info_img","WHERE infoid IN ($selectedids)");
				$db -> query("UPDATE `{$db_mymps}information` SET img_path = '' WHERE id IN ($selectedids)");
				$act = 'Delete Image In Post';
			break;
			case 'refresh':
				foreach(explode(',',$selectedids) as $kids => $vids){
					$activetime  = $db -> getOne("SELECT activetime FROM `{$db_mymps}information` WHERE id = '$vids'");
					$endtime	= $activetime == 0 ? 0 : $activetime*3600*24+$timestamp;
					$db -> query("UPDATE `{$db_mymps}information` SET begintime = '$timestamp',endtime='$endtime' WHERE id = '$vids'");
				}
				$act = 'Refresh Post';
			break;
			case 'level0':
				$db -> query("UPDATE `{$db_mymps}information` SET info_level = '0' WHERE id IN ($selectedids)");
				$act = 'Set As Under Revision';
			break;
			case 'level1':
				$db -> query("UPDATE `{$db_mymps}information` SET info_level = '1' WHERE id IN ($selectedids)");
				$act = 'Set As Normal';
			break;
			case 'level2':
				$db -> query("UPDATE `{$db_mymps}information` SET info_level = '2' WHERE id IN ($selectedids)");
				$act = 'Set As Recommended';
			break;
			case 'ifred':
				$db -> query("UPDATE `{$db_mymps}information` SET ifred = '1' WHERE id IN ($selectedids)");
				$act = 'Redden Post Title';
			break;
			case 'ifbold':
				$db -> query("UPDATE `{$db_mymps}information` SET ifbold = '1' WHERE id IN ($selectedids)");
				$act = 'Bold Post Title';
			break;
		}
	}
	
	!empty($act) && write_msg('In total '.$act.' '.$count.' posts',$return_url,'write_record');
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = $where = $selectedids = $step = NULL;
exit();
?>
