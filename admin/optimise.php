<?php 
define('CURSCRIPT','optimise');
require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');
$step = array(
	'1'=>'Delete Expired Categorized Posts',
	'2'=>'Delete Categorized Posts Under Revision',
	'3'=>'Keep Only Member Log-in Records Within Two Months',
	'4'=>'Delete Member Payment Records With No Coins Spent',
	'5'=>'Delete Member Payment Records With Failed Payments',
	'6'=>'删除QQ登录的冗余会员帐号(中国元素，建议斟酌)',
	'7'=>'Save Only'.$mymps_mymps["cfg_record_save"].'Administrator Log-inn Records',
	'8'=>'Save Only'.$mymps_mymps["cfg_record_save"].'Administrator Operation Records',
	'9'=>'Delete Messages Already Read By Member',
	'10'=>'Save Only Sent Mail Records Within One Month',
	'11'=>'Mysql Optimize Database Table'
);
$here = 'Ezi2u System Optimization';
chk_admin_purview("purview_优化大师");
if($action == 'dopost'){
	$steporder = $steporder ? mhtmlspecialchars($steporder) : array();
	foreach($steporder as $k => $v){
		$next .= $v == 1 ? $k.',' : '';
	}
	$next = $next ? $next : ',';
}else {
	$next && !intval($next) && $finished = 1;
}
include mymps_tpl(CURSCRIPT);
if(!empty($next)){
	$next = substr($next,0,-1);
	$nextarr = explode(',',$next);
	$nextid = $nextarr[0];
	$last .= $nextid.',';
	if(!$nextarr[0]){
		$finished = 1;
	}
	unset($nextarr[0]);
	$next = implode(',',$nextarr);
	$next .= ',';
	switch($nextid){
		case '1':
			//删除过期信息
			$where = " WHERE endtime < '$timestamp' AND endtime != '0'";
			$query = $db->query("SELECT id FROM {$db_mymps}information $where");
			while($post = $db->fetchRow($query)) {
				$ids .= "$post[id],";
			}
			$selectedids = substr($ids,0,-1);
			if($selectedids && $selectedids != ','){
				$query = $db -> query("SELECT * FROM `{$db_mymps}information` WHERE id IN ($selectedids)");
				while($row = $db -> fetchRow($query)){
					@unlink(MYMPS_ROOT.$row['html_path']);
				}
				mymps_delete("information","WHERE id IN($selectedids)");
				mymps_delete("info_extra","WHERE infoid IN ($selectedids)");
				$query = $db -> query("SELECT * FROM `{$db_mymps}info_img` WHERE infoid IN ($selectedids)");
				while($row = $db -> fetchRow($query)){
					@unlink(MYMPS_ROOT.$row['imgpath']);
					@unlink(MYMPS_ROOT.$row['pre_imgpath']);
				}
				mymps_delete("info_img","WHERE infoid IN ($selectedids)");
				mymps_delete("comment","WHERE typeid IN ($selectedids) AND type = 'information'");
			}
		break;
		case '2':
			//删除待审信息
			$where = " WHERE info_level = '0'";
			$query = $db->query("SELECT id FROM {$db_mymps}information $where");
			while($post = $db->fetchRow($query)) {
				$ids .= "$post[id],";
			}
			$selectedids = substr($ids,0,-1);
			if($selectedids && $selectedids != ','){
				$query = $db -> query("SELECT * FROM `{$db_mymps}information` WHERE id IN ($selectedids)");
				while($row = $db -> fetchRow($query)){
					@unlink(MYMPS_ROOT.$row['html_path']);
				}
				mymps_delete("information","WHERE id IN($selectedids)");
				mymps_delete("info_extra","WHERE infoid IN ($selectedids)");
				$query = $db -> query("SELECT * FROM `{$db_mymps}info_img` WHERE infoid IN ($selectedids)");
				while($row = $db -> fetchRow($query)){
					@unlink(MYMPS_ROOT.$row['imgpath']);
					@unlink(MYMPS_ROOT.$row['pre_imgpath']);
				}
				mymps_delete("info_img","WHERE infoid IN ($selectedids)");
				mymps_delete("comment","WHERE typeid IN ($selectedids) AND type = 'information'");
			}
		break;
		case '3':
			//删除会员登录记录
			$monthdate = strtotime("-2 month");
			$db->query("DELETE FROM `{$db_mymps}member_record_login` WHERE pubdate < '$monthdate'");
		break;
		case '4':
			//删除无金币消费的会员消费记录
			$db->query("DELETE FROM `{$db_mymps}member_record_use` WHERE paycost = '<font color=red>扣除金币 0 </font>'");
		break;
		case '5':
			//删除支付失败的会员支付记录
			$db->query("DELETE FROM `{$db_mymps}payrecord` WHERE paybz = '等待支付'");
		break;
		case '6':
			//删除冗余QQ帐号
			$db->query("DELETE FROM `{$db_mymps}member` WHERE openid != '' AND userid != '' AND userpwd = ''");
		break;
		case '7':
			//删除管理员登录记录
			if(!$mymps_mymps['cfg_record_save']) $mymps_mymps['cfg_record_save'] = 100;
			$total_count = mymps_count("admin_record_login");
			if($total_count >= $mymps_mymps['cfg_record_save']){
				$delrecord=$db->getAll("SELECT id FROM `{$db_mymps}admin_record_login` ORDER BY ID DESC LIMIT 1,".$mymps_mymps['cfg_record_save']);
				foreach ($delrecord as $k => $value){
					$id .= $value[id].",";
				}
				$id = substr($id,0,-1);
				mymps_delete("admin_record_login","WHERE id NOT IN (".$id.")");
			}
		break;
		case '8':
			//删除管理员操作记录
			if(!$mymps_mymps['cfg_record_save']) $mymps_mymps['cfg_record_save'] = 100;
			$total_count = mymps_count("admin_record_action");
			if($total_count >= $mymps_mymps['cfg_record_save']){
				$delrecord=$db->getAll("SELECT id FROM `{$db_mymps}admin_record_action` ORDER BY ID DESC LIMIT 1,".$mymps_mymps['cfg_record_save']);
				foreach ($delrecord as $k => $value){
					$id .= $value[id].",";
				}
				$id = substr($id,0,-1);
				mymps_delete("admin_record_action","WHERE id NOT IN (".$id.")");
			}
		break;
		case '9':
			//删除短消息
			$db -> query("DELETE FROM `{$db_mymps}member_pm` WHERE if_read = '1'");
		break;
		case '10':
			$monthdate = strtotime("-1 month");
			$db -> query("DELETE FROM `{$db_mymps}mail_sendlist` WHERE last_send < '$monthdate' ");
		break;
		case '11':
			//SQL优化
			$query = $db->query("SHOW TABLE STATUS LIKE '$db_mymps%'", 'SILENT');
			while($table = $db->fetchRow($query)) {
				$db->query("OPTIMIZE TABLE $table[Name]");
			}
		break;
		
	}
	if($finished != 1){
		echo mymps_goto('?last='.$last.'&next='.$next);
		ob_flush();
    	flush();
    	sleep(1);
	} else{
		ob_end_flush();
	}
}
?>
