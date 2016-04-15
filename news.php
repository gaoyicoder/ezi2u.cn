<?php
define('IN_SMT',true);
define('IN_MYMPS',true);
define('CSCRIPT','news');

require_once dirname(__FILE__)."/include/global.php";
require_once MYMPS_DATA."/config.php";
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";

ifsiteopen();
!ifplugin(CSCRIPT) && exit('The news plug-in has either been disabled by the administrator or not been installed!');

$id	= isset($id) ? intval($id) : '';
$catid = isset($catid) ? intval($catid) : 0;
$page = isset($page) ? intval($page) : 1;

$city = get_city_caches(0);
if($id) {
	define('CURSCRIPT','news');
	$id = isset($id) ? intval($id) : '';
	if(!$news = $db -> getRow("SELECT * FROM `{$db_mymps}news` WHERE id = '$id'")){
		write_msg('Your designated news either does not exist or has been deleted!');//获得新闻内容
		exit;
	}
	$latest_news = mymps_get_news_list(15);//取得最新发布的10条新闻
	$relate_news = mymps_get_news_list(8,$news['catid']);//取得相关的8条新闻
	$image_news = mymps_get_news_list(6,'',1);//取得最新的6条图文新闻
	
	$news['view_url'] = $mymps_global['SiteUrl'].($news['isactive'] == 1 ? '/news.php?id='.$id : $news['html_path']);
	
	if($news['redirect_url'] != '' && $news['isjump'] == 1) write_msg('Please wait, you are being redirected to '.$news[redirect_url].' ',$news[redirect_url]);
	
	/*****页面标题,当前位置,SEO信息****/
	$loc				 = get_location('channel',$news[catid],$news[title]);
	$location	 		 = $loc['location'];
	$page_title			 = $loc['page_title'];
	
	$advertisement			= get_advertisement('other');//获得全局广告
	$adveritems				= $city['advertisement'];
	$advertisement			= $advertisement['all'];
	
	$news['keywords']	 = $news['keywords'] ? $news['keywords'] : $news['title'];
	$news['description'] = mhtmlspecialchars(substring(clear_html($news['content']),0,250));
	
	/*新闻内容内链处理*/
	$news['content'] = replace_insidelink($news['content'],'news');
	
	$latest_info = mymps_get_info_list(10,'','','','','','','',false);
	
} elseif($catid) {

	define('CURSCRIPT','news_list');
	$catid = isset($catid) ? intval($catid) : 0;//初始化catid
	$channel = get_cat_info($catid,'channel');
	if(!$channel) write_msg('Your designated news column either does not exist or has been deleted!');//获得当前栏目的相关信息
	$loc		= get_location('channel',$catid);//获得页面标题
	$location	= $loc['location'];
	$page_title	= $loc['page_title'];
	
	$seo		= get_seoset();
	$rewrite 	= $seo['seo_force_news'];
	
	$cat_children	= get_cat_children($catid,'channel');
	
	$param = setParam(array('catid'),$rewrite,'news-');
	$rows_num = $db->getOne("SELECT COUNT(*) FROM `{$db_mymps}news` AS a WHERE catid IN($cat_children) {$city_limit}");
	$page1 = page1("SELECT * FROM {$db_mymps}news WHERE catid IN($cat_children) {$city_limit} ORDER BY id DESC",$mymps_global['cfg_list_page_line'] ? $mymps_global['cfg_list_page_line'] : 25);
	foreach($page1 as $kr => $r){
		$arr['begintime']   = $r['begintime'];
		$arr['hit']  		= $r['hit'];
		$arr['title']  	    = $r['title'];
		$arr['iscommend']  	= $r['iscommend'];
		$arr['content'] 	= clear_html($r['content']);
		$arr['uri']	  	  	= $r['isjump'] ? $r['redirect_url'] : Rewrite('news',array('id'=>$r['id']));
		$arr['imgpath'] 	= $r['imgpath'];
		$news[]			  	= $arr;
	}
	
	$advertisement			= get_advertisement('other');//获得全局广告
	$adveritems				= $city['advertisement'];
	$advertisement			= $advertisement['all'];
	
	$cat_list = get_categories_tree(empty($channel['parentid']) ? $catid : $channel['parentid'],'channel');//获得同类栏目
	$latest_info = mymps_get_info_list(10,'','','','','','','',false);
	$latest_news = mymps_get_news_list(15,false);//取得最新发布的10条新闻
	$image_news = mymps_get_news_list(6,'',1,false);//取得最新的6条图文新闻;
	$pageview = page2($rewrite);
	
} else {

	define('CURSCRIPT','news_index');
	$top_news	= mymps_get_news_list(18,'',0);//取得最新的18条新闻
	$hot_news	= mymps_get_news_list(20,'',0,false,1);//取得最新的推荐新闻
	$image_news = mymps_get_news_list(6,'',1,false);//取得最新的6条图文新闻
	
	$catquery = $db -> query("SELECT catid,catname,html_dir FROM `{$db_mymps}channel` WHERE parentid = '0' AND if_view = '2' ORDER BY catorder ASC");
	while($queryrow = $db -> fetchRow($catquery)){
		$_array['catid'] 	= $queryrow['catid'];
		$_array['catname'] 	= $queryrow['catname'];
		$_array['uri'] 		= Rewrite('news',array('catid'=>$queryrow['catid'],'html_dir'=>$queryrow['html_dir']));
		$channel[]		= $_array;
	}
	for($i=0; $i<count($channel); $i++){
		$do_sql = $db -> query("SELECT iscommend,id,title,catid,html_path,begintime,isjump,redirect_url FROM `{$db_mymps}news` WHERE catid IN(".get_cat_children($channel[$i]['catid'],'channel').") {$city_limit} ORDER BY begintime DESC LIMIT 0,8");
		while($row = $db -> fetchRow($do_sql)){
			$arr['id'] 			= $row['id'];
			$arr['iscommend'] 	= $row['iscommend'];
			$arr['title'] 		= $row['title'];
			$arr['begintime'] 	= $row['begintime'];
			$arr['uri']			= $row['isjump'] == 1 ? $row['redirect_url'] : Rewrite('news',array('id'=>$row['id'],'html_path'=>$row['html_path']));
			
			$channel[$i]['news'][] = $arr;
		}
	}
	
	$loc		= get_location('news',0,'Site News');
	$page_title = $loc['page_title'];
	$location	= $loc['location'];
	
	$s = array();
	$s['keywords'] = str_replace('{city}',$city['cityname'],$pluginsettings['news']['seokeywords']);
	$s['description'] = str_replace('{city}',$city['cityname'],$pluginsettings['news']['seodescription']);
	
	$advertisement	= get_advertisement('other');//获得全局广告
	$adveritems		= $city['advertisement'];
	$advertisement	= $advertisement['all'];
	
	$focus = $city['focus']['news'];
	$latest_info = mymps_get_info_list(10,'','','','','','','',false);
	$hot_member = mymps_get_member_list(12,3,'',1);

}

globalassign();
include mymps_tpl(CURSCRIPT);
is_object($db) && $db->Close();
exit();
?>
