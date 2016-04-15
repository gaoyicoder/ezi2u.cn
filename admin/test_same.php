<?php
define('CURSCRIPT','test_same');
require_once(dirname(__FILE__)."/global.php");
require_once(MYMPS_INC."/db.class.php");

(!defined('IN_ADMIN') || !defined('IN_MYMPS')) && exit('Access Denied');

$part = isset($part)  ? $part : 'default' ;

if($part == 'default') {

	$here = 'Check For Repeated Categorized Post Themes';
	chk_admin_purview("purview_Delete Repeated");
	include mymps_tpl('test_same');
	exit();
	
} elseif($part == 'do_list') {

	$query = $db -> query("SELECT COUNT(title) AS dd,title FROM `{$db_mymps}information` GROUP BY title ORDER BY dd DESC LIMIT 0,$pagesize");
	$allarc = 0;
	include mymps_tpl('test_same_list');
	exit();
	
} else if($part == 'do_action') {
	//删除选中的内容（只保留一条）
    
    if(empty($infoTitles)){
        header("Content-Type: text/html; charset=".$charset."");
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8".$charset."\">\r\n";
        write_msg("You have not yet designated files to be deleted!");
        exit();
    }
	
    $totalarc = 0;
	$orderby = ($deltype=='delnew' ? " ORDER BY id DESC " : " ORDER BY id ASC ");
    
    foreach($infoTitles as $titles => $title){
	
         $title = trim($title);
         $title = addslashes( $title=='' ? '' : urldecode($title) );
         $sql = "SELECT id,title FROM `{$db_mymps}information` WHERE title='$title' $orderby";
         $query = $db->query($sql);
         $rownum = $db->num_rows($query);

         if($rownum < 2) continue;
         $i = 1;
         while($row = $db->fetchRow($query))
         {
               $i++;
               $nid = $row['id'];
               $ntitle = $row['title'];
               if($i > $rownum) continue;
               $totalarc++;
               DelInfo($nid);
         }
    }
    $db->query(" OPTIMIZE TABLE `{$db_mymps}information`; ");
    write_msg("You have deleted [<font color=red>{$totalarc}</font>] repeated post themes in total!","olmsg");
    exit();
}

function DelInfo($id=''){
	global $db,$db_mymps;
	if(!$id) exit;
	$get_row = $db -> getRow("SELECT * FROM `{$db_mymps}information` WHERE id = '$id'");
	@unlink(MYMPS_ROOT.$get_row['html_path']);
	if(!empty($get_row['img_path'])){
		$del = $db->getAll("SELECT path,prepath FROM `{$db_mymps}info_img` WHERE infoid='$id'");
		foreach ($del as $k => $v){
			@unlink(MYMPS_ROOT.$v[path]) ;
			@unlink(MYMPS_ROOT.$v[prepath]);
		}
		mymps_delete("info_img","WHERE infoid = '$id'");
	}
	
	/*删除信息评论*/
	mymps_delete("comment","WHERE type = 'information' AND typeid = '$id'");
	mymps_delete("info_extra","WHERE infoid = '$id'");
	mymps_delete("information","WHERE id = '$id'");
}
?>
