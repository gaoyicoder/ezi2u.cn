<?php
if(!defined('IN_MYMPS')) exit('Forbidden');
$mymps_global['cfg_if_member_register'] != 1 && write_msg("Operation failed, for registration has been disabled by the administrator!");

if(!$mixcode || $mixcode != md5($cookiepre)){
	die('The source you requested is incorrect');
	exit();
}

$userid 	= $userid ? mhtmlspecialchars($userid) : '';
$userpwd 	= trim($userpwd);
$reuserpwd 	= trim($reuserpwd);
$email	 	= $email  ? mhtmlspecialchars($email)  : '';
$tname		= $tname  ? mhtmlspecialchars($tname)  : '';
$cname		= $cname  ? mhtmlspecialchars($cname)  : '';
$sex		= $sex 	  ? mhtmlspecialchars($sex)    : '';
$tel		= $tel 	  ? mhtmlspecialchars($tel)	   : '';
$fax		= $fax 	  ? mhtmlspecialchars($fax)    : '';
$address	= $address? mhtmlspecialchars($address) : '';
$areaid		= intval($areaid);
$qq			= intval($qq);
$mobile		= intval($mobile);
$introduce	= $introduce ? textarea_post_change($introduce) : '';
/*×¢²áµØÏŞÖÆ*/
$ip = '';
$ip = GetIP();
$ip2area = $ipdata = '';
require_once MYMPS_INC.'/ip.class.php';
$ipdata  = new ip();
$ipaddress = $ipdata -> getaddress($ip);
$ip2area = $ipaddress['area1'].$ipaddress['area2'];
$i=1;
unset($ipdata,$ipaddress);
$mymps_global['cfg_member_regplace'] = $mymps_global['cfg_member_regplace'] ? str_replace('ï¼Œ',',',$mymps_global['cfg_member_regplace']) :'';
if(!empty($mymps_global['cfg_member_regplace']) && !empty($ip2area)){
	$allow_reg_area = array();
	$allow_reg_area = explode(',',$mymps_global['cfg_member_regplace']);
	foreach($allow_reg_area as $k => $v){
		if(strstr($ip2area,$v)) {
			$i=$i+1;
		}
	}
	if($i == 1){
		write_msg("The administrator of system has limited that<b style='color:red'>".$mymps_global['cfg_member_regplace']."</b>Only local IPs are eligible for registration! <br />Should you wish to continue, please contact a customer service staff.","olmsg");
		exit;
	}
	unset($allow_reg_area,$ip2area,$i);
}

/*IP¶Î×¢²áÏŞÖÆ*/
if(!empty($mymps_global['cfg_forbidden_reg_ip'])){
	foreach(explode(",", $mymps_global['cfg_forbidden_reg_ip']) as $ctrlip) {
		if(preg_match("/^(".preg_quote(($ctrlip = trim($ctrlip)), '/').")/", $ip)) {
			$ctrlip = $ctrlip.'%';
			write_msg("Your current IP <b style='color:red'>".$ip."</b> has been blacklisted by an administrator; therefore you cannot register as a member!");
			exit;
		}
	}
	unset($ctrlip);
}


/*ÑéÖ¤ÂëÉèÖÃ*/
if($authcodesettings['register'] == 1 && empty($activation) && !$randcode = mymps_chk_randcode($checkcode)){
	write_msg('Incorrect identifying code, please return and retry');
}

($reuserpwd != $userpwd && empty($activation)) && write_msg("The passwords you have entered are not identical!");

/*ÑéÖ¤ÎÊ´ğÉèÖÃ*/
$data = '';
@include MYMPS_DATA.'/caches/checkanswer_settings.php';
if(is_array($data)){
	$whenregister = $data['whenregister'];
	$result = read_static_cache('checkanswer');
	if($whenregister == '1' && is_array($result)){
		if(!is_array($checkquestion) || empty($checkquestion['answer']) || empty($checkquestion['id'])) write_msg('You have not yet entered the identifying question!');
		if($result[$checkquestion['id']]['answer'] != $checkquestion['answer']){
			write_msg('The answer you entered to the identifying question is incorrect, please try again!');
		}
	}
	$result = $checkquestion = NULL;
}


if($reg_corp == '1' && (empty($email) || empty($tname) || empty($catid) || empty($cityid) || empty($cname))) write_msg('Items with<font color=red>*</font>are must-enters.');

/*if(!inchinese($userid)) write_msg('ÓÃ»§Ãû°üº¬ÖĞÎÄ£¡');*/

if(PASSPORT_TYPE == 'phpwind'){
	//pwÕûºÏ
	require MYMPS_ROOT.'/pw_client/uc_client.php';
	$checkuser = uc_check_username($userid);
	if($checkuser == -2){
		write_msg('This user ID already exists , please try again with another user ID.');
	} elseif($checkuser == -1){
		write_msg('Your designated user ID does not conform to the rules , please try again with another user ID.');
	} elseif($checkuser == 1){
	
	} else {
		write_msg('Unknown error, please try again with another user ID.');
	}
	
	if($email){
		$checkemail = uc_check_email($email);
		$checkemail == -3 && write_msg('This Email address is in wrong format, please check and reenter');
		$checkemail == -4 && write_msg('This Email address has already been used, please change an Email address and try again.');
	}
	
	uc_user_register($userid,md5($userpwd),$email);
	
} elseif(PASSPORT_TYPE == 'ucenter'){
	//ucÕûºÏ
	require MYMPS_ROOT.'/uc_client/client.php';
	//ÔÚUCenter×¢²áÓÃ»§ĞÅÏ¢
	if($activation && ($activeuser = uc_get_user($activation))) {
		list($uid, $userid) = $activeuser;
	} else {
		$user = $db -> getRow("SELECT id,userid FROM `{$db_mymps}member` WHERE userid = '$userid'");
		if(uc_get_user($userid) && !$user['userid']) {
			//ÅĞ¶ÏĞèÒª×¢²áµÄÓÃ»§Èç¹ûÊÇĞèÒª¼¤»îµÄÓÃ»§£¬ÔòĞèÌø×ªµ½µÇÂ¼Ò³Ãæ
			write_msg("You don¡¯t have to register this user ID, please log-in(?)",$mymps_global[SiteUrl]."/".$mymps_global['cfg_member_logfile']);
		}
		$uid = uc_user_register($userid,$userpwd, $email);
		if($uid <= 0) {
			if($uid == -1) {
				write_msg('Forbidden User ID');
			} elseif($uid == -2) {
				write_msg( 'Forbidden content found');
			} elseif($uid == -3) {
				write_msg( ' This user ID already exists');
			} elseif($uid == -4) {
				write_msg( 'This Email address is in wrong format');
			} elseif($uid == -5) {
				write_msg( 'This Email address is not allowed to register');
			} elseif($uid == -6) {
				write_msg( 'This Email address has been used to register');
			} else {
				write_msg( 'Undefined');
			}
		} else {
			$userid  = trim($userid);
			$userpwd = trim($userpwd);
			$email 	 = trim($email);
		}
	}
	
} else {
	//²»ÕûºÏ
	$rs	= CheckUserID($userid,'User ID');
	$rs != 'ok' && write_msg($rs);
	strlen($userid) > 20 && write_msg("Your designated user ID is longer than 20 characters and cannot be used to register!");
	(strlen($userid) < 3 || strlen($userpwd) < 5) && write_msg("our designated user ID is too short (less than 3 characters) and cannot be used to register!");
	!is_email($email) && write_msg("This Email address is in wrong format!");
	$db->getOne("SELECT id FROM `{$db_mymps}member` WHERE userid = '$userid' ") && write_msg("The user ID {$userid} that you have designated already exists, please try again with another user ID!");
}

if($userid) {

	/*»ı·Ö±ä»¯*/
	$score_change = get_credit_score();
	$score_changer = $score_change['score']['rank']['register'];
	$score_changer = $score_changer === 0 ? ' +0' : $score_changer;
	
	member_reg($userid,md5($userpwd),$email,$safequestion,$safeanswer,$openid,$cname);
	$money_own	=	$db -> getOne("SELECT money_own FROM `{$db_mymps}member_level` WHERE id = '1'");
	$money_own	=	$money_own ? $money_own : 0;
	
	if($reg_corp == 1){
		if(is_array($catid)){
			foreach($catid as $kids => $vids){
				$db->query("INSERT INTO `{$db_mymps}member_category` (userid,catid)VALUES('$userid','$vids')");
			}
			$catids  = implode(',',$catid);
		}
		$db->query("UPDATE `{$db_mymps}member` SET tname = '$tname' , cname = '$cname', catid = '$catids', areaid = '$areaid',qq = '$qq' , if_corp = '1' ,tel = '$tel' , mobile = '$mobile', money_own = '$money_own' ,introduce = '$introduce',address = '$address' ,score = score".$score_changer."  WHERE userid = '$userid'");
	} else {
		$db->query("UPDATE `{$db_mymps}member` SET money_own = '$money_own',score = score".$score_changer." WHERE userid = '$userid'");
	}
	
	$score_change = $score_changer = NULL;
	
	/*
	 ·¢ËÍ»¶Ó­¶ÌÏûÏ¢
	 */
	if($mymps_global['cfg_member_reg_title'] && $mymps_global['cfg_member_reg_content']){
		$title 	 = str_replace('{username}',$userid,$mymps_global['cfg_member_reg_title']);
		$content = str_replace('{sitename}',$mymps_global['SiteName'],$mymps_global['cfg_member_reg_content']);
		$content = str_replace('{time}',GetTime($timestamp),$content);
		$content = str_replace('{username}',$userid,$content);
		sendpm('admin',$userid,$title,$content,1);	
	}
	
	//Èç¹ûÊÇµã»÷×¢²áÍÆ¹ãÈËµÄÁ´½Ó×¢²á
	$fromuid = mgetcookie('fromuid');
	$fromip	 = mgetcookie('fromip');
	if($fromuid && $mymps_global['cfg_if_affiliate'] == 1){
		$fromuid = intval($fromuid);
		$fromip = trim($fromip);
		if($fromip != GetIP()){
			$score_changer = "+".$mymps_global['cfg_affiliate_score'];
			$db -> query("UPDATE `{$db_mymps}member` SET score = score".$score_changer." WHERE id = '$fromuid'");
		}
	}

	$member_log -> in($userid,md5($userpwd),'off','noredirect');
	if(PASSPORT_TYPE == 'phpwind'){
		$user_login = uc_user_login($userid,md5($userpwd),0);
		$ucsynlogin = $user_login['synlogin'];
		echo $ucsynlogin;
		echo mymps_goto($url ? $url : $mymps_global['SiteUrl'].'/member/index.php');
	}elseif(PASSPORT_TYPE == 'ucenter'){
		list($uid, $username, $password, $email) = uc_user_login($userid, $userpwd);
		echo uc_user_synlogin($uid);
		echo mymps_goto($url ? $url : $mymps_global['SiteUrl'].'/member/index.php');
	} else {
		write_msg("Congratulations, your registration has been successful! You will now be redirected to Member Management Centre",$mymps_global['SiteUrl']."/member/index.php");
	}
	
}
?>
