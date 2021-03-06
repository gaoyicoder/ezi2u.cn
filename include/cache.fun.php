<?php
function updatecaches(){
	@set_time_limit(0);
	global $db,$db_mymps,$mymps_global;
	clear_cache_files();
	write_admin_cache();
	updateadvertisement();
	write_cron_cache();
	write_checkanswer_cache();
	update_checkanswer_settings();
	update_jswizard_settings();
	write_jswizard_cache();
	write_authcode_cache();
	write_plugin_cache();
	write_insidelink_cache();
}

function get_changecity_cities(){
	global $db,$db_mymps,$mymps_global;
	$FinalArray = read_static_cache('changecity_cities');
	if($FinalArray === false){
		$all = $db -> getAll("SELECT firstletter FROM `{$db_mymps}city` GROUP BY firstletter");
		if(is_array($all)){
			foreach($all as $key => $val){
				$FirstLetterArray[]= $val['firstletter'];
			}
		}
		$all = $db -> getAll("SELECT * FROM `{$db_mymps}city` ORDER BY displayorder ASC");
		if(is_array($all)){
			foreach($all as $key => $val){
				foreach($FirstLetterArray as $k => $v){
					if($val['firstletter'] == $v){
						$v = strtoupper($v);
						$FinalArray['all'][$v][$val['cityid']]['cityid'] = $val['cityid'];
						$FinalArray['all'][$v][$val['cityid']]['cityname'] = $val['cityname'];
						$FinalArray['all'][$v][$val['cityid']]['ifhot'] = $val['ifhot'];
						$FinalArray['all'][$v][$val['cityid']]['domain'] = $val['domain'] ? $val['domain'] : $mymps_global['SiteUrl'].$mymps_global['cfg_citiesdir'].'/'.$val['directory'].'/';
					}
				}
			}
			is_array($FinalArray['all']) && ksort($FinalArray['all']);
		}
		
		write_static_cache('changecity_cities',$FinalArray);
	}
	$FirstLetterArray = NULL;
	return $FinalArray['all'];
}

function get_changeprovince_cities(){
	global $db,$db_mymps,$mymps_global;
	$FinalArray = read_static_cache('changeprovince_cities');
	if($FinalArray === false){
		$all = $db -> getAll("SELECT provinceid,provincename FROM `{$db_mymps}province` ORDER BY displayorder ASC");
		if(is_array($all)){
			foreach($all as $key => $val){
				$ProvinceidArray[$val['provinceid']]= $val['provincename'];
			}
		}
		$all = NULL;
		$all = $db -> getAll("SELECT * FROM `{$db_mymps}city` ORDER BY displayorder ASC");

		
		foreach($ProvinceidArray as $k => $v){
			if(is_array($all)){
				foreach($all as $key => $val){
					if($val['provinceid'] == $k){
						if(in_array($val['cityname'],array('北京（中国元素，需要斟酌）','上（中国元素，需要斟酌）海','天津（中国元素，需要斟酌）','重（中国元素，需要斟酌）庆'))){
							$v = '直辖（中国元素，需要斟酌）市';
						}
						$FinalArray['all'][$v][$val['cityid']]['cityid'] = $val['cityid'];
						$FinalArray['all'][$v][$val['cityid']]['cityname'] = $val['cityname'];
						$FinalArray['all'][$v][$val['cityid']]['ifhot'] = $val['ifhot'];
						$FinalArray['all'][$v][$val['cityid']]['domain'] = $val['domain'] ? $val['domain'] : $mymps_global['SiteUrl'].$mymps_global['cfg_citiesdir'].'/'.$val['directory'].'/';
					}
				}
			}
			//is_array($FinalArray['all']) && ksort($FinalArray['all']);
		}
		
		write_static_cache('changeprovince_cities',$FinalArray);
	}
	$FirstLetterArray = NULL;
	return $FinalArray['all'];
}

function get_hot_cities(){
	global $db,$db_mymps,$mymps_global;
	$FinalArray = read_static_cache('hot_cities');
	if($FinalArray === false){
		$query = $db -> query("SELECT * FROM `{$db_mymps}city` WHERE ifhot = '1' ORDER BY displayorder ASC");
		while($row = $db -> fetchRow($query)){
			$FinalArray['hot'][$row['cityid']]['cityid'] = $row['cityid'];
			$FinalArray['hot'][$row['cityid']]['citypy'] = $row['citypy'];
			$FinalArray['hot'][$row['cityid']]['cityname'] = $row['cityname'];
			$FinalArray['hot'][$row['cityid']]['directory'] = $row['directory'];
			$FinalArray['hot'][$row['cityid']]['domain'] = $row['domain'] ? $row['domain'] : $mymps_global['SiteUrl'].$mymps_global['cfg_citiesdir'].'/'.$row['directory'].'/';
		}
		
		write_static_cache('hot_cities',$FinalArray);
	}
	$FirstLetterArray = NULL;
	return $FinalArray['hot'];
}

function get_mobile_settings(){
	global $db,$db_mymps;
	$data = read_static_cache('mobile');
	if($data === false){
		clear_cache_files('mobile');
		$res = $db->getOne("SELECT value FROM `{$db_mymps}config` WHERE type='mobile' AND description = 'mobile'");
		$res = $res ? ($charset == 'utf-8' ? utf8_unserialize($res) : unserialize($res)) : array();
		write_static_cache('mobile',$res);
	}else{
		$res = $data;
	}
	return $res;
}

function get_commentsettings(){
	global $db,$db_mymps;
	$data = read_static_cache('commentsettings');
	if($data === false){
		clear_cache_files('commentsettings');
		$res = $db->getOne("SELECT value FROM `{$db_mymps}config` WHERE type='comment' AND description = 'comment'");
		$res = $res ? ($charset == 'utf-8' ? utf8_unserialize($res) : unserialize($res)) : array();
		write_static_cache('commentsettings',$res);
	}else{
		$res = $data;
	}
	return $res;
}

function get_information_count(){
	global $db,$db_mymps,$city;
	$where = $city['cityid'] ? " WHERE cityid = '$city[cityid]'" : "";
	//今天发布信息数量
	$sql = "SELECT catid,count(*) AS num FROM {$db_mymps}information $where group by catid";
	$counts = $db->getAll($sql);
	$res = array();
	foreach($counts as $k=>$v){
		$res[$v['catid']] = $v['num'];
	}
	return $res;
}

function write_insidelink_cache(){
	global $db,$db_mymps,$charset;
	clear_cache_files('insidelink');
	$query = $db -> query("SELECT * FROM `{$db_mymps}insidelink`");
	while($row = $db -> fetchRow($query)){
		$res['detail'][$row['word']] = $row['url'];
	}
	
	$settings = $db -> getOne("SELECT value FROM `{$db_mymps}config` WHERE type = 'insidelink' AND description = 'insidelink'");
	$res['settings'] = ($charset == 'gbk') ? unserialize($settings) : utf8_unserialize($settings);
	
	write_static_cache('insidelink',$res);
}

function updateadvertisement(){
	global $timestamp;
	$query = $GLOBALS['db'] -> query("SELECT * FROM `{$GLOBALS['db_mymps']}advertisement` WHERE available>'0' AND starttime<='$timestamp' AND type != 'normalad' ORDER BY displayorder ASC");
	if($GLOBALS['db']->num_rows($query)) {
		while($adv = $GLOBALS['db']->fetchRow($query)) {
			foreach(explode("\t",$adv['targets']) as $target){
				/*如果为首页分类间广告*/
				if($adv['type'] == 'indexcatad' && is_numeric($target)) {
					$advs['index']['type'][$adv['type']][$target][] = $adv['advid'];
					$advs['index']['items'][$adv['advid']]  = $adv['code'];
				}elseif($target == 'index'){
					//如果为首页显示
					$advs['index']['type'][$adv['type']][] 	= $adv['advid'];
					$advs['index']['items'][$adv['advid']]  = $adv['code'];
				}elseif($target == 'all'){
					foreach(array('category','info','index','other') as $range){
						$position = $charset == 'gbk' ? unserialize($adv['parameters']) : utf8_unserialize($adv['parameters']);
						if($position['position']){
							$advs[$range][$target]['type'][$adv['type']][$position['position']][] = $adv['advid'];
						}else{
							$advs[$range][$target]['type'][$adv['type']][] = $adv['advid'];
						}
						$advs[$range]['items'][$adv['advid']]  = $adv['code'];
					}
				} elseif(is_numeric($target)){
					//如果为数字 即为分类栏目或info阅读页显示
					foreach(array('category','info') as $range){
						$position = $charset == 'gbk' ? unserialize($adv['parameters']) : utf8_unserialize($adv['parameters']);
						if($position['position']){
							$advs[$range][$target]['type'][$adv['type']][$position['position']][] = $adv['advid'];
						} else {
							$advs[$range][$target]['type'][$adv['type']][] = $adv['advid'];
						}
						$advs[$range]['items'][$adv['advid']]  = $adv['code'];
					}
				}
			}
		}
		
		foreach(array('index','category','info','other') as $range){
			write_static_cache('adv_'.$range,$advs[$range]);
		}
	}
	
}

function write_cron_cache(){
	global $db,$db_mymps,$timestamp;
	$query = $db->query("SELECT * FROM `{$db_mymps}crons` WHERE 1 OR nextrun = '0'");
	while($row = $db -> fetchRow($query)){
		$res[$row['name']]['lastrun'] = $row['lastrun'];
		$res[$row['name']]['nextrun'] = $row['nextrun'];
		$res[$row['name']]['day'] 	  = $row['day'];
	}
	$content = "<?php\r\n";
    $content .= "\$m_cron = " . var_export($res, true) . ";\r\n";
    $content .= "?>";
	if(!createfile(MYMPS_DATA.'/cron.cache.php',$content)){
		write_msg(MYMPS_DATA.'The file /cron.cache.php cannot be written. Please check your corresponding authorities!');
	}
}

function write_authcode_cache(){
	global $db,$db_mymps;
	clear_cache_files('authcodesettings');
	$query = $db -> query("SELECT * FROM `{$db_mymps}config` WHERE type = 'authcode'");
	while($row = $db -> fetchRow($query)){
		$res[$row['description']] = $row['value'];
	}
	write_static_cache('authcodesettings',$res);
}

/*更新验证回答缓存*/
function write_checkanswer_cache(){
	$query = $GLOBALS['db'] -> query("SELECT * FROM `{$GLOBALS['db_mymps']}checkanswer` ORDER BY id DESC");
	while($row = $GLOBALS['db'] -> fetchRow($query)){
		$res[$row['id']]['id'] = $row['id'];
		$res[$row['id']]['question'] = $row['question'];
		$res[$row['id']]['answer'] = $row['answer'];
	}
	write_static_cache('checkanswer',$res);
}

function update_checkanswer_settings(){
	global $db,$db_mymps;
	clear_cache_files('checkanswer_settings');
	$query = $db -> query("SELECT * FROM `{$db_mymps}config` WHERE type = 'checkanswe'");
	while($row = $db -> fetchRow($query)){
		$res[$row['description']] = $row['value'];
	}
	write_static_cache('checkanswer_settings',$res);
}

function update_config_cache(){
	$query = $GLOBALS['db'] -> query("SELECT description,value FROM `{$GLOBALS['db_mymps']}config` WHERE type = 'config'");
	while($row = $GLOBALS['db']->fetchRow($query)){
		$res[$row['description']] = $row['value'];
	}
	$content = "<?php\r\n";
    $content .= "\$mymps_global = " . var_export($res, true) . ";\r\n";
    $content .= "?>";
	if(!createfile(MYMPS_DATA.'/config.php',$content)){
		write_msg(MYMPS_DATA.'The file /config.php cannot be written. Please check your corresponding authorities!');
	}
}

function write_htmlstyle_cache($style = 'news'){
	global $db,$db_mymps;
	$row = $db->getRow("SELECT value FROM `{$db_mymps}config` WHERE description = 'glb_html_".$style."'");
	$mymps .= "<?php\n";
	$mymps .= "\$htmlstyle[$style] = '$row[value]';\n";
	$mymps .= "?>";
	!createfile(MYMPS_DATA.'/html_style.inc.php',$mymps) && write_msg(MYMPS_DATA."The file /html_style.inc.php cannot be written. Please check your corresponding authorities!");
}

/**
 *  清除指定后缀的模板缓存或编译文件
 *
 * @access  public
 * @param  bool       $is_cache  是否清除缓存还是清出编译文件
 * @param  string     $ext       需要删除的文件名，不包含后缀
 * is_cache  	1=系统缓存  2=模板缓存文件 3=模板编译文件
 * @return int        返回清除的文件个数
 */
function clear_tpl_files($is_cache = 1, $ext = '')
{
    $dirs = array();
    if ($is_cache == 1){
        $dirs[] = MYMPS_DATA . '/caches/';
    }elseif($is_cache == 2){
        $dirs[] = MYMPS_DATA . '/smarty/caches/';
    } elseif($is_cache == 3){
		$dirs[] = MYMPS_DATA . '/smarty/compiles/';
	}
    $str_len = strlen($ext);
    $count   = 0;
    foreach ($dirs AS $dir){
        $folder = @opendir($dir);

        if ($folder === false){
            continue;
        }

        while ($file = readdir($folder)){
            if ($file == '.' || $file == '..' || $file == 'index.htm' || $file == 'index.html'){
                continue;
            }
            if (is_file($dir . $file)){
                /* 如果有文件名则判断是否匹配 */
                $pos = strrpos($file, '.');
                if ($str_len > 0 && $pos !== false){
                    $ext_str = substr($file, 0, $pos);

                    if ($ext_str == $ext){
                        if (@unlink($dir . $file)){
                            $count++;
                        }
                    }
                }else{
                    if (@unlink($dir . $file)){
                        $count++;
                    }
                }
            }
        }
        closedir($folder);
    }

    return $count;
}


/**
 * 清除模版缓存文件
 *
 * @access  public
 * @param   mix     $ext    模版文件名， 不包含后缀
 * @return  void
 */
function clear_smt_cache_files($ext = '')
{
    return clear_tpl_files(2, $ext);
}

/**
 * 清除模版编译文件
 *
 * @access  public
 * @param   mix     $ext    模版文件名， 不包含后缀
 * @return  void
 */
function clear_compiled_files($ext = '')
{
    return clear_tpl_files(3, $ext);
}

/**
 * 清除系统缓存文件
 *
 * @access  public
 * @param   mix     $ext    模版文件名， 不包含后缀
 * @return  void
 */
function clear_cache_files($ext = '')
{
    return clear_tpl_files(1, $ext);
}

/**
 * 清除模版编译和缓存文件
 *
 * @access  public
 * @param   mix     $ext    模版文件名后缀
 * @return  void
 */
function clear_all_files($ext = '')
{
    return clear_tpl_files(1, $ext) + clear_tpl_files(2,  $ext) + clear_tpl_files(3,  $ext);
}

function clear_smarty_files(){
	clear_tpl_files(2,  $ext) + clear_tpl_files(3,  $ext);
}

function read_static_cache($cache_name){
    if ((DEBUG_MODE & 2) == 2){
        return false;
    }
    static $result = array();
    if (!empty($result[$cache_name])){
        return $result[$cache_name];
    }
    $cache_file_path = MYMPS_DATA . '/caches/' . $cache_name . '.php';
    if (file_exists($cache_file_path)){
        include_once($cache_file_path);
        $result[$cache_name] = $data;
        return $result[$cache_name];
    }else{
        return false;
    }
}

function write_static_cache($cache_name, $caches){
    if ((DEBUG_MODE & 2) == 2){
        return false;
    }
    $cache_file_path = MYMPS_DATA . '/caches/' . $cache_name . '.php';
    $content = "<?php\r\n";
    $content .= "\$data = " . var_export($caches, true) . ";\r\n";
    $content .= "?>";
    file_put_contents($cache_file_path, $content, LOCK_EX);
}

function get_cache_config(){
	$data = read_static_cache('cache');
	if($data === false){
		$query = $GLOBALS['db'] -> query("SELECT * FROM `{$GLOBALS['db_mymps']}cache`");
		while($row = $GLOBALS['db']->fetchRow($query)){
			$cache[$row['page']]['time'] = $row['time'];
			$cache[$row['page']]['open'] = $row['open'];
		}
		write_static_cache('cache',$cache);
	} else {
		$cache = $data;
	}
	return $cache;
}

function update_jswizard_settings(){
	global $db,$db_mymps;
	clear_cache_files('jswizard_settings');
	$query = $db -> query("SELECT * FROM `{$db_mymps}config` WHERE type = 'jswizard'");
	while($row = $db -> fetchRow($query)){
		$res[$row['description']] = $row['value'];
	}
	write_static_cache('jswizard_settings',$res);
}

function write_jswizard_cache(){
	global $db,$db_mymps,$charset;
	clear_cache_files('jswizard_lists');
	$query = $db -> query("SELECT * FROM `{$db_mymps}jswizard`");
	while($row = $db -> fetchRow($query)){
		$res[$row['flag']]['id'] 	= $row['id'];
		$res[$row['flag']]['flag'] 	= $row['flag'];
		$res[$row['flag']]['parameter'] = $charset == 'utf-8' ? utf8_unserialize($row['parameter']) : unserialize($row['parameter']);		
	}
	write_static_cache('jswizard_lists',$res);
}

function write_admin_cache(){
	clear_cache_files('admin');
	$citycaches = get_allcities();
	$query = $GLOBALS['db'] -> query("SELECT a.*,b.purviews,b.typename,b.ifsystem FROM `{$GLOBALS['db_mymps']}admin` AS a LEFT JOIN `{$GLOBALS['db_mymps']}admin_type` AS b ON a.typeid = b.id");
	while($row = $GLOBALS['db'] -> fetchRow($query)){
		$res[$row['userid']]['typename']	=	$row['typename'];
		$res[$row['userid']]['ifsystem']	=	$row['ifsystem'];
		$res[$row['userid']]['purviews']	=	$row['purviews'];
		$res[$row['userid']]['cityid']		=	$row['cityid'];
		$res[$row['userid']]['cityname']	=	empty($row['cityid']) ? 'Master Site ' : $citycaches[$row['cityid']]['cityname'];
	}
	$citycaches = $row = $query = NULL;
	write_static_cache('admin',$res);
	return $res;
}

/*获取积分信用设置*/
function get_credit_score(){
	global $db,$db_mymps,$charset;
	$data = read_static_cache('credit_score');
	if($data === false){
		clear_cache_files('score_credit');
		
		$query = $db -> query("SELECT * FROM `{$db_mymps}config` WHERE type = 'credit_sco'");
		while($row = $db -> fetchRow($query)){
			$res[$row['description']] = $charset == 'utf-8' ? utf8_unserialize($row['value']) : unserialize($row['value']);
		}

		write_static_cache('credit_score',$res);
	}else{
		$res = $data;
	}
	return $res;
}

/*获取首页模板参数设置*/
function get_tpl_index(){
	global $db,$db_mymps,$charset;
	$data = read_static_cache('tpl_index');
	if($data === false){
		clear_cache_files('tpl_index');
		
		$query = $db -> query("SELECT * FROM `{$db_mymps}config` WHERE type = 'tpl'");
		while($row = $db -> fetchRow($query)){
			$res[$row['description']] = $charset == 'utf-8' ? utf8_unserialize($row['value']) : unserialize($row['value']);
		}

		write_static_cache('tpl_index',$res);
	}else{
		$res = $data;
	}
	return $res;
}

function get_city_caches($cityid=0){
	global $db,$db_mymps,$mymps_global,$tpl_index,$timestamp;
	
	if(!$tpl_index){
		$tpl_index = get_tpl_index();
		$tpl_index = $tpl_index['tpl_set'];
	}
	
	$cityid = intval($cityid);
	$data = read_static_cache('city_'.$cityid);
	if($data === false){
		$city_limit = " AND cityid = '$cityid'";
		
		if(!empty($cityid)){
			//分站下的地区
			$query = $db -> query("SELECT * FROM `{$db_mymps}area` WHERE cityid = '$cityid' ORDER BY displayorder ASC");
			while($row = $db -> fetchRow($query)){
				$list['area'][$row['areaid']]['areaid'] = $row['areaid'];
				$list['area'][$row['areaid']]['areaname'] = $row['areaname'];
				$createin_areaid .= $row['areaid'].',';
			}
			$createin_areaid = $createin_areaid ? substr($createin_areaid,0,-1) : '';
			
			//分站下的街道路段
			if(!empty($createin_areaid)){
				$query = $db -> query("SELECT * FROM `{$db_mymps}street` WHERE areaid IN(".$createin_areaid.") ORDER BY displayorder ASC");
				while($row = $db -> fetchRow($query)){
					$list['area'][$row['areaid']]['street'][$row['streetid']]['streetid'] = $row['streetid'];
					$list['area'][$row['areaid']]['street'][$row['streetid']]['streetname'] = $row['streetname'];
				}
			}
			unset($createin_areaid);
			
			//该分站的信息
			$row = get_allcities($cityid);
			$list['cityid'] = $row['cityid'];
			$list['citypy'] = $row['citypy'];
			$list['cityname'] = $row['cityname'];
			$list['directory'] = $row['directory'];
			$list['domain'] = $row['domain'];
			$list['mappoint'] = $row['mappoint'];
			$list['firstletter'] = $row['firstletter'];
			$list['title'] = $row['title'];
			$list['keywords'] = $row['keywords'];
			$list['description'] = $row['description'];
		} else {
			$list['cityid'] = $cityid;
			$list['citypy'] = '';
			$list['cityname'] = '';
			$list['directory'] = '';
			$list['domain'] = $mymps_global['SiteUrl'].'/';
			$list['mappoint'] = '';
			$list['firstletter'] = '';
			$list['title'] = '';
			$list['keywords'] = '';
			$list['description'] = '';
		}
		
		//分站下的lifebox 
		$query = $db -> query("SELECT * FROM `{$db_mymps}lifebox` WHERE if_view = 2 {$city_limit} ORDER BY displayorder DESC LIMIT 0,$tpl_index[lifebox]");
		while($row = $db -> fetchRow($query)){
			$list['lifebox'][$row['id']]['id'] = $row['id'];
			$list['lifebox'][$row['id']]['lifename'] = $row['lifename'];
			$list['lifebox'][$row['id']]['lifeurl'] = $row['lifeurl'];
		}

		//分站下的telephone
		$query = $db -> query("SELECT * FROM `{$db_mymps}telephone` WHERE if_view = 2 {$city_limit} ORDER BY displayorder DESC LIMIT 0,$tpl_index[telephone]");
		while($row = $db -> fetchRow($query)){
			$list['telephone'][$row['id']]['telname'] = $row['telname'];
			$list['telephone'][$row['id']]['telnumber'] = $row['telnumber'];
			$list['telephone'][$row['id']]['if_bold'] = $row['if_bold'];
			$list['telephone'][$row['id']]['color'] = $row['color'];
		}

		//分站下的首页focus 
		$query = $db -> query("SELECT image,pre_image,url,words,id FROM `{$db_mymps}focus` WHERE typename = 'Site Homepage' {$city_limit} ORDER BY focusorder DESC LIMIT 0,5");
		while($row = $db -> fetchRow($query)){
			$list['focus']['index'][$row['id']]['image'] = $row['image'];
			$list['focus']['index'][$row['id']]['pre_image'] = $row['pre_image'];
			$list['focus']['index'][$row['id']]['url'] = $row['url'];
			$list['focus']['index'][$row['id']]['words'] = $row['words'];
		}

		//分站下的新闻focus 
		$query = $db -> query("SELECT image,pre_image,url,words,id FROM `{$db_mymps}focus` WHERE typename = 'News Homepage' {$city_limit} ORDER BY focusorder DESC LIMIT 0,5");
		while($row = $db -> fetchRow($query)){
			$list['focus']['news'][$row['id']]['image'] = $row['image'];
			$list['focus']['news'][$row['id']]['pre_image'] = $row['pre_image'];
			$list['focus']['news'][$row['id']]['url'] = $row['url'];
			$list['focus']['news'][$row['id']]['words'] = $row['words'];
		}
		
		//分站下的公告
		$query = $db -> query("SELECT * FROM `{$db_mymps}announce` WHERE begintime<='$timestamp' AND (endtime='0' OR endtime>'$timestamp') {$city_limit} ORDER BY id DESC LIMIT 0,$tpl_index[announce]");
		while($row = $db -> fetchRow($query)){
			$list['announce'][$row['id']]['title'] 		= $row['title'];
			$list['announce'][$row['id']]['begintime']	= $row['begintime'];
			$list['announce'][$row['id']]['endtime']	= $row['endtime'];
			$list['announce'][$row['id']]['titlecolor']	= $row['titlecolor'];
			$list['announce'][$row['id']]['author']		= $row['author'];
			$list['announce'][$row['id']]['content']	= $row['content'];
			$list['announce'][$row['id']]['uri'] 		= $row['redirecturl'] ? $row['redirecturl'] : Rewrite('about',array('part'=>'announce','id'=>$row['id'],'html_path'=>'/announce/index'.$seo['seo_htmlext'].'#'.$row['id']));
		}
	
		//分站首页显示友情链接
		$query = "SELECT weblogo, webname, url, catid, cityid, ifindex FROM `{$db_mymps}flink` WHERE 1 {$city_limit} AND ischeck = '2' ORDER BY ordernumber ASC";
		$res = $db->getAll($query);
		//$list['flink']['img'] = $list['flink']['txt'] = array();
		$i = 0;
		foreach ($res AS $row){
			if (!empty($row['weblogo']) && $row['ifindex'] == 2){
				$i++;
				$list['flink']['img'][] = array('name' => $row['webname'],
										'url'  => $row['url'],
										'logo' => $row['weblogo']);
			}elseif($row['ifindex'] == 2){
				$list['flink']['txt'][] = array('name' => $row['webname'],'url'  => $row['url']);
			}
			if($row['catid']) $list['flink'][$row['catid']][] = array('name' => $row['webname'],'url'  => $row['url']);//栏目友链
		}
		if($i == 0) unset($list['flink']['img']);
		
		//分站下的广告
		$query = $db -> query("SELECT advid,code FROM `{$db_mymps}advertisement` WHERE 1 {$city_limit} AND available>'0' AND starttime<='$timestamp' AND type != 'normalad'");
		while($row = $db -> fetchRow($query)){
			$list['advertisement'][$row['advid']]  = $row['code'];
		}
		
		//分站下的头部导航 
		$city_limit = " AND cityid = '$cityid'";
		$query = $db -> query("SELECT id,url,color,target,title,ico FROM `{$db_mymps}navurl` WHERE typeid = '1' AND isview = '2' {$city_limit} ORDER BY displayorder ASC LIMIT 0,20");
		while($row = $db -> fetchRow($query)){
			$list['topnav'][$row['id']]['url'] = $row['url'];
			$list['topnav'][$row['id']]['color'] = $row['color'];
			$list['topnav'][$row['id']]['target'] = $row['target'];
			$list['topnav'][$row['id']]['title'] = $row['title'];
			$list['topnav'][$row['id']]['ico'] = $row['ico'];
		}
		
		unset($query,$row);
		write_static_cache('city_'.$cityid,$list);
	} else {
		$list = $data; 
	}
	unset($query,$row,$city_limit);
	return $list;
}

function get_allcities($cityid=0){
	global $db,$db_mymps,$mymps_global;
	$data = read_static_cache('allcities');
	if($data === false){
		$query = $db -> query("SELECT * FROM `{$db_mymps}city` ORDER BY firstletter ASC,displayorder ASC");
		while($row = $db -> fetchRow($query)){
			$res[$row['cityid']]['cityid'] = $row['cityid'];
			$res[$row['cityid']]['citypy'] = $row['citypy'];
			$res[$row['cityid']]['cityname'] = $row['cityname'];
			$res[$row['cityid']]['directory'] = $row['directory'];
			$res[$row['cityid']]['firstletter'] = $row['firstletter'];
			$res[$row['cityid']]['mappoint'] = $row['mappoint'];
			$res[$row['cityid']]['ifhot'] = $row['ifhot'];
			$res[$row['cityid']]['domain'] = $row['domain'] ? $row['domain'] : $mymps_global['SiteUrl'].$mymps_global['cfg_citiesdir'].'/'.$row['directory'].'/';
			$res[$row['cityid']]['title'] = $row['title'];
			$res[$row['cityid']]['keywords'] = $row['keywords'];
			$res[$row['cityid']]['description'] = $row['description'];
		}
		write_static_cache('allcities',$res);
	} else {
		$res = $data;
	}
	return empty($cityid) ? $res : $res[$cityid];
}

function get_cityoptions($cityid=''){
	$citycaches = get_allcities();
	if(!$citycaches) return;
	foreach($citycaches as $k => $v){
		if(is_array($cityid)){
			$mymps .= in_array($k,$cityid) ? '<option value="'.$v[cityid].'" selected>' : '<option value="'.$v[cityid].'">';
		} else {
			$mymps .= $cityid == $k ? '<option value="'.$v[cityid].'" selected>' : '<option value="'.$v[cityid].'">';
		}
		//$mymps .= $v['firstletter'].'.'.$v['cityname'];
		$mymps .= $v['cityname'];
		$mymps .= '</option>';
	}
	unset($citycaches);
	return $mymps;
}

function get_category_dir(){
	$data = read_static_cache('category_dir');
	if($data === false){
		$query = $GLOBALS['db'] -> query("SELECT catid,dir_typename FROM `{$GLOBALS['db_mymps']}category`");
		while($row = $GLOBALS['db']->fetchRow($query)){
			$cache[$row['catid']] = $row['dir_typename'];
		}
		write_static_cache('category_dir',$cache);
	} else {
		$cache = $data;
	}
	return $cache;
}
?>