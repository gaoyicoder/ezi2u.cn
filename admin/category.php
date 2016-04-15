<?php
define('CURSCRIPT','category');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once dirname(__FILE__)."/include/color.inc.php";
require_once dirname(__FILE__)."/include/ifview.inc.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = $part ? $part : 'list' ;

$cat_color = $color;

if(!submit_check(CURSCRIPT.'_submit')) {
	
	require_once MYMPS_DATA."/html_type.inc.php";
	
	if($part == 'list'){
		
		chk_admin_purview("purview_Category Info");
		$f_cat = cat_list('category',0,0,false);
		$here = "Post Category List";
		include(mymps_tpl("category_list"));
		
	} elseif($part == 'edit') {
		include MYMPS_DATA.'/category_tpl.inc.php';
		include MYMPS_DATA.'/information_tpl.inc.php';
		$cat = $db->getRow("SELECT * FROM {$db_mymps}category WHERE catid = '$catid'");
		$here = "Edit Post Category";
		$cat['description'] = $cat['description'] ? de_textarea_post_change($cat['description']) : '';
		include(mymps_tpl("category_edit"));
		
	} elseif($part == 'add') {
		include MYMPS_DATA.'/category_tpl.inc.php';
		include MYMPS_DATA.'/information_tpl.inc.php';
		chk_admin_purview("purview_Add a Category");
		$maxorder = $db->getOne("SELECT MAX(catorder) FROM {$db_mymps}category");
		$maxorder = $maxorder + 1;
		$here = "Add Post Category";
		include mymps_tpl("category_add");
		
	} elseif($part == 'del') {
		
		empty($catid) && write_msg('No Records Selected');
		mymps_delete("category","WHERE ".get_children($catid,'catid'));
		mymps_delete("information","WHERE ".get_children($catid,'catid'));
																	 
		clear_cache_files('category_option_static');
		clear_cache_files('category_pid_releate');
		clear_cache_files('category_tree');
		clear_cache_files('category_dir');
		write_msg("The post category  $catid has successfully been deleted!","category.php?part=list","Mymps");
		
	}
	
} else {
	
	$part != 'list' && require_once dirname(__FILE__)."/include/pinyin.inc.php";
	
	if($part == 'list' ){
		
		if(is_array($catorder)){
			foreach($catorder as $key => $value){
				$db->query("UPDATE `{$db_mymps}category` SET catorder = '$value' WHERE catid = ".$key);		
			}
		}
		
		if(is_array($if_viewids)){
			$db->query("UPDATE `{$db_mymps}category` SET if_view = '1' ");
			foreach($if_viewids as $key){
				$db->query("UPDATE `{$db_mymps}category` SET if_view = '2' WHERE catid = ".$key);
			}
		} else {
			$db->query("UPDATE `{$db_mymps}category` SET if_view = '1' ");
		}
		
		/*清除缓存*/
		foreach(array('option_static','pid_releate','tree','dir') as $range){
			clear_cache_files('category_'.$range);
		}
		
		write_msg('Post category has successfully been updated!','?part=list','record');
		
	} elseif ($part == 'add'){
		
		$catname  	 	= explode("\r\n",trim($catname));
		$template 	 	= empty($template) ? 'list' : trim($template);
		$template_info	= empty($template_info) ? 'info' : trim($template_info);
		$usecoin		= isset($usecoin) ? intval($usecoin) : 0;
		
		(empty($catname) || !is_array($catname)) && write_msg("Please Enter Category Name!");
		
		if(empty($catorder)){
			$sql = "SELECT MAX(catorder) FROM {$db_mymps}category";
			$maxorder = $db->getOne($sql);
			$catorder = $maxorder;
		}
		
		if(is_array($catname)){
			
			foreach ($catname as $key => $value){
				$value = trim($value);
				$catorder ++;
				$len = strlen($value);
				($len < 2 || $len > 30) && write_msg("Category name must be between 2 and 30 characters in length!");
				$db->query("INSERT INTO {$db_mymps}category (catname,usecoin,if_view,parentid,modid,catorder,if_upimg,if_mappoint,dir_type,template,template_info) VALUES ('$value','$usecoin','$isview','$parentid','$modid','$catorder','$if_upimg','$if_mappoint','$dir_type','$template','$template_info')");

				$insert_id = $db -> insert_id();
				
				//如果为一级栏目
				if($parentid == 0){
						
					if($dir_type == 1){
						
						$html_dir = '/'.$insert_id.'/';
						
					} elseif ($dir_type == 2) {
						
						$html_dir = '/'.GetPinyin($value).'/';
						$dir_typename = GetPinyin($value);
						
					} elseif ($dir_type == 3) {
						
						$html_dir = '/'.GetPinyin($value,1).'/';
						$dir_typename = GetPinyin($value,1);
						
					}
					
				} else {
					
					$row = $db -> getRow("SELECT * FROM `{$db_mymps}category` WHERE catid = '$parentid'");
					
					if($dir_type == 1){
						
						$html_dir = ($row['html_dir'] ? $row['html_dir'] : '/').$insert_id.'/';
						
					} elseif ($dir_type == 2) {
						
						$html_dir = ($row['html_dir'] ? $row['html_dir'] : '/').GetPinyin($value).'/';
						$dir_typename = GetPinyin($value);
						
					} elseif ($dir_type == 3) {
						
						$html_dir = ($row['html_dir'] ? $row['html_dir'] : '/').GetPinyin($value,1).'/';
						$dir_typename = GetPinyin($value,1);
						
					}
					
				}
				
				$db->query("UPDATE `{$db_mymps}category` SET dir_typename='$dir_typename',html_dir = '$html_dir' WHERE catid = '$insert_id'");

			}

			/*清除缓存*/
			foreach(array('option_static','pid_releate','tree','dir') as $range){
				clear_cache_files('category_'.$range);
			}
			
			$nav_path = 'Industry Management &raquo Add Category';
			$message  = 'Category Successfully Added';
			$after_action = "<a href='?part=add'><u>Continue Adding Category</u></a>
			&nbsp;&nbsp;<a href='?part=list'><u>Manage Added Category</u></a>";
			show_message($nav_path,$message,$after_action);
			
		}else{
			write_msg('Adding post category failed, please enter information according to the format.');
		}
		
	} elseif ($part == 'edit') {
	
		$template = empty($template) ? 'list' : trim($template);
		$usecoin  = isset($usecoin)  ? intval($usecoin) : 0 ;
		
		empty($catname) && write_msg("Please enter post category name");
		
		$catid == $parentid && write_msg("A post category must not from itself!");
		
		$len = strlen($catname);
		
		($len < 2 || $len > 30) && write_msg("Post category name must be between 2 and 30 characters in length!");
		
		$parentid != 0 && $row = $db -> getRow("SELECT catname,html_dir FROM `{$db_mymps}category` WHERE catid = '$parentid'");
		
		$description = $description ? textarea_post_change($description) : '';
		
		//自定义目录名
		if($dir_type == 4){
		
			!$mydir && write_msg('Please enter the customized directory!');
			
			if($parentid == 0){
				$html_dir = '/'.$mydir.'/';
			} else {
				$html_dir = $row['html_dir'].$mydir.'/';
			}
			
		} else {
			
			//如果为父目录
			if($parentid == 0){
					
				if($dir_type == 1){
					
					$html_dir = '/'.$catid.'/';
					
				} elseif ($dir_type == 2) {
					
					$html_dir = '/'.GetPinyin($catname).'/';
					
				} elseif ($dir_type == 3) {
					
					$html_dir = '/'.GetPinyin($catname,1).'/';
					
				}
				
			} else {
				
				if($dir_type == 1){
					
					$html_dir = $row['html_dir'].$catid.'/';
					
				} elseif ($dir_type == 2) {
					
					$html_dir = $row['html_dir'].GetPinyin($catname).'/';
					
				} elseif ($dir_type == 3) {
					
					$html_dir = $row['html_dir'].GetPinyin($catname,1).'/';
				
				}
				
			}
				
		}
		
		if($mydir && $db -> getOne("SELECT COUNT(catid) FROM `{$db_mymps}category` WHERE dir_typename = '$mydir' AND dir_typename != ''") > 1){
			write_msg("The directory".$mydir."already exists, please change or create a new directory!");
			exit;
		}
		
		$db->query("UPDATE `{$db_mymps}information` SET dir_typename = '$mydir' WHERE catid = '$catid'");
		$db->query("UPDATE {$db_mymps}category SET catname='$catname',icon='$icon',usecoin='$usecoin',if_view = '$isview',color='$fontcolor',title='$title',keywords='$keywords',description='$description',parentid='$parentid',modid='$modid',catorder='$catorder',dir_type = '$dir_type', dir_typename = '$mydir', html_dir = '$html_dir' ,if_upimg='$if_upimg',if_mappoint='$if_mappoint',template='$template',template_info='$template_info' WHERE catid = '$catid'");
		
		if($children_mod == '1'){
			$db -> query("UPDATE `{$db_mymps}category` SET modid = '$modid' WHERE ".get_children($catid,'catid'));
		}
		if($children_tpl == '1'){
			$db -> query("UPDATE `{$db_mymps}category` SET template = '$template' WHERE ".get_children($catid,'catid'));
		}
		if($children_tplinfo == '1'){
			$db -> query("UPDATE `{$db_mymps}category` SET template_info = '$template_info' WHERE ".get_children($catid,'catid'));
		}
		if($children_upload == '1'){
			$db -> query("UPDATE `{$db_mymps}category` SET if_upimg = '$if_upimg' WHERE ".get_children($catid,'catid'));
		}
		if($children_map == '1'){
			$db -> query("UPDATE `{$db_mymps}category` SET if_mappoint = '$if_mappoint' WHERE ".get_children($catid,'catid'));
		}
		if($children_des == '1'){
			$db -> query("UPDATE `{$db_mymps}category` SET description = '$description' WHERE ".get_children($catid,'catid'));
		}
		if($children_usecoin == '1'){
			$db -> query("UPDATE `{$db_mymps}category` SET usecoin = '$usecoin' WHERE ".get_children($catid,'catid'));
		}
		
		/*清除缓存*/
		foreach(array('option_static','pid_releate','tree','dir') as $range){
			clear_cache_files('category_'.$range);
		}
		
		$nav_path = 'Industry Management &raquo Edit Industry';
		$message  = 'Post Category Successfully Edited '.$catname;
		$after_action = "<a href='?part=add'><u>Continue Adding Category</u></a>
		&nbsp;&nbsp;<a href='?part=edit&catid=$catid'><u>Re-edit This Industry</u></a>&nbsp;&nbsp;<a href='?part=list#$catid'><u>Manage Added Categories</u></a>";
		show_message($nav_path,$message,$after_action);
		
	}
	
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();

function info_typemodels($modid=""){
	global $db,$db_mymps;
	$sql = "SELECT id,name,displayorder FROM `{$db_mymps}info_typemodels` ORDER BY displayorder ASC";
	$opt = $db->getAll($sql);
	foreach ($opt as $k => $value){
		$mymps .= "<option value=\"".$value[id]."\"";
		$mymps .= ($modid == $value[id])?"selected style=\"background-color:#6EB00C;color:white\"":"";
		$mymps .= ">".$value[name]."</option>";
	}
	return $mymps;
}
?>
