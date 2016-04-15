<?php
define('IN_SMT',true);
define ('CURSCRIPT','category');
define('IN_MYMPS', true);
require_once dirname(__FILE__)."/include/global.php";
require_once MYMPS_DATA."/config.php";
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";
$catid		= isset($catid)    	? intval($catid) 	: 0;
$cityid		= isset($cityid)    ? intval($cityid) 	: 0;
$areaid		= isset($areaid)    ? intval($areaid) 	: 0;
$streetid	= isset($streetid)  ? intval($streetid) : 0;
$page		= isset($page)    	? intval($page) 	: 1;
ifsiteopen();
runcron();
$seo	 = $seo ? $seo : get_seoset();
$rewrite = $seo['seo_force_category'];
if($Catid && $rewrite == 'rewrite_py'){
	$detail=explode("-",$Catid);
	$dir_typename = $detail[0];
	$cat_dir = array_flip(get_category_dir());
	$catid = $cat_dir[$dir_typename];
	if($detail[1]){
		for($i=1;$i<count($detail) ;$i++ ){
			$_GET[$detail[$i]]=$$detail[$i]=str_replace(array('#@#','#!#'),array('-','/'),$detail[++$i]);	
		}
		extract($_GET);
	}
	$cat_dir = $Catid = $detail = NULL;
}elseif($CAtid && $rewrite == 'rewrite'){
	$detail=explode("-",$CAtid);
	$catid = $detail[1];
	if($detail[2]){
		for($i=2;$i<count($detail) ;$i++ ){
			$_GET[$detail[$i]]=$$detail[$i]=str_replace(array('#@#','#!#'),array('-','/'),$detail[++$i]);	
		}
		extract($_GET);
	}
	$CAtid = $detail = NULL;
}
!($cat = get_cat_info($catid)) && write_msg('The column you designated does not exist or is deleted!',$mymps_global['SiteUrl']);
$cat['caturi']	=  Rewrite('category',array('catid'=>$catid,'dir_typename'=>$cat['dir_typename']));
$allow_identifier = allow_identifier();
$allow_identifier = $allow_identifier[$cat['modid']]['identifier'];
$allow_identifier = is_array($allow_identifier) ? $allow_identifier : array();
$allow_identifiers = $rewrite == 'rewrite_py' ? array_merge(array('areaid','streetid'),$allow_identifier) : array_merge(array('catid','areaid','streetid'),$allow_identifier);
$city = get_city_caches($cityid);
if($mymps_global['cfg_independency'] && $cityid){
	$maincity = get_city_caches(0);
	$independency = explode(',',$mymps_global['cfg_independency']);
	$independency = is_array($independency) ? $independency : array();
	if(in_array('friendlink',$independency)){
		$city['flink'] = empty($city['flink']) ? $maincity['flink'] : $city['flink'];
	}
	if(in_array('topnav',$independency)){
		$city['topnav'] = empty($city['topnav']) ? $maincity['topnav'] : $city['topnav'];
	}
	if(in_array('advertisement',$independency)){
		$city['advertisement'] = empty($city['advertisement']) ? $maincity['advertisement'] : $city['advertisement'];
	}
	$maincity = NULL;
}
$cat['title']	= str_replace('{city}',$city['cityname'],$cat['title']);
$cat['keywords'] = str_replace('{city}',$city['cityname'],$cat['keywords']);
$cat['keywords'] = $cat['keywords'] ? $cat['keywords'] : $city['cityname'].$cat['catname'].'Post';
$cat['description'] = str_replace('{city}',$city['cityname'],$cat['description']);
$cat['description'] = $cat['description'] ? $cat['description'] : "$city[cityname]$cat[catname] channel provides you with information on $city[cityname]$cat[catname]. In here you will find lots of posts on $city[cityname]$cat[catname]for you to view, and you may also make post on $city[cityname] $cat[catname] for other to view.";
$mymps_extra_model = mod_identifier();
$mymps_extra_model = $mymps_extra_model[$cat['modid']];
$mymps_extra_model = is_array($mymps_extra_model) ? $mymps_extra_model : array();
$page_title_extra .= $city['area'][$areaid]['areaname'].$city['area'][$areaid]['street'][$streetid]['streetname'];
$cat_list   = get_categories_tree($catid);
$sq = $s = '';
if($cat['modid'] > 1){
	$s = " LEFT JOIN `{$db_mymps}information_{$cat[modid]}` AS g ON a.id = g.id";
	foreach ($$_request as $key => $val){
		if(in_array($key,$allow_identifier) && !empty($$key)){
			$sq .= " AND g.`$key` = '$val' ";
		}
	}
}
$cate_limit = " AND ".get_children($catid);
$city_limit 	= empty($city['cityid']) ? "": " AND a.cityid = '$city[cityid]'";
$city_limit    .= empty($areaid) ? "": " AND a.areaid = '$areaid'";
$city_limit    .= empty($streetid) ? "": " AND a.streetid = '$streetid'";
$orderby	= $cat['parentid'] == 0 ? " ORDER BY a.upgrade_type DESC,a.begintime DESC" : " ORDER BY a.upgrade_type_list DESC,a.begintime DESC";
$param		= setParam($allow_identifiers,$rewrite,'category-',$city['domain'].$seo['seo_htmldir'].$cat['html_dir']);
$rows_num   =  $db -> getOne("SELECT COUNT(a.id) FROM `{$db_mymps}information` AS a {$s} WHERE a.info_level > 0 {$sq}{$cate_limit}{$city_limit}");
$sql = "SELECT a.id,a.title,a.cityid,a.userid,a.contact_who,a.content,a.img_path,a.img_count,a.upgrade_type,a.upgrade_type_list,a.upgrade_time,a.upgrade_time_list,a.begintime,a.endtime,a.info_level,a.certify,a.ifred,a.ifbold,a.dir_typename,a.web_address,b.areaname FROM {$db_mymps}information AS a LEFT JOIN `{$db_mymps}area` AS b ON a.areaid = b.areaid {$s} WHERE 1 AND a.info_level > 0 {$sq}{$cate_limit}{$city_limit}{$orderby}";
$page1 = page1($sql,$mymps_global['cfg_list_page_line'] ? $mymps_global['cfg_list_page_line'] : 10);
$info_list = array();
foreach($page1 as $key => $val){
	$infolist['id']				= $val['id'];
	$infolist['begintime']		= get_format_time($val['begintime']);
	$infolist['endtime']		= get_format_time($val['endtime']);
	$infolist['isguoqi']		= get_info_life_time($val['endtime']) == '<font color=red>Expired</font>' ? 1 : 0;
	$infolist['isnew']			= $timestamp - $val['begintime'] < 43200 ? 1 : 0;
	$infolist['title']			= $val['title'];
	$infolist['ifred']			= $val['ifred'];
	$infolist['ifbold']			= $val['ifbold'];
	$infolist['img_count']		= $val['img_count'];
	$infolist['content']		= clear_html($val['content']);
	$infolist['areaname']		= $val['areaname'];
	$infolist['poster']			= !empty($val['userid']) ? '<a target="black" href='.Rewrite('space',array("user"=>$val["userid"])).'>'.$val["userid"].'</a>' : ($val['contact_who'] ? $val['contact_who'] : 'Guest');
	$infolist['img_path']		= $val['img_path'];
	$infolist['uri']			= $cityid ? Rewrite('info',array('id'=>$val['id'],'dir_typename'=>$val['dir_typename'],'domain'=>$city['domain'])) : Rewrite('info',array('id'=>$val['id'],'dir_typename'=>$val['dir_typename'],'cityid'=>$val['cityid']));
	$infolist['info_level']		= $val['info_level'];
	$infolist['upgrade_type']	= !$cat['parentid'] ? ($val['upgrade_time'] >= $timestamp ? $val['upgrade_type'] : 1):($val['upgrade_time_list'] >= $timestamp ? $val['upgrade_type_list'] : 1);
	$infolist['certify']		= $val['certify'];
	$infolist['web_address']	= $val['web_address'];
	$info_list[$val['id']]		= $infolist;
	$ids .= $val['id'].',';
}
$idin = $ids ? " AND a.id IN(".substr($ids,0,-1).")" : '';
$pageline = NULL;
$pageview	= page2($rewrite);
$advertisement	= get_advertisement('category');
$adveritems		= $city['advertisement'];
$advertisement['type']	= $advertisement['all'] ? (is_array($advertisement[$catid]['type']) ? array_merge($advertisement['all']['type'],$advertisement[$catid]['type']) : $advertisement['all']['type']): $advertisement[$catid]['type'];
switch($rewrite){
	case 'rewrite':
		foreach($mymps_extra_model as $key => $val){
			if(is_array($val['list'])){
				foreach($val['list'] as $k => $v){
					$mymps_extra_model[$key]['list'][$k]['uri'] = 'category';
					foreach($allow_identifiers as $keys){
						if($v['identifier'] == $keys){
							$mymps_extra_model[$key]['list'][$k]['uri'] .= $v[id] ? '-'.$keys.'-'.$v[id] : '';
						}else{
							$mymps_extra_model[$key]['list'][$k]['uri'] .= $$keys ? '-'.$keys.'-'.$$keys : '';
						}
					}
					$mymps_extra_model[$key]['list'][$k]['uri'] .= '.html';
					if($v['id'] == $$v['identifier']){
						$mymps_extra_model[$key]['list'][$k]['select'] .= 1;
						$page_title_extra .= $v[name] != 'Any' ? $v[name] : '';//网页标题
					} else{
						$mymps_extra_model[$key]['list'][$k]['select'] .= 0;
					}
				}
			}
		}
	
		if($city['cityid']){
			$area_list = $city['area'];
			if($areaid){
				$street_list = $city['area'][$areaid]['street'];
				if($street_list && is_array($street_list)){
					foreach($street_list as $key => $val){
						$street_list[$key]['uri'] = 'category';
						foreach($allow_identifiers as $keys){
							if($keys == 'streetid'){
								$street_list[$key]['uri'] .=  $val['streetid'] ? '-'.$keys.'-'.$val[streetid] : '';
							} else {
								$street_list[$key]['uri'] .= $$keys ? '-'.$keys.'-'.$$keys : '';
							}
						}
						$street_list[$key]['uri'] .= '.html';
						$street_list[$key]['select'] = $val['streetid'] == $streetid ? '1' : 0;
					}
				}
			}
			if(is_array($area_list)){
				$streetid = '';
				$area_list = array_merge(array('0'=>array('areaid'=>'0','areaname'=>'Any')),$area_list);
				foreach($area_list as $key => $val){
					$area_list[$key]['uri'] = 'category';
					foreach($allow_identifiers as $keys){
						if($keys == 'areaid'){
							$area_list[$key]['uri'] .=  $val['areaid'] ? '-'.$keys.'-'.$val[areaid] : '';
						} else {
							$area_list[$key]['uri'] .= $$keys ? '-'.$keys.'-'.$$keys : '';
						}
					}
					$area_list[$key]['uri'] .= '.html';
					$area_list[$key]['select'] = $val['areaid'] == $areaid ? '1' : 0;
				}
			}
		}
	break;
	case 'rewrite_py':
		foreach($mymps_extra_model as $key => $val){
			if(is_array($val['list'])){
				foreach($val['list'] as $k => $v){
					$mymps_extra_model[$key]['list'][$k]['uri'] = $dir_typename;
					foreach($allow_identifiers as $keys){
						if($v['identifier'] == $keys){
							$mymps_extra_model[$key]['list'][$k]['uri'] .= $v['id'] ? '-'.$keys.'-'.$v[id] : '';
						}else{
							$mymps_extra_model[$key]['list'][$k]['uri'] .= $$keys ? '-'.$keys.'-'.$$keys : '';
						}
					}
					$mymps_extra_model[$key]['list'][$k]['uri'] .= '/';
					if($v['id'] == $$v['identifier']){
						$mymps_extra_model[$key]['list'][$k]['select'] .= 1;
						$page_title_extra .= $v['name'] != 'Any' ? $v['name'] : '';//网页标题
					} else{
						$mymps_extra_model[$key]['list'][$k]['select'] .= 0;
					}
				}
			}
		}
		if($city['cityid']){
			$area_list = $city['area'];
			if($areaid){
				$street_list = $city['area'][$areaid]['street'];
				if($street_list && is_array($street_list)){
					foreach($street_list as $key => $val){
						$street_list[$key]['uri'] = $dir_typename;
						foreach($allow_identifiers as $keys){
							if($keys == 'streetid'){
								$street_list[$key]['uri'] .=  $val['streetid'] ? '-'.$keys.'-'.$val[streetid] : '';
							} else {
								$street_list[$key]['uri'] .= $$keys ? '-'.$keys.'-'.$$keys : '';
							}
						}
						$street_list[$key]['uri'] .= '/';
						$street_list[$key]['select'] = $val['streetid'] == $streetid ? '1' : 0;
					}
				}
			}
			if(is_array($area_list)){
				$streetid = '';
				$area_list = array_merge(array('0'=>array('areaid'=>'0','areaname'=>'Any')),$area_list);
				foreach($area_list as $key => $val){
					$area_list[$key]['uri'] = $dir_typename;
					foreach($allow_identifiers as $keys){
						if($keys == 'areaid'){
							$area_list[$key]['uri'] .=  $val['areaid'] ? '-'.$keys.'-'.$val[areaid] : '';
						} else {
							$area_list[$key]['uri'] .= $$keys ? '-'.$keys.'-'.$$keys : '';
						}
					}
					$area_list[$key]['uri'] .= '/';
					$area_list[$key]['select'] = $val['areaid'] == $areaid ? '1' : 0;
				}
			}
		}
	break;
	default:
		foreach($mymps_extra_model as $key => $val){
			if(is_array($val['list'])){
				foreach($val['list'] as $k => $v){
					$mymps_extra_model[$key]['list'][$k]['uri'] = 'category.php?';
					foreach($allow_identifiers as $keys){
						if($v['identifier'] == $keys){
							$mymps_extra_model[$key]['list'][$k]['uri'] .= $v['id'] ? $keys.'='.$v[id].'&' : '';
						} else {
							$mymps_extra_model[$key]['list'][$k]['uri'] .= $$keys ? $keys.'='.$$keys.'&' : '';
						}
					}
					$mymps_extra_model[$key]['list'][$k]['uri'] = substr($mymps_extra_model[$key]['list'][$k]['uri'],0,-1);
					if($v[id] == $$v[identifier]){
						$mymps_extra_model[$key]['list'][$k]['select'] .= 1;
						$page_title_extra .= $v[name] != 'Any' ? $v[name] : '';//网页标题
					} else{
						$mymps_extra_model[$key]['list'][$k]['select'] .= 0;
					}
				}
			}
		}
		if($city['cityid']){
			$area_list = $city['area'];
			if($areaid){
				$street_list = $city['area'][$areaid]['street'];
				if($street_list && is_array($street_list)){
					foreach($street_list as $key => $val){
						$street_list[$key]['uri'] = 'category.php?';
						foreach($allow_identifiers as $keys){
							if($keys == 'streetid'){
								$street_list[$key]['uri'] .=  $val['streetid'] ? $keys.'='.$val[streetid].'&' : '';
							} else {
								$street_list[$key]['uri'] .= $$keys ? $keys.'='.$$keys.'&' : '';
							}
						}
						$street_list[$key]['uri'] = substr($street_list[$key]['uri'],0,-1);
						$street_list[$key]['select'] = $val['streetid'] == $streetid ? '1' : 0;
					}
				}
			}
			if(is_array($area_list)){
				$streetid = '';
				$area_list = array_merge(array('0'=>array('areaid'=>'0','areaname'=>'Any')),$area_list);
				foreach($area_list as $key => $val){
					$area_list[$key]['uri'] = 'category.php?';
					foreach($allow_identifiers as $keys){
						if($keys == 'areaid'){
							$area_list[$key]['uri'] .=  $val['areaid'] ? $keys.'='.$val[areaid].'&' : '';
						} else {
							$area_list[$key]['uri'] .= $$keys ? $keys.'='.$$keys.'&' : '';
						}
					}
					$area_list[$key]['uri'] = substr($area_list[$key]['uri'],0,-1);
					$area_list[$key]['select'] = $val['areaid'] == $areaid ? '1' : 0;
				}
			}
		}
	break;
}
$pdetail = $page_title_extra.($cat['title']?$cat['title']:$cat['catname']);
$pdetail .= $page>1 ? ' - Page '.$page.'~' : '';
$pdetail .= ' - '.$city['cityname'].$mymps_global['SiteName'];
$pdetail = $city['cityname'].$pdetail;//单独显示标题
$loc = get_location('category',$catid,'','',$pdetail);
$page_title = $loc['page_title'];
$location	= $loc['location'];
if($cat['parentid']>0){
	$flag = array_reverse(get_parent_cats('category',$catid));
	$cat['parentid'] = $flag[0]['catid'];
}
$hotcities = get_hot_cities();
$hotcities = is_array($hotcities) ? $hotcities : array();
$allow_identifier=$allow_identifer[$cat['modid']]['identifier'];
$description = $cat['description'] ? strip_tags($cat['description']) : $cat['catname'];
$keywords = $cat['keywords']?$cat['keywords']:$cat['catname'];
$friendlink = $city['flink'][$cat['catid']];
globalassign();
include mymps_tpl($cat['template'] ? $cat['template'] : 'list');
is_object($db) && $db->Close();
$city = $maincity = $info_list = $advertisement = NULL;
unset($city,$maincity,$info_list,$advertisement);
exit;
?>