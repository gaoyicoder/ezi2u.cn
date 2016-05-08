<?php

!defined('IN_MYMPS') && exit('FORBIDDEN');

define('IN_MYMPS',true);

define('MEMBERDIR',MYMPS_ROOT.'/member');

require_once MYMPS_INC.'/cache.fun.php';

require_once MYMPS_INC.'/class.fun.php';

require_once MYMPS_DATA."/config.db.php";

require_once MYMPS_INC."/db.class.php";

require_once MYMPS_INC."/member.class.php";



if(!$id) write_msg('For deleted Posts, the ID of the caption can not be blank.');

if(!$infoid = $db->getOne("SELECT id FROM `{$db_mymps}information` WHERE id = '$id' AND info_level > 0")) write_msg('The post you are trying to delete does not exist or is under revision.','olmsg');



$post	= is_member_info($id);

$manage_pwd = isset($_POST['manage_pwd']) ? trim($_POST['manage_pwd']) : '';



if(empty($manage_pwd) && !$post['ismember']){

	

	include MYMPS_ROOT.'/template/box/info_write_pwd.html';



}elseif(!empty($manage_pwd)||$post['ismember']==1){



	if($post['ismember'] == 0 && (mymps_count("information","WHERE id = '$id' AND manage_pwd = '".md5($manage_pwd)."'")<=0)) write_msg("Deleting failed, for you have typed in the wrong administrator code.");

	

	if($post['ismember'] == 1){

		if(!$member_log -> chk_in()){

			@include MYMPS_DATA.'/caches/authcodesettings.php';

			$authcodesettings = $data;

			$data = NULL;

			$gourl = 'delinfo';

			include MYMPS_ROOT.'/template/box/login.html';

			$authcodesettings = NULL;

			exit;

		} elseif($s_uid != $post['userid']){

			write_msg("Deleting Failed, for this post was not made by you.","olmsg");

			exit;

		}

	}

	

	mymps_delete("information_".$post[modid],"WHERE id = '$id'");

	$image = $db->getAll("SELECT id,path,prepath FROM `{$db_mymps}info_img` WHERE infoid = '$id'");

	

	if(is_array($image)){

		foreach ($image as $k => $v){

			@unlink(MYMPS_ROOT.$v['prepath']);

			@unlink(MYMPS_ROOT.$v['path']);

			mymps_delete("info_img","WHERE id = $v[id]");

		}

	}

	

	mymps_delete("information","WHERE id = '$id'");

	

	$url = ($post['ismember'] == 1) ? $mymps_global['SiteUrl'].'/member/index.php?m=info' : $mymps_global['SiteUrl'];

	write_msg("Post number $id has successfully been deleted!<br /><br /><input value=\"Close Window\" type=\"button\" onclick=\"parent.location.href='$url';parent.closeopendiv();\" style='margin-left:auto;margin-right:auto;' class='blue'>",olmsg);

	

}

?>

