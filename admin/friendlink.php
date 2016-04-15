<?php
define('CURSCRIPT','friendlink');
require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

$do = $do ? $do : 'link';
switch ($do){
	case 'link':
		$part = $part ? $part : 'list';
		require_once MYMPS_INC."/flink.fun.php";
		if($part == 'list'){
			chk_admin_purview("purview_Related Sites");
			$where = $ifindex ? " WHERE ifindex = '$ifindex'" : " WHERE 1";
			$where .= $catid   ? " AND catid = '$catid'" : "";
			$where .= $admin_cityid ? " AND cityid = '$admin_cityid'" : ($cityid ? " AND cityid = '$cityid'" : " AND cityid = '0'");
			$rows_num = mymps_count("flink",$where);
			$param	= setParam(array("do","cityid","part","ifindex","catid"));
			$links 	= page1("SELECT * FROM {$db_mymps}flink $where ORDER BY ordernumber ASC");
			$here 	= "Related Link Management";
			$cats = $db -> getAll("SELECT * FROM `{$db_mymps}category` WHERE parentid = '0'");
			include mymps_tpl(CURSCRIPT."_default");
		}elseif($part == 'add'){
			chk_admin_purview("purview_Add a Site");
			$here = "Add Related Link";
			$sql = "SELECT * FROM {$db_mymps}flink_type ORDER BY id Asc";
			$links = $db->getAll($sql);
			include mymps_tpl(CURSCRIPT."_add");
		}elseif($part == 'insert'){
			
			$sql = "Insert Into `{$db_mymps}flink`(id,cityid,ifindex,url,webname,weblogo,typeid,createtime,ischeck,ordernumber,catid)
				Values('','$cityid','$ifindex','$url','$webname','$weblogo','$typeid','$timestamp','$ischeck','$ordernumber','$catid'); ";
			$res = $db->query($sql);
			clear_cache_files('city_'.$cityid);
			write_msg("Related link $webname has successfully been added!","?part=list","mymps");
			
		}elseif ($part == 'edit'){
			
			$sql = "SELECT * FROM {$db_mymps}flink WHERE id = '$id'";
			$link = $db->getRow($sql);
			$here = "Edit Related Link";
			include mymps_tpl(CURSCRIPT."_edit");
			
		}elseif($part == 'update'){
			
			if(empty($url)||empty($webname)){write_msg("Please enter information in full");exit();};
			$sql = "UPDATE {$db_mymps}flink SET cityid='$cityid',webname='$webname',weblogo='$weblogo',url='$url',catid='$catid',ordernumber='$ordernumber',createtime='$timestamp',ifindex='$ifindex',ischeck='$ischeck',msg='".textarea_post_change($msg)."',name='$name',qq='$qq',email='$email',typeid='$typeid',dayip='$dayip',pr='$pr' WHERE id = '$id'";
			$res = $db->query($sql);
			clear_cache_files('city_'.$cityid);
			write_msg("Related link $webname has successfully been edited!","?part=edit&id=".$id,"mymps");
			
		}elseif($part == 'delete'){
			
			if(empty($id))write_msg("No Record Selected");
			mymps_delete("flink","WHERE id = '$id'");
			clear_cache_files('city_'.$cityid);
			write_msg("Related link $id has successfully been deleted!","friendlink.php".$cityid);
			
		}elseif ($part == 'doall'){
		
			if(is_array($ordernumber)){
				foreach($ordernumber as $korder => $value){
					$db->query("UPDATE `{$db_mymps}flink` SET ordernumber = '$value' WHERE id = '$korder'");	
				}
			}
			
			if(is_array($ids)){
				if(in_array($do_action,array('index','inside','del'))){
					if($do_action == 'index') {
						$db -> query("UPDATE `{$db_mymps}flink` SET ifindex = '2' WHERE ".create_in($ids,'id'));
					} elseif($do_action == 'inside') {
						$db -> query("UPDATE `{$db_mymps}flink` SET ifindex = '1' WHERE ".create_in($ids,'id'));
					} elseif($do_action == 'del') {
						$db -> query("DELETE FROM `{$db_mymps}flink` WHERE ".create_in($ids,'id'));
					}
				}
			}
			
			clear_cache_files('city_'.$cityid);
			write_msg("Related link has successfully been updated or deleted!", "?do=link&part=list&cityid=".$cityid,"mymps");
		}
	break;
	case 'type':
		$part = $part ? $part : 'list' ;
		$here="<b>Site Type Management</b>";
		if ($part == 'list'){
			$sql = "SELECT * FROM {$db_mymps}flink_type ORDER BY id Asc";
			$links = $db->getAll($sql);
			include mymps_tpl(CURSCRIPT."_type");
		}elseif ($part == 'insert'){
			$typename = trim($typename);
			$sql = "Insert Into `{$db_mymps}flink_type`(id,typename)
				Values('','$typename');";
			$res = $db->query($sql);
			write_msg("Site category $typename has successfully been added","?do=type","mymps");
		}elseif ($part == 'update'){
			$typename = trim($_POST['typename']);
			$sql = "UPDATE {$db_mymps}flink_type SET typename='$typename' WHERE id = '$id'";
			$res = $db->query($sql);
			write_msg("Category $typename has successfully been edited!","?do=type&part=edit&id=".$id,"mymps");
		}elseif ($part == 'delete'){
			if(empty($id)){
				write_msg("No Record Selected");
			}else{
				mymps_delete("flink_type","WHERE id = '$id'");
				write_msg("Category $id has successfully been deleted!","?do=type","mymps");
			}
		}
	break;
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit;
?>
