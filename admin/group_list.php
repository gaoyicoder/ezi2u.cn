<?php
define('CURSCRIPT','group');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = $part ? trim($part) : 'list' ;
$id	  = isset($id) ? intval($id) : '';

chk_admin_purview("purview_Started");

if(!submit_check(CURSCRIPT.'_submit')){
	
	require_once MYMPS_ROOT.'/plugin/group/include/functions.php';
	require_once MYMPS_DATA.'/grouplevel.inc.php';
	
	$here = ($part == 'edit' ? 'Edit' : '').'Started Group Purchase Activity';
	
	if($part == 'edit'){
		
		if(empty($id)) write_msg('Group purchase activity number must not be empty!');
		$edit = $db -> getRow("SELECT * FROM `{$db_mymps}group` WHERE groupid = '$id'");
		if(empty($edit['groupid'])) write_msg('This group purchase activity no longer exists!');
		$edit['des'] = de_textarea_post_change($edit['des']);
		$edit['othercontent'] = de_textarea_post_change($edit['othercontent']);
		$acontent 	= get_editor('content','',$edit['content'],'100%','400');
		$meetdate = $edit['meetdate'] ? date('Y-m-d',$edit['meetdate']) : '';
		$enddate = $edit['enddate'] ? date('Y-m-d',$edit['enddate']) : '';
		
	} else {
		
		$gname = isset($gname) ? trim($gname) : '';
		$userid = isset($userid) ? trim($userid) : '';
		$meetdate = isset($meetdate) ? intval(strtotime($meetdate)) : '';
		$enddate = isset($enddate) ? intval(strtotime($enddate)) : '';
		$cate_id = isset($cate_id) ? intval($cate_id) : '';
		$cityid = isset($cityid) ? intval($cityid) : '';
		
		$where = ' WHERE 1';
		$where .= $gname != '' ? " AND gname LIKE '%".$gname."%'" : ''; 
		$where .= $userid != '' ? " AND userid = '$userid'" : ''; 
		$where .= $meetdate != '' ? " AND meetdate >= '$meetdate'" : '';
		$where .= $enddate != '' ? " AND enddate <= '$enddate'" : '';
		$where .= !empty($cate_id) ? " AND cate_id = '$cate_id'" : '';
		$where .= $admin_cityid ? " AND cityid = '$admin_cityid'" : ($cityid ? " AND cityid = '$cityid'" : '');
		
		$group = page1("SELECT * FROM `{$db_mymps}group` $where ORDER BY displayorder DESC");
		$rows_num = $db -> getOne("SELECT COUNT(groupid) FROM `{$db_mymps}group` $where");
		$param = setParam(array('part','gname','userid','meetdate','enddate','cate_id','cityid'));
		$meetdate = !$meetdate ? '' : date('Y-m-d',$meetdate);
		$enddate = !$enddate ? '' : date('Y-m-d',$meetdate);
	}
	
	include mymps_tpl('group_'.$part);
	exit();
	
} else {
	
	if($part == 'list'){
		
		if(empty($selectedids)) write_msg('You have not yet selected any group purchase activity!');
		$create_in = create_in($selectedids);
		if(!$action || !in_array($action,array('delall','glevel0','glevel1','glevel2','glevel3','glevel4'))){
			write_msg('You have not designated any operation!');
		}
		if($action == 'delall'){
			$query = $db -> query("SELECT * FROM `{$db_mymps}group` WHERE groupid ".$create_in);
			while($row = $db -> fetchRow($query)){
				$delete[$row['id']]['picture'] = $row['picture'];
				$delete[$row['id']]['pre_picture'] = $row['pre_picture'];
			}
			foreach($delete as $k => $v){
				@unlink(MYMPS_ROOT.$v['picture']);
				@unlink(MYMPS_ROOT.$v['pre_picture']);
			}
			$db -> query("DELETE FROM `{$db_mymps}group` WHERE groupid ".$create_in);
			unset($delete,$row,$query,$create_in);
		} elseif(in_array($action,array('glevel0','glevel1','glevel2','glevel3','glevel4'))) {
			switch($action){
				case 'glevel0':
					$action = 0;
				break;
				case 'glevel1':
					$action = 1;
				break;
				case 'glevel2':
					$action = 2;
				break;
				case 'glevel3':
					$action = 3;
				break;
				case 'glevel4':
					$action = 4;
				break;
			}
			$db -> query("UPDATE `{$db_mymps}group` SET glevel = '$action' WHERE groupid ".$create_in);
			unset($create_in,$action);
		}
	} elseif($part == 'edit') {
		
		if(empty($id)) write_msg('Group purchase activity number must not be empty!');
		if(empty($gname)) write_msg('Activity name must not be empty!');
		if(empty($gaddress)) write_msg('Place for activity must not be empty!');
		if(empty($des)) write_msg('Activity brief must not be empty!');
		if(empty($meetdate)) write_msg('Starting time must not be empty!');
		if(empty($enddate)) write_msg('Ending time must not be empty!');
		
		$name_file = 'group_image';
		$meetdate = intval(strtotime($meetdate));
		$enddate = intval(strtotime($enddate));
		$des = textarea_post_change($des);
		$othercontent = textarea_post_change($othercontent);
		$cate_id = intval($cate_id);
		$areaid = intval($areaid);
		$gaddress = trim($gaddress);
		$signintotal = intval($signintotal);
		$masterqq = intval($masterqq);
		$displayorder = intval($displayorder);
		
		if($_FILES[$name_file]['name']){
			require_once MYMPS_INC.'/upfile.fun.php';
			$destination = "/group/".date('Ym')."/";
			$mymps_image = start_upload($name_file,$destination,0,$mymps_mymps['cfg_group_limit']['width'],$mymps_mymps['cfg_group_limit']['height'],$picture,$pre_picture);
			$picture	 = $mymps_image[0];
			$pre_picture = $mymps_image[1];
			unset($mymps_image);
		}
		unset($name_file);

		$db -> query("UPDATE `{$db_mymps}group` SET gname='$gname',des='$des',content='$content',cate_id='$cate_id',areaid='$areaid',gaddress='$gaddress',picture='$picture',pre_picture='$pre_picture',meetdate='$meetdate',enddate='$enddate',dateline='$timestamp',mastername='$mastername',masterqq='$masterqq',glevel='$glevel',signintotal='$signintotal',glevel='$glevel',commenturl='$commenturl',biztype='$biztype',othercontent='$othercontent',displayorder='$displayorder' WHERE groupid = '$id'");
		
		$url = '?part=edit&id='.$id;
		
	}
	
	write_msg('Operation Successful!',$url ? $url : '?part=list');
	
}
?>
