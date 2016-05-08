<?php

!defined('WAP') && exit('FORBIDDEN');

define('CURSCRIPT','login');



$returnurl = isset($_REQUEST['returnurl']) ? mhtmlspecialchars($_REQUEST['returnurl']) : '';



if($action == 'logout'){



	$member_log->out('noredirect');

	redirectmsg('You have successfully logged-out ',$returnurl ? $returnurl : 'index.php?mod=index');

	

} elseif($action == 'login') {

	

	$userid = isset($_POST['userid']) ? mhtmlspecialchars(trim($_POST['userid'])) : '';

	$userpwd = isset($_POST['userpwd']) ? mhtmlspecialchars(md5(trim($_POST['userpwd']))) : '';

	$checkcode = isset($_POST['checkcode']) ? mhtmlspecialchars(trim($_POST['checkcode'])) : '';



	if($mobile_settings['authcode'] == 1 && !mymps_chk_randcode($checkcode)){

		redirectmsg('Incorrect identification code, please return to reenter.','index.php?mod=login');

	}

	if($userid == '' || $userpwd == '') redirectmsg('User account or password cannot be empty','index.php?mod=login');



	if($s_uid  = $db -> getOne("SELECT userid FROM `{$db_mymps}member` WHERE userid='$userid' AND userpwd='$userpwd'")){

		$member_log -> in($s_uid,$userpwd,'off','noredirect');
        $url = $returnurl ? $returnurl : 'index.php?mod=index';

//		redirectmsg($s_uid.' Welcome back!',$returnurl ? $returnurl : 'index.php?mod=index');
        header('Location: '.$url);

	}else{

		redirectmsg('Log-in failed, for you have entered the wrong account ID/password!',$returnurl ? $returnurl : 'index.php?mod=login');

	}



} else{



	if($iflogin == 1){

		redirectmsg('You have logged-in.',$returnurl ? $returnurl : 'index.php');

	}else{

		include mymps_tpl('member_login');

	}

}



?>