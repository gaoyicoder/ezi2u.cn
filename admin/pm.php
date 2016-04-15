<?php
define('CURSCRIPT','pm');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once MYMPS_MEMBER.'/include/common.func.php';

!in_array($part,array('outbox','send','del')) && $part = 'send';

function member_groups(){
	global $db,$db_mymps;
	$all = $db->getAll("SELECT * FROM `{$db_mymps}member_level`");
	foreach($all as $k => $v){
		$mymps .= '<option value='.$v[id].'>'.$v[levelname].'</option>';
	}
	return $mymps;
}

if(!submit_check(CURSCRIPT.'_submit')){

	chk_admin_purview("purview_In-site Messages");
	
	$here = ($part == 'send') ? 'Send Message To Multiple Users' : 'Sent Massages';
	if($part == 'outbox'){
		
		$sql 	  = "SELECT * FROM `{$db_mymps}member_pm` WHERE if_sys = '1' AND if_del = '0' ORDER BY id DESC";
		$rows_num = mymps_count("member_pm","WHERE if_sys = '1'");
		$param	  = setParam(array('part'));
		$pm 	  = page1($sql);
	} elseif($part == 'send' && $id) {

		$pm_row = $db->getRow("SELECT title,content FROM `{$db_mymps}member_pm` WHERE id = '$id'");
		$title = de_textarea_post_change($pm_row['title']);
		$content = de_textarea_post_change($pm_row['content']);
	} elseif($part == 'del') {
		//$db->query("UPDATE `{$db_mymps}member_pm` SET if_del = 1 WHERE id = ".$id);
		mymps_delete("member_pm","WHERE id = '$id'");
		write_msg('Message numbered '.$id.'has successfully been deleted!',$url,'writerecord');
	}
	include mymps_tpl(CURSCRIPT.'_'.$part);
}else{
	if(is_array($delids)){
		foreach ($delids as $kids => $vids){
			//$db->query("UPDATE `{$db_mymps}member_pm` SET if_del = 1 WHERE id = ".$vids);
			mymps_delete("member_pm","WHERE id = ".$vids);
		}
		write_msg('The designated message has successfully been deleted!',$url);
	}
	
	set_time_limit(0);
	$content = textarea_post_change($content);
	(empty($touser) && empty($group)) && die('Please designate the user you wish to message to!') ;
	
	echo '<style>*{font-size:12px}</style>';
	
	if(is_array($group)){
		foreach($group AS $kid  => $vid){
			if(!$rgrow = $db -> getAll("SELECT userid FROM `{$db_mymps}member` WHERE levelid = '$vid'")){
				echo 'There are not yet any members in this group!';
			}else{
				foreach ($rgrow AS $row){
					$result = sendpm($admin_id,$row[userid],$title,$content,1);
					if($result[succ] == 'yes') {
						echo 'Sending Message: <font color=green>Successful!</font> To: '.$result[member].'<br>';
					}else{
						echo 'Sending Message: <font color=red>Failed!</font> To: '.$result[member].'<br>';
					}
					ob_flush();
					flush();
				}
			}
		}
	} else {
		$touser = str_replace('，',',',$touser);
		$touser = explode(',',$touser);
		foreach ($touser AS $kuser => $vuser){
			$result = sendpm($admin_id,$vuser,$title,$content,1);
			echo '<style>*{font-size:12px}</style>';
			if($result[succ] == 'yes') {
				echo 'Sending Message: <font color=green>Successful!</font> To: '.$result[member].'<br>';
			}else{
				echo 'Sending Message: <font color=red>Failed!</font> To: '.$result[member].'<br>';
			}
			ob_flush();
			flush();
		}
	}
	
	write_msg('Message Sending Completed','olmsg','record');
}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();
?>
