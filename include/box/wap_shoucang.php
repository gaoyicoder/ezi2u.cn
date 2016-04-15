<?php
!defined('IN_MYMPS') && exit('FORBIDDEN');
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";
require_once MYMPS_INC."/cache.fun.php";
require_once MYMPS_INC."/member.class.php";
$infoid = $_REQUEST['infoid'] ? intval($_REQUEST['infoid']) : '';
!$infoid && write_msg('A post to be marked as favourite must have a theme ID!','olmsg');
$log = $member_log -> chk_in();

switch($log){
	case true:
	
	$msg = '
		<!DOCTYPE html>
		<html lang="zh-CN" class="index_page">
		<head>
			<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" />
			<meta name="format-detection" content="telephone=no" />
			<meta name="format-detection" content="email=no" />
			<meta name="format-detection" content="address=no;">
			<meta name="apple-mobile-web-app-capable" content="yes" />
			<meta name="apple-mobile-web-app-status-bar-style" content="default" />
			<title>System Notification - <?=$mymps_global[SiteName]?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		</head>
		<body>
	';
	if($db->getOne("SELECT COUNT(id) FROM `{$db_mymps}shoucang` WHERE infoid = '$infoid' AND userid = '$s_uid'") > 0){
		$msg .= '<style>div{line-height:28px; font-size:12px; text-align:left; float:left; margin-bottom:30px; color:#585858;} span{margin-left:5px; margin-right:15px; display:block; float:left; height:64px; width:64px; background:url('.$mymps_global[SiteUrl].'/template/default/images/post/info_icons.png) 0 -128px no-repeat; margin-bottom:10px;}</style><span></span><div>You have marked this post as favourite already!<br />View it in <a href=\''.$mymps_global[SiteUrl].'/m/index.php?mod=shoucang\' style=\'font-size:14px;\'>My Favourites>></a></div>';
	} else {
		//$r		= $db -> getRow("SELECT title,html_path FROM `{$db_mymps}information` WHERE id = '$infoid'");
		//$url	= Rewrite('info',array('id'=>$infoid,'html_path'=>$r['html_path']));
		$r		= $db -> getRow("SELECT title FROM `{$db_mymps}information` WHERE id = '$infoid'");
		$url	= Rewrite('info',array('id'=>$infoid));
	
		$url	= str_replace($mymps_global['SiteUrl'],'',$url);
		if(!$s_uid) exit('Invalid member, please log in again.');
		$db->query("INSERT INTO `{$db_mymps}shoucang` (infoid,title,url,userid,intime)VALUES('$infoid','$r[title]','$url','$s_uid','$timestamp')");
		$msg .= '<style>div{line-height:28px; font-size:12px; text-align:left; float:left; margin-bottom:30px; color:#585858;} span{margin-left:5px; margin-right:15px; display:block; float:left; height:64px; width:64px; background:url('.$mymps_global[SiteUrl].'/template/default/images/post/info_icons.png) 0 0 no-repeat; margin-bottom:10px;}</style><span></span><div>Post successfully marked as favourite! Please login to view it.<br />View it in <a href=\''.$mymps_global[SiteUrl].'/m/index.php?mod=shoucang\'style=\'font-size:14px;\'>My Favourites>></a>';
	}
	$msg .= '
		</body>
		</html>
	';
	
	echo $msg;
	$msg = $r = NULL;
	
	break;
	
	default:
	
		$mobile_settings = get_mobile_settings();
		$url = "/m/index.php?mod=member";  
		echo "<script language = 'javascript' type = 'text/javascript'>window.location.href = '$url' </script>"; 
		 
	break;
}

?>
