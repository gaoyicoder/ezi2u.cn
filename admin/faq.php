<?php
define('CURSCRIPT','faq');

require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

$do = $do ? $do : 'faq' ;
switch ($do){
	case 'faq':
		$part = $part ? $part : 'all' ;
		if($part == 'add'){
			chk_admin_purview("purview_Ask for Help");
			$acontent = get_editor('content','Default');
			$here = "Post Help Topic";
			$faq_type=$db->getAll("SELECT id,typename FROM `{$db_mymps}faq_type`");
			include(mymps_tpl(CURSCRIPT."_add"));
		}elseif($part == 'insert'){
			$db->query("INSERT INTO `{$db_mymps}faq` (id,typeid,title,content) Values ('','$typeid','$title','$content')");
			$inid = $db->insert_id();
			write_msg("Congratulations, this help on problem has successfully been posted!<br /><br /><a href='$db_mymps_global[SiteUrl]/public/about.php?part=faq&id=$inid' target=_blank>Click To View</a> | 
			<a href='faq.php?part=edit&id=$inid'>Re-edit</a> |  
			<a href='faq.php?part=all'>Return To Help List</a>			
			<br /><br />
			<a href='faq.php?part=add'>>>Continue Posting For Help</a>",'olmsg');
			clear_cache_files('cache');
			show_msg($msgs,"Help on problem <b>".$title."</b> has successfully been posted!");
		}elseif($part == 'edit'){
			if(trim($action) == 'dopost'){
				$update = $db->query("UPDATE `{$db_mymps}faq` SET title='$title',content='$content',typeid='$typeid' WHERE id = '$id'");
				if($update){
					write_msg("Congratulations, this help on problem has successfully been edited!<br /><br /><a href='$db_mymps_global[SiteUrl]/public/about.php?part=faq&id=$id' target=_blank>Click To View</a> | 
					<a href='faq.php?part=edit&id=$id'>Re-edit</a> |  
					<a href='faq.php?part=all'>Return To Help List</a>			
					<br /><br />
					<a href='faq.php?part=add'>>>Continue Posting For Help</a>",'olmsg');
					clear_cache_files('faq');
				}
			}else {
				$id = intval($id);
				$here = "Edit Help On Problems";
				$faq_type=$db->getAll("SELECT id,typename FROM `{$db_mymps}faq_type`");
				$edit = $db -> getRow("SELECT * FROM {$db_mymps}faq WHERE id = '$id'");
				$acontent = get_editor('content','Normal',$edit['content']);
				include(mymps_tpl(CURSCRIPT."_edit"));
			}
		}elseif($part == 'delete'){
			if(empty($id)){
				write_msg("No Record Selected");
			}else{
				mymps_delete("faq","WHERE id = '$id'");
				clear_cache_files('faq');
				write_msg("Help post $id has successfully been deleted!",$url,"mymps");
			}
		}elseif($part == 'all'){
			chk_admin_purview("purview_Problems");
			$faq_type=$db->getAll("SELECT id,typename FROM `{$db_mymps}faq_type`");
			$page = empty($page) ? '1' : intval($page);
			$where="WHERE a.typeid like '%".$typeid."%'";
			$sql = "SELECT a.id,a.title,b.typename,a.typeid FROM {$db_mymps}faq AS a LEFT JOIN {$db_mymps}faq_type AS b ON a.typeid = b.id $where ORDER BY a.id DESC";
			$rows_num = $db->getOne("SELECT COUNT(*) FROM {$db_mymps}faq AS a $where");
			$param	  =setParam(array('typeid'));
			$faq 	  = array();
			foreach(page1($sql) as $k => $row){
				$arr['id']       = $row['id'];
				$arr['title']    = $row['title'];
				$arr['typeid'] 	 = $row['typeid'];
				$arr['typename'] = $row['typename'];
				$faq[]      	 = $arr;
			}
			$here="Help Topic";
			include(mymps_tpl(CURSCRIPT."_all"));
		}elseif($part == 'delall'){
			$id = mymps_del_all("faq",$_POST['id']);
			clear_cache_files('faq');
			write_msg('Help post '.$id.' has successfully been deleted!',$url,'mymps_record');
		}
	break;
	case 'type':
		$part = $part ? $part : 'list' ;
		$here="<b>Category Management In Help Centre </b>";
		if ($part == 'list'){
			$links = $db->getAll("SELECT * FROM {$db_mymps}faq_type ORDER BY id Asc");
			include(mymps_tpl("faq_type"));
		}elseif ($part == 'insert'){
			$sql = "Insert Into `{$db_mymps}faq_type`(id,typename)
				Values('','$typename');";
			$res = $db->query($sql);
			clear_cache_files('faq');
			write_msg("Help category $typename has successfully been added!","faq.php?do=type","mymps");
		}elseif ($part == 'update'){
			$sql = "UPDATE {$db_mymps}faq_type SET typename='$typename' WHERE id = '$id'";
			$res = $db->query($sql);
			clear_cache_files('faq');
			write_msg("分类 $typename 更改成功","faq.php?do=type");
		}elseif ($part == 'delete'){
			if(empty($id)){
				write_msg("No Record Selected");
			}else{
				$url = '?do=type';
				$db -> query("DELETE FROM `{$db_mymps}faq` WHERE typeid = ".$id."");
				mymps_delete(CURSCRIPT."_type","WHERE id='$id'");
				clear_cache_files('faq');
				write_msg("Category  $id has successfully been deleted!",$url,"mymps");
			}
		}
	break;
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit;
?>
