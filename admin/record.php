<?php
define('CURSCRIPT','record');

require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");
require_once(MYMPS_DATA."/config.inc.php");

!in_array($do,array('member','admin')) && $do = 'admin';

!in_array($part,array('login','money','action')) && $part = 'login';

if($result == 'false'){
	$_result = 0;
} elseif($result == 'true') {
	$_result = 1;
} else {
	$_result = '';
}

if($action == 'delrecord'){
	$total_count = mymps_count($do."_record_".$part);
	if($total_count<$mymps_mymps['cfg_record_save']){
		write_msg("Operation failed, for relevant records did not reach ".$mymps_mymps['cfg_record_save']." in number!");
	}
	$delrecord=$db->getAll("SELECT id FROM `{$db_mymps}".$do."_record_".$part."` ORDER BY ID DESC LIMIT 1,".$mymps_mymps['cfg_record_save']);
	foreach ($delrecord as $k => $value){
		$id .= $value[id].",";
	}
	$id = substr($id,0,-1);
	mymps_delete($do."_record_".$part,"WHERE id NOT IN (".$id.")");
	write_msg("Operation Records Successfully Deleted!",$url,"MyMPS");
	exit;
} elseif($action == 'doexcel'){
	$data[] = array ('User ID','IP','Port','Geographic Location','Browser','Operating System','Time Logged-in','Time Logged Out');
	$query = $db -> query("SELECT * FROM `{$db_mymps}member_record_login` ORDER BY pubdate DESC");
	while($row = $db -> fetchRow($query)){
		$data[$row['id']][]	= $row['userid'];
		$data[$row['id']][]	= $row['ip'];
		$data[$row['id']][] = $row['port'];
		$data[$row['id']][] = $row['ip2area'];
		$data[$row['id']][]	= $row['browser'];
		$data[$row['id']][]	= $row['os'];
		$data[$row['id']][]	= GetTime($row['pubdate']);
		$data[$row['id']][] = GetTime($row['outdate'] ? $row['outdate'] :($row['pubdate']+3627));
	}
	require MYMPS_INC.'/php-excel.class.php';
	$xls = new Excel_XML('gb2312', false, 'MemberRecordSheet');
	$xls->addArray($data);
	$xls->generateXML(date("Y-m-d-His",$timestamp));
	unset($xls);
	exit;
}elseif($action == 'savemonth'){
	$monthdate = strtotime("-2 months");
	$db->query("DELETE FROM `{$db_mymps}member_record_login` WHERE pubdate < '$monthdate'");
	write_msg('Log-in Records in recent two months have successfully been deleted!','record.php?do=member&part=login','Mymps');
	exit;
}

switch ($do){
	
	case 'admin':
	
		if ($part == 'login'){
			chk_admin_purview("purview_Admin Record");
			$here = "Administrator Background Log-in Records";
			$where = "WHERE result like '%".$_result."%' AND (id like '%".$keywords."%' OR adminid like '%".$keywords."%' OR adminpwd like '%".$keywords."%' OR pubdate like '%".$keywords."%' OR ip like '%".$keywords."%')";
			
			$sql = "SELECT * FROM {$db_mymps}admin_record_login $where ORDER BY id desc";
			$rows_num = $db->getOne("SELECT COUNT(*) FROM `{$db_mymps}admin_record_login` $where");
			$param=setParam(array('do','part','result','keywords'));
			$record= array();
			foreach(page1($sql) as $k => $row){
				$arr['id']     	   = $row['id'];
				$arr['adminid']    = $row['adminid'];
				$arr['adminpwd']   = $row['adminpwd'];
				$arr['pubdate']    = GetTime($row['pubdate']);
				$arr['ip'] 		   = $row['ip'];
				$arr['result'] 	   = $row['result'];
				$record[]      	   = $arr;
			}
			
			include (mymps_tpl("record_login"));
			
		}elseif ($part == 'action'){
		
			chk_admin_purview("purview_Admin Record");
			$here 		= "Administrator Background Operation Records";

			$where = "WHERE a.id like '%".$keywords."%' OR a.adminid like '%".$keywords."%' OR a.action like '%".$keywords."%' OR a.pubdate like '%".$keywords."%' OR a.ip like '%".$keywords."%' ORDER BY a.id desc";
			$sql = "SELECT a.id,a.adminid,a.action,a.pubdate,a.ip,b.typeid,c.typename FROM {$db_mymps}admin_record_action AS a LEFT JOIN {$db_mymps}admin AS b ON a.adminid = b.userid  LEFT JOIN {$db_mymps}admin_type AS c ON b.typeid = c.id $where";
			$rows_num = $db->getOne("SELECT COUNT(*) FROM `{$db_mymps}admin_record_action` AS a $where ");
			$param=setParam(array('do','part','result','keywords'));
			$record= array();
			foreach(page1($sql) as $k => $row){
				$arr['id']       = $row['id'];
				$arr['adminid']    = $row['adminid'];
				$arr['typename']    = $row['typename'];
				$arr['action']   = $row['action'];
				$arr['pubdate'] = GetTime($row['pubdate']);
				$arr['ip'] = $row['ip'];
				$record[]      = $arr;
			}
			include (mymps_tpl("record_action"));
		}
		
	break;	
	
	case 'member':
	
		if ($part == 'login'){
		
			chk_admin_purview("purview_Log-in Record");
			
			if (trim($action)=='delall'){
				write_msg('Deleting operation log '.mymps_del_all("member_record_".$part,$id).' of ordinary member has been successful',$url,"mymps");
			}
			
			$here = "Ordinary Member Log-in Records";
			$where = " WHERE userid like '%".$keywords."%' ";
			$sql = "SELECT * FROM {$db_mymps}member_record_login $where ORDER BY id DESC";
			$rows_num = mymps_count("member_record_login",$where);
			$param=setParam(array('do','part'));
			$record= array();
			foreach(page1($sql) as $k => $row){
				$arr['id']      	= $row['id'];
				$arr['userid']     = $row['userid'];
				$arr['userpwd']    = $row['userpwd'];
				$arr['pubdate'] 	= GetTime($row['pubdate']);
				$arr['outdate'] 	= GetTime($row['outdate'] ? $row['outdate'] :($row['pubdate']+3627));
				$arr['ip'] 			= $row['ip'];
				$arr['ip2area'] 	= $row['ip2area'];
				$arr['browser'] 	= $row['browser'];
				$arr['port'] 		= $row['port'];
				$arr['os'] 			= $row['os'];
				$arr['result']		= $row['result'];
				$record[]      		= $arr;
			}
			include (mymps_tpl("record_login_member"));
			
		}elseif($part == 'money'){
			chk_admin_purview("purview_Purchase Record");
			$here = "Member Consumption Records";
			if (trim($action)=='delall'){
				write_msg('Delete <b>'.$here.'</b> '.mymps_del_all("member_record_use",$id).' 成功',$url,"mymps");
				exit();
			}
			$sql = "SELECT * FROM `{$db_mymps}member_record_use` ORDER BY pubtime DESC";
			$rows_num = mymps_count("member_record_use",$where);
			$param = setParam(array('do','part'));
			$get = array();
			foreach(page1($sql) as $k => $row){
				$arr['id']         = $row['id'];
				$arr['userid']     = $row['userid'];
				$arr['subject']    = $row['subject'];
				$arr['paycost']    = $row['paycost'];
				$arr['pubtime']    = GetTime($row['pubtime']);
				$get[]      = $arr;
			}
			include (mymps_tpl("record_bank"));
		}
	break;
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();
?>
