<?php
define('CURSCRIPT','login');
define('IN_SMT',true);
define('IN_MYMPS', true);
define('IN_MANAGE',true);

require_once dirname(__FILE__)."/include/global.php";
require_once dirname(__FILE__)."/data/config.php";
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";

ifsiteopen();
if($mymps_global['cfg_if_member_log_in'] != 1) write_msg("Operation failed, for the member function has been disabled by the administrator!");

@include MYMPS_DATA.'/caches/authcodesettings.php';
$authcodesettings = $data;
$data = NULL;
require_once MYMPS_MEMBER.'/include/common.func.php';

if(!in_array($mod,array(CURSCRIPT,'register','forgetpass','out','openlogin'))){
	$mod = $_REQUEST['mod'] = CURSCRIPT;
}
require_once MYMPS_DATA."/config.inc.php";
require_once MYMPS_INC."/member.class.php";

$url   = isset($url) ? checkhtml($url) : '';
$action = isset($action) ? $action : '';
$action = ($mymps_global['cfg_if_corp'] != 1 && $action == 'store') ? 'person' : $action;
$cityid = isset($cityid) ? intval($cityid) : '';

if(!submit_check('log_submit')){

	if($mod != 'out' && $mod != 'openlogin'){
		$member_log -> chk_in() && write_msg('','member/index.php');
	}
	
	switch($mod){
		case 'out':
			if(PASSPORT_TYPE == 'ucenter'){
				//整合UC
				$member_log -> out('noredirect');
				require MYMPS_ROOT.'/uc_client/client.php';
				$ucsynlogout = uc_user_synlogout();
				echo $ucsynlogout;
				echo mymps_goto($url ? $url : $mymps_global['SiteUrl'].'/'.$mymps_global['cfg_member_logfile']);
				
			} elseif(PASSPORT_TYPE == 'phpwind'){
				//整合PW
				$member_log -> out('noredirect');
				require MYMPS_ROOT.'/pw_client/uc_client.php';
				$ucsynlogout = uc_user_synlogout();
				echo $ucsynlogout;
				echo mymps_goto($url ? $url : $mymps_global['SiteUrl'].'/'.$mymps_global['cfg_member_logfile']);
			} else {
				$member_log -> out(trim($url));
			}
		break;
		
		case 'login':
			$data = NULL;
			@require MYMPS_INC.'/qqlogin/config.inc.php';
			$mymps_global['ifqqlogin'] = $data['open'];
			$data = NULL;
			
			$url = trim($url);
			$city = get_city_caches($cityid);
			$loc 		= get_location('login',0,'Member Log-in');
			$page_title = $loc['page_title'];
			$location 	= $loc['location'];
			$mymps_imgcode = $authcodesettings['login'];
			globalassign();
			include mymps_tpl(CURSCRIPT);
			
		break;
		
		case 'register':

			$mymps_global['cfg_if_member_register'] != 1 && write_msg("Operation failed, for registration has been disabled by the administrator!");
			
			$data = NULL;
			@require MYMPS_INC.'/qqlogin/config.inc.php';
			$mymps_global['ifqqlogin'] = $data['open'];
			$data = NULL;
			
			$city = get_city_caches($cityid);
			$loc 		= get_location('register',0,'Register as Member');
			$page_title = $loc['page_title'];
			$location	= $loc['location'];
			
			if(in_array($action,array('store','person'))){
				require MYMPS_DATA.'/safequestions.php';
				$safequestion = GetSafequestion(0,'safequestion');
				$mymps_imgcode = $authcodesettings['register'];
				$submit = 'Register Now';
				if($action == 'store') $get_area_options = select_where_option('/include/selectwhere.php',$city['cityid'],$areaid,$streetid);
				if($action == 'store') $get_member_cat = get_member_cat();
				$mixcode = md5($cookiepre);
				
				$data = '';
				@include MYMPS_DATA.'/caches/checkanswer_settings.php';
				if(is_array($data)){
					$whenregister = $data['whenregister'];
					if($whenregister == '1' && $checkanswer = read_static_cache('checkanswer')){
						$checkquestion['id']		= $randid = array_rand($checkanswer,1);
						$checkquestion['question']  = $checkanswer[$randid]['question'];
						$checkquestion['answer']	= $checkanswer[$randid]['answer'];
					}
					unset($whenregister,$checkquestion,$data,$checkanswer,$loc,$page_title,$location,$member_log);
				}
				include mymps_tpl($mod.'_'.$action);
			}else{
				include mymps_tpl($mod);
			}
		break;
		
		case 'forgetpass':
			$uid = $uid ? intval($uid) : '';
			$code = $code ? mhtmlspecialchars($code) : '';
			if($code){
				$code = $code ? mhtmlspecialchars($code) : '';
				$arr = explode('.',base64_decode($code));
				$uid = $arr[0];
				$user_info = $db -> getRow("SELECT id,userid,userpwd,email FROM `{$db_mymps}member` WHERE id = '$uid'");
				
				if(($timestamp - $arr[2] < 1800) && $arr[1] == md5($user_info['id'].'+'.$user_info['userpwd'])){
					$userid = $user_info['userid'];
					$uid = $user_info['id'];
					$email = $user_info['email'];
					globalassign();
					include mymps_tpl($mod.'_3');
				} else {
					$status = 'error';
					$msg = 'This password-resetting link has expired!';
					globalassign();
					include mymps_tpl(mymps_tpl($mod.'_4'));
				}
			} else {
				$mymps_imgcode = $authcodesettings['forgetpass'];
				globalassign();
				include mymps_tpl($mod);
			}
			
		break;
		
		case 'openlogin':
			!in_array($action,array('bind','reg')) && $action = 'reg';
			session_start();
			
			if(empty($_SESSION['nickname']) || empty($_SESSION['openid'])) write_msg('Session failed; please re-log-in!',$mymps_global[SiteUrl].'/include/qqlogin/qq_login.php');
			$nickname = $_SESSION['nickname'];
			
			$loc 		= get_location('login',0,'会员登录');
			$page_title = $loc['page_title'];
			$location 	= $loc['location'];
			$figureurl_qq_1 = $_SESSION['figureurl_qq_1'];
			$mixcode = md5($cookiepre);
			
			globalassign();
			include mymps_tpl('openlogin');
		break;
	}
}else{

	if($mod == 'openlogin'){
		define('QQLOGIN',1);//开启应用QQ登录接口
		!in_array($action,array('bind','reg')) && write_msg('The source you requested is incorrect!','olmsg');
		session_start();
		$openid = mhtmlspecialchars($_SESSION['openid']);
		$cname  = mhtmlspecialchars($_SESSION['nickname']);
		
		if($action == 'bind'){
			if(empty($cname) || empty($openid)) write_msg('Your Logging-in has expired; please re-log-in!',$mymps_global[SiteUrl].'/include/qqlogin/qq_login.php');
			$userid  = mhtmlspecialchars(trim($bind_userid));
			$userpwd = mhtmlspecialchars(trim($bind_userpwd));
			//绑定已有帐号
			if(!$mixcode || $mixcode != md5($cookiepre)){
				die('The source you requested is incorrect');
				exit();
			}
			if(empty($bind_userid) || empty($bind_userpwd)){
				write_msg('You must input your former user ID and password!');
			}
		
			if(!$db -> getOne("SELECT id  FROM `{$db_mymps}member` WHERE userid = '$userid' AND userpwd = '".md5($userpwd)."'")){
				write_msg('The former account ID or password is incorrect, please return and reenter!');
			}
			$db -> query("DELETE FROM `{$db_mymps}member` WHERE openid = '$openid'");//删除QQ登录自动注册的帐号
			$db -> query("UPDATE `{$db_mymps}member` SET openid = '$openid' WHERE userid = '$userid'");
			//开始登录
			$bind_userid = $bind_userpwd = $qqlogin = NULL;
			
			
			//开始登录
			if(PASSPORT_TYPE == 'phpwind'){
				require MYMPS_ROOT.'/pw_client/uc_client.php';
				$user_login = uc_user_login($userid,md5($userpwd),0);
				echo $user_login['synlogin'];
			} elseif(PASSPORT_TYPE == 'ucenter'){
				require MYMPS_ROOT.'/uc_client/client.php';
				list($uid, $username, $password, $email) = uc_user_login($userid, $userpwd);
				echo uc_user_synlogin($uid);
			}
			
			$member_log -> in($userid,md5($userpwd),'off','noredirect');
			
			/*
			@session_unregister('openid');
			@session_unregister('nickname');
			@session_unregister('access_token');
			@session_unregister('appid');
			*/
			session_unset();
			echo mymps_goto($mymps_global['SiteUrl'].'/member/index.php');
			
		} elseif($action == 'reg'){
			$userid  = mhtmlspecialchars(trim($userid));
			$userpwd = mhtmlspecialchars(trim($userpwd));
			$email 	 = mhtmlspecialchars(trim($email));
			
			if(!$userid){
				write_msg('Please enter your user ID!');
				exit;
			}
			
			if(!$userpwd){
				write_msg('Please enter your log-in password!');
				exit;
			}
			
			if(!$email){
				write_msg('Please enter your Email address!');
				exit;
			}
			
			//用QQ帐号注册新帐号
			$reg_corp = 0;
			
			if(PASSPORT_TYPE == 'phpwind'){
				//pw整合
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
				
				$checkemail = uc_check_email($email);
				if($checkemail == -3){
					write_msg('This Email address is in wrong format, please input a correct Email address');
				}
				
				uc_user_register($userid,md5($userpwd),$email);
				
			} elseif(PASSPORT_TYPE == 'ucenter'){
				//uc整合
				require MYMPS_ROOT.'/uc_client/client.php';
				//在UCenter注册用户信息
				if($activation && ($activeuser = uc_get_user($activation))) {
					list($uid, $userid) = $activeuser;
				} else {
					$user = $db -> getRow("SELECT id,userid FROM `{$db_mymps}member` WHERE userid = '$userid'");
					if(uc_get_user($userid) && !$user['userid']) {
						//判断需要注册的用户如果是需要激活的用户，则需跳转到登录页面
						write_msg("You don’t have to register this user ID, please log-in(?)",$mymps_global[SiteUrl]."/".$mymps_global['cfg_member_logfile']);
					}
					$uid = uc_user_register($userid,$userpwd, $email);
					if($uid <= 0) {
						if($uid == -1) {
							write_msg('Forbidden User ID');
						} elseif($uid == -2) {
							write_msg( 'Forbidden content found');
						} elseif($uid == -3) {
							write_msg( 'User ID Already Exists');
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
				//不整合
				$openlogin_uri = $mymps_global[SiteUrl]."/".$mymps_global[cfg_member_logfile]."?mod=openlogin";
				$rs	= CheckUserID($userid,'User ID');
				$rs != 'ok' && write_msg($rs);
				//strlen($userid) > 40 && write_msg("您的用户名多于40个字符，不允许注册！");
				strlen($userid) < 4 && write_msg("Your designated user ID is too short (less than 4 characters) and cannot be used to register!",$openlogin_uri);
				!is_email($email) && write_msg("This Email address is in wrong format!");
				$db->getOne("SELECT id FROM `{$db_mymps}member` WHERE userid = '$userid' AND openid = ''") && write_msg("The user ID {$userid} that you have designated already exists, please try again with another user ID!",$openlogin_uri);
			}
			
			/*积分变化*/
			$score_change = get_credit_score();
			$score_changer = $score_change['score']['rank']['register'] == '0' ? '+0' : $score_change['score']['rank']['register'];
			
			$userpwd = md5($userpwd);
			$money_own	=	$db -> getOne("SELECT money_own FROM `{$db_mymps}member_level` WHERE id = '1'");
			$money_own	=	$money_own ? $money_own : 0;
			
			$db -> query("UPDATE `{$db_mymps}member` SET jointime='$timestamp',logintime='$timestamp',userpwd = '$userpwd',email='$email',money_own = '$money_own',score = score".$score_changer."  WHERE userid = '$userid' ");
			//member_reg($userid,md5($userpwd),$email,$safequestion,$safeanswer,$openid,$cname);
			
			$score_change = $score_changer = NULL;
			
			/*
			 发送欢迎短消息
			 */
			if($mymps_global['cfg_member_reg_title'] && $mymps_global['cfg_member_reg_content']){
				$title 	 = str_replace('{username}',$userid,$mymps_global['cfg_member_reg_title']);
				$content = str_replace('{sitename}',$mymps_global['SiteName'],$mymps_global['cfg_member_reg_content']);
				$content = str_replace('{time}',GetTime($timestamp),$content);
				$content = str_replace('{username}',$userid,$content);
				sendpm('admin',$userid,$title,$content,1);
			}
			
			//如果是点击注册推广人的链接注册
			if(mgetcookie('fromuid') && $mymps_global['cfg_if_affiliate'] == 1){
				$fromuid = intval(mgetcookie('fromuid'));
				$fromip = trim(mgetcookie('fromip'));
				if($fromip != GetIP()){
					$score_changer = "+".$mymps_global['cfg_affiliate_score'];
					$db -> query("UPDATE `{$db_mymps}member` SET score = score".$score_changer." WHERE id = '$fromuid'");
				}
			}
			/*
			@session_unregister('openid');
			@session_unregister('nickname');
			@session_unregister('access_token');
			@session_unregister('appid');
			*/
			session_unset();
			if(PASSPORT_TYPE == 'phpwind'){
				$member_log -> in($userid,md5($userpwd),'off','noredirect');
				$user_login = uc_user_login($userid,md5($userpwd),0);
				$ucsynlogin = $user_login['synlogin'];
				echo $ucsynlogin;
				echo mymps_goto($url ? $url : $mymps_global['SiteUrl'].'/member/index.php');
			}elseif(PASSPORT_TYPE == 'ucenter'){
				$member_log -> in($userid,$userpwd,$memory,'noredirect');
				list($uid, $username, $password, $email) = uc_user_login($userid, $userpwd);
				echo uc_user_synlogin($uid);
				echo mymps_goto($url ? $url : $mymps_global['SiteUrl'].'/member/index.php');
			} else {
				$member_log -> in($userid,$userpwd,$memory,'noredirect');
				write_msg("Redirecting to the User Management Centre, please wait……",$mymps_global['SiteUrl']."/member/index.php");
			}
			
			
		}
		
	} else{
		include MYMPS_MEMBER.'/include/'.$mod.'.inc.php';
	}
}

is_object($db) && $db->Close();
$city = $maincity = NULL;
unset($city,$maincity);
exit();
?>
