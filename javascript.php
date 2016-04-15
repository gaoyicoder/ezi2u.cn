<?php
error_reporting(E_ALL^E_NOTICE);
@header("Content-Type: text/html; charset=utf-8");
__FILE__ == '' && die('Fatal error code: 0');

define("IN_MYMPS",true);
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
define('CURDIR',dirname(__FILE__));
define('MYMPS_ROOT',CURDIR);
define('MYMPS_DATA',CURDIR.'/data');
define('MYMPS_INC',CURDIR.'/include');

if(function_exists('date_default_timezone_set')) date_default_timezone_set('Hongkong');

@set_magic_quotes_runtime(0);
if (defined('DEBUG_MODE') == false){
    define('DEBUG_MODE', 0);
}

if(PHP_VERSION < '4.1.0') {
	$_GET		=	&$HTTP_GET_VARS;
	$_SERVER	=	&$HTTP_SERVER_VARS;
	unset($HTTP_GET_VARS,$HTTP_SERVER_VARS);
}

if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) {
	exit('Request tainting attempted.');
}

require_once MYMPS_DATA."/config.php";
require_once CURDIR."/include/common.fun.php";

$part 		= isset($_GET['part']) 	 ? 	mhtmlspecialchars($_GET['part']) : 'jswizard';
$flag 		= isset($_GET['flag']) 	 ? 	mhtmlspecialchars($_GET['flag']) : '';
$id	 		= isset($_GET['id']) 	 ?	intval($_GET['id']) : '';
$inajax		= isset($_GET['inajax']) ?	intval($_GET['inajax']) : '';
$getvalue	= isset($_GET['value'])	 ? 	mhtmlspecialchars($_GET['value']) : '';
$timestamp	= time();
$cityid	 	= isset($_GET['cityid']) ?	intval($_GET['cityid']) : '';
//$getvalue   = iconv('GB2312','UTF-8',$getvalue);

if(empty($part) || !in_array($part,array('advertisement','information','news','member','jswizard','iflogin','chk_remember','chk_authcode','chk_answer','chk_remail'))){
	$part = 'advertisement';
}

if($part == 'chk_answer'){
	
	$data = NULL;
	@require_once CURDIR."/include/cache.fun.php";
	$result   = read_static_cache('checkanswer');
	if(is_array($result)){
		if(empty($getvalue) || empty($id)){
			exit('Please enter the identifying question!');
		}elseif($result[$id]['answer'] != $getvalue){
			exit('Incorrect Answer!');
		}else{
			exit('success');
		}
	}
	$result = $getvalue = $whenpost = $data = NULL;

	
}elseif($part == 'chk_authcode'){

	@session_save_path(CURDIR.'/data/sessions');
	exit(mymps_chk_randcode($getvalue) ? 'success' : 'The identifying code you input is incorrect!');
	$getvalue='';
	
}elseif($part == 'chk_remember'){

	require_once MYMPS_DATA."/config.db.php";
	@header("Content-type: text/html; charset=".$charset);
	
	require_once MYMPS_INC."/db.class.php";
	if(empty($getvalue)){
		echo "This User ID cannot be used for registration!";
	} else {
		if(PASSPORT_TYPE == 'phpwind'){
		
			include MYMPS_ROOT.'/pw_client/uc_client.php';
			exit(uc_user_get($getvalue) ? "Unfortunately, this User ID had already been registered!" : "success");
		
		} elseif(PASSPORT_TYPE == 'ucenter'){
		
			include MYMPS_ROOT.'/uc_client/client.php';
			exit(uc_get_user($getvalue) ? "Unfortunately, this User ID had already been registered!" : "success");
			
		} else {
		
			$check = CheckUserID($getvalue,"User ID");
			if(strstr($getvalue,'admin') || strstr($getvalue,'Administrator')){
				exit("This User ID is now under protection, please use another one.");	
			}
			if(strlen($getvalue) < 5 || strlen($getvalue) > 20){
				exit("Please note that User ID must be within 5-20 characters in lengtn!");
			}
			if($check == 'ok'){
				exit((!$re = $db->getOne("SELECT * FROM {$db_mymps}member WHERE userid LIKE '$getvalue'")) ? "success" : "Unfortunately, this User ID had already been registered!");
	
			}else{
				exit($check);
			}
		}
		
	}
	$getvalue = NULL;

}elseif($part == 'chk_remail'){

	$mod = isset($_GET['mod']) 	 ?	intval($_GET['mod']) : 0;
	require_once MYMPS_DATA."/config.db.php";
	@header("Content-type: text/html; charset=".$charset);
	require_once MYMPS_INC."/db.class.php";
	if($db->getOne("SELECT id FROM {$db_mymps}member WHERE email = '$getvalue'")){
		echo empty($mod) ? 'Unfortunately, this E-mail address had already been used for registration!' : 'success';
	} else {
		echo $mod == 1 ? 'This E-mail address doe not exist and cannot be used to receive mails!' : 'success';
	}

}elseif($part == 'advertisement') {

	empty($id) && exit(html2js('Invalid Id'));
	require_once CURDIR."/data/config.db.php";
	require_once CURDIR."/include/db.class.php";
	
	if($code = $db -> getOne("SELECT code FROM `{$db_mymps}advertisement` WHERE available > '0' AND starttime<='".$timestamp."' AND type = 'normalad' AND advid = '$id'")) echo html2js($code);

} elseif($part == 'iflogin'){
	
	require_once MYMPS_DATA."/config.db.php";
	require_once MYMPS_INC."/db.class.php";
	require_once MYMPS_INC."/member.class.php";
	$data = NULL;
	@include MYMPS_INC.'/qqlogin/config.inc.php';
	$echo = $data['open'] == 1 ? '<ul><a href="'.$mymps_global[SiteUrl].'/include/qqlogin/qq_login.php" title="Log-in with QQ Account"><img align="absmiddle" src="'.$mymps_global['SiteUrl'].'/include/qqlogin/qq_login.gif"></a></ul> <ul class="line"><u></u></ul>' : '';
	$data = NULL;
	$echo .= '<ul><a href="'.$mymps_global['SiteUrl'].'/'.$mymps_global['cfg_member_logfile'].'?cityid='.$cityid.'" >Log-in</a></ul><ul class="line"><u></u></ul><ul><a href="'.$mymps_global[SiteUrl].'/'.$mymps_global['cfg_member_logfile'].'?mod=register&cityid='.$cityid.'" >Register 00</a></ul>';
	echo html2js($member_log->chk_in() ? 'Welcome back, '.$s_uid.' ！&nbsp;<a href="'.$mymps_global['SiteUrl'].'/member/index.php">Member Centre</a> <a href="'.$mymps_global[SiteUrl].'/'.$mymps_global['cfg_member_logfile'].'?mod=out&url='.$url.'" >Exit</a> ' : $echo);

} elseif(in_array($part,array('information','news','member'))) {

	empty($id) && exit(html2js('Invalid Id'));
	require_once CURDIR."/data/config.db.php";
	require_once CURDIR."/include/db.class.php";
	
	$db->query("UPDATE `{$db_mymps}".$part."` SET hit = hit+1 WHERE id = '$id'");
	
	$hit = $db->getOne("SELECT hit FROM `{$db_mymps}".$part."` WHERE id = '$id'");
	echo html2js($hit);
	unset($hit);

} elseif($part == 'jswizard') {
	
	if(empty($flag)) exit(html2js('Access Diened!'));
	
	$jswizard_lists = array();
	$data = '';
	$allowflag = '';
	
	include CURDIR.'/data/caches/jswizard_lists.php';
	$jswizard_lists = $data;
	unset($data);
	!in_array($flag,array_keys($jswizard_lists)) && exit(html2js('NO flag exists!'));
	
	require_once CURDIR."/include/cache.fun.php";
	@include CURDIR."/data/caches/jswizard_settings.php";
	$jssettings = $data;
	unset($data);

	if(empty($jssettings['jsstatus'])) exit(html2js('<font color=red>The webmaster did not enable this feature.</font>'));
	
	$nocache	= empty($jssettings['jscachelife']) ? TRUE :  NULL;
	
	$jsrefdomains	=	isset($jssettings['jsrefdomains']) ? $jssettings['jsrefdomains'] : preg_replace("/([^\:]+).*/", "\\1", (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : NULL));
	$REFERER	= 	parse_url($_SERVER['HTTP_REFERER']);
	if($jsrefdomains && (empty($REFERER) || !in_array($REFERER['host'], explode("\r\n", trim($jsrefdomains))))) {
		exit(html2js('<font color=red>Referer restriction is taking effect.</font>'));
	}
	
	$cachefile	=	CURDIR.'/data/caches/javascript_'.$flag.'.php';
	
	$expiration = NULL;
	@include($cachefile);
	
	if(!$expiration || $expiration >= $timestamp){
		require_once CURDIR."/data/config.db.php";
		require_once CURDIR."/include/db.class.php";
		$jsmodule = jsmodule($flag);
		$datalist = $writedata = procdata('document.write("'.$jsmodule.'");');
		unset($jsmodule);
		if(!$nocache) {
			$writedata = "\$datalist = '".addcslashes($writedata, '\\\'')."';";
			UpdateCache($cachefile, $writedata);
		}
		is_object($db) && $db->Close();
		$db = NULL;
	}
	
	echo $datalist;
	
} else{

	exit(html2js('Access Denied!'));
}

unset($part,$flag,$cachefile,$nocache,$jsrefdomains,$allowflag,$jswizard_lists,$datalist,$writedata,$inajax,$timestamp);

function jsmodule($flag=''){
	global $db,$db_mymps,$jswizard_lists,$jssettings,$jscharset,$mymps_global;
	$parameter			=	$jswizard_lists[$flag]['parameter'];
	$catid				=	is_array($parameter['catid']) 	? implode("','",$parameter['catid']) 	: NULL;
	$cityid				=	is_array($parameter['cityid']) 	? implode("','",$parameter['cityid']) : NULL;
	$newwindow			=	!empty($parameter['newwindow']) ? $parameter['newwindow'] 			: 1;
	$items				=	!empty($parameter['items']) 	? intval($parameter['items']) 		: 10;
	$maxlength			=	!empty($parameter['maxlength']) ? intval($parameter['maxlength']) 	: 50;
	$ids				=	!empty($parameter['ids'])		? str_replace(",","','",trim($parameter['ids']))			: NULL;
	$keyword			=	!empty($parameter['keyword']) 	? $parameter['keyword'] 			: NULL;
	$special			=	is_array($parameter['special']) ? $parameter['special'] 			: NULL;
	$orderby			=	!empty($parameter['orderby']) 	? ($parameter['orderby'] == 'views' ? 'hit' : 'begintime') : 'begintime';
	$jstemplate			= 	!empty($parameter['jstemplate'])? $parameter['jstemplate']			: '{title}<br />';
	$jscharset			=	!empty($parameter['jscharset'])	? $parameter['jscharset']			: NULL;
	$target				= 	$parameter['newwindow'] == 1 	? 'target=_blank' 					: 'target=_self';
	$jsdateformat		=	isset($jssettings['jsdateformat']) ?  $jssettings['jsdateformat'] : 'Y - m -d';
	
	$datalist = array();
	if($keyword) {
		if(preg_match("(AND|\+|&|\s)", $keyword) && !preg_match("(OR|\|)", $keyword)) {
			$andor 		= ' AND ';
			$keywordsrch 	= '1';
			$keyword 	= preg_replace("/( AND |&| )/is", "+", $keyword);
		} else {
			$andor 		= ' OR ';
			$keywordsrch 	= '0';
			$keyword 	= preg_replace("/( OR |\|)/is", "+", $keyword);
		}
		$keyword = str_replace('*', '%', addcslashes($keyword, '%_'));
		foreach(explode('+', $keyword) as $text) {
			$text = trim($text);
			if($text) {
				$keywordsrch .= $andor;
				$keywordsrch .= "t.title LIKE '%$text%'";
			}
		}
		$keyword = " AND ($keywordsrch)";
	} else {
		$keyword = '';
	}
	
	require_once CURDIR.'/data/info_special.inc.php';
	
	$sql	=	($catid ? ' AND t.catid IN (\''.$catid.'\')' : '')
				.$keyword
				.($ids ? ' AND t.id IN (\''.$ids.'\')' : '')
				.($cityid ? ' AND t.cityid IN (\''.$cityid.'\')' : '');
				
	if(is_array($special) && $special != array(0=>'1',1=>'2',2=>'3',3=>'4',4=>'5',5=>'6',6=>'7',7=>'8',8=>'9')){
		foreach($special as $k => $v){
			switch($v){
				case 1:$sql .= ' AND t.upgrade_type = \'2\' AND t.upgrade_time > \'$timestamp\'';break;
				case 2:$sql .= ' AND t.upgrade_type_list = \'2\' AND t.upgrade_time_list > \'$timestamp\'';break;
				case 3:$sql .= ' AND t.upgrade_type_index = \'2\' AND t.upgrade_time_index > \'$timestamp\'';break;
				case 4:$sql .= ' AND t.info_level = \'0\'';break;
				case 5:$sql .= ' AND t.info_level = \'1\'';break;
				case 6:$sql .= ' AND t.info_level = \'2\'';break;
				case 7:$sql .= ' AND t.ifred = \'1\'';break;
				case 8:$sql .= ' AND t.ifbold = \'1\'';break;
				case 9:$sql .= ' AND t.certify = \'1\'';break;
			}
		}	
	} else {
		$sql .= ' AND t.info_level > \'0\'';
	}
	
	$sqlfrom =  ",c.catname,c.dir_typename FROM `{$db_mymps}information` t LEFT JOIN `{$db_mymps}category` c ON c.catid = t.catid" ;
	
	$query	=	$db->query("SELECT t.id,t.cityid,t.img_path,t.catid,t.title,t.content,t.userid,t.contact_who,t.ismember,t.begintime,t.hit,t.ifbold,t.ifred,c.dir_typename
				$sqlfrom WHERE 1
				$sql
				ORDER BY t.$orderby DESC
				LIMIT 0,$items;"
				);
	
	while($data = $db->fetchRow($query)){
		$datalist[$data['id']]['catid']			=	$data['catid'];
		$datalist[$data['id']]['catname']		=	$data['catname'];
		$datalist[$data['id']]['caturl']		=	Rewrite('category',array('catid'=>$data['catid'],'dir_typename'=>$data['dir_typename']));
		$datalist[$data['id']]['img_path']		=	$data['img_path'];
		$datalist[$data['id']]['catnamelength']	=	strlen($datalist[$data['id']]['catname']);
		$datalist[$data['id']]['title']			=	isset($data['title']) ? str_replace('\'', '&nbsp;',addslashes($data['title'])) : NULL;
		$datalist[$data['id']]['link']			=	Rewrite('info',array('id'=>$data['id'],'dir_typename'=>$data['dir_typename'],'cityid'=>$data['cityid']));
		$datalist[$data['id']]['begintime']		=	date("$jsdateformat",$data['begintime']);
		$datalist[$data['id']]['hit']			=	$data['hit'];
		$datalist[$data['id']]['ifbold']		=	$data['ifbold'];
		$datalist[$data['id']]['ifred']			=	$data['ifred'];
		$datalist[$data['id']]['introduce']		=	str_replace(array('\'',"\n","\r"), array('&nbsp;','',''), addslashes(cutstr(mhtmlspecialchars(preg_replace("/(\[.+\])/s", '', strip_tags(nl2br($data['content'])))), 255)));
		if($data['userid'] && $data['ismember'] == 1) {
			$datalist[$data['id']]['author'] 	= 	'<a href=\''.Rewrite('space',array('user'=>$data['userid'])).'\' target=\'_blank\'>'.$data[userid].'</a>';
		} else {
			$datalist[$data['id']]['author'] 	= 	!empty($data['contact_who']) ? $data['contact_who'] : 'Tourist';
		}
		$threadtypeids[]				=	$data['typeid'];
	}
	
	$writedata = '';
	if(is_array($datalist)) {
		foreach($datalist AS $t => $val) {
			$SubjectStyles	 = '';
			$SubjectStyles	.= " style='";
			$SubjectStyles	.= $val['ifbold'] == 1 ? 'font-weight: bold;' : NULL;
			$SubjectStyles	.= $val['ifred'] == 1 ? 'color: red;' : NULL;
			$SubjectStyles	.= "'";
			
			$val['title'] = cutstr($val['title'],($catnamelength ? ($maxlength - $val['catnamelength']) : $maxlength));
			$replace['{link}']			= $val['link'];
			$replace['{title}']			= '<a href=\''.$val["link"].'\' '.$SubjectStyles.' '.$target.'>'.$val['title'].'</a>';
			$replace['{title_nolink}']	= $val['title'];
			$replace['{catname}']		= '<a href=\''.$val["caturl"].'\' target=_blank>'.$val['catname'].'</a>';
			$replace['{begintime}'] 	= $val['begintime'];
			$replace['{introduce}'] 	= $val['introduce'];
			$replace['{author}'] 		= $val['author'];
			$replace['{hit}'] 			= $val['hit'];
			$replace['{imgpath}']		= $mymps_global['SiteUrl'].($val['img_path'] ? $val['img_path'] : '/images/nophoto.gif');
			$writedata .= str_replace(array_keys($replace), $replace, $jstemplate);
		}
	}
	
	unset($mymps_global);
	return parsenode($writedata);
}

function parsenode($data) {
	global $jstemplate;
	if($jstemplate) {
		$data = preg_replace("/\[node\](.+?)\[\/node\]/is", $data, $jstemplate, 1);
		$data = preg_replace("/\[node\](.+?)\[\/node\]/is", '', $data);
	}
	return $data;
}

function procdata($data) {
	global $jscharset,$charset;
	if($jscharset && strtoupper($charset) == 'GBK') {
		$data = iconv('GBK','UTF-8',$data);
	}
	return $data;
}

function UpdateCache($cachefile,$data='') {
	global $timestamp, $jscachelife;
	if(!$fp = @fopen($cachefile, 'wb')) {
		exit("document.write(\"Unable to write to cache file!<br />Please chmod ./data/caches to 777 and try again.\");");
	}
	$fp = @fopen($cachefile, 'wb');
	$cachedata = "if(!defined('IN_MYMPS')) exit('Access Denied');\n\$expiration = '".($timestamp + $jscachelife)."';\n".$data."\n";
	@fwrite($fp, "<?php\n//Mymps cache file, DO NOT modify me!".
			"\n//Created: ".date("M j, Y, G:i").
			"\n//Identify: ".md5(basename($cachefile).$cachedata)."\n\n$cachedata?>");
	@fclose($fp);
}

function strexists($haystack, $needle) {
	return !(strpos($haystack, $needle) === FALSE);
}
?>