<?php
error_reporting(E_ALL ^ E_NOTICE);

$do   = isset($_GET['do']) ? htmlspecialchars(trim($_GET['do'])) : 'login';
$go   = isset($_GET['go']) ? htmlspecialchars(trim($_GET['go'])) : 'mymps_right';
$part = isset($_GET['part']) ? htmlspecialchars(trim($_GET['part'])) : 'default';

if($do == 'login'){
	define('IN_MYMPS', true);
	include "../include/global.php";
	require_once MYMPS_DATA."/config.php";
	require_once MYMPS_DATA."/config.db.php";
	require_once MYMPS_INC."/db.class.php";
	require_once MYMPS_INC."/admin.class.php";
	@include MYMPS_DATA.'/caches/authcodesettings.php';
	$authcodesettings = $data;
	$data = NULL;
	$url = trim($url);
	if ($part == 'chk'){
		define(CURSCRIPT,'admin_login');
		$url = $url ? $url : 'index.php?do=manage&go='.$go;
		if($authcodesettings['adminlogin'] == 1 && !$randcode = mymps_chk_randcode($checkcode)){
			write_msg('Incorrect identifying code, please return and retry.');
			exit;
		}
		$username = trim($username);
		$password = trim($password);
		$pubdate  = $timestamp ? $timestamp : time();
		$ip		  = GetIP();
		$row = $db->getRow("SELECT id,userid,cityid,pwd,uname FROM {$db_mymps}admin WHERE userid='".$username."' AND pwd='".md5($password)."'");
		if($row){
			$admin_id  	= $row['userid'];
			$admin_name = $row['uname'];
			$admin_cityid = $row['cityid'];
			$mymps_admin -> mymps_admin_login($admin_id,$admin_name,$admin_cityid);
			$db->query("UPDATE {$db_mymps}admin SET loginip='".GetIP()."',logintime='$timestamp' WHERE userid='$row[userid]'");
			$db->query("INSERT INTO `{$db_mymps}admin_record_login` (id,adminid,adminpwd,pubdate,ip,result) VALUES ('','$username','".md5($password)."','$pubdate','$ip','1')");
			write_msg($admin_name."You have successfully logged into".MPS_SOFTNAME."system management centre",$url);
		}else{
			$db->query("INSERT INTO `{$db_mymps}admin_record_login` (id,adminid,adminpwd,pubdate,ip,result) VALUES ('','$username','$password','$pubdate','$ip','0')");
			write_msg("Incorrect user ID or password, please return and retry.");
		}
	}elseif ($part == 'out'){
		define('IN_MYMPS', true);
		$mymps_admin -> mymps_admin_logout();
		write_msg("You have logged out from the system management centre safely","index.php");
	}elseif ($part == 'default'){
		define('IN_MYMPS', true);
		$url 	 = trim($_GET['url']);
		if($mymps_admin -> mymps_admin_chk_getinfo()){
			write_msg("","index.php?do=manage");
		}else{
			include(mymps_tpl("login"));
		}
	}else{
		define('IN_MYMPS', true);
		write_msg("","index.php?do=manage");
	}
	
}elseif($do == 'manage'){

	require_once dirname(__FILE__)."/global.php";
	
	if($part == 'left'){
		require_once dirname(__FILE__)."/include/".($admin_cityid ? 'mymps.citymenu.inc.php' : 'mymps.menu.inc.php');
		$part=trim($_GET['part']);
		$part = $part ? $part : 'info';
		$mymps_admin_menu = mymps_admin_menu("left");
		include mymps_tpl('admin_left');
	}elseif($part == 'default'){
		include mymps_tpl('admin_default');
	}elseif($part == 'top'){
		require_once MYMPS_INC.'/db.class.php';
    	require_once dirname(__FILE__)."/include/".($admin_cityid ? 'mymps.citymenu.inc.php' : 'mymps.menu.inc.php');
    	$mymps_admin_menu = mymps_admin_menu("top");
		$admindir	= getcwdOL();
		$width = $admin_cityid ? '575' : '670';
		if($admin_cityid){
			$www = get_city_caches($admin_cityid);
			$www = $www['domain'];
		} else {
			$www = '../';
		}
		$admin = get_admin_info();
		include mymps_tpl('admin_top');
	}elseif($part == 'right'){
		$go = trim($_GET['go']);
		require_once MYMPS_INC."/db.class.php";
		require_once MYMPS_DATA."/config.inc.php";
		require_once dirname(__FILE__). ($admin_cityid ? "/include/mymps.citycount.inc.php" : "/include/mymps.count.inc.php");
		foreach ($ele as $w =>$v){
			$mymps_count_str .= $w == "siteabout" ? "<div class=\"clear\"></div>" : "";
			$mymps_count_str .= "<div class=\"countsquare\">
			<div class=\"ab\">
			";
			foreach ($element[$w] as $k =>$u){
				$mymps_count_str .= "<div class=\"b\">";
				$mymps_count_str .= $u[where] ? "<a href=\"#\" onclick=\"parent.framRight.location='$u[url]';\">".$k."<br><div class=\"c\">".mymps_count($u[table],$u[where])."</div></a>" : "<a href=\"#\" onclick=\"parent.framRight.location='$u[url]';\">".$k."<br><div class=\"c\">".mymps_count($u[table])."</div></a>";
				$mymps_count_str .= "</div>";
			}
			$mymps_count_str .= "</div>
			<div class=\"a\"></div>
			</div>";
		}
		require_once dirname(__FILE__)."/include/wel.inc.php";
		foreach($welcome as $k => $value){
			$mymps_welcome_str .="<tr bgcolor=\"#f5fbff\"><td width=\"15\" bgcolor=\"#F6FBFF\" style=\"\">".$k."</td><td bgcolor=\"white\" style=\"padding:15px;\" class=\"other\">".$value."</td></tr>";
		}
		$here = "Ezi2u System Management Homepage";
		echo mymps_admin_tpl_global_head($go);
		include mymps_tpl('admin_index');
		unset($ele,$element);
		echo mymps_admin_tpl_global_foot();	
    }
}elseif($do == 'power'){
	require_once dirname(__FILE__)."/global.php";
	require_once MYMPS_INC."/member.class.php";
	$s_uid = trim($_GET['userid']);
	$s_pwd = trim($_GET['password']);
	$member_log -> in($s_uid,$s_pwd,'off',$url);
}else{
	define('IN_MYMPS', true);
	write_msg('Unknown error, please re-log into the system background to operate.','index.php?do=login&part=out');
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();
?>
