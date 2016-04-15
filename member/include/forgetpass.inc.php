<?php
if($action == 'sendmail'){
	
	$email = isset($email) ? mhtmlspecialchars($email): '';
	if($authcodesettings['forgetpass'] == 1 && !$randcode = mymps_chk_randcode($checkcode)){write_msg('Wrong Identification code, please return and try again');}
	empty($email)  && write_msg("Please enter the Email address!");
	//if(mgetcookie('emailsended'.$email) == 1){write_msg("Please rest for a while and try sending messages again");}
	$user_info = $db ->getRow("SELECT * FROM `{$db_mymps}member` WHERE email = '$email'");
	if ($user_info['userid']){
		require MYMPS_INC.'/email.fun.php';
		$code = base64_encode($user_info['id'].".".md5($user_info['id'].'+'.$user_info['userpwd']).'.'.$timestamp);
		
		globalassign();
		if (send_pwd_email($user_info['id'], $user_info['userid'], $email, $code)){
			//msetcookie("emailsended".$userinfo['email'],1);
			$status = 'error2';
			include mymps_tpl($mod.'_2');
		}else{
			$status = 'error2';
			$msg = 'Sending message failed, please contact a customer service staff: '.$mymps_global["SiteTel"].'to reset your password!';
			include mymps_tpl($mod.'_4');
		}
	
	}else{
	
		$status = 'error2';
		$msg = 'The Email address or user account does not exist! Please contact a customer service staff: '.$mymps_global["SiteTel"].'！';
		globalassign();
		include mymps_tpl($mod.'_4');
	
	}
	
} elseif($action == 'resetpwd'){
	$uid = $uid ? intval($uid) : '';
	$userid = $userid ? mhtmlspecialchars($userid) : '';
	$userpwd = $userpwd ? mhtmlspecialchars($userpwd) : '';
	$email = $email ? mhtmlspecialchars($email) : '';
	if(empty($userpwd)) write_msg('Please enter your new password!');
	if(PASSPORT_TYPE == 'phpwind'){
		//pw整合
		require MYMPS_ROOT.'/pw_client/uc_client.php';
		$pw_user = uc_user_get($userid);
		$result = uc_user_edit($pw_user['uid'], $pw_user['username'], '', md5($userpwd), '');
	} elseif(PASSPORT_TYPE == 'ucenter') {
		//UC整合
		require MYMPS_ROOT.'/uc_client/client.php';
		$result =  uc_user_edit($userid, $userpwd, $userpwd, $email, 1);
	}
	
	if (!empty($userpwd)){
		$db->query("UPDATE `{$db_mymps}member` SET userpwd='".md5($userpwd)."' WHERE id = '$uid'");
		$status = 'success';
	} else {
		$status = 'error';
		$msg = 'Unidentified error, changing password failed!';
	}
	
	globalassign();
	include mymps_tpl($mod.'_4');
}
?>