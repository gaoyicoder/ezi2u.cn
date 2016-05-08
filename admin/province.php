<?php

define('CURSCRIPT','province');

require_once(dirname(__FILE__)."/global.php");

require_once(MYMPS_INC."/db.class.php");



if(!submit_check(CURSCRIPT.'_submit')){

	

	$here = '省份/直辖市管理（中国元素，建议了解马来西亚行政区划后再行翻译）';

	$province = $db -> getAll("SELECT * FROM `{$db_mymps}province` ORDER BY displayorder ASC");

	include mymps_tpl("province");



}else{



	if(is_array($provincename)) {

		foreach($provincename as $key => $val) {

			$province_name	= trim($val);

			$display_order	= intval($displayorder[$key]);

			if($province_name) {

				$db->query("UPDATE `{$db_mymps}province` SET displayorder='$display_order',provincename='$province_name' WHERE provinceid='$key'");

				unset($province_name,$display_order);

			}

		}

	}



	if(is_array($newdisplayorder) && is_array($newprovincename)) {

		foreach($newprovincename as $key => $provincename) {

			$provincename  = trim($provincename);

			$displayorder = intval($newdisplayorder[$key]);

			if($provincename) {

				$db->query("INSERT INTO	`{$db_mymps}province` (displayorder,provincename) VALUES ( '$displayorder','$provincename')");

				unset($displayorder,$provincename,$cate_view);

			}

		}

	}

	

	if(is_array($delete)) {

		$db -> query("DELETE FROM `{$db_mymps}province` WHERE ".create_in($delete,'provinceid'));

	}

	

	write_msg('省份/直辖市设置更新成功（中国元素，建议了解马来西亚行政区划后再行翻译）','?','write_record');

	

}

?>