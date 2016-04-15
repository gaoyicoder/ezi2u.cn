<?php
define('CURSCRIPT','admin');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

switch ($do){
	case 'user':
		$part = $part ? $part : 'list' ;
		
		if($part == 'list'){
			chk_admin_purview("purview_User List");
			$where .= $typeid ? "AND a.typeid = 'typeid'":"";
			$where .= $admin_cityid ? " AND a.cityid = '$admin_cityid'" : ($cityid ? " AND a.cityid = '$cityid'" : "");
			$sql = "SELECT a.id,a.userid,a.cityid,a.uname,a.tname,a.logintime,a.loginip,a.typeid,b.typename FROM `{$db_mymps}admin` AS a LEFT JOIN `{$db_mymps}admin_type` AS b ON a.typeid = b.id WHERE 1 {$where} ORDER BY a.typeid Asc";
			
			$admin = $db->getAll($sql);
			$allcities = get_allcities();
			$here = "Administrator Account Management";
			include mymps_tpl("admin_user");
		}elseif ($part=='add'){
			chk_admin_purview("purview_User List");
			$here = "Add Site Administrator Account";
			include mymps_tpl("admin_user_add");
		}elseif($part=='insert'){
			$pwd = md5(trim($pwd));
			!is_email($email) && write_msg("The Email address is in the wrong format.");
			mymps_count("admin","WHERE userid LIKE '$userid'") > 0 && write_msg("An account with this name already exists, so please try using another name!");
			$db->query("INSERT INTO `{$db_mymps}admin`(userid,cityid,uname,tname,pwd,typeid,email)
				VALUES('$userid','$cityid','$uname','$tname','$pwd','$typeid','$email'); ");
			write_admin_cache();
			write_msg("Successfully added $userid as administrator","?do=user","record");
			
		}elseif($part=='edit'){
			$id = $id ? $id : $db->getOne("SELECT id FROM `{$db_mymps}admin` WHERE userid = '$userid'");
			$sql = "SELECT * FROM {$db_mymps}admin WHERE id = '$id'";
			$admin = $db->getRow($sql);
			if(!$admin) write_msg("This administrator account does not exist!");
			if($admin_cityid && $admin['cityid'] != $admin_cityid) write_msg("This administrator is not from your sub-site");
			$here = "Edit Administrator Account";
			include mymps_tpl("admin_user_edit");
		}elseif ($part == 'update'){
			if(!is_email($email)){write_msg("The Email address is in the wrong format.");exit();}
			$pwd = !empty($pwd) ? "pwd='".md5($pwd)."'," :"";
			$db->query("UPDATE {$db_mymps}admin SET {$pwd} userid='$userid',cityid='$cityid',uname='$uname',typeid='$typeid',tname='$tname',email='$email' WHERE id = '$id'");
			write_admin_cache();
			write_msg("Site administrator account $uname has successfully been edited","admin.php?do=user&part=edit&id=".$id,"record");
		}elseif($part == 'delete'){
			if(empty($id)){
				write_msg("No Records Of Selections");
			}else{
				if(mymps_delete("admin","WHERE id = '$id'")){
					write_admin_cache();
					write_msg("Successfully Deleted $id From Administrators","?do=user","record");
				}else{
					write_msg("Deleting Administrator Failed!");
				}
			}
		}
	break;
	case 'group':
		require_once(dirname(__FILE__)."/include/mymps.menu.inc.php");
		$part = $part ? $part : 'list';
		if ($part == 'list'){
			chk_admin_purview("purview_User Group");
			$sql = "SELECT * FROM {$db_mymps}admin_type ORDER BY id desc";
			$group = $db->getAll($sql);
			$here = "System User Group Management";
			include mymps_tpl("admin_group");
		}elseif($part == 'add'){
			
			chk_admin_purview("purview_User Group");
			
			$here = "Add User Group";
			include(mymps_tpl("admin_group_add"));
		}elseif($part == 'insert'){
			$purview  = is_array($_POST['purview']) ? implode(",", $_POST['purview']) : '';
			$typename = trim($_POST['typename']);
			$ifsystem = trim($_POST['ifsystem']);
			if(!empty($typename)){
				$sql = "select count(*) from {$db_mymps}admin_type where typename = '$typename'";
				$db->getOne($sql) && write_msg("User group with this name already exists, please try using another group name!");
			}
			$res = $db->query("Insert Into `{$db_mymps}admin_type`(id,typename,ifsystem,purviews)
				Values('','$typename','$ifsystem','$purview')");
			write_admin_cache();
			write_msg("User group $typename has successfully been added!","?do=group","record");
		}elseif($part == 'edit'){
			$sql = "SELECT * FROM {$db_mymps}admin_type WHERE id = '$id'";
			$group = $db->getRow($sql);
			$purview = explode(',',$group['purviews']);
			$here = "Change Authority Of User Group";
			include(mymps_tpl("admin_group_edit"));
		}elseif($part=='update'){
			$purview = is_array($purview) ? implode(",", $purview) : '';
			$sql = "UPDATE `{$db_mymps}admin_type` SET typename='$typename',ifsystem='$ifsystem',purviews='$purview' WHERE id = '$id'";
			if($res = $db->query($sql)){
				write_admin_cache();
				write_msg("User group $typename has successfully been edited!","?do=group&part=edit&id=".$id,"record");
			}
		}elseif($part == 'delete'){
			if(empty($id)){
				write_msg("No Records Of Selections");
			}elseif (mymps_count("admin","WHERE typeid = '$id'")>0){
				write_msg("There are still users in this group, so it cannot be deleted!");
			}else {
				if(mymps_delete("admin_type","WHERE id = '$id'")){
					write_admin_cache();
					write_msg("User group $id has successfully been deleted!","?do=group","record");
				}else{
					write_msg("Deleting Administrator User Group Failed!");
				}
			}
		}
	break;
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();

function get_admin_group($typeid=""){
	global $db,$db_mymps;
	$admin = $db->getAll("SELECT * FROM `{$db_mymps}admin_type` ORDER BY id desc");
	foreach($admin AS $row)
	{
		$mymps .= "<option value=\"".$row[id]."\"";
		$mymps .= ($typeid == $row[id])?"selected style=\"background-color:#6EB00C;color:white\"":"";
		$mymps .= ">".$row[typename]."</option>";
	}
	return $mymps;
}
?>
