<?php

define('IN_SMT',true);

define('IN_MYMPS',true);

require_once dirname(__FILE__)."/include/global.php";

require_once dirname(__FILE__)."/data/config.php";

require_once MYMPS_DATA."/config.db.php";

require_once MYMPS_INC."/db.class.php";

require_once MYMPS_INC."/member.class.php";

$iflogin 	= $member_log -> chk_in();



$action  = isset($action)	? trim($action) 	: '';

$part 	 = isset($part)		? trim($part) 		: '';

$id   	 = isset($id) 		? intval($id) 		: '';

$inajax  = isset($inajax) 	? intval($inajax) 	: '';



if(empty($id)) exit('Access Denied!');

if(!in_array($part,array('information','news','store'))) write_msg('The module you wish to submit your comment to  must not be empty!');

$dotphpurlarray = array('information'=>'information.php','news'=>'news.php','coupon'=>'coupon.php','group'=>'group.php');



$commentsettings = get_commentsettings();

/*���ر�����Ϣ����*/

if(!$commentsettings[$part]){

	exit(html2js('<div class="closed">The administrator has disabled comments on this module.</div>'));

	$commentsettings = $part = $db = $db_mymps = $id = NULL;

}



if($action == 'insert'){

	$_COOKIE['comment'.$part.$id] == 1 && write_msg('You have been commenting too frequently, so please take a pause before continuing.');

	if(!$iflogin && !$randcode = mymps_chk_randcode($checkcode)){

		write_msg('Incorrect identifying code, please return and retry.');

		exit;

	}

	empty($content) && write_msg("Submission failed, for the content of comment cannot be empty!");

	strlen($content)>255 && write_msg("�벻Ҫ��д����127������(�й�Ԫ�أ����黻�����)!");

	

	if(!$iflogin){

	

		switch($commentsettings[$part]){

			case 1:

				$userid = '';

			break;

			case 2:

				$loginuser	= $loginuser ? mhtmlspecialchars($loginuser) : '';

				$loginpwd	= $loginpwd	 ? mhtmlspecialchars($loginpwd)	 : '';

				if(empty($loginuser)) write_msg('Please enter your User ID!');

				if(empty($loginpwd)) write_msg('Please enter your password!');

				$loginpwd = md5($loginpwd);

				if(!$res = $db -> getOne("SELECT id FROM `{$db_mymps}member` WHERE userid = '$loginuser' AND userpwd = '$loginpwd'")){

					unset($res);

					write_msg('ou have input the incorrect user ID or password, or the designated user ID does not exist!');

				} else {

					$userid		= $loginuser;

					$member_log -> in($loginuser,$loginpwd,'','noredirect');

				}

			break;

		}

		

	} else {

		$userid = $s_uid;

	}

	

	

	$result 		= verify_badwords_filter($mymps_global['cfg_if_comment_verify'],'',$content);

	$content 		= textarea_post_change($result['content']);

	$comment_level  = $result['level'];

	$db->query("INSERT INTO `{$db_mymps}comment` (typeid,content,pubtime,ip,comment_level,userid,type)VALUES('$id','$content','$timestamp','".GetIP()."','$comment_level','".$userid."','$part')");

	

	setcookie('comment'.$part.$id,1,$timestamp+30,'/');

	

	if($comment_level == 1){

		write_msg("",$dotphpurlarray[$part]."?id=".$id.'#comment_write');

	}else{

		define('IN_AJAX',true);

		write_msg("The comment you submitted may contain forbidden content and will be displayed after being revised!",$dotphpurlarray[$part]."?id=".$id);

	}

	unset($loginuser,$loginpwd,$comment_level,$id);

}



$res = $db->getAll("SELECT content,userid,pubtime,ip FROM `{$db_mymps}comment` WHERE typeid = '$id' AND comment_level = '1' AND type = '$part' ORDER BY pubtime ASC LIMIT 0,10");

foreach($res as $k => $row){

	$arr['content']    = $row['content'];

	$arr['pubtime']    = get_format_time($row['pubtime']);

	$arr['userid']     = $row['userid'];

	$arr['ip']     = $row['ip'];

	$comment_all[]     = $arr;

}

	

$ajax_content ='

<div class="box specialpostcontainer">';

if(is_array($comment_all)){

	$i = 0;

	foreach($comment_all as $key => $val){

	$i++;

	$ajax_content.='

		<div class="specialpost">

		<div class="postinfo">

		<h2>';

	$ajax_content.= $val['userid'] ? '<a class="dropmenu" style="font-weight: normal;" href="'.Rewrite("space",array("user"=>$val["userid"])).'" target="_blank" >'.$val["userid"].'</a>' : '<a class="dropmenu" style="font-weight: normal;">'.part_ip($val['ip']).'</a>';

	$ajax_content.='

		'.$val["pubtime"].' </h2>

		<strong>'.$i.'<sup>Floor</sup></strong>

		</div>

		<div class="postmessage">

		<div class="t_msgfont">'.$val["content"].'

		</div>

		</div>

		</div>';

	}

} else {

	

	$ajax_content.='

	<div class="specialpost">

	<div class="postinfo">

	<h2>No one have made any comments yet.^_^</h2>

	<strong></strong>

	</div>

	</div>';

	

}



$ajax_content.=' 

	<div id="postleave">

		<a name="comment_write"></a>

		<form action="'.$mymps_global["SiteUrl"].'/comment.php?part='.$part.'&amp;action=insert" method="post" id="CommentForm" name="CommentForm" onsubmit="return CommentCheckForm();">

		<input name="id" value="'.$id.'" type="hidden">

		<dl><dt>Content:  </dt><dd><textarea name="content" class="commenttextarea"></textarea></dd></dl>

		';

		

		

if($iflogin){

	$ajax_content .= '<div class=clearfix></div><dl><dt>&nbsp;</dt><dd><div style="margin-top:5px">'.$s_uid.' &nbsp;<a href="'.$mymps_global[SiteUrl].'/'.$mymps_global[cfg_member_logfile].'?part=out&url='.urlencode($mymps_global["SiteUrl"].'/'.$dotphpurlarray[$part].'?id='.$id).'">Exit</a></div></dd></dl>';

} else {



	/*����Ա��¼״̬���� */

	if($commentsettings[$part] == 2){

		$ajax_content .= '

			<div class="clearfix"></div>

			<dl>

			<dt>Log-in Account: </dt>

			<dd>

			<input name="loginuser" class="commenttxt" style="width:100px;">

			&nbsp;&nbsp;&nbsp;&nbsp; 

			Password<input name="loginpwd" type="password" class="commenttxt" style="width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$mymps_global[SiteUrl].'/'.$mymps_global[cfg_member_logfile].'?mod=register" target="_blank">Register an Account &raquo;</a>

			</dd>

			</dl>

		';

	}

	

	$ajax_content .='<div class="clearfix"></div>';

	

	$ajax_content .= '<dl><dt>Code:  </dt><dd><input name="checkcode" class="commenttxt" type="text" style="width:74px"/> <img src="'.$mymps_global["SiteUrl"].'/'.$mymps_global[cfg_authcodefile].'" alt="Cannot see clearly? Click to Refresh." class="authcode" align="absmiddle" onClick="this.src=this.src+\'?\'"/></span></dd></dl>';

}

		

$ajax_content .= '

		<div class="clearfix"></div>

		<dl><dt>&nbsp;</dt><dd><input type="submit" class="commentsubmit" value="Submit" style="line-height:18px" name="mymps"></dd></dl>

		</form> 

	</div>

</div>

';

echo html2js($ajax_content);

is_object($db) && $db -> Close();

unset($ajax_concotent,$iflogin,$mymps_global,$member_log,$comment_all,$rows_num,$param,$page,$userid,$content,$inajax,$id,$part,$action,$userid,$s_uid,$db,$timestamp,$dotphpurlarray,$commentsettings);

exit();

?>

