<?php
define('CURSCRIPT','channel');

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
		
		chk_admin_purview("purview_News Categories");
		$f_cat = cat_list('channel',0,0,false);
		$here = "News Column List";
		include mymps_tpl("news_channel_list");
		
	} elseif($part == 'edit') {
		
		!$catid && write_msg('Please select the ID of column you wish to edit!');
		$cat = $db->getRow("SELECT * FROM {$db_mymps}channel WHERE catid = '$catid'");
		$here = "Edit News Column";
		include(mymps_tpl("news_channel_edit"));
		
	} elseif($part == 'add') {
		
		$maxorder = $db->getOne("SELECT MAX(catorder) FROM {$db_mymps}channel");
		$maxorder = $maxorder + 1;
		$here = "Add News Column";
		include(mymps_tpl("news_channel_add"));
		
	} elseif($part == 'del') {
		
		!$catid && write_msg('No Records Selected');
		
		mymps_delete("channel","WHERE catid = '$catid'");
		mymps_delete("channel","WHERE parentid = '$catid'");
		mymps_delete("news","WHERE catid IN(".get_cat_children($catid,'channel').")");
		
		foreach(array('option_static','pid_releate') as $range){
			clear_cache_files('channel_'.$range);
		}
		
		write_msg("News Column $catid has successfully been deleted!","channel.php?part=list","Mymps");
		
	}
	
} else {
	
	($part == 'add' || $part == 'edit') && require_once dirname(__FILE__)."/include/pinyin.inc.php";
	
	if($part == 'list'){
		
		if(is_array($catorder)){
			$cur_action .= 'Sort ';
			foreach($catorder as $key => $value){
				$db->query("UPDATE `{$db_mymps}channel` SET catorder = '$value' WHERE catid = ".$key);
			}
		}
		
		if(is_array($if_viewids)){
			$cur_action .= 'Enable/Disable';
			$db->query("UPDATE `{$db_mymps}channel` SET if_view = '1' ");
			foreach($if_viewids as $k => $val){
				$db->query("UPDATE `{$db_mymps}channel` SET if_view = '2' WHERE catid = ".$val);
			}
		} else {
			$db->query("UPDATE `{$db_mymps}channel` SET if_view = '1' ");
		}
				
		/*清除缓存*/
		foreach(array('option_static','pid_releate') as $range){
			clear_cache_files('channel_'.$range);
		}
		
		write_msg('News Column '.$cur_action.' has successfully been updated!','?part=list','record');
		
	} elseif ($part == 'add'){
		
		empty($catname) && write_msg('Please enter news column name!');
		$len		= strlen($catname);
		($len < 2 ) && write_msg("News column name must be over 2 characters in length!");
		$catname	= explode('|',trim($catname));
		
		if(empty($catorder)){
			$maxorder = $db->getOne("SELECT MAX(catorder) FROM {$db_mymps}channel");
			$catorder = $catorder + 1;
		}
		
		if(is_array($catname)){
			
			foreach ($catname as $key => $value){
				
				$value = trim($value);
				$catorder ++;
				$len = strlen($value);
				($len < 2 || $len > 30) && write_msg("Category name must be between 2 and 30 characters in length!");
				$db -> query("INSERT INTO {$db_mymps}channel (catname,if_view,title,keywords,description,parentid,catorder,dir_type) VALUES ('$value','$isview','$value','$value','$value','$parentid','$catorder','$dir_type')");
				$insert_id = $db -> insert_id();
				
				//如果为一级栏目
				if($parentid == 0){
					if($dir_type == 1){
						$html_dir = '/'.$insert_id.'/';
					} elseif ($dir_type == 2) {
						$html_dir = '/'.GetPinyin($value).'/';
					} elseif ($dir_type == 3) {
						$html_dir = '/'.GetPinyin($value,1).'/';
					}
				} else {
					$row = $db -> getRow("SELECT * FROM `{$db_mymps}channel` WHERE catid = '$parentid'");
					if($dir_type == 1){
						$html_dir = ($row['html_dir'] ? $row['html_dir'] : $row['html_dir']).$insert_id.'/';
					} elseif ($dir_type == 2) {
						$html_dir = ($row['html_dir'] ? $row['html_dir'] : $row['html_dir']).GetPinyin($value).'/';
					} elseif ($dir_type == 3) {
						$html_dir = ($row['html_dir'] ? $row['html_dir'] : $row['html_dir']).GetPinyin($value,1).'/';
					} 
				}
				
				$db->query("UPDATE `{$db_mymps}channel` SET html_dir = '$html_dir' WHERE catid = '$insert_id'");
			}
			
			/*清除缓存*/
			foreach(array('option_static','pid_releate') as $range){
				clear_cache_files('channel_'.$range);
			}
			
			write_msg('A news column has successfully been added!','?part=list','record');
			
		}else{
			write_msg('Adding news category failed; please input information according to format!');
		}
		
	} elseif ($part == 'edit') {
		
		empty($catname) && write_msg('Please enter the news column name!');
		
		strlen($catname) < 2 && write_msg("News column name must be over 2 characters in length!");
		
		$catid == $parentid && write_msg("A column must not from itself!");
		
		$parentid != 0 && $row = $db -> getRow("SELECT catname,html_dir FROM `{$db_mymps}channel` WHERE catid = '$parentid'");
		
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
		
		$sql = "UPDATE {$db_mymps}channel SET catname='$catname',if_view='$isview',title='$title',color='$fontcolor',keywords='$keywords',description='$description',parentid='$parentid',catorder='$catorder',dir_type = '$dir_type', dir_typename = '$mydir', html_dir = '$html_dir' WHERE catid = '$catid'";
		
		$res = $db->query($sql);
		
		$nav_path = 'News Column Management &raquo Edit Column';
		
		$message  = 'News Column Successfully Edited! '.$catname;
		
		$after_action = "<a href='?part=add'><u>Continue Adding Column</u></a>
		&nbsp;&nbsp;<a href='?part=edit&catid=$catid'><u>Re-Edit This Column</u></a>&nbsp;&nbsp;<a href='?part=list#$catid'><u>Added Columns Management</u></a>";
		
		/*清除缓存*/
		foreach(array('option_static','pid_releate') as $range){
			clear_cache_files('channel_'.$range);
		}
		
		show_message($nav_path,$message,$after_action);

	}
	
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();
?>
