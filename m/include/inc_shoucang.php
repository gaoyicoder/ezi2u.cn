<?php
!defined('WAP') && exit('FORBIDDEN');
define('CURSCRIPT','shoucang');

$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : '';
$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : '';

if($ac == 'del'){

	empty($selectedids) && write_msg('','index.php?mod=shoucang&error=1&page='.$page);
	$db -> query("DELETE FROM `{$db_mymps}shoucang` {$where} AND id ".create_in($selectedids));
	write_msg('','index.php?mod=shoucang&success=3&page='.$page);

}elseif($ac == 'delthis'){
	
	if(!$id) write_msg('','index.php?mod=shoucang&error=1&page='.$page);
	$db->query("DELETE FROM `{$db_mymps}shoucang` WHERE id = '$id' AND userid = '$s_uid'");
	write_msg('','index.php?mod=shoucang&success=3&page='.$page);
	
} else {

	$sql = "SELECT a.*,b.id,c.catid,c.catname FROM {$db_mymps}shoucang AS a LEFT JOIN {$db_mymps}information AS b ON a.infoid = b.id LEFT JOIN {$db_mymps}category AS c ON b.catid = c.catid WHERE a.userid = '$s_uid' ORDER BY a.id DESC";

	$list     = array();	
	foreach(page1($sql) as $k => $row){
		$arr['id']          = $row['id'];
		$arr['catname']     = $row['catname'];
		$arr['infoid']      = $row['infoid'];
		$arr['title']  	    = SpHtml2Text($row['title']);
		$arr['intime']   	= get_format_time($row['intime']);
		$arr['url']  		= 'index.php?mod=information&id='.$row['infoid'];
		$list[]= $arr;
	}	
}

include mymps_tpl('member_shoucang');
?>