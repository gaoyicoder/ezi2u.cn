<?php
define('CURSCRIPT','area');
require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$mympsdirectory = array('admin','api','attachment','backup','data','html','images','include','install','member','mypub','plugin','public','rewrite','template','uc_client');

$part = $part ? $part : 'list';
if(!submit_check(CURSCRIPT.'_submit')){
	
	if($part == 'list'){
		
		chk_admin_purview("purview_Built State-site");
		
		if($areaid){
			$areaid = intval($areaid);
			$currentname = $db -> getOne("SELECT areaname FROM `{$db_mymps}area` WHERE areaid = '$areaid'");
			$list = $db -> getAll("SELECT * FROM `{$db_mymps}street` WHERE areaid = '$areaid' ORDER BY displayorder ASC");
		} elseif($cityid) {
			$cityid = intval($cityid);
			$currentname = $db -> getOne("SELECT cityname FROM `{$db_mymps}city` WHERE cityid = '$cityid'");
			$list = $db -> getAll("SELECT * FROM `{$db_mymps}area` WHERE cityid = '$cityid' ORDER BY displayorder ASC");
		} else {
		
			$keywords = trim($keywords);
			$showperpage = intval($showperpage);
			if($keywords){
				if($type == 'cityid'){
					$where = " AND cityid = '$keywords'";
				} elseif($type == 'directory') {
					$where = " AND directory = '$keywords'";
				} elseif($type == 'cityname'){
					$where = " AND cityname = '$keywords'";
				} elseif($type == 'provincename'){
					$provinceid = $db -> getOne("SELECT provinceid FROM `{$db_mymps}province` WHERE provincename = '$keywords'");
					if($provinceid) $where = " AND provinceid = '$provinceid'";
				} else {
					$where = "";
				}
			}
			
			$province = $db -> getAll("SELECT * FROM `{$db_mymps}province` ORDER BY displayorder ASC");
			
			$param = setParam(array('part','keywords','type','showperpage'));
				
			$rows_num = $db->getOne("SELECT count(cityid) FROM `{$db_mymps}city` WHERE 1 {$where} ORDER BY displayorder ASC");
				
			$list = page1("SELECT * FROM `{$db_mymps}city` WHERE 1 {$where} ORDER BY displayorder ASC",$showperpage);
		}

		$here = "List of Districts";
		
		include(mymps_tpl("area_list"));
		
	} elseif($part == 'area_city_add'){
	
		chk_admin_purview("purview_Add State-site");
	
		if($action == 'batch'){
			$step = $step ? intval($step) : 1;
			if($step == 1) $province = $db -> getAll("SELECT * FROM `{$db_mymps}province` ORDER BY displayorder ASC");
			$here = 'Add Sub-sites By Batches';
			include(mymps_tpl("area_city_add_batch"));
		} else {
			$here = 'Add Single Sub-site';
			$province = $db -> getAll("SELECT * FROM `{$db_mymps}province` ORDER BY displayorder ASC");
			include(mymps_tpl("area_city_add"));
		}
		
	} elseif($part == 'area_add'){
		chk_admin_purview("purview_Add District");
		$here = "Add area";
		$city_area = get_city_area();
		include(mymps_tpl("area_add"));
	} elseif($part == 'area_street_add'){
		chk_admin_purview("purview_Add Section");
		$here = "Add street";
		$city_area = get_city_area();
		include(mymps_tpl("area_street_add"));
	} elseif($part == 'edit' && $cityid){
		
		$cityid = intval($cityid);
		$city = $db->getRow("SELECT * FROM {$db_mymps}city WHERE cityid = '$cityid'");
		if(!$city) write_msg('The city sub-site you selected does not exist!');
		
		$province = $db -> getAll("SELECT * FROM `{$db_mymps}province` ORDER BY displayorder ASC");
		$here = "Edit City Sub-site";
		
		include(mymps_tpl("area_city_edit"));
		
	} elseif($part == 'del' && $cityid){
		
		DelCity($cityid);
		clear_cache_files('changecity_cities');
		clear_cache_files('changeprovince_cities');
		clear_cache_files('city_'.$cityid);
		clear_cache_files('citysiteabout_'.$cityid);
		clear_cache_files('allcities');
		clear_cache_files('hot_cities');
		write_msg("City sub-site numbered".$cityid."has successfully been deleted!","?part=list","Mymps_record");
		
	} elseif($part == 'makealldir'){
		$r = $db->getAll("SELECT cityid,directory FROM `{$db_mymps}city`");
		foreach($r as $k => $v){
			write_city_file($mymps_global['cfg_citiesdir'],$v['cityid'],$v['directory']);
		}
		write_msg('List of all sub-sites has been created!','area.php','write_record');
	} elseif($part == 'delalldir'){
		$directory = $db->getAll("SELECT directory FROM `{$db_mymps}city`");
		foreach($directory as $k => $v){
			if(empty($mymps_global['cfg_citiesdir']) && in_array($v,$mympsdirectory)){	
			} elseif($v['directory'] && !in_array($v['directory'],$mympsdirectory)) {
				DelDir(MYMPS_ROOT.$mymps_global['cfg_citiesdir'].'/'.$v['directory']);
			}
		}
		write_msg('List of all sub-sites has been deleted!','area.php','write_record');
	} elseif($part == 'usedomain'){
		$query=$db->query("SELECT * FROM `{$db_mymps}city`");
		while($row=$db->fetchRow($query)){
			$domaina = str_replace('http://www.','',$mymps_global['SiteUrl']);
			$domain = 'http://'.$row[directory].'.'.$domaina.'/';
			$db->query("UPDATE `{$db_mymps}city` SET domain = '$domain' WHERE cityid = '$row[cityid]'");
			$domain = NULL;
		}
		clear_cache_files('allcities');
		clear_cache_files('hot_cities');
		clear_cache_files('changecity_cities');
		write_msg('Second-level domain has been enabled for all sub-sites!','area.php','write_record');
	} elseif($part == 'usenodomain'){
		$db->query("UPDATE `{$db_mymps}city` SET domain = ''");
		clear_cache_files('allcities');
		clear_cache_files('hot_cities');
		clear_cache_files('changecity_cities');
		write_msg('Second-level domain has been disabled for all sub-sites!','area.php','write_record');
	}
	
} else {
	
	$return = $url ? $url : 'area.php';
	
	if(is_array($batchnew) && $step == 1){
		$displayorder = $db -> getOne("SELECT max(displayorder) FROM `{$db_mymps}city`");
		if(empty($batchnew['cityname'])) write_msg('City name for sub-site cannot be empty, and to input more cities, please separate each city with | .');
		$batchnew['cityname'] = trim($batchnew['cityname']);
		include dirname(__FILE__).'/include/pinyin.inc.php';
		foreach(explode('|',$batchnew['cityname']) as $k => $v){
			if(!$db -> getOne("SELECT cityid FROM `{$db_mymps}city` WHERE cityname = '$v'")){
				$displayorder = $displayorder + 1;
				$arr['provinceid']  = $provinceid;
				$arr['cityname']    = $v;
				$arr['citypy'] 	    = GetPinyin($v);
				$arr['directory']   = GetPinyin($v,1);
				$arr['directory'] 	= ($db -> getOne("SELECT cityid FROM `{$db_mymps}city` WHERE directory = '$arr[directory]'")) ? $arr['citypy'] : $arr['directory'];//检测城市目录名是否重复
				$arr['firstletter'] = substr($arr['citypy'],0,1);
				$arr['domain'] 		= '';
				$arr['displayorder']= $displayorder;
				$array[] = $arr;
			} else {
				$repeatwarning .= '<font color=red>'.$v.'</font> ';
			}
		}
		$repeatwarning .= $repeatwarning ? 'Repeated records found and omitted by system' : '';
		
		$here = "Add Sub-site By Batches";
		$step = 2;
		$provincename = $db -> getOne("SELECT provincename FROM `{$db_mymps}province` WHERE provinceid = '$batchnew[provinceid]'");
		include(mymps_tpl("area_city_add_batch"));
		$displayorder = NULL;
		exit;
	}
	
	if($step == 2 && is_array($batchnewcityname) && is_array($batchnewdirectory)){
		$batchnewprovinceid = intval($batchnewprovinceid);

		foreach($batchnewcityname AS $key => $q) {
			$batch_newcityname	= trim($q);
			$batch_newdirectory 	= mhtmlspecialchars(trim($batchnewdirectory[$key]));
			$batch_newcitypy  	= mhtmlspecialchars(trim($batchnewcitypy[$key]));
			$batch_newfirstletter= mhtmlspecialchars(trim($batchnewfirstletter[$key]));
			$batch_newdisplayorder = mhtmlspecialchars(trim($batchnewdisplayorder[$key]));
			$batch_newdomain		= mhtmlspecialchars(trim($batchnewdomain[$key]));
			$batch_newifhot		= mhtmlspecialchars(trim($batchnewifhot[$key]));
			if($batch_newcityname && $batch_newdirectory) {
				$db -> query("INSERT INTO `{$db_mymps}city` (provinceid,cityname,citypy,displayorder,directory,domain,firstletter,ifhot) VALUES ('$batchnewprovinceid','$batch_newcityname','$batch_newcitypy','$batch_newdisplayorder','$batch_newdirectory','$batch_newdomain','$batch_newfirstletter','$batch_newifhot')");
				write_city_file($mymps_global['cfg_citiesdir'],$db->insert_id(),$batch_newdirectory);
			}
		}
		clear_cache_files('allcities');
		clear_cache_files('changecity_cities');
		clear_cache_files('changeprovince_cities');
		clear_cache_files('hot_cities');
		write_msg('Designated Sub-sites has successfully been added by batches! ','area.php');
		exit;
	}
	
	if(is_array($actiondir)){
		switch($action){
			case 'mkdir':
				foreach($actiondir as $k => $v){
					write_city_file($mymps_global['cfg_citiesdir'],$k,$v);
				}
			break;
			case 'deldir':
				foreach($actiondir as $k => $v){
					if(empty($mymps_global['cfg_citiesdir']) && in_array($v,$mympsdirectory)){
						
					} elseif($v && !in_array($v,$mympsdirectory)) {
						DelDir(MYMPS_ROOT.$mymps_global['cfg_citiesdir'].'/'.$v);
					}
				}
			break;
			case 'delcity':
				foreach($actiondir as $k => $v){
					DelCity($k);
					clear_cache_files('city_'.$k);
					clear_cache_files('citysiteabout_'.$k);
				}
				clear_cache_files('changecity_cities');
				clear_cache_files('changeprovince_cities');
				clear_cache_files('allcities');
				clear_cache_files('hot_cities');
				write_msg("Designated sub-site has successfully been deleted!","area.php");
			break;
			default:
				write_msg('Please select the operation you desire.');
			break;
		}
		clear_cache_files('allcities');
		clear_cache_files('changecity_cities');
		clear_cache_files('changeprovince_cities');
		clear_cache_files('hot_cities');
		write_msg('Sub-site directory files '.($action == 'mkdir' ? 'batched creation' : 'batched deletion').'is successful. 。',$return,'write_record');
	}
	
	if(is_array($citynew)){
		
		empty($citynew['cityname']) && write_msg('Name of the city sub-site should not be empty!');
		empty($citynew['firstletter']) && write_msg('The initials cannot be empty!');
		empty($citynew['directory']) && write_msg('Directory for saved files cannot be empty! ');
		empty($citynew['citypy']) && write_msg('City name in English cannot be empty!');
		
		$citynew['provinceid'] = intval($citynew['provinceid']);
		$citynew['cityname'] = trim($citynew['cityname']);
		$citynew['firstletter'] = trim($citynew['firstletter']);
		$citynew['direcoty'] = trim($citynew['direcoty']);
		$citynew['domain'] = trim($citynew['domain']);
		$citynew['citypy'] = trim($citynew['citypy']);
		$citynew['title'] = trim($citynew['title']);
		$citynew['keywords'] = trim($citynew['keywords']);
		$citynew['description'] = trim($citynew['description']);
		
		if($db -> getOne("SELECT count(cityid) FROM `{$db_mymps}city` WHERE directory = '$citynew[directory]'") > 0){
			write_msg($citynew['directory'].' Repeated directory, please try again using another directory!');
		}
		
		if($db -> getOne("SELECT count(cityid) FROM `{$db_mymps}city` WHERE cityname = '$citynew[cityname]'") > 0){
			write_msg($citynew['cityname'].' Repeated city sub-site, please check if this sub-site has already been added!');
		}
		
		if(empty($mymps_global['cfg_citiesdir']) && in_array($citynew['directory'],$mympsdirectory)){
			write_msg('This directory  <b>'.$citynew[directory].'</b> is the same as a reserved directory by mymps;<br /><br />please try again with another directory');
		}
		
		$db -> query("INSERT INTO `{$db_mymps}city` (provinceid,cityname,citypy,displayorder,directory,mappoint,domain,firstletter,ifhot,title,keywords,description) VALUES ('$citynew[provinceid]','$citynew[cityname]','$citynew[citypy]','$citynew[displayorder]','$citynew[directory]','$citynew[mappoint]','$citynew[domain]','$citynew[firstletter]','$citynew[ifhot]','$citynew[title]','$citynew[keywords]','$citynew[description]')");
		$cid = $db->insert_id();
		write_city_file($mymps_global['cfg_citiesdir'],$cid,$citynew['directory']);
		clear_cache_files('changecity_cities');
		clear_cache_files('changeprovince_cities');
		clear_cache_files('hot_cities');
		clear_cache_files('allcities');
		clear_cache_files('city_'.$cid);
		write_msg('The city sub-site '.$citynew["cityname"].' has successfully been created!',$return,'Mymps_record');
	}
	
	if(is_array($cityedit)) {
		
		empty($cityedit['cityname']) && write_msg('Name of the city sub-site should not be empty!');
		empty($cityedit['firstletter']) && write_msg('The initials cannot be empty!');
		empty($cityedit['directory']) && write_msg('Directory for saved files cannot be empty! ');
		empty($cityedit['citypy']) && write_msg('City name in English cannot be empty!');
		
		$cityedit['provinceid'] = intval($cityedit['provinceid']);
		$cityedit['cityname'] = trim($cityedit['cityname']);
		$cityedit['firstletter'] = trim($cityedit['firstletter']);
		$cityedit['direcoty'] = trim($cityedit['direcoty']);
		$cityedit['domain'] = trim($cityedit['domain']);
		$cityedit['citypy'] = trim($cityedit['citypy']);
		$cityedit['title'] = trim($cityedit['title']);
		$cityedit['keywords'] = trim($cityedit['keywords']);
		$cityedit['description'] = trim($cityedit['description']);
		
		/*if($db -> getOne("SELECT count(cityid) FROM `{$db_mymps}city` WHERE directory = '$cityedit[directory]' AND cityid != '$cityid'") > 0){
			write_msg($cityedit['directory'].' 目录名重复，请换一个目录名后再试!');
		}*/
		
		if(empty($mymps_global['cfg_citiesdir']) && in_array($cityedit['directory'],$mympsdirectory)){
			write_msg('This directory <b>'.$cityedit[directory].'</b> is the same as a reserved directory by mymps;<br /><br />please try again with another directory');
		}
		
		$db -> query("UPDATE `{$db_mymps}city` SET provinceid = '$cityedit[provinceid]',cityname = '$cityedit[cityname]' , citypy = '$cityedit[citypy]' , displayorder = '$cityedit[displayorder]' , directory = '$cityedit[directory]' , mappoint = '$cityedit[mappoint]' , domain = '$cityedit[domain]' , firstletter = '$cityedit[firstletter]' , ifhot = '$cityedit[ifhot]', title = '$cityedit[title]', keywords = '$cityedit[keywords]', description = '$cityedit[description]' WHERE cityid = '$cityid'");
		$cityedit['olddirectory'] != $cityedit['directory'] && DelDir(MYMPS_ROOT.'/c/'.$cityedit['olddirectory']);
		clear_cache_files('allcities');
		clear_cache_files('changecity_cities');
		clear_cache_files('changeprovince_cities');
		clear_cache_files('hot_cities');
		write_city_file($mymps_global['cfg_citiesdir'],$cityid,$cityedit['directory']);
		
		clear_cache_files('city_'.$cityid);
		write_msg('The city sub-site '.$cityedit[cityname].' has successfully been edited!','area.php?part=edit&cityid='.$cityid,'mymps');
	}
	
	if(is_array($newarea)){
		empty($newarea['cityid']) && write_msg('Please select the city sub-site it is from!');
		foreach(explode('|',trim($newarea['areaname'])) as $k => $v){
			$newarea['displayorder'] ++;
			$len = strlen($v);
			if($len < 2 || $len > 30){
				write_msg("District name must be between 2 and 30 characters in length!");
			}
			$db -> query("INSERT INTO `{$db_mymps}area` (areaname,cityid,displayorder)VALUES('$v','$newarea[cityid]','$newarea[displayorder]')");
			clear_cache_files('city_'.$newarea[cityid]);
		}
		
		write_msg('District of sub-site has successfully been added!','area.php?cityid='.$newarea[cityid],'Mymps_record');
	}
	
	if(is_array($newstreet)){
		empty($newstreet['areaid']) && write_msg('Please select the district of sub-site it is from!');
		foreach(explode('|',trim($newstreet['streetname'])) as $k => $v){
			$newarea['newstreet'] ++;
			$len = strlen($v);
			if($len < 2 || $len > 30){
				write_msg("Road name must be between 2 and 30 characters in length!");
			}
			$db -> query("INSERT INTO `{$db_mymps}street` (streetname,areaid,displayorder)VALUES('$v','$newstreet[areaid]','$newarea[newstreet]')");
			clear_cache_files('city_'.$newstreet[cityid]);
		}
		write_msg('Road/section has successfully been added!','area.php?areaid='.$newstreet[areaid].'&cityid='.$cityid.'&cityname='.$cityname,'Mymps_record');
	}
	
	if(is_array($updatecity_displayorder)){
		foreach($updatecity_displayorder as $k => $v){
			$db -> query("UPDATE `{$db_mymps}city` SET displayorder = '$v' WHERE cityid = '$k'");
		}
		clear_cache_files('changecity_cities');
		clear_cache_files('changeprovince_cities');
		clear_cache_files('hot_cities');
	}
	
	if(is_array($updatearea_areaname)){
		$return = 'area.php?cityid='.$cityid;
		foreach($updatearea_areaname as $k => $v){
			$db -> query("UPDATE `{$db_mymps}area` SET areaname = '$v' WHERE areaid = '$k'");
		}
	}
	
	if(is_array($updatearea_displayorder)){
		$return = 'area.php?cityid='.$cityid;
		foreach($updatearea_displayorder as $k => $v){
			$db -> query("UPDATE `{$db_mymps}area` SET displayorder = '$v' WHERE areaid = '$k'");
		}
	}
	
	if(is_array($updatestreet_displayorder)){
		$return = 'area.php?cityid='.$cityid.'&areaid='.$areaid.'&cityname='.$cityname;
		foreach($updatestreet_displayorder as $k => $v){
			$db -> query("UPDATE `{$db_mymps}street` SET displayorder = '$v' WHERE streetid = '$k'");
		}
	}
	
	if(is_array($updatestreet_streetname)){
		$return = 'area.php?cityid='.$cityid.'&areaid='.$areaid.'&cityname='.$cityname;
		foreach($updatestreet_streetname as $k => $v){
			$db -> query("UPDATE `{$db_mymps}street` SET streetname = '$v' WHERE streetid = '$k'");
		}	
	}
	
	if(is_array($deletestreetid)){
		$return = 'area.php?cityid='.$cityid.'&areaid='.$areaid.'&cityname='.$cityname;
		$db -> query("DELETE FROM `{$db_mymps}street` WHERE ".create_in($deletestreetid,'streetid'));
	}
	
	if(is_array($deleteareaid)){
		$return = 'area.php?cityid='.$cityid;
		$db -> query("DELETE FROM `{$db_mymps}street` WHERE ".create_in($deleteareaid,'areaid'));
		$db -> query("DELETE FROM `{$db_mymps}area` WHERE ".create_in($deleteareaid,'areaid'));
	}
	
	write_msg('分站地区更新成功！',$return,'Mymps_record');
	
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();

function get_city_area($areaid=''){
	global $db,$db_mymps;
	$query = $db -> query("SELECT * FROM {$db_mymps}city ORDER BY displayorder ASC");
	while($row = $db -> fetchRow($query)){
		$list[$row['cityid']]['cityid'] = $row['cityid'];
		$list[$row['cityid']]['cityname'] = $row['cityname'];
		$list[$row['cityid']]['displayorder'] = $row['displayorder'];
		$list[$row['cityid']]['domain'] = $row['domain'];
		$list[$row['cityid']]['directory'] = $row['directory'];
		$list[$row['cityid']]['firstletter'] = $row['firstletter'];
	}
	$query = $db -> query("SELECT * FROM `{$db_mymps}area` ORDER BY displayorder ASC");
	while($row = $db -> fetchRow($query)){
		$list[$row['cityid']]['area'][$row['areaid']]['areaid'] = $row['areaid'];
		$list[$row['cityid']]['area'][$row['areaid']]['areaname'] = $row['areaname'];
	}
	return $list;
}

function write_city_file($dirname,$cityid,$directory){
	global $mympsdirectory,$mymps_global,$db,$db_mymps;
	if(!$cityid){
		return ;
	}
	if(empty($dirname)){
		$p = '';
		if(in_array($directory,$mympsdirectory)){
			write_msg('This directory <b>'.$directory.'</b> is the same as a reserved directory by mymps;<br /><br />please try again with another directory');
			exit;
		}
	} else {
		$p = '../';
	}
	$dirname = $dirname.'/'.$directory;
	if(!createdir(MYMPS_ROOT.'/'.$dirname)){
		write_msg(MYMPS_ROOT.'/'.$dirname.' Failed to create directory!');
	}
	$string="<?php\r\n\$cityid=$cityid;\r\nrequire dirname(__FILE__).'/../$p'.basename(__FILE__);\r\n?>";
	createfile(MYMPS_ROOT."$dirname/about.php",$string);
	createfile(MYMPS_ROOT."$dirname/index.php",$string);
	createfile(MYMPS_ROOT."$dirname/category.php",$string);
	createfile(MYMPS_ROOT."$dirname/information.php",$string);
	createfile(MYMPS_ROOT."$dirname/coupon.php",$string);
	createfile(MYMPS_ROOT."$dirname/goods.php",$string);
	createfile(MYMPS_ROOT."$dirname/corporation.php",$string);
	createfile(MYMPS_ROOT."$dirname/group.php",$string);
}

function DelCity($cityid){
	global $db,$db_mymps,$mymps_global,$mympsdirectory;
	$all = $db -> getAll("SELECT areaid FROM `{$db_mymps}area` WHERE cityid = '$cityid'");
	if(is_array($all)){
		foreach($all as $k => $v){
			$areaids = $v[areaid].',';
		}
	}
	if($areaids = substr($areaids,0,-1)){
		mymps_delete("street","WHERE areaid IN($areaids)");
		unset($areaids,$all);
	}
	
	$directory = $db -> getOne("SELECT directory FROM `{$db_mymps}city` WHERE cityid = '$cityid'");
	if($directory && !in_array($directory,$mympsdirectory)){
		DelDir(MYMPS_ROOT.$mymps_global['cfg_citiesdir'].'/'.$directory);
	}
	unset($directory);
	
	mymps_delete("area","WHERE cityid = '$cityid'");
	mymps_delete("city","WHERE cityid = '$cityid'");
	mymps_delete("information","WHERE cityid = '$cityid'");
	mymps_delete("member","WHERE cityid = '$cityid'");
	mymps_delete("flink","WHERE cityid = '$cityid'");
	mymps_delete("admin","WHERE cityid = '$cityid'");
	mymps_delete("announce","WHERE cityid = '$cityid'");
	mymps_delete("focus","WHERE cityid = '$cityid'");
	mymps_delete("group","WHERE cityid = '$cityid'");
	mymps_delete("coupon","WHERE cityid = '$cityid'");
	mymps_delete("news","WHERE cityid = '$cityid'");
	mymps_delete("lifebox","WHERE cityid = '$cityid'");
	mymps_delete("telephone","WHERE cityid = '$cityid'");
	mymps_delete("navurl","WHERE cityid = '$cityid'");
	mymps_delete("advertisement","WHERE cityid = '$cityid'");
}
?>
