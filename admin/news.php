<?php
define('CURSCRIPT','news');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_DATA."/info.level.inc.php";
require_once MYMPS_INC."/db.class.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = $part ? $part : 'list' ;

$iscommend_arr = array('0'=>'Normal','1'=>'<font color=red>Recommended</font>');

if(!submit_check(CURSCRIPT.'_submit')) {

	chk_admin_purview("purview_News List");
	
	if($part == 'list'){

		$here = "Site News Management";
		$where .= $title != '' ? "WHERE a.title LIKE '%".$title."%'" : "WHERE 1";
		$where .= $catid ? " AND a.catid IN (".get_cat_children($catid,'channel').")":'';
		$sql = "SELECT a.*,b.catname FROM `{$db_mymps}news` AS a LEFT JOIN `{$db_mymps}channel` AS b ON a.catid = b.catid $where ORDER BY a.begintime DESC";
		$rows_num = $db -> getOne("SELECT COUNT(*) FROM `{$db_mymps}news` AS a $where");
		$param	= setParam(array("part","title","catid"));
		$news 	= page1($sql);
		
		include(mymps_tpl("news_list"));
		
	} elseif($part == 'edit' && $id) {
		
		$row = $db->getRow("SELECT * FROM {$db_mymps}news WHERE id = '$id'");
		$acontent = get_editor('content','Default',$row[content],'100%','600px');
		$here = "Edit News Piece";
		
		include(mymps_tpl(CURSCRIPT));
		
	} elseif($part == 'add') {
		
		$acontent = get_editor('content','Default','','100%','600px');
		$here = "Add News Piece";
		
		include(mymps_tpl(CURSCRIPT));
		
	} elseif($part == 'del') {
		
		if(empty($id)){
			write_msg('No Record Selected');
		}
		
		$html_path = $db -> getOne("SELECT html_path FROM `{$db_mymps}news` WHERE id = '$id'");
		@unlink(MYMPS_ROOT.$html_path);
		
		mymps_delete("news","WHERE id = '$id'");
		write_msg("News piece with ID $id has successfully been deleted!",$url,"Mymps");
	}
	
} else {
	
	/*
	批量删除新闻
	*/
	if($part == 'list'){
		$i = '';
		if(is_array($delids)){
			$i = 1;
			foreach ($delids as $kids => $vids){
				$html_path = $db -> getOne("SELECT html_path FROM `{$db_mymps}news` WHERE id = '$vids'");
				@unlink(MYMPS_ROOT.$html_path);
				mymps_delete("news","WHERE id = ".$vids);
			}
		}else{
			write_msg('You have not designated news ID for the operation');
		}
		
		($i == 1) && write_msg('The news piece with designated ID has been deleted!',$url,'insertecord');
		
	/*
	新增新闻
	*/
	} elseif ($part == 'add'){
		
		!$title && write_msg("Please Enter Title Of News");
		!$catid && write_msg("Please Enter Category Name");
		($isjump == 1 && !$redirect_url) && write_msg('Please enter the URL that the news jumps to!');
		($isjump != 1 && !$content) && write_msg('Please enter content of news!');
		
		//如果为跳转地址
		if($isjump == 1){
			
			$do_mymps = $db->query("INSERT INTO `{$db_mymps}news` (title,cityid,catid,redirect_url,isjump,isbold,iscommend,begintime,introduction,author,source,keywords) VALUES ('$title','$cityid','$catid','$redirect_url','1','$isbold','$iscommend','$timestamp','$introduction','$author','$from','$keywords')");

		}else{
																																																								 			$redirect_url = '';								
			if($ifout == 'bodyimg'){
				$imgpath = bodyimg(mystripslashes($content));
			}
			$do_mymps = $db->query("INSERT INTO `{$db_mymps}news` (title,cityid,keywords,catid,isbold,iscommend,content,hit,perhit,begintime,introduction,author,source,imgpath) VALUES
('$title','$cityid','$keywords','$catid','$isbold','$iscommend','$content','$hit','$perhit','$timestamp','$introduction','$author','$from','$imgpath')");
			
		}
		$id = $db -> insert_id();
		
		//添加焦点图
		if(is_array($isfocus) && $imgpath){
			foreach($isfocus as $kfocus => $vfocus){
				if($vfocus == 'index'){
					//首页焦点图
					$typename = 'Site Homepage';
				} else {
					$typename = 'News Homepage';
				}
				
				$db->query("INSERT INTO `{$db_mymps}focus` (image,pre_image,words,url,pubdate,focusorder,typename)
				VALUES('$imgpath','$imgpath','$title','$viewpath','$timestamp','$id','$typename')");
			}
			clear_cache_files('focus_index');
			clear_cache_files('focus_news');
		}
		
		$nav_path = 'News Management &raquo Add News';
		$message  = 'A News Piece Successfully Added <<'.$title.'>>';
		$after_action = "<a href=\"../news.php?id=".$id."\" target=\"_blank\"><u>View This News</u></a>&nbsp;&nbsp;<a href='?part=add'><u>Continue Adding News</u></a>&nbsp;&nbsp;<a href='?part=edit&id=$id'><u>Re-edit This News Piece</u></a>&nbsp;&nbsp;<a href='?part=list'><u>Added News Management</u></a>";
		show_message($nav_path,$message,$after_action);
		
	/*
	修改新闻内容
	*/
	} elseif ($part == 'edit') {
		
		!$id && write_msg("The news piece with designated ID has been deleted!");
		!$title && write_msg("Please Enter Title Of News");
		!$catid && write_msg("Please Enter Category Name");
		($isjump == 1 && !$redirect_url) && write_msg('Please enter the URL that the news jumps to!');
		($isjump != 1 && !$content) && write_msg('Please enter content of news!');
		
		//如果为跳转地址
		if($isjump == 1){
			
			$do_mymps = $db->query("UPDATE `{$db_mymps}news` SET title = '$title' , redirect_url = '$redirect_url' , catid = '$catid', cityid = '$cityid' , keywords = '$keywords' , iscommend = '$iscommend' , isbold = '$isbold' , isjump = '1' , hit = '$hit' , perhit = '$perhit' , imgpath = '$imgpath' , author = '$author' , source = '$from' , introduction = '$introduction' WHERE id = '$id'");

		}else{
			
			$redirect_url = '';
			if($ifout == 'bodyimg'){
				$imgpath = bodyimg(mystripslashes($content));
			}
			
			$do_mymps = $db->query("UPDATE `{$db_mymps}news` SET title = '$title', content = '$content', keywords = '$keywords' , catid = '$catid' , cityid = '$cityid' , iscommend = '$iscommend' , isbold = '$isbold' , isjump = '0' , hit = '$hit' , perhit = '$perhit' ,begintime = '$timestamp' , imgpath = '$imgpath' , author = '$author' , source = '$from' , introduction = '$introduction' WHERE id = '$id'");
			
		}
		
		//生成html
		$viewpath = $mymps_global['SiteUrl'].'/news.php?id='.$id;
			
		
		//添加焦点图
		if(is_array($isfocus) && $imgpath){
			foreach($isfocus as $kfocus => $vfocus){
				if($vfocus == 'index'){
					//首页焦点图
					$typename = 'Site Homepage';
				} else {
					$typename = 'News Homepage';
				}
				
				$db->query("INSERT INTO `{$db_mymps}focus` (image,pre_image,words,url,pubdate,focusorder,typename,cityid)
				VALUES('$imgpath','$imgpath','$title','$viewpath','$timestamp','$id','$typename','$cityid')");
			}
			clear_cache_files('focus_index');
			clear_cache_files('focus_news');
		}
		
		$nav_path = 'News Management &raquo Edit News';
		
		$message  = 'News Successfully Edited <<'.$title.'>>';
		
		$after_action = "<a href=".$viewpath." target=\"_blank\"><u>View This News</u></a>&nbsp;&nbsp;<a href='?part=add'><u>Adding A News</u></a>&nbsp;&nbsp;<a href='?part=edit&id=$id'><u>Re-edit This News Piece</u></a>&nbsp;&nbsp;<a href='?part=list'><u>Added News Management</u></a>";
		
		show_message($nav_path,$message,$after_action);
		
	}
	
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();

function bodyimg($obj) { 
	if(isset($obj)){ 
		if ( preg_match( "<img.*src=[\"](.*?)[\"].*?>", $obj, $regs ) ) { 
			return $obj = $regs[1]; 
		}
	} else {
		return false;
	}
}

function mystripslashes($string)
{
	if(!is_array($string)) return stripslashes($string);
	foreach($string as $key => $val) $string[$key] = new_stripslashes($val);
	return $string;
}
?>
<br />
