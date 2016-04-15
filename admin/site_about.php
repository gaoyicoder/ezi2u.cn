<?php
define('CURSCRIPT','site_about');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

!in_array($part,array('list','edit')) && $part = 'list'; 

if(!submit_check(CURSCRIPT.'_submit')){
	
	chk_admin_purview("purview_Column Settings");
	
	require_once MYMPS_DATA."/html_type.inc.php";
	
	if($id) $about = $db->getRow("SELECT * FROM {$db_mymps}about WHERE id = '$id'");
	$acontent = $id ? get_editor('content','Default',$about['content']) : get_editor('content','Default','');
	$about[displayorder] = $id ? $about[displayorder] : ($db->getOne("SELECT max(displayorder) FROM `{$db_mymps}about` "))+1;
	$about_type = $db->getAll("SELECT * FROM {$db_mymps}about ORDER BY displayorder ASC");
	$here = 'About Us Settings';

	include mymps_tpl('site_about');
	
} else {
	
	if($part == 'list'){
		
		if(is_array($delids)){
			$delids = implode(',',$delids);
			mymps_delete("about","WHERE id IN($delids)");
		}
		if(is_array($displayorder)){
			foreach($displayorder as $key => $value){
				$db->query("UPDATE `{$db_mymps}about` SET displayorder = '$value' WHERE id = ".$key);		
			}
		}
	
	} elseif($part == 'edit') {
		
		require_once dirname(__FILE__)."/include/pinyin.inc.php";
		
		$pubdate = $time;
		$content = trim($content);
		
		if(!$id){
			//新增
			if(empty($typename)) write_msg('Column Name Cannot Be Empty');
			if(empty($content)) write_msg('Column Content Cannot Be Empty');
			
			$db -> query("INSERT INTO {$db_mymps}about (typename,dir_type,content,pubdate,displayorder) VALUES ('$typename','$dir_type','$content','$pubdate','$displayorder')");
			$id = $db -> insert_id();
			//获得路径类型
			$dir_typename = get_htmlpath_type($dir_type,$typename,$id,$mydir);
			//更新html路径
			$db -> query("UPDATE `{$db_mymps}about` SET dir_typename = '$dir_typename' WHERE id = '$id'");
		} else {
			//修改
			$dir_typename = get_htmlpath_type($dir_type,$typename,$id,$mydir);
			$db->query("UPDATE {$db_mymps}about SET typename = '$typename', content='$content',pubdate='$pubdate', dir_type = '$dir_type' , dir_typename = '$dir_typename',displayorder = '$displayorder' WHERE id = '$id'");
			$forward_url = '?part=edit&id='.$id;
			
		}
		
	}
	
	write_msg("About Us Column has successfully been updated or deleted!",$forward_url ? $forward_url : '?part=list' ,"write_sys_record");
	
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit;
?>
