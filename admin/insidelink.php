<?php
define('CURSCRIPT','insidelink');
require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = isset($part)  ? $part : 'list' ;
$id	  = isset($id)	  ? intval($id) : 0;

if(!submit_check(CURSCRIPT.'_submit')){
	
	$here = 'Settings On The Internal Link Of Text';
	chk_admin_purview("purview_Link-in-text");
	$insidelink_forward = array('information'=>'Categorized Post','news'=>'News','goods'=>'Products','group'=>'Group Purchase','coupon'=>'Coupon');
	$rows_num 	= mymps_count("insidelink");
	$param		= setParam(array("part"));
	$insidelink 	= page1("SELECT * FROM `{$db_mymps}insidelink` ORDER BY id DESC");
	$settings = $db -> getOne("SELECT value FROM `{$db_mymps}config` WHERE type = 'insidelink' AND description = 'insidelink'");
	$settings = ($charset == 'gb2312') ? unserialize($settings) : utf8_unserialize($settings);
	include(mymps_tpl(CURSCRIPT));

} else {
	
	if(is_array($settings)){
		$db -> query("DELETE FROM `{$db_mymps}config` WHERE type = 'insidelink'");
		$value = serialize($settings);
		$db -> query("INSERT INTO `{$db_mymps}config` (type,description,value)VALUES('insidelink','insidelink','$value')");
	}

	if(is_array($word)) {
		foreach($word as $key => $val) {
			$words	= trim($val);
			$urls	= trim($url[$key]);
			if($words) {
				$db->query("UPDATE `{$db_mymps}insidelink` SET url='$urls', word='$words' WHERE id='$key'");
			}
		}
	}

	if(is_array($newword) && is_array($newurl)) {
		foreach($newword as $key => $val) {
			$word = trim($val);
			$url  = trim($newurl[$key]);
			if($word) {
				$db->query("INSERT INTO	`{$db_mymps}insidelink` (word,url) VALUES ('$word', '$url')");
			}
		}
	}
	
	if(is_array($delete)) {
		$db -> query("DELETE FROM `{$db_mymps}insidelink` WHERE ".create_in($delete,'id'));
	}
	
	write_insidelink_cache();
	unset($word,$url,$words,$urls,$newword,$newurl);
	
	write_msg('Settings on the internal link of text have successfully been updated!','insidelink.php','write_record');

}

is_object($db) && $db->Close();
$mymps_global = $db = $db_mymps = $part = NULL;
exit();
?>
