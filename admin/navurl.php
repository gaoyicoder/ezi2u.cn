<?php
define('CURSCRIPT','navurl');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once dirname(__FILE__)."/include/color.inc.php";
require_once dirname(__FILE__)."/include/ifview.inc.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$typeid = $admin_cityid ? 1 : ($typeid ? intval($typeid) : 3);

if(!submit_check(CURSCRIPT.'_submit')){
	
	chk_admin_purview("purview_Navigation");
	
	$nav_type = array();
	
	if($admin_cityid){
		$nav_type[1] = 'Head Navigation';
	} else {
		$nav_type[3] = 'Main Navigation';
		$nav_type[1] = 'Sub-navigation';
		$nav_type[2] = 'Rear Navigation';
	}
	
	$target = array(
		'_blank' => 'New Window',
		'_self'	 => 'Current Window'
	);
	
	if($part == 'restore'){
		
		restore_headerurl();
		write_msg('Default main navigation with text link has successfully been restored!','?typeid=3');
		
	} elseif($part == 'restorefooter') {
	
		restore_footerurl();
		write_msg('Default rear navigation with text link has successfully been restored!','?typeid=2');
		
	} else {
	
		$here		= 'Link Navigation Settings';
		$where		= " WHERE typeid = '$typeid'";
		$where 		.= $admin_cityid ? " AND cityid = '$admin_cityid'" : ($cityid ? " AND cityid = '$cityid'" : " AND cityid = '0'");
		$rows_num	= mymps_count(CURSCRIPT,$where);
		$param		= setParam(array("part","typeid","cityid"));
		$url		= array();
		
		$url		= page1("SELECT * FROM {$db_mymps}".CURSCRIPT." $where ORDER BY displayorder ASC");
		include mymps_tpl(CURSCRIPT);
	
	}

} else {
	
if(is_array($navtitle)){
		foreach($navtitle as $key => $v){
			$db -> query("UPDATE `{$db_mymps}navurl` SET title = '$v',displayorder = '$displayorder[$key]',cityid='$cityid[$key]',url='$navurl[$key]',isview='$isviewids[$key]',ico='$icoids[$key]',target='$target[$key]',color='$showcolor[$key]',flag='$flag[$key]' WHERE id = ".$key);
		}
	}
	
	if(is_array($newtitle) && is_array($newurl)) {
		foreach($newtitle AS $key => $q) {
			$title 			= trim($q);
			$url  			= mhtmlspecialchars(trim($newurl[$key]));
			$cityid  		= mhtmlspecialchars(trim($newcityid[$key]));
			$typeid  		= mhtmlspecialchars(trim($newtypeid[$key]));
			$displayorder   = mhtmlspecialchars(trim($newdisplayorder[$key]));
			$isview			= mhtmlspecialchars(trim($newisview[$key]));
			$ico			= mhtmlspecialchars(trim($newico[$key]));
			$target			= $newtarget[$key] ? mhtmlspecialchars(trim($newtarget[$key])) : '_blank';
			$showcolor		= mhtmlspecialchars(trim($newshowcolor[$key]));
			$flag			= mhtmlspecialchars(trim($newflag[$key]));
			$flag			= $typeid == 3 ? 'outlink' : '';			
			
			if($title && $url) {
				$db->query("INSERT INTO `{$db_mymps}navurl` (url,cityid,title,ico,typeid,isview,target,flag,displayorder,createtime) VALUES ('$url','$cityid','$title','$ico','$typeid','$isview','$target','$flag','$displayorder','$timestamp')");
			}
			
			if($typeid == 1) {
				clear_cache_files('city_'.$cityid);
			}
		}
		
	}
	
	if(is_array($delids)){
		
		foreach ($delids as $kids => $vids){
			mymps_delete(CURSCRIPT,"WHERE id = ".$vids);
		}
		
		$allcities = get_allcities();
		if(is_array($allcities)){
			foreach($allcities as $key => $val){
				clear_cache_files('city_'.$key);
			}
		}
		$allcities = NULL;
		
	}
	
	if(!$admin_cityid){
		clear_cache_files('navurl_foot');
		clear_cache_files('navurl_header');
		clear_cache_files('city_0');
	} else {
		clear_cache_files('city_'.$admin_cityid);
	}
	
	write_msg('Link navigation settings have successfully been updated!',$forward_url,'MympsRecord');

}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit;

function get_navtype_options($typeid = ''){
	global $nav_type;
	foreach ($nav_type as $key => $value){
		$mymps .= '<option value='.$key.'';
		$mymps .= ($typeid == $key) ? ' selected>' : '>';
		$mymps .= $value.'</option>';
	}
	return $mymps;
}

function get_target_options($ttarget = ''){
	global $target;
	foreach ($target as $key => $value){
		$mymps .= '<option value='.$key;
		$mymps .= ($ttarget == $key) ? ' selected>' : '>';
		$mymps .= $value.'</option>';
	}
	return $mymps;
}

function restore_footerurl(){
	global $db,$db_mymps,$seo,$timestamp;
	if(!$seo) $seo = get_seoset();
	$db->query("DELETE FROM `{$db_mymps}navurl` WHERE typeid = '2'");
	$query = $db->query("SELECT * FROM `{$db_mymps}about` ORDER BY displayorder ASC");
	while($row=$db->fetchRow($query)){
		$about[$row['id']]['id']=$row['id'];
		$about[$row['id']]['name']=$row['typename'];
		$about[$row['id']]['uri']= Rewrite('about',array('part'=>'aboutus','id'=>$row['id']));
	}
	
	$url = array();
	$url['faq']['name']				= 'Site Help';
	$url['faq']['uri']				= Rewrite('about',array('part'=>'faq'));
	$url['friendlink']['name']		= 'Related Links';
	$url['friendlink']['uri']		= Rewrite('about',array('part'=>'friendlink'));
	$url['annnounce']['name']		= 'Site Announcements';
	$url['annnounce']['uri']		= Rewrite('about',array('part'=>'announce'));
	$url['sitemap']['name']			= 'Site Map';
	$url['sitemap']['uri']			= Rewrite('about',array('part'=>'sitemap'));

	$url = is_array($about) ? array_merge($about,$url) : $url;
	$i=0;
	foreach($url as $k => $v){
		$i = $i+1;
		$db -> query("INSERT INTO `{$db_mymps}navurl` (url,target,title,flag,typeid,isview,displayorder,createtime)VALUES('$v[uri]','_blank','$v[name]','$k','2','2','$i','$timestamp')");
	}
	clear_cache_files('navurl_foot');
}

function restore_headerurl(){
	global $db,$db_mymps,$mymps_global,$seo;
	$seo = get_seoset();
	$rewrite = $seo['seo_force_category'];
	$db -> query("DELETE FROM `{$db_mymps}navurl` WHERE typeid = '3'");
	/*信息栏目导航*/
	$query = $db -> query("SELECT * FROM `{$db_mymps}category` WHERE parentid = '0'");
	while($row = $db -> fetchRow($query)){
		$category[$row['catid']]['catid'] = $row['catid'];
		$category[$row['catid']]['name']  = $row['catname'];
		$category[$row['catid']]['uri']   = Rewrite('category',array('catid'=>$row['catid'],'dir_typename'=>$row['dir_typename']));
		$category[$row['catid']]['flag']  = $row['catid'];
	}
	$category = $category ? $category : array();
	/*插件导航*/
	$plugin = array();
	@include MYMPS_DATA.'/caches/pluginmenu_member.php';
	if(is_array($data)){
		foreach($data as $k => $v){
			if($k != 'news'){
				$plugin[$k]['catid'] = $k;
				$plugin[$k]['flag'] = $k;
				$plugin[$k]['uri']  = plugin_url($k,array('cate_id'=>0,'id'=>0));
				$plugin[$k]['name'] = $v;
			} else {
				$plugin[$k]['catid'] = $k;
				$plugin[$k]['flag'] = $k;
				$plugin[$k]['uri']  = rewrite('news',array('part'=>'index'));
				$plugin[$k]['name'] = $v;
			}
		}
	}
	$plugin['corp']['catid'] = 'corp';
	$plugin['corp']['flag']  = 'corp';
	$plugin['corp']['uri']   = rewrite('corp',array('part'=>'index'));
	$plugin['corp']['name']  = 'Shops Of Sellers';
	unset($data);
	$url = (is_array($plugin) && is_array($category)) ? array_merge($category,$plugin) : $category;
	$i=0;
	if(is_array($url)){
		foreach($url as $k => $v){
			$i = $i+1;
			$db -> query("INSERT INTO `{$db_mymps}navurl` (url,target,title,flag,typeid,isview,displayorder,createtime)VALUES('$v[uri]','_self','$v[name]','$v[catid]','3','2','$i','$timestamp')");
		}
	}
	clear_cache_files('navurl_header');
}
?>
