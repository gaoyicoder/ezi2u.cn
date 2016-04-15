<?php
define('CURSCRIPT','member_comment');
require_once dirname(__FILE__).'/global.php';
require_once MYMPS_INC.'/db.class.php';

$where = $userid ? "WHERE userid = '$userid'" : '';
$where .= $commentlevell ? " AND commentlevel = '$commentlevel'" : '';

$mlevel = array();
$mlevel[0] = '<font color=red>Under Revision</font>';
$mlevel[1] = '<font color=#006acd>Normal</font>';

if(!submit_check(CURSCRIPT.'_submit')){
	chk_admin_purview("purview_Template Review");
	$here = 'Comment By Other Users';
	$rows_num = mymps_count("member_comment",$where);
	$param	  = setParam(array("part"));
	$comment 	  = page1("SELECT * FROM `{$db_mymps}member_comment` $where ORDER BY id DESC");
	include mymps_tpl(CURSCRIPT);
} else {
	if(is_array($ids)){
		if($part == 'delall'){
			foreach ($ids as $kids => $vids){
				mymps_delete("member_comment","WHERE id = ".$vids);
			}
			write_msg('Designated comment has successfully been deleted!',$url,'writerecord');
		} elseif (strstr($part,'level')) {
			$part = FileExt($part);
			foreach ($ids as $kids => $vids){
				$db->query("UPDATE `{$db_mymps}member_comment` SET commentlevel = '$part' WHERE id = ".$vids);
			}
			write_msg('Status of designated comment has successfully been set to '.$mlevel[$part].'！',$url,'writerecord');
		} else {
			write_msg('Undefined Action!');
		}
	} else {
		write_msg('Please select comment you wish to operate on!');
	}
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();
?>
