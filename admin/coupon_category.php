<?php
define('CURSCRIPT','coupon');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = $part ? $part : 'list' ;

chk_admin_purview("purview_Coupon Categorie");

if(!submit_check(CURSCRIPT.'_submit')){

	$here = 'Coupon Category';
	$cate = $db -> getAll("SELECT * FROM `{$db_mymps}coupon_category`");
	include mymps_tpl('group_category');
	exit();

} else {
	
	if(is_array($cate_name)) {
		foreach($cate_name as $key => $val) {
			$catename	= trim($val);
			$cateorder	= intval($cate_order[$key]);
			$cateview	= intval($cate_view[$key]);
			if($catename) {
				$db->query("UPDATE `{$db_mymps}coupon_category` SET cate_view='$cateview', cate_order='$cateorder',cate_name='$catename' WHERE cate_id='$key'");
				unset($catename,$cateview,$cateorder);
			}
		}
	}

	if(is_array($newcate_order) && is_array($newcate_view) && is_array($newcate_name)) {
		foreach($newcate_name as $key => $cate_name) {
			$cate_name  = trim($cate_name);
			$cate_order = intval($newcate_order[$key]);
			$cate_view  = intval($newcate_view[$key]);
			if($cate_name) {
				$db->query("INSERT INTO	`{$db_mymps}coupon_category` (cate_view,cate_order,cate_name) VALUES ('$cate_view', '$cate_order','$cate_name')");
				unset($cate_order,$cate_name,$cate_view);
			}
		}
	}
	
	if(is_array($delete)) {
		$db -> query("DELETE FROM `{$db_mymps}coupon_category` WHERE ".create_in($delete,'cate_id'));
	}
	
	write_msg('Coupon Category Successfully Updated!','?','write_record');
	
}
?>
