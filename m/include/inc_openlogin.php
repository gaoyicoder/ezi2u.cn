<?php

!defined('WAP') && exit('FORBIDDEN');

define('CURSCRIPT','openlogin');



$url   = isset($url) ? strip_tags($url) : '';

$action = isset($action) ? trim($action) : '';	

		

if(!submit_check('log_submit')){

	!in_array($action,array('bind','reg')) && $action = 'reg';

	session_start();

	

	if(empty($_SESSION['nickname']) || empty($_SESSION['openid'])) redirectmsg('Session failed, please re-log-in!',$mymps_global[SiteUrl].'/include/qqlogin/qq_login.php');

	

	$nickname        = $_SESSION['nickname'];

	$figureurl_qq_1  = $_SESSION['figureurl_qq_1'];

	$mixcode         = md5($cookiepre);



}else{	

	!in_array($action,array('bind','reg')) && redirectmsg('The source you requested is incorrect!','olmsg');

	session_start();

	$openid = mhtmlspecialchars($_SESSION['openid']);

	$cname  = mhtmlspecialchars($_SESSION['nickname']); 

	//$cname  = mhtmlspecialchars($charset == 'gb2312' ? iconv("UTF-8", "GBK", $_SESSION['nickname']) : $_SESSION['nickname']);

	

	if($action == 'bind'){

	

		if(empty($cname) || empty($openid)) redirectmsg('Your Logging-in has expired; please re-log-in!',$mymps_global[SiteUrl].'/include/qqlogin/qq_login.php');

		$userid  = isset($_POST['bind_userid']) ? mhtmlspecialchars(trim($_POST['bind_userid'])) : '';

		$userpwd   = isset($_POST['bind_userpwd']) ? mhtmlspecialchars(trim($_POST['bind_userpwd'])) : '';

		$bind_userid = isset($_POST['bind_userid']) ? mhtmlspecialchars($_POST['bind_userid']) : '';

		$bind_userpwd = isset($_POST['bind_userpwd']) ? mhtmlspecialchars($_POST['bind_userpwd']) : '';

		$mixcode = isset($_POST['mixcode']) ? mhtmlspecialchars($_POST['mixcode']) : '';



		if(!$mixcode || $mixcode != md5($cookiepre)) errormsg('The system recognizes your source to be incorrect!');

		if(empty($bind_userid) || empty($bind_userpwd)) redirectmsg('You must input your former user ID and password!','index.php?mod=openlogin&action=bind');

		if(!$db -> getOne("SELECT id  FROM `{$db_mymps}member` WHERE userid = '$userid' AND userpwd = '".md5($userpwd)."'")){

			redirectmsg('The former account ID or password is incorrect, please return and reenter!','index.php?mod=openlogin&action=bind');

		}

		

		$db -> query("DELETE FROM `{$db_mymps}member` WHERE openid = '$openid'");//ɾ��QQ��¼�Զ�ע����ʺ�

		$db -> query("UPDATE `{$db_mymps}member` SET openid = '$openid' WHERE userid = '$userid'");

		$bind_userid = $bind_userpwd = $qqlogin = NULL;

		//��ʼ��¼

		$member_log -> in($userid,md5($userpwd),'off','noredirect');



		@session_unregister('openid');

		@session_unregister('nickname');

		@session_unregister('access_token');

		@session_unregister('appid'); 

		

		redirectmsg('Congratulations, binding is successful!','index.php?mod=member');

	

	} elseif($action == 'reg'){

	

		$userid  = isset($_POST['userid']) ? mhtmlspecialchars(trim($_POST['userid'])) : '';

		$email   = isset($_POST['email']) ? mhtmlspecialchars(trim($_POST['email'])) : '';

		$userpwd = isset($_POST['userpwd']) ? mhtmlspecialchars(md5(trim($_POST['userpwd']))) : '';



		if($userid == '') redirectmsg('Please enter the user ID you use to log-in.','index.php?mod=openlogin');

		if($email == '') redirectmsg('Please enter your Email address.','index.php?mod=openlogin');

		if($userpwd == '') redirectmsg('Please enter the password you use to log-in','index.php?mod=openlogin');



		$reg_corp = 0;

		$rs	= CheckUserID($userid,'User ID');

		$rs != 'ok' && redirectmsg($rs,'index.php?mod=openlogin');

		strlen($userid) > 20 && redirectmsg('This user ID is more than 20 characters and cannot be used to register!','index.php?mod=openlogin');

		(strlen($userid) < 3 || strlen($userpwd) < 5) && redirectmsg('This user ID or password is too short (less than 3 characters) and cannot be used to register!','index.php?mod=openlogin');

		!is_email($email) && redirectmsg('Sorry, the format of Email address is incorrect!','index.php?mod=openlogin');

		$db->getOne("SELECT id FROM `{$db_mymps}member` WHERE userid = '$userid' AND openid = ''") && redirectmsg('The user ID  {$userid} that you have designated already exists, please try another user ID!','index.php?mod=openlogin');



		$userpwd    = md5($userpwd);

		$db -> query("UPDATE `{$db_mymps}member` SET jointime='$timestamp',logintime='$timestamp',userpwd = '$userpwd',email='$email' WHERE userid = '$userid' ");



		@session_unregister('openid');

		@session_unregister('nickname');

		@session_unregister('access_token');

		@session_unregister('appid');

		

		$member_log -> in($userid,$userpwd,'off','noredirect');

		redirectmsg('Congratulations, you have successfully completed the registration!','index.php?mod=member');

	}



}

include mymps_tpl('member_openlogin');





?>