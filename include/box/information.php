<?php
!defined('IN_MYMPS') && exit('FORBIDDEN');
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";
require_once MYMPS_INC."/cache.fun.php";
require_once MYMPS_INC."/class.fun.php";

$filepath	=	isset($_GET['filepath']) ? trim($_GET['filepath']) : '';
$level		=	isset($_GET['level'])	 ? trim($_GET['level'])	   : '';

$ok['id']	   = intval($_GET['id']);
$ok['filepath'] = trim($_GET['filepath']);
$ok['infotitle']= trim($_GET['title']); 
$ok['seotitle'] = "Post Successful - Make Categorized Posts";
$ok['level']	   = $level;
$ok['content']  = ($level==0) ? "":
$ok['info_uri'] = Rewrite('info',array('id'=>$ok['id'],'html_path'=>$ok['filepath']));

$nav_bar = 'Notification on Post';
globalassign();
include mymps_tpl("info_post_write_ok");
?>