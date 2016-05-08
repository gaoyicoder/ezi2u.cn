<?php

if(!defined('IN_MYMPS')) exit('Forbidden');



$userid	 	= mhtmlspecialchars($userid);

$userpwd 	= trim($userpwd);

$loginip 	= GetIP();

$logintime  = $timestamp ? $timestamp : time();

$memory 	= isset($memory) ? trim($memory) : '';

$url 		= trim($url);



if($authcodesettings['login'] == 1 && !$randcode = mymps_chk_randcode($checkcode)){

	write_msg('Wrong identifying code, please return and retry');

}



($userid == '' || $userpwd == '') && write_msg("User ID and password cannot be empty");



$s_uid  = $db -> getOne("SELECT userid FROM `{$db_mymps}member` WHERE (userid='$userid' OR email = '$userid' OR tel = '$userid') AND userpwd='".md5($userpwd)."'");



$userid = $userid ? $userid : $s_uid;



if(PASSPORT_TYPE == 'phpwind'){

	//pw���

	require MYMPS_ROOT.'/pw_client/uc_client.php';

	$user_login = uc_user_login($userid,md5($userpwd),0);

	if($user_login['status'] == '-2'){

		//�������

		//$db->query("INSERT INTO `{$db_mymps}member_record_login` (id,userid,userpwd,pubdate,ip,result) VALUES ('','$userid','$userpwd','$logintime','$loginip','0')");

		write_msg('You have entered the wrong password!');

	} elseif($user_login['status'] == '-1') {

		//�û������

		write_msg('The user ID you have entered does not exist!');

	} elseif($user_login['status'] == '1' && !$i =$db -> getOne("SELECT COUNT(id) FROM `{$db_mymps}member` WHERE userid = '$userid'")){

		//�û�������pw�û��?������mymps��

		member_reg($userid,md5($userpwd),$userid.'@163.com');

	}



} elseif(PASSPORT_TYPE == 'ucenter') {

	//UC���

	require MYMPS_ROOT.'/uc_client/client.php';

	

	//ͨ��ӿ��жϵ�¼�ʺŵ���ȷ�ԣ�����ֵΪ����

	list($uid, $username, $password, $email) = uc_user_login($userid, $userpwd);

	

	if($uid > 0) {

	

		if(!$db->getOne("SELECT count(*) FROM {$db_mymps}member WHERE userid='$userid'")) {

			member_reg($userid,md5($userpwd));

		}else{

			$db->query("UPDATE `{$db_mymps}member` SET userpwd = '".md5($userpwd)."' WHERE userid = '$userid'");

		}

		

		$s_uid = $userid;

		

	} else {

	

		//$db->query("INSERT INTO `{$db_mymps}member_record_login` (id,userid,userpwd,pubdate,ip,result) VALUES ('','$userid','$userpwd','$logintime','$loginip','0')");

		

		if($uid == -1) {

			write_msg( 'The user ID does not exist or has been deleted');

		} elseif ($uid == -2) {

			write_msg( 'Wrong password');

		} else {

			write_msg( 'Undefined Operation');

		}

		

		exit;

	}

} 



//mymps�˵�¼

if($s_uid){



	if($_COOKIE['loginscore_'.md5($s_uid)] != 1){

		/*��ֱ仯*/

		$score_change = get_credit_score();

		$score_changer = $score_change['score']['rank']['login'];

	

		$db->query("UPDATE `{$db_mymps}member` SET loginip = '$loginip',logintime = '$logintime',score = score".$score_changer." WHERE userid = '$s_uid'");

		

		$score_change = $score_changer = NULL;

		$url = $url ? $url : $mymps_global[SiteUrl].'/member/index.php?alert=1';

	}



	setcookie("loginscore_".md5($s_uid),1);

	

	$member_log -> in($s_uid,md5($userpwd),$memory,'noredirect');

	if(PASSPORT_TYPE == 'phpwind' && $user_login['synlogin']){

		echo $user_login['synlogin'];//���ͬ����½�Ĵ���

	} elseif(PASSPORT_TYPE == 'ucenter'){

		echo uc_user_synlogin($uid);//���ͬ����¼�Ĵ���

	}

	echo mymps_goto($url ? $url : $mymps_global['SiteUrl'].'/member/index.php');

	

}else{



	//$db->query("INSERT INTO `{$db_mymps}member_record_login` (id,userid,userpwd,pubdate,ip,result) VALUES ('','$userid','$userpwd','$logintime','$loginip','0')");

	write_msg("Logging-in failed, for you may have entered the wrong user ID or password");

}

?>

