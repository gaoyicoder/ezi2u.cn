<?php
define('CURSCRIPT','certification');
require_once dirname(__FILE__).'/global.php';
require_once MYMPS_INC."/db.class.php";

$certify_arr = array('1'=>'Business Licence','2'=>'ID');
$typeid = $typeid ? $typeid : '1';
$page = $page ? intval($page) : '1';

if(!submit_check(CURSCRIPT.'_submit')){
	
	chk_admin_purview("purview_Authentication");
	
	$info_do_type = array();
	$info_do_type['On Awards'] = array(
		"Credible Certifications",
	);
	$info_do_type['On Punishments'] = array(
		"Picture Not Clear Enough",
		"Fake Certificates",
		"Expired Corresponding Certificates"
	);
	if($part == 'yes' && $userid){
		$set = $typeid == 1 ? "com_certify = '1'," : "per_certify = '1',";
		$db -> query("UPDATE `{$db_mymps}information` SET certify = '1' WHERE userid = '$userid'");
		
		/*积分变化*/
		$score_change = get_credit_score();
		$score_changer = $typeid == 1 ? $score_change['score']['rank']['com_certify'] : $score_change['score']['rank']['per_certify'] ;
		/*信用值变化*/
		$credit_changer = $typeid == 1 ? $score_change['credit']['rank']['com_certify'] : $score_change['credit']['rank']['per_certify'] ;
		/*信用等级*/
		$credit = $db -> getOne("SELECT credit FROM `{$db_mymps}member` WHERE userid = '$userid'");
		$credit = $credit.$credit_changer;

		if($score_change){
			foreach($score_change['credit_set']['rank'] AS $level => $credi) {
				if($credit <= $credi) {
					$credits = $level;
					break;
				}
			}
			$credits = $credits - 1;
		}
		
		$db->query("UPDATE `{$db_mymps}member` SET ".$set." score = score".$score_changer." , credit = credit".$credit_changer.",credits = '$credits' WHERE userid = '$userid'");
		$score_change = $credits = $score_changer = NULL;
		
		$here = 'Affiliated Operation';
		$title = 'Respected Member '.$userid.' ，You have passed the real name verification!';
		include mymps_tpl('information_pm');
	}elseif($part == 'no' && $userid){
		!$userid && write_msg('Please Designate Member ID!');
		$set = ($typeid == 1) ? "SET com_certify = '0'" : "SET per_certify = '0'";
		$db -> query("UPDATE `{$db_mymps}member` $set WHERE userid = '$userid'");
		$db -> query("UPDATE `{$db_mymps}information` SET certify = '0' WHERE userid = '$userid'");
		$here = 'Affiliated Operation';
		$nummoney = '-2';
		$title = 'Respected Member '.$userid.' You have unfortunately failed the real name verification!';
		include mymps_tpl('information_pm');
	}else{
		$here = $certify_arr[$typeid].'Verification';
		$sql  = "SELECT a.*,b.per_certify,b.com_certify FROM `{$db_mymps}certification` AS a LEFT JOIN `{$db_mymps}member` AS b ON a.userid = b.userid WHERE a.typeid = '$typeid'";
		$rows_num = mymps_count("certification","WHERE typeid = '$typeid'");
		$param	= setParam(array('typeid'));
		$certification = page1($sql);
		include mymps_tpl(CURSCRIPT);
	}
} else {
	if(is_array($delids)){
		foreach ($delids as $kids => $vids){
			$delrow = $db->getRow("SELECT img_path FROM `{$db_mymps}certification` WHERE id = '$vids'");
			@unlink(MYMPS_ROOT.$delrow['img_path']);
			unset($delrow);
			mymps_delete(CURSCRIPT,"WHERE id = ".$vids);
		}
		$message = 'Submission record of member verification has successfully been updated/deleted!';
	}
	if($part == 'sendpm'){
		require_once MYMPS_MEMBER.'/include/common.func.php';
		!$userid && write_msg("You have not yet designated member account!");
		if($if_money == 1){
			$db->query("UPDATE `{$db_mymps}member` SET money_own = money_own {$money_num} WHERE userid = '$userid'");
		}
		if($if_pm == 1){
			$msg .= ($if_money == 1)?"<br />Coin Number Change：<b style=color:red>".$money_num."</b>":'';
			$result = sendpm($admin_id,$userid,$title,$msg,1);
		}
		$message = '用户 '.$userid.' Real Name Verification Result Successfully Updated!';
	}
	write_msg($message,'?typeid='.$typwid.'&page='.$page,'write_record');
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();
?>
