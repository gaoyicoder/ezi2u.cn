<?php
define('CURSCRIPT','goods_category');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";
require_once dirname(__FILE__)."/include/color.inc.php";
require_once dirname(__FILE__)."/include/ifview.inc.php";

@require_once MYMPS_ROOT."/plugin/goods/include/functions.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = $part ? $part : 'list' ;

$cat_color = $color;

if(!submit_check(CURSCRIPT.'_submit')) {
	
	if($part == 'list'){
		
		chk_admin_purview("purview_Goods Categories");
		$f_cat = goods_cat_list('category',0,0,false);
		$here = "Product Category List";
		include(mymps_tpl("goods_category_list"));
		
	} elseif($part == 'edit') {
		include MYMPS_DATA.'/category_tpl.inc.php';
		$cat = $db->getRow("SELECT * FROM {$db_mymps}goods_category WHERE catid = '$catid'");
		$here = "Edit Product Category";
		include(mymps_tpl("goods_category_edit"));
		
	} elseif($part == 'add') {
		include MYMPS_DATA.'/category_tpl.inc.php';
		$maxorder = $db->getOne("SELECT MAX(catorder) FROM {$db_mymps}goods_category");
		$maxorder = $maxorder + 1;
		$here = "Add Product Category";
		include mymps_tpl("goods_category_add");
		
	} elseif($part == 'del') {
		
		empty($catid) && write_msg('No Records Selected');
		mymps_delete("goods_category","WHERE catid = '$catid'");
		mymps_delete("goods_category","WHERE parentid = '$catid'");
		mymps_delete("goods","WHERE catid IN (".get_goods_children($catid).")");
																	 
		clear_cache_files('goods_category_option_static');
		clear_cache_files('goods_category_pid_releate');
		clear_cache_files('goods_category_tree');
		write_msg("Product category $catid has successfully been deleted!","goods_category.php?part=list","Mymps");
		
	}
	
} else {
	
	if($part == 'list' ){
		
		if(is_array($catorder)){
			foreach($catorder as $key => $value){
				$db->query("UPDATE `{$db_mymps}goods_category` SET catorder = '$value' WHERE catid = ".$key);		
			}
		}
		
		if(is_array($if_viewids)){
			$db->query("UPDATE `{$db_mymps}goods_category` SET if_view = '1' ");
			foreach($if_viewids as $key){
				$db->query("UPDATE `{$db_mymps}goods_category` SET if_view = '2' WHERE catid = ".$key);
			}
		} else {
			$db->query("UPDATE `{$db_mymps}goods_category` SET if_view = '1' ");
		}
		
		/*清除缓存*/
		foreach(array('option_static','pid_releate','tree') as $range){
			clear_cache_files('goods_category_'.$range);
		}
		
		write_msg('Product category has successfully been updated!','?part=list','record');
		
	} elseif ($part == 'add'){
		
		$catname  	 = explode('|',trim($catname));
		$template 	 = empty($template) ? 'list' : trim($template);
		
		(empty($catname) || !is_array($catname)) && write_msg("Please enter product category name");
		
		if(empty($catorder)){
			$sql = "SELECT MAX(catorder) FROM {$db_mymps}goods_category";
			$maxorder = $db->getOne($sql);
			$catorder = $catorder + 1;
		}
		
		if(is_array($catname)){
			
			foreach ($catname as $key => $value){
				$value = trim($value);
				$catorder ++;
				$len = strlen($value);
				($len < 2 || $len > 30) && write_msg("Product category name must be between 2 and 30 characters in length!");
				$db->query("INSERT INTO {$db_mymps}goods_category (catname,if_view,title,keywords,description,parentid,catorder) VALUES ('$value','$isview','$value','$value','$value','$parentid','$catorder')");

			}

			/*清除缓存*/
			foreach(array('option_static','pid_releate','tree') as $range){
				clear_cache_files('goods_category_'.$range);
			}
			
			$nav_path = 'Product Category Management &raquo Add Product Category';
			$message  = 'Product Category Successfully Added';
			$after_action = "<a href='?part=add'><u>Continue Adding Product Category</u></a>
			&nbsp;&nbsp;<a href='?part=list'><u>Added Product Category Management</u></a>";
			show_message($nav_path,$message,$after_action);
			
		}else{
			write_msg('Adding product category failed, please enter information according to the format.');
		}
		
	} elseif ($part == 'edit') {
	
		$template = empty($template) ? 'list' : trim($template);
		
		empty($catname) && write_msg("Please enter product category name");
		
		$catid == $parentid && write_msg("A product category must not include itself!");
		
		$len = strlen($catname);
		
		($len < 2 || $len > 30) && write_msg("Product category name must be between 2 and 30 characters in length!");
		
		$sql = "UPDATE {$db_mymps}goods_category SET catname='$catname',if_view = '$isview',color='$fontcolor',title='$title',keywords='$keywords',description='$description',parentid='$parentid',catorder='$catorder' WHERE catid = '$catid'";
		
		$res = $db->query($sql);
		
		/*清除缓存*/
		foreach(array('option_static','pid_releate','tree') as $range){
			clear_cache_files('goods_category_'.$range);
		}
		
		$nav_path = 'Product Category Management &raquo Edit Product Category';
		$message  = 'Product Category Successfully Edited '.$catname;
		$after_action = "<a href='?part=add'><u>Continue Adding Product Category</u></a>
		&nbsp;&nbsp;<a href='?part=edit&catid=$catid'><u>Re-edit This Product Category</u></a>&nbsp;&nbsp;<a href='?part=list#$catid'><u>Added Product Category Management</u></a>";
		show_message($nav_path,$message,$after_action);
		
	}
	
}

is_object($db) && $db->Close();
$db = $mymps_global = $part = $action = $here = NULL;
exit();
?>
