<?php
define('CURSCRIPT','plugin');
require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

!defined('IN_ADMIN') && exit('Access Denied');

chk_admin_purview("purview_Installed Plugins");

if(!submit_check(CURSCRIPT.'_submit')) {
	
	if($op == 'disable' && !empty($id)){
		
		$db -> query("UPDATE `{$db_mymps}plugin` SET disable = '1' WHERE id = '$id'");
		write_plugin_cache();
		echo '<script language="javascript">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>';
		write_msg('This plug-in has successfully been disabled!','plugin.php','write_record');
		
	} elseif($op == 'able' && !empty($id)){
		
		$db -> query("UPDATE `{$db_mymps}plugin` SET disable = '0' WHERE id = '$id'");
		write_plugin_cache();
		echo '<script language="javascript">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>';
		write_msg('This plug-in has successfully been enabled!','plugin.php','write_record');
		
	} elseif($op == 'edit' && !empty($id)) {
		
		$here = 'Plug-in Details';
		$edit = $db -> getRow("SELECT * FROM `{$db_mymps}plugin` WHERE id = '$id'");
		if(!$edit['flag']) write_msg('The plug-in you have designated does not exist!');
		$edit['config'] = $charset == 'utf-8' ? utf8_unserialize($edit['config']) : unserialize($edit['config']);
		include mymps_tpl('plugin_edit');
	
	} else {

		$here = 'Plug-in Management';
		$plugin = $db -> getAll("SELECT * FROM `{$db_mymps}plugin`");
		include mymps_tpl(CURSCRIPT);

	}
	
} else {
	
	if($op == 'edit' && !empty($id)){
		$config = serialize($config);
		$db -> query("UPDATE `{$db_mymps}plugin` SET config = '$config' WHERE id = '$id'");
		$return = 'plugin.php?op=edit&id='.$id;
	}
	write_plugin_cache();
	echo '<script language="javascript">window.parent.framLeft.location.reload(); </script><style>body,*,html{font-size:12px;}</style>';
	write_msg('Plug-in settings has successfully been updated!<br />Should management menu for the plug-in do not show up, please press F5 to refresh the page.',$return ? $return : 'plugin.php','write_admin_record');
}

is_object($db) && $db->Close();
$mymps_global = $db = $op = $db_mymps = $part = NULL;
exit();
?>
