<?php
!defined('WAP') && exit('FORBIDDEN');
define('CURSCRIPT','register');

$mobile_settings['register'] != 1 && errormsg('Registration through mobile version has been disabled on our site.');

if($action == 'register'){

	include MYMPS_ROOT.'/member/include/common.func.php';
	
	$userid = isset($_POST['userid']) ? mhtmlspecialchars($_POST['userid']) : '';
	$userpwd = isset($_POST['userpwd']) ? mhtmlspecialchars($_POST['userpwd']) : '';
	$reuserpwd = isset($_POST['reuserpwd']) ? mhtmlspecialchars($_POST['reuserpwd']) : '';
	$email = isset($_POST['email']) ? mhtmlspecialchars($_POST['email']) : '';
	$agreergpermit = isset($_POST['agreergpermit']) ? mhtmlspecialchars($_POST['agreergpermit']) : '';
	$mixcode = isset($_POST['mixcode']) ? mhtmlspecialchars($_POST['mixcode']) : '';
	if(!$mixcode || $mixcode != md5($cookiepre)){
		errormsg('The system recognizes your source to be incorrect!');
	}

	$checkcode = isset($_POST['checkcode']) ? mhtmlspecialchars($_POST['checkcode']) : '';
	if($mobile_settings['authcode'] == 1 && !mymps_chk_randcode($checkcode)){
		redirectmsg('Wrong identifying code! Please return to the previous page and try again!','index.php?mod=register');
	}
	if($agreergpermit != 1) redirectmsg('You must agree to the term and conditions before registering.','index.php?mod=register');
	$rs	= CheckUserID($userid,'User ID');
	$rs != 'ok' && redirectmsg($rs,'index.php?mod=register');
	if($userpwd != $reuserpwd) redirectmsg('The passwords you input are not identical, please return to the previous page and try again!','index.php?mod=register');
	strlen($userid) > 20 && redirectmsg('This user ID is more than 20 characters and cannot be used to register!','index.php?mod=register');
	(strlen($userid) < 3 || strlen($userpwd) < 5) && redirectmsg('This user ID or password is too short (less than 3 characters) and cannot be used to register!','index.php?mod=register');
	!is_email($email) && redirectmsg('Sorry, the format of Email address is incorrect!','index.php?mod=register');
	$db->getOne("SELECT id FROM `{$db_mymps}member` WHERE userid = '$userid' ") && redirectmsg('The user ID '.$userid.' already exists, please try another user ID!','index.php?mod=register');
	member_reg($userid,md5($userpwd),$email,$safequestion,$safeanswer);
	$member_log -> in($userid,md5($userpwd),'off','noredirect');
	redirectmsg('Congratulations, you have successfully completed the registration!','index.php?mod=index');
	
} else {
	$mixcode = md5($cookiepre);
	include mymps_tpl('member_register');
}
?>