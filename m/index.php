<?php
error_reporting(E_ALL^E_NOTICE);
__FILE__ == '' && die('Fatal error code: 0');
if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) {
	exit('Request tainting attempted.');
}
@set_magic_quotes_runtime(0);
if (defined('DEBUG_MODE') == false) define('DEBUG_MODE', 0);
if(PHP_VERSION < '4.1.0') {
	$_GET =	&$HTTP_GET_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	unset($HTTP_GET_VARS,$HTTP_SERVER_VARS);
}
if(function_exists('date_default_timezone_set')) date_default_timezone_set('Hongkong');

define('IN_MYMPS',true);
define('WAP',true);
define('WAPDIR',dirname(__FILE__));
define('MYMPS_ROOT' , WAPDIR.'/..');
define('MYMPS_INC'	, MYMPS_ROOT.'/include');
define('MYMPS_DATA'	, MYMPS_ROOT.'/data');
define('MYMPS_UPLOAD', MYMPS_ROOT.'/attachment');

session_save_path(MYMPS_ROOT.'/m/sessions');
require_once MYMPS_DATA.'/config.php';
require_once MYMPS_DATA.'/config.db.php';
require_once MYMPS_INC."/db.class.php";
include MYMPS_INC.'/common.fun.php';
include MYMPS_INC.'/cache.fun.php';
include MYMPS_INC.'/class.fun.php';

@header("Content-Type: text/html; charset=".$charset);
include MYMPS_ROOT.'/version.php';

$mobile_settings = get_mobile_settings();
if($mobile_settings['allowmobile'] != 1){
	errormsg('Sorry, the mobile version of the site has temporarily been suspended!');
}

if(pcclient()) write_msg('',$mymps_global['SiteUrl']);

$timestamp = time();
$mod = isset($_GET['mod'])	? mhtmlspecialchars($_GET['mod'])	: '';
$preview = isset($_GET['preview']) ? mhtmlspecialchars($_GET['preview']) : '';
$action = isset($_REQUEST['action']) ? mhtmlspecialchars($_REQUEST['action']) : '';
$cityid = isset($_REQUEST['cityid']) ? intval($_REQUEST['cityid']) : '';
$cityid = isset($cityid) ? intval($cityid) : mgetcookie('cityid');

!in_array($mod,array('category','index','items','information','login','openlogin','myhome','register','mypost','post','search','member','shoucang','history','delete','about','newinfo','changecity','hui','tuan','hui_list','tuan_list','store_hui_list','store_tuan_list', 'store_tuan_list_fi', 'receive_money_list')) && $mod = 'index';

if($cityid) {
	if(!$city = $db->getRow("SELECT * FROM `{$db_mymps}city` WHERE cityid = '$cityid'")){
		redirectmsg('This state doesn��t exist; please reselect state!','index.php?mod=changecity');
	}else{
		msetcookie('cityid',$cityid);	
	}
}else{
	if($mod == 'index'){
		$ip = GetIP();
		if(is_array($fromcity = get_ip2city($ip))){
			@header("location:$mymps_global[SiteUrl]/m/index.php?cityid=".$fromcity['cityid']);
			exit;
		}
	}
	$city = array('cityname'=>'State','cityid'=>0);	
}

$s_uid = $iflogin = NULL;
include MYMPS_INC.'/member.class.php';
$returnurl = urlencode(GetUrl());
if($member_log->chk_in()){
	$iflogin = 1;

    $row_member = $db -> getRow("SELECT * FROM `{$db_mymps}member` WHERE userid = '$s_uid'");
    if($row_member['if_corp'] == 1) {
        $user_title = "<span style='color: #27ae60'>Seller</span>";
    } else {
        $user_title = "<span style='color: #27ae60;'>Dear</span>";
    }

	$loginfo = '<a class="u_name fl">Welcome, '.$user_title.'</a><!--<a style="padding-top: 0px;height: 20px;line-height: 20px;" href="index.php?mod=member&userid='.$s_uid.'" class="u_name fl">'.$s_uid.'</a>--> <a href="index.php?mod=login&action=logout&returnurl='.$returnurl.'" class="exit58">Exit Safely</a>';
	$loginfopost = '<a class="u_name fl">Welcome, </a><a href="index.php?mod=member&userid='.$s_uid.'" class="u_name fl"><b>'.$s_uid.'</b></a>   &nbsp;&nbsp;<a href="index.php?mod=login&action=logout&returnurl='.$returnurl.'" class="exit58">Exit</a>';
	$loginfomypost = '<a href="index.php?mod=mypost&userid='.$s_uid.'" class="my_publish">'.Posts.'</a>';
	$loginfomyshoucang = '<a href="index.php?mod=shoucang&userid='.$s_uid.'" class="my_collect">'.Favourites.'</a>';
} else {
	$iflogin = 0;
	$loginfo = '<a href="index.php?mod=login&returnurl='.$returnurl.'" class="logn_btn">Log-in</a> <a href="index.php?mod=register" class="logn_btn">Register</a>';
	$loginfopost = '<div class="d3"><a href="index.php?mod=login&returnurl='.$returnurl.'">Log-in</a></div> <div class="d4"><a href="index.php?mod=register">Register</a></div>';
	$loginfomypost = '<a href="index.php?mod=login&returnurl='.$returnurl.'" class="my_publish">Posts</a>';
	$loginfomyshoucang = '<a href="index.php?mod=login&returnurl='.$returnurl.'" class="my_collect">Favourites</a>';
}

include WAPDIR.'/include/inc_'.$mod.'.php';

is_object($db) && $db -> Close();
$parent_cats = $loginfo = $newinfo = $mod = $ac = $mymps_global = $catid = $areaid = $db = $db_mymps = $mobile_settings = $member_log = NULL;

function errormsg($error_msg){
	global $charset,$mymps_global,$cityid;
	echo '<?xml version="1.0" encoding="'.$charset.'"?>';
	include WAPDIR.'/template/header_error.tpl.php';
	echo '<div>'.$error_msg.'</div>';
	include WAPDIR.'/template/footer_error.tpl.php';
	exit;
}

function redirectmsg($redirectmsg,$url){
	global $charset,$mymps_global,$cityid;
	echo '<?xml version="1.0" encoding="'.$charset.'"?>';
	include WAPDIR.'/template/header_error.tpl.php';
	echo '<div>'.$redirectmsg.' <a href="'.$url.'">Click To Continue</a></div>';
	include WAPDIR.'/template/footer_error.tpl.php';
	exit;
}

function setparams($param)
{
	foreach($param as $k =>$v){
		global ${$v};
		$params .= ${$v} ? urlencode($v).'='.${$v}.'&' : '';
	}
	return $params;
}

function pager(){
	global $page,$totalpage,$rows_num,$param;
	if($totalpage == 1 && $page == 1){
		$nav = $rows_num.' Results';
	}else{
		if($page-1 < 1){
			$nav .= '<a href="javascript:void();" class="pageprev pagedisable">Prev.</a>';
			$nav .= '<a class="pageno pagecur">'.$page.'</a>';
			$nav .= '<a href="?'.$param.'page='.($page+1).'" class="pageno">'.($page+1).'</a>';
			if($totalpage > $page+1){
				$nav .= '<a href="?'.$param.'page='.($page+2).'" class="pageno">'.($page+2).'</a>';
			}
		}else{
			$nav .= '<a href="?'.$param.'page='.($page-1 < 1 ? 1 : $page-1).'" class="pageprev">Prev.</a>';
			if($totalpage == 3 && $page==3){
				$nav .= '<a href="?'.$param.'page='.($page-2).'" class="pageno">'.($page-2).'</a>';	
			}
			$nav .= '<a href="?'.$param.'page='.($page-1).'" class="pageno">'.($page-1 < 1 ? 1 : $page-1).'</a>';	
			$nav .= '<a class="pageno pagecur">'.$page.'</a>';
			if($totalpage > $page){
				$nav .= '<a href="?'.$param.'page='.($page+1).'" class="pageno">'.($page+1).'</a>';
			}
		}
		
		if($totalpage > $page){
			$nav .= '<a href="?'.$param.'page='.($page+1).'" class="pagenext">Next</a>';
		}else{
			$nav .= '<a href="javascript:void();" class="pagenext pagedisable">Next</a>';
		}
	}
	echo $nav;
}

function mylicense( $agree_domain )
{
	if ( empty( $HTTP_HOST ) ){
		if ( mygetenv( "HTTP_HOST" ) ){
			$HTTP_HOST = mygetenv( "HTTP_HOST" );
		}else{
			$HTTP_HOST = '';
		}
	}
	$agree_domain = '.127.0.0.1|localhost|mayicms.test|'.$agree_domain;
	$now_domain = getRootdomain(htmlspecialchars( $HTTP_HOST ));
	$now_domain = str_replace('.www.','',$now_domain);
	if ( !in_array( $now_domain, explode( "|", $agree_domain ) )){
		exit('<a href="http://www.mymps.com.cn">mymps Official Website</a><p><a href="http://bbs.mymps.com.cn">mymps BBS</a>');
	}
}
?>
