<?php
foreach($_GET as $_key => $_value) {
	$_key{0} != '_' && $$_key = mhtmlspecialchars(maddslashes($_value));
}

$catid = isset($catid) ? intval($catid) : 0;
$areaid = isset($areaid) ? intval($areaid) : 0;
$streetid = isset($streetid) ? intval($streetid) : 0;
$page = isset($page) ? intval($page) : 1;
$cat_list   = get_categories_tree($catid);

if(empty($catid)){
	include mymps_tpl('category_all');
	exit;
}

if(!$cat = get_cat_info($catid)){
	errormsg('The column you requested either does not exist or deleted!');
}

//手机版每页显示记录
$perpage = $mobile_settings['mobiletopicperpage'] ? $mobile_settings['mobiletopicperpage'] : 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : '';
$page = empty($page) ? 1 : $page;

//筛选字段
$allow_identifier = allow_identifier();
$allow_identifier = $allow_identifier[$cat['modid']]['identifier'];
$allow_identifier = is_array($allow_identifier) ? $allow_identifier : array();
$allow_identifiers = array_merge(array('mod','catid','cityid','areaid','streetid'),$allow_identifier);

//字段筛选
$mymps_extra_model = mod_identifier();
$mymps_extra_model = $mymps_extra_model[$cat['modid']];
$mymps_extra_model = is_array($mymps_extra_model) ? $mymps_extra_model : array();
foreach($mymps_extra_model as $key => $val){
	if(is_array($val['list'])){
		foreach($val['list'] as $k => $v){
			$mymps_extra_model[$key]['list'][$k]['uri'] = 'index.php?mod=category&cityid='.$cityid;
			foreach($allow_identifiers as $keys){
				if($v['identifier'] == $keys){
					$mymps_extra_model[$key]['list'][$k]['uri'] .= $v['id'] ? '&'.$keys.'='.$v['id'] : '';
				} else {
					$mymps_extra_model[$key]['list'][$k]['uri'] .= $$keys ? '&'.$keys.'='.$$keys : '';
				}
			}
			if($v['id'] == $$v['identifier']){
				$mymps_extra_model[$key]['list'][$k]['select'] .= 1;
			} else{
				$mymps_extra_model[$key]['list'][$k]['select'] .= 0;
			}
		}
	}
}

//分类筛选
$parentcats = get_parent_cats('category',$catid);
$parentcats = is_array($parentcats) ? array_reverse($parentcats) : '';

//构造SQL
$sq = $s = '';
if($cat['modid'] > 1){
	$s = "LEFT JOIN `{$db_mymps}information_{$cat[modid]}` AS g ON a.id = g.id";
	foreach ($_GET as $key => $val){
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

$param		= setparams($allow_identifiers);

$rows_num 	= $cat['totalnum'] =  $db -> getOne("SELECT COUNT(a.id) FROM `{$db_mymps}information` AS a {$s} WHERE a.info_level > 0 {$sq}{$cate_limit}{$city_limit}");
$totalpage = ceil($rows_num/$perpage);
$num = intval($page-1)*$perpage;

$idin = get_page_idin("id","SELECT a.id FROM `{$db_mymps}information` AS a {$s} WHERE a.info_level > 0 {$sq}{$cate_limit}{$city_limit}{$orderby}",$perpage);

$idin = $idin ? " AND a.id IN (".$idin.") " : "";

$sql = "SELECT a.* FROM {$db_mymps}information AS a WHERE 1 {$idin} {$orderby}";

$infolist = $idin ? $db -> getAll($sql) : array();
foreach($infolist as $k => $row){
	$arr['id']              = $row['id'];
	$arr['title']           = $row['title'];
	$arr['hit']             = $row['hit'];
	$arr['img_path']        = $row['img_path'];
	$arr['img_count']       = $row['img_count'];
	$arr['upgrade_type']    = $row['upgrade_type'];
	$arr['upgrade_type_list']= $row['upgrade_type_list'];
	$arr['contact_who']     = $row['contact_who'];
	$arr['web_address']     = $row['web_address'];
	$arr['content']	        = $row['content'];
	$arr['begintime']       = $row['begintime'];
	$info_list[$row['id']]	= $arr;
	$ids .= $row['id'].',';
}	
if($cat['modid'] > 1 && $idin) {
	$des = get_info_option_array();
	$extra = $db ->getAll("SELECT a.* FROM `{$db_mymps}information_{$cat[modid]}` AS a WHERE 1 {$idin}"); 
	foreach($extra as $k => $v){
		unset($v['iid']);
		unset($v['content']);
		foreach($v as $u => $w){
			$g = get_info_option_titval($des[$u],$w);
			if($u != 'id' && !is_numeric($u)) $info_list[$v['id']]['extra'][$u] = $g['value'];
		}
	}
}

$pageline = NULL;
$pageview	= page2($rewrite);

//地区分类
if($city['cityid']){
	$area_list = $db->getAll("SELECT * FROM `{$db_mymps}area` WHERE cityid = '$cityid'");
	$area_list = $area_list ? $area_list : '';
	if($areaid){
		$street_list = $db->getAll("SELECT * FROM `{$db_mymps}street` WHERE areaid = '$areaid'");
		if($street_list && is_array($street_list)){
			foreach($street_list as $key => $val){
				$street_list[$key]['uri'] = 'index.php?mod=category&cityid='.$cityid;
				foreach($allow_identifiers as $keys){
					if($keys == 'streetid'){
						$street_list[$key]['uri'] .=  $val['streetid'] ? '&'.$keys.'='.$val['streetid'] : '';
					} else {
						$street_list[$key]['uri'] .= $$keys ? '&'.$keys.'='.$$keys : '';
					}
				}
				$street_list[$key]['select'] = $val['streetid'] == $streetid ? '1' : 0;
			}
		}
	}
	if(is_array($area_list)){
		$streetid = '';
		$area_list = array_merge(array('0'=>array('areaid'=>'0','areaname'=>'Any')),$area_list);
		foreach($area_list as $key => $val){
			$area_list[$key]['uri'] = 'index.php?mod=category&cityid='.$cityid;
			foreach($allow_identifiers as $keys){
				if($keys == 'areaid'){
					$area_list[$key]['uri'] .=  $val['areaid'] ? '&'.$keys.'='.$val['areaid'] : '';
				} else {
					$area_list[$key]['uri'] .= $$keys ? '&'.$keys.'='.$$keys : '';
				}
			}
			$area_list[$key]['select'] = $val['areaid'] == $areaid ? '1' : 0;
		}
	}
}else{
	$hotcities = get_hot_cities();	
}

include mymps_tpl('category_list');

function maddslashes($string, $force = 0) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = maddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}
?>
