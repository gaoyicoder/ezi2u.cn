<?php
define('CURSCRIPT','announce');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

$part = $part ? $part : 'all' ;
$cityid = $cityid ? intval($cityid) : 0;

if($part == 'add' || $part == 'edit'){
	require_once dirname(__FILE__)."/include/color.inc.php";
	$mymps_title_color = $color;
}

if($part == 'add'){

	chk_admin_purview("purview_Post a Ann");
	
	$acontent = get_editor('content','Normal');
	$here = "Post Site Announcement";
	include(mymps_tpl("announce_add"));
	
}elseif($part == 'insert'){

	$db->query("Insert Into `{$db_mymps}announce` (id,cityid,title,titlecolor,content,pubdate,begintime,endtime,author,redirecturl) Values ('','$cityid','$title','$titlecolor','$content','$timestamp','".strtotime($begintime)."','".strtotime($endtime)."','$author','$redirecturl')");
	$inid = $db->insert_id();
	
	clear_cache_files('city_'.$cityid);
		
	$nav_path = 'Site Announcement Management &raquo Post Site Announcement';
	$message  = 'Announcement Successfully Added <<'.$title.'>>';
	$after_action = "<a href='../about.php?part=announce#$inid' target=\"_blank\"><u>View This Announcement</u></a>&nbsp;&nbsp;<a href='?part=add'><u>Add More Announcements</u></a>&nbsp;&nbsp;<a href='?part=edit&id=$inid'><u>Re-edit This Announcement</u></a>&nbsp;&nbsp;<a href='announce.php'><u>Added Announcement Management</u></a>";
	show_message($nav_path,$message,$after_action);
	
}elseif($part == 'edit'){

	if(trim($_POST[action])=='dopost'){

		$sql = "UPDATE `{$db_mymps}announce` SET cityid = '$cityid',title='$title',titlecolor ='$titlecolor',content='$content',author='$author',pubdate='$timestamp',begintime='".strtotime($begintime)."',endtime='".strtotime($endtime)."',redirecturl='$redirecturl' WHERE id = '$id'";
		$res = $db->query($sql);
		
		clear_cache_files('city_'.$cityid);
		
		$nav_path = 'Site Announcement Management &raquo Edit Site Announcement';
		$message  = 'Announcement Successfully Edited <<'.$title.'>>';
		$after_action = "<a href='../about.php?part=announce#$id' target=\"_blank\"><u>View This Announcement</u></a>&nbsp;&nbsp;<a href='?part=add'><u>I want to add an announcement</u></a>&nbsp;&nbsp;<a href='?part=edit&id=$id'><u>Re-edit This Announcement</u></a>&nbsp;&nbsp;<a href='announce.php'><u>Added Announcement Management</u></a>";
		
		show_message($nav_path,$message,$after_action);
		
	}else{
	
		$id = intval($id);
		$here = "Edit Site Announcement";
		$edit = $db -> getRow("SELECT * FROM {$db_mymps}announce WHERE id = '$id'");
		$acontent = get_editor('content','Normal',$edit['content']);
		include(mymps_tpl("announce_edit"));
		
	}
}elseif($part == 'delete'){

	$id = intval($id);
	
	if(empty($id))write_msg("No Records Of Selection");
	else{
		mymps_delete("announce","WHERE id = '$id'");
		clear_cache_files('city_'.$cityid);
		write_msg("Deleting announcement $id has been successful",$url,"Mymps_record");
	}
	
}elseif($part == 'all'){

	chk_admin_purview("purview_Ann list");
	
	$page = empty($page) ? 1 : intval($page);
	$where = $title ? " AND title like '%".$title."%'" : "";
	$where .= $author ? " AND author like '%".$author."%'" : "";
	$where .= $admin_cityid ? " AND cityid = '$admin_cityid'" : ($cityid ? " AND cityid = '$cityid'" : " AND cityid = '0'");
	$sql = "SELECT * FROM {$db_mymps}announce WHERE 1 $where ORDER BY id DESC";
	$rows_num = mymps_count('announce','WHERE 1'.$where);
	$param=setParam(array('id','title','author','cityid'));
	$announce = page1($sql);
	$here="List Of Announcements";
	include(mymps_tpl("announce_all"));
	
}elseif($part == 'delall'){

	clear_cache_files('city_'.$cityid);
	write_msg('Delete Announcement '.mymps_del_all("announce",$_POST[id]).' Successful',$url,"Mymps_record");
	
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit;
?>
