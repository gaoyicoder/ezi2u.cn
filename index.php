<?php
/*
 * this is not a freeware, use is subject to license terms
 * ============================================================================
 * 版权所有 mymps研发团队，保留所有权利。
 * 网站地址: http://www.mymps.com.cn；
 * 交流论坛：http://bbs.mymps.com.cn；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * 软件作者: 郑州维维信息技术有限公司
`*/
define('IN_SMT', true);
define('IN_MYMPS', true);
define('CURSCRIPT','index');

require_once dirname(__FILE__)."/include/global.php";
require_once MYMPS_DATA."/config.php";
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";

if(!pcclient() && $view != 'pc'){
	$mobile_settings = get_mobile_settings();
	if($mobile_settings['autorefresh'] == 1 && $mobile_settings['allowmobile'] == 1){
		write_msg('',$mobile_settings['mobiledomain'] ? $mobile_settings['mobiledomain'] : $mymps_global['SiteUrl'].'/m/index.php');
		exit;
	}
	$mobile_settings = NULL;
}

if(!$cityid && !is_robot()){
	if(in_array($mymps_global['cfg_redirectpage'],array('nchome','ncchangecity'))){
		$ip = GetIP();
		if(is_array($fromcity = get_ip2city($ip))){
			@header("location:".$fromcity['domain']);
			exit;
		} elseif($mymps_global['cfg_redirectpage'] == 'ncchangecity') {
			@header("location:".$mymps_global[SiteUrl]."/changecity.php");
			exit;
		}
	}elseif($mymps_global['cfg_redirectpage'] == 'changecity') {
		@header("location:".$mymps_global[SiteUrl]."/changecity.php");
		exit;
	}elseif(is_numeric($mymps_global['cfg_redirectpage'])){
		//强制访问指定分站首页
		$r = get_city_caches($mymps_global['cfg_redirectpage']);
		$r['domain'] = $r['domain'] ? $r['domain'] : $mymps_global['SiteUrl'];
		@header("location:".$r['domain']);
		unset($r);
		exit;
	}
}

$tpl_index = get_tpl_index();
$tpl_index = $tpl_index['tpl_set'];

$city = get_city_caches($cityid);
$city['cityid'] && $city_limit = "AND a.cityid = '$city[cityid]'";

$maincity = get_city_caches(0);
$independency = explode(',',$mymps_global['cfg_independency']);
$independency = is_array($independency) ? $independency : array();
if(in_array('friendlink',$independency)){
	$city['flink'] = empty($city['flink']) ? $maincity['flink'] : $city['flink'];
}
if(in_array('topnav',$independency)){
	$city['topnav'] = empty($city['topnav']) ? $maincity['topnav'] : $city['topnav'];
}
if(in_array('announce',$independency)){
	$city['announce'] = empty($city['announce']) ? $maincity['announce'] : $city['announce'];
}
if(in_array('focus',$independency)){
	$city['focus'] = empty($city['focus']) ? $maincity['focus'] : $city['focus'];
}
if(in_array('lifebox',$independency)){
	$city['lifebox'] = empty($city['lifebox']) ? $maincity['lifebox'] : $city['lifebox'];
}
if(in_array('focus',$independency)){
	$city['telephone'] = empty($city['telephone']) ? $maincity['telephone'] : $city['telephone'];
}
if(in_array('advertisement',$independency)){
	$city['advertisement'] = empty($city['advertisement']) ? $maincity['advertisement'] : $city['advertisement'];
}
$maincity = NULL;
$loc					= get_location('index');
$location				= $loc['location'];
$page_title				= $loc['page_title'];
unset($loc);

$seo = get_seoset();
if(!$city['cityid']){
	$city['title'] = $page_title;
	$city['keywords'] = str_replace('{city}','',$seo['seo_keywords']);
	$city['description'] = str_replace('{city}','',$seo['seo_description']);
} else {
	$city['title'] = $city['title'] ? $city['title'] : $page_title;
	$city['keywords'] = $city['keywords'] ? $city['keywords'] : str_replace('{city}',$city['cityname'],$seo['seo_keywords']);
	$city['description'] = $city['description'] ? $city['description'] : str_replace('{city}',$city['cityname'],$seo['seo_description']);
}
$mymps_global = array_merge($mymps_global,$seo);

$advertisement			= get_advertisement('index');
$adveritems				= $city['advertisement'];
$advertisement['type']	= $advertisement['all'] ? (is_array($advertisement['type']) ? array_merge($advertisement['all']['type'],$advertisement['type']) : $advertisement['all']['type']) : $advertisement['type'];

$members = $mymps_global['cfg_if_corp'] == 1 ? mymps_get_member_list(!$cityid ? 14 : '','','',1,'',2) : '';
$index_topinfo = mymps_get_info_list($tpl_index['indextopinfo'],0,3);
$shopclass = get_corp_tree(0,'corp');

if($city['domain'] && $city['domain'] != $mymps_global['SiteUrl'].'/') msetcookie('fromcitydomain',$city['domain'],$timestamp+3600*24*30);
globalassign();
include mymps_tpl('index_'.$tpl_index['banmian']);
exit;
?>