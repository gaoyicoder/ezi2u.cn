<?php

function write_money_use($info='',$cost=''){

	global $db,$db_mymps,$s_uid,$timestamp;

	$timestamp = $timestamp ? $timestamp : time();

	if($db -> query("INSERT INTO `{$db_mymps}member_record_use` (userid,paycost,subject,pubtime) VALUES ('$s_uid','$cost','$info','$timestamp')"))return true;

	else return false;

}



function member_reg($userid,$userpwd,$email='',$safequestion='',$safeanswer='',$openid='',$cname=''){



	global $mymps_global,$db,$db_mymps,$member_log,$timestamp;

	

	if($openid){

		if($db->getOne("SELECT id FROM `{$db_mymps}member` WHERE openid = '$openid'")) write_msg('Openid has been used. Please try again to complete your account information!');

	}

	

	$ip = GetIP();

	$safeanswer = trim($safeanswer);

	$row 		= $db->getRow("SELECT money_own FROM `{$db_mymps}member_level` WHERE id = '1'"); 

	$money_own	= $row['money_own'];

	$face 		= "";

	

	$sql 		= "INSERT INTO `{$db_mymps}member`(id,userid,userpwd,logo,prelogo,email,safequestion,safeanswer,levelid,joinip,loginip,jointime,logintime,money_own,openid,cname) VALUES ('','$userid','$userpwd','$face','$face','$email','$safequestion','$safeanswer','1','$ip','$ip','$timestamp','$timestamp','$money_own','$openid','$cname')";

	

	$db -> query($sql);

}



function sendpm($fromuser='',$touser='',$title='',$content='',$if_sys=0){

	global $db,$db_mymps,$timestamp;

	$fromuser = $fromuser ? mhtmlspecialchars($fromuser) : '';

	$touser	  = $touser	  ? mhtmlspecialchars($touser)	 : '';

	$title 	  = $title	  ? mhtmlspecialchars($title)	 : '';

	$content  = $content  ? $content	 				 : '';

	

	$pubtime = $timestamp ? $timestamp : time();

	$result  = array();

	$title 	 = str_replace("'",'"',$title);

	$content = str_replace("'",'"',$content);

	empty($title) && $title = substring($content,0,15);

	if(empty($touser)) die('Please designate user ID you wish to send message to.');

	if(empty($content) || $fromuser == $touser) {

		$result['succ'] = 'no';

		$result['member'] = $touser;

		return $result;

		exit;

	}

	if(!$ifuser = $db->getOne("SELECT userid FROM `{$db_mymps}member` WHERE userid = '$touser'")){

		$result['succ'] = 'no';

		$result['member'] = $touser;

	} else {

		$db -> query("INSERT INTO `{$db_mymps}member_pm` (title,content,fromuser,touser,pubtime,if_sys) VALUES ('$title','$content','$fromuser','$touser','$pubtime','$if_sys')");

		$result['succ'] = 'yes';

		$result['member'] = $touser;

	}

	return $result;

}

?>