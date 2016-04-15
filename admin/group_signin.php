<?php
define('CURSCRIPT','group_signin');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = $part ? trim($part) : 'list' ;
$id	  = isset($id) ? intval($id) : '';

chk_admin_purview("purview_Sign-up");

require_once MYMPS_DATA.'/group_signin_status.inc.php';

if(!submit_check(CURSCRIPT.'_submit')){

	if($part == 'list'){
		$name = isset($name) ? trim($name) : '';
		$userid = isset($userid) ? trim($userid) : '';
		$begindate = isset($begindate) ? intval(strtotime($begindate)) : '';
		$enddate = isset($enddate) ? intval(strtotime($enddate)) : '';
		$cate_id = isset($cate_id) ? intval($cate_id) : '';
		$areaid = isset($areaid) ? intval($areaid) : '';
		
		$where = ' WHERE 1';
		$where .= $name != '' ? " AND a.sname LIKE '%".$name."%'" : ''; 
		$where .= $userid != '' ? " AND b.userid = '$userid'" : ''; 
		$where .= $begindate != '' ? " AND b.dateline > '$begindate'" : '';
		$where .= $enddate != '' ? " AND b.dateline < '$enddate'" : '';
		
		$rows_num = $db -> getOne("SELECT COUNT(signid) FROM `{$db_mymps}group_signin` AS a LEFT JOIN `{$db_mymps}group` AS b ON a.groupid = b.groupid $where");
		$param = setParam(array('part','name','userid','dateline'));
		$group = page1("SELECT a.*,b.gname,b.userid FROM `{$db_mymps}group_signin` AS a LEFT JOIN `{$db_mymps}group` AS b ON a.groupid = b.groupid $where ORDER BY dateline DESC");
		$begindate = !$begindate ? '' : date('Y-m-d',$begindate);
		$enddate = !$enddate ? '' : date('Y-m-d',$enddate);
	} elseif($part == 'view') {
		if(empty($id)) write_msg('Sign-up Number must not be empty!');
		$view = $db -> getRow("SELECT a.*,b.gname FROM `{$db_mymps}group_signin` AS a LEFT JOIN `{$db_mymps}group` AS b ON a.groupid = b.groupid WHERE a.signid = '$id'");
	}
	$here = 'Group Purchase Signing-up Management';
	include mymps_tpl('group_signin_'.$part);
	exit();

} else {

	if(empty($selectedids)) write_msg('You have not yet selected any signing-up record!');
	$create_in = create_in($selectedids);
	if(!$action || !in_array($action,array('delall','status0','status1'))){
		write_msg('You have not designated any operation!');
	}
	
	if($action == 'delall'){
		$db -> query("DELETE FROM `{$db_mymps}group_signin` WHERE signid ".$create_in);
	} elseif(in_array($action,array('status0','status1'))) {
		switch($action){
			case 'status0':
				$action = 0;
			break;
			case 'status1':
				$action = 1;
			break;
		}
		$db -> query("UPDATE `{$db_mymps}group_signin` SET status = '$action' WHERE signid ".$create_in);
		unset($action);
	}
	write_msg('Operation Successful!',$url ? $url : '??part=list');
	unset($create_in);
	exit();

}

unset($status);
?>
