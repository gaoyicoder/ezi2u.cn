<?php
define('CURSCRIPT','info_type');

require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

$part = $part ? $part : 'option_list' ;

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

if($part == 'option_list'){
	
	chk_admin_purview("purview_Field Manage");
	
	require_once(MYMPS_DATA."/info.type.inc.php");
	$classid = $classid ? $classid : $db -> getOne("SELECT MAX(classid) FROM `{$db_mymps}info_typeoptions`") ;
	$here 	 = 'Categorized Information Field';
	$options = $db->getAll("SELECT * FROM `{$db_mymps}info_typeoptions` WHERE classid ='0' ORDER BY displayorder DESC");
	$detail  = $db->getRow("SELECT title,optionid FROM `{$db_mymps}info_typeoptions` WHERE optionid ='$classid'");
	$option	 = $db->getAll("SELECT * FROM `{$db_mymps}info_typeoptions` WHERE classid ='$classid' AND classid != '0' ORDER BY displayorder DESC");
	include (mymps_tpl("info_option"));
}elseif($part == 'option_add'){
	(empty($title)||empty($identifier)||empty($type)||empty($classid)) && write_msg("Please complete the related information!");
	if(mymps_count("info_typeoptions","WHERE identifier = '$identifier'")>0){write_msg("Parameter name".$identifer."already exists, please use another parameter name and try again.");exit();}
	$res = $db->query("INSERT INTO `{$db_mymps}info_typeoptions` (title,identifier,type,displayorder,classid,available,required,search)VALUES('$title','$identifier','$type','$displayorder','$classid','$available','$required','$search')");
	$optionid = $db -> insert_id();

	/*清除缓存*/
	clear_cache_files('mod_search_option');
	clear_cache_files('mod_search_identifier');
	write_msg("Information field".$title."has successfully been added! Please continue to edit field details to complete the operation!","?part=option_edit&optionid=".$optionid,"mymps.com.cn");
	
}elseif($part == 'option_edit'){
	$optionid = intval($_GET['optionid']);
	$action = trim($_GET['action']);
	switch ($action){
		case 'update':
			$rule	= $_POST['rules'];
			$rules	= serialize(str_replace(" ","",$rule[$typenew]));
			$db->query("UPDATE `{$db_mymps}info_typeoptions` SET title='$title',identifier='$identifier',type='$typenew',classid='$classid',displayorder='$displayorder',description='$description',rules ='$rules',available='$available',required='$required',search='$search' WHERE optionid = '$optionid'");
			
			$rl = str_replace(" ","",$rule[$typenew]);
			$r = $db -> getAll("SELECT id,options FROM `{$db_mymps}info_typemodels` WHERE id > 1");
			foreach($r as $k => $v){
				if(in_array($optionid,explode(',',$v['options'])) && $db->num_rows($db->query("SHOW TABLES LIKE '{$db_mymps}information_{$v[id]}'")) == 1){
					//有表
					if($typenew == 'text'){
						$option_sql = " VARCHAR(".($rl[maxlength]?$rl[maxlength]:250).") NOT NULL";
					}elseif($typenew == 'textarea'){
						$option_sql = " MEDIUMTEXT";
					}elseif($typenew == 'number'){
						$option_sql = " MEDIUMINT(7) NOT NULL DEFAULT '0'";
					}elseif($typenew == 'radio'){
						$option_sql = " TINYINT(1) NOT NULL DEFAULT '0'";
					}elseif($typenew == 'checkbox'){
						$option_sql = " VARCHAR(100) NOT NULL DEFAULT '0'";
					}elseif($typenew == 'select'){
						$option_sql = " TINYINT(1) NOT NULL DEFAULT '0'";
					}
					if(!in_array($identifier,array('iid','id','content'))){
						if(($db->num_rows($db->query("SHOW COLUMNS FROM `{$db_mymps}information_{$v[id]}` LIKE '$identifier'")))){
							//如果已有该字段
							$sql = "ALTER TABLE `{$db_mymps}information_{$v[id]}` CHANGE `$identifier` `$identifier`  $option_sql;";
						}else{
							//如果没有该字段
							$sql = "ALTER TABLE `{$db_mymps}information_{$v[id]}` ADD `$identifier` $option_sql;";
						}
					}
					$db->query($sql);
				}
			}
			
			/*清除缓存*/
			clear_cache_files('mod_search_option');
			clear_cache_files('mod_search_identifier');
			clear_cache_files('info_typeoptions');
			write_msg("The properties of information field <b>".$title."</b> has successfully been edited!","?part=option_edit&optionid=".$optionid,"MyMps");
		
		break;
		default:
			$options = $db->getAll("SELECT * FROM `{$db_mymps}info_typeoptions` WHERE classid ='0' ORDER BY optionid DESC");
			$edit	 = $db->getRow("SELECT * FROM `{$db_mymps}info_typeoptions` WHERE optionid ='$optionid'");
			$here	 = "Categorized Field";
			$class_option = $db->getAll("SELECT optionid,title FROM `{$db_mymps}info_typeoptions` WHERE classid = '0' ORDER BY displayorder,optionid DESC");
			if($edit[rules]){
				$rule = unserialize($edit[rules]);
				if(is_array($rule)){
					foreach($rule as $w){
						$rules[$edit[type]] .= $w;
					}
				}
			}
			require_once(MYMPS_DATA."/info.type.inc.php");
			include (mymps_tpl("info_option_edit"));
			
		break;
	}
}elseif($part == 'option_delall'){
	$a = $db -> getAll("SELECT id,options FROM `{$db_mymps}info_typemodels` WHERE id > 1");
	foreach($id as $u => $w){
		if($identifier = $db -> getOne("SELECT identifier FROM  `{$db_mymps}info_typeoptions` WHERE optionid = $w" )){
			foreach($a as $k => $v){
				if($db->num_rows($db->query("SHOW TABLES LIKE '{$db_mymps}information_{$v[id]}'")) == 1 && $db->num_rows($db->query("SHOW COLUMNS FROM `{$db_mymps}information_{$v[id]}` LIKE '$identifier'"))){
					$db->query("ALTER TABLE `{$db_mymps}information_{$v[id]}` DROP COLUMN `$identifier`;");
				}
			}
		}
	}
	foreach($a as $i => $j){
		if($j['options']){
			$o = explode(',',$j['options']);
			if(is_array($o)) $o = array_flip($o);
			foreach($id as $t => $b){
				if($o[$b]) unset($o[$b]);
			}
			if(is_array($o)) $o = array_flip($o);
			if(is_array($o)) $o = implode(',',$o);
			$db->query("UPDATE `{$db_mymps}info_typemodels` SET options = '$o' WHERE id = '$j[id]'");
		}
	}
	clear_cache_files('mod_search_option');
	clear_cache_files('mod_search_identifier');
	clear_cache_files('info_typeoptions');
	write_msg('Information field '.mymps_del_all("info_typeoptions",$id,'optionid').' has successfully been deleted!',$url,"mymps");
}elseif($part == 'option_type'){
	switch($action){
		case 'insert':
			$title = trim($_POST['title']);
			if(empty($title)){
				write_msg("Please enter a name for the category!");
			}
			$mymps_in = $db->query("INSERT `{$db_mymps}info_typeoptions` (title,classid) VALUES ('$title','0')");
			write_msg("Field model category".$title."has successfully been added!","?part=option_type","MYMPS.COM.CN");
		break;
		case 'update':
			empty($title) && write_msg("Please enter a name for the category!");
			$mymps_rs = $db->query("UPDATE `{$db_mymps}info_typeoptions` SET title = '$title' WHERE optionid = '$id'");
			write_msg("Field model category".$title."has successfully been edited!","?part=option_type","MYMPS.COM.CN");
		break;
		case 'del':
			empty($id) && write_msg("You have not yet selected the number (ID) of the option!");
			$mymps_del = mymps_delete("info_typeoptions","WHERE optionid = '$id'");
			write_msg("Field model category".$id."has successfully been deleted!","?part=option_type","WWW.MYMPS.COM.CN");	
		break;
		default:
			$here = "Field Category Management";
			$sql  = "SELECT optionid,classid,title FROM `{$db_mymps}info_typeoptions` WHERE classid = 0";
			$type = $db->getAll($sql);
			include mymps_tpl("info_option_type");
		break;
	}
	
}elseif($part == 'mod'){
	switch ($action){
		case 'insert':
			empty($name) && write_msg("Please enter a name for the field model!");
			$displayorder = trim($_POST['displayorder'])?trim($_POST['displayorder']):'0';
			$sql = "INSERT `{$db_mymps}info_typemodels` (id,name,type,displayorder) VALUES ('','$name','0','$displayorder')";
			$db->query($sql);
			$mod_id = $db -> insert_id();
			/*清除缓存*/
			clear_cache_files('mod_search_option');
			clear_cache_files('mod_search_identifier');
			write_msg("Field Model ".$name." has successfully been added! Please continue to allocate corresponding field to this model!","?part=mod&action=edit&id=".$mod_id,"MyMPS.Com.cn");
		break;
		case 'update':
			empty($name) && write_msg("Please enter a name for the field model!");
			if(empty($options)){
				write_msg('Please select at least one field!');
				exit;
			}
			$post_opt = !empty($options) ? implode (',', $_POST['options']) : '';
			$db->query("UPDATE `{$db_mymps}info_typemodels` SET name='$name',displayorder='$displayorder',options='$post_opt' WHERE id = '$id'");
			
			if($db->num_rows($db->query("SHOW TABLES LIKE '{$db_mymps}information_{$id}'")) == 1){
				//存在表
				if(is_array($options)){
					$option_sql = '';
					foreach($options as $k => $v){
						if($r = $db->getRow("SELECT identifier,type,rules FROM `{$db_mymps}info_typeoptions` WHERE available = 'on' AND optionid = '$v'")){
							$identifier = $r['identifier'];
							$type = $r['type'];
							$rule = $charset == 'gbk' ? unserialize($r['rules']) : utf8_unserialize($r['rules']);
							
							if($type == 'text'){
								$option_sql = " VARCHAR(".($rule[maxlength]?$rule[maxlength]:250).") NOT NULL";
							}elseif($type == 'textarea'){
								$option_sql = " MEDIUMTEXT";
							}elseif($type == 'number'){
								$option_sql = " MEDIUMINT(7) NOT NULL DEFAULT '0'";
							}elseif($type == 'radio'){
								$option_sql = " TINYINT(1) NOT NULL DEFAULT '0'";
							}elseif($type == 'checkbox'){
								$option_sql = " VARCHAR(100) NOT NULL DEFAULT '0'";
							}elseif($type == 'select'){
								$option_sql = " TINYINT(1) NOT NULL DEFAULT '0'";
							}
							
							if(!in_array($identifier,array('iid','id','content'))){
								if(($db->num_rows($db->query("SHOW COLUMNS FROM `{$db_mymps}information_{$id}` LIKE '$identifier'")))){
									//如果已经有了这个字段
									$sql = "ALTER TABLE `{$db_mymps}information_{$id}` CHANGE `$identifier` `$identifier`  $option_sql;";
								}else{
									//如果没有这个字段
									$sql = "ALTER TABLE `{$db_mymps}information_{$id}` ADD `$identifier` $option_sql;";
								}
							}
						}
						if($id > 1) $db->query($sql);
					}
				}
				
			}else{
				//不存在表
				if(is_array($options)){
					$option_sql = '';
					foreach($options as $k => $v){
						if($r = $db->getRow("SELECT identifier,type,rules FROM `{$db_mymps}info_typeoptions` WHERE available = 'on' AND optionid = '$v'")){
							$identifier = $r['identifier'];
							$type = $r['type'];
							$rule = $charset == 'gbk' ? unserialize($r['rules']) : utf8_unserialize($r['rules']);
							if($type == 'text'){
								$option_sql .= "`$identifier` VARCHAR(".($rule[maxlength]?$rule[maxlength]:250).") NOT NULL,";
							}elseif($type == 'textarea'){
								$option_sql .= "`$identifier` MEDIUMTEXT,";
							}elseif($type == 'number'){
								$option_sql .= "`$identifier` MEDIUMINT(7) NOT NULL DEFAULT '0',";
							}elseif($type == 'radio'){
								$option_sql .= "`$identifier` TINYINT(1) NOT NULL DEFAULT '0',";
							}elseif($type == 'checkbox'){
								$option_sql .= "`$identifier` VARCHAR(100) NOT NULL DEFAULT '0',";
							}elseif($type == 'select'){
								$option_sql .= "`$identifier` TINYINT(1) NOT NULL DEFAULT '0',";
							}
						}
					}
				}
				
				if($id > 1){
					$sqldb= mysql_get_server_info() > '4.1' ? " DEFAULT CHARSET=$dbcharset " : "";
					$sql="CREATE TABLE IF NOT EXISTS `{$db_mymps}information_{$id}` (
					`iid` MEDIUMINT(7) NOT NULL auto_increment,
					`id` INT(10) NOT NULL DEFAULT '0',
					{$option_sql}
					`content` MEDIUMTEXT,
					PRIMARY KEY  (`iid`),
					KEY `id` (`id`)
					) ENGINE=MyISAM {$sqldb} AUTO_INCREMENT=1 ;";
					$db->query($sql);
				}
			}
			
			
			/*清除缓存*/
			clear_cache_files('mod_search_option');
			clear_cache_files('mod_search_identifier');
			write_msg("Field model ".$name." has successfully been edited!","?part=mod&action=edit&id=".$id,"BBS.MYMPS");
		
		break;
		case 'edit':
			$here="Field Model Settings";
			$edit=$db->getRow("SELECT * FROM `{$db_mymps}info_typemodels` WHERE id ='$id'");
			if(!empty($edit['options'])){
				$options = explode(',',$edit['options']);
			}
			$opt = get_all_options();
			include (mymps_tpl("info_mod_edit"));
			
		break;
		case 'delall':
			if(is_array($id)){
				foreach($id as $k => $v){
					$db->query("DROP TABLE IF EXISTS `{$db_mymps}information_{$v}`;");
				}
				mymps_del_all("info_typemodels",$id);
				clear_cache_files('mod_search_option');
				clear_cache_files('mod_search_identifier');
				write_msg('Designated Field Model Successfully Deleted', '?part=mod',"mymps");
			}
			
		break;
		default:
		
			chk_admin_purview("purview_Module Manage");
			
			$here="Field Model Management";
			$mod=$db->getAll("SELECT * FROM `{$db_mymps}info_typemodels` ORDER BY id ASC");
			include (mymps_tpl("info_mod"));
		break;
	}
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();

function get_type_option($identifier=""){
	global $var_type;
	foreach ($var_type as $k=>$value){
		$mymps .= "<option value=\"".$k."\"";
		$mymps .=($identifier==$k)?" selected":"";
		$mymps .=">".$value."(".$k.")</option>";
	}
	return $mymps;
}

function get_mymps_admin_info_type($rules=""){
	global $mymps_admin_info_type,$edit,$rules,$var_type;
	foreach($mymps_admin_info_type as $k => $value){
		$estyle =($edit[type]!=$k)?'style="display:none"':'';
		$str .= "<div id=\"style_".$k."\" ".$estyle." class=\"mytable\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"vbm\"><tr class=\"firstr\"><td colspan=\"2\">".$var_type[$k]."(".$k.")</td></tr>".$value."</table></div>";
	}
	return $str;
}

function get_all_options(){
	global $db,$db_mymps;
	$sql = "SELECT optionid,title,type,identifier FROM `{$db_mymps}info_typeoptions`";
	$optgroup=$db->getAll($sql."WHERE classid = 0 ORDER BY displayorder,optionid DESC");
	foreach($optgroup as $k => $value){
		$opt .="<optgroup label=".$value[title].">";
		$op = $db->getAll($sql."WHERE classid != 0 AND classid = '$value[optionid]' ORDER BY displayorder,optionid DESC");
		foreach($op as $w => $y){
			$opt .="<option value=".$y[optionid].">".$y[title]." / ".$y[identifier]." / ".$y[type]."</option>";
		}
		$opt .="</optgroup>";
	}
	return $opt;
}
?>
