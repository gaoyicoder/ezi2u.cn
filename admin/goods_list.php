<?php
define('CURSCRIPT','goods');

require_once dirname(__FILE__)."/global.php";
require_once MYMPS_INC."/db.class.php";

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = $part ? trim($part) : 'list' ;
$id	  = isset($id) ? intval($id) : '';
$cityid	  = isset($cityid) ? intval($cityid) : '';

chk_admin_purview("purview_Goods List");

if(!submit_check(CURSCRIPT.'_submit')){
	
	require_once MYMPS_ROOT.'/plugin/goods/include/functions.php';
	
	$here = ($part == 'edit' ? 'Edit' : '').'Posted Vouchers';
	
	if($part == 'edit'){
	
		@include_once MYMPS_DATA.'/moneytype.inc.php';
		
		if(empty($id)) write_msg('Voucher number cannot be empty!');
		$edit = $db -> getRow("SELECT * FROM `{$db_mymps}goods` WHERE goodsid = '$id'");
		if(empty($edit['goodsid'])) write_msg('This Voucher no longer exists!');
		$acontent 	= get_editor('content','',$edit['content'],'100%','400');
		
	} else {
		
		$goodslevel = array('1'=>'<font color=green>For Sale</font>','2'=>'<font color=blue>No Longer For Sale</font>','3'=>'<font color=green>Recommended</font>','4'=>'<font color=red>Popular</font>','5'=>'<font color=purple>On Sale</font>');
		$goodsname = isset($goodsname) ? trim($goodsname) : '';
		$userid = isset($userid) ? trim($userid) : '';
		$catid = isset($catid) ? intval($catid) : '';
		
		$where = ' WHERE 1';
		$where .= $gname != '' ? " AND a.goodsname LIKE '%".$goodsname."%'" : ''; 
		$where .= $userid != '' ? " AND a.userid = '$userid'" : ''; 
		$where .= !empty($catid) ? " AND a.catid IN(".get_goods_children($catid).")" : '';
		$where .= $type == 1 ? " AND onsale = '1'" : '';
		$where .= $type == 2 ? " AND onsale = '2'" : '';
		$where .= $type == 3 ? " AND tuijian = '1'" : '';
		$where .= $type == 4 ? " AND remai = '1'" : '';
		$where .= $type == 5 ? " AND cuxiao = '1'" : '';
		$where .= $admin_cityid ? " AND cityid = '$admin_cityid'" : ($cityid ? " AND cityid = '$cityid'" : '');
		
		$rows_num = $db -> getOne("SELECT COUNT(a.goodsid) FROM `{$db_mymps}goods` AS a $where");
		$param = setParam(array('part','goodsname','userid','catid','cityid','type'));
		$goods = page1("SELECT a.*,b.catname FROM `{$db_mymps}goods` AS a LEFT JOIN `{$db_mymps}goods_category` AS b ON a.catid = b.catid $where ORDER BY a.dateline DESC");
	}
	
	include mymps_tpl('goods_'.$part);
	exit();
	
} else {
	
	if($part == 'list'){
		
		if(empty($selectedids)) write_msg('You have not selected any Voucher!');
		$create_in = create_in($selectedids);
		if(!$action || !in_array($action,array('delall','goodslevel1','goodslevel2','goodslevel3','goodslevel4','goodslevel5'))){
			write_msg('You have not designated any operation!');
		}
		if($action == 'delall'){
			$query = $db -> query("SELECT * FROM `{$db_mymps}goods` WHERE goodsid ".$create_in);
			while($row = $db -> fetchRow($query)){
				$delete[$row['id']]['picture'] = $row['picture'];
				$delete[$row['id']]['pre_picture'] = $row['pre_picture'];
			}
			foreach($delete as $k => $v){
				@unlink(MYMPS_ROOT.$v['picture']);
				@unlink(MYMPS_ROOT.$v['pre_picture']);
			}
			$db -> query("DELETE FROM `{$db_mymps}goods` WHERE goodsid ".$create_in);
			unset($delete,$row,$query,$create_in);
		} elseif(in_array($action,array('goodslevel1','goodslevel2','goodslevel3','goodslevel4','goodslevel5'))) {
			switch($action){
				case 'goodslevel1':
					$db -> query("UPDATE `{$db_mymps}goods` SET onsale = '1' WHERE goodsid ".$create_in);
				break;
				case 'goodslevel2':
					$db -> query("UPDATE `{$db_mymps}goods` SET onsale = '2' WHERE goodsid ".$create_in);
				break;
				case 'goodslevel3':
					$db -> query("UPDATE `{$db_mymps}goods` SET tuijian = '1' WHERE goodsid ".$create_in);
				
				break;
				case 'goodslevel4':
					$db -> query("UPDATE `{$db_mymps}goods` SET remai = '1' WHERE goodsid ".$create_in);
				break;
				case 'goodslevel5':
					$db -> query("UPDATE `{$db_mymps}goods` SET cuxiao = '1' WHERE goodsid ".$create_in);
				break;
			}
			
			unset($create_in,$action);
		}
	} elseif($part == 'edit') {
		
		if(empty($id)) write_msg('Voucher number cannot be empty!');
		if(empty($goodsname)) write_msg('Voucher name cannot be empty!');
		if(empty($content)) write_msg('Voucher details cannot be empty!');
		
		$name_file = 'goods_image';
		$catid = intval($catid);
		
		if($_FILES[$name_file]['name']){
			require_once MYMPS_INC.'/upfile.fun.php';
			$destination = "/goods/".date('Ym')."/";
			$mymps_image = start_upload($name_file,$destination,0,$mymps_mymps['cfg_goods_limit']['width'],$mymps_mymps['cfg_goods_limit']['height'],$picture,$pre_picture);
			$picture	 = $mymps_image[0];
			$pre_picture = $mymps_image[1];
			unset($mymps_image);
		}
		unset($name_file);

		$db -> query("UPDATE `{$db_mymps}goods` SET goodsname='$goodsname',content='$content',cityid='$cityid',catid='$catid',picture='$picture',pre_picture='$pre_picture',dateline='$timestamp',cityid='$cityid',userid='$userid',oldprice='$oldprice',nowprice='$nowprice',gift='$gift',huoyuan='$huoyuan',rushi='$rushi',tuihuan='$tuihuan',jiayi='$jiayi',weixiu='$weixiu',fahuo='$fahuo',zhengpin='$zhengpin',onsale='$onsale',tuijian='$tuijian',remai='$remai',cuxiao='$cuxiao',baozhang='$baozhang' WHERE goodsid = '$id'");
		
		$url = '?part=edit&id='.$id;
		exit();
		
	}
	
	write_msg('操作成功！',$url ? $url : '?part=list&cityid='.$cityid);
	
}
?>
