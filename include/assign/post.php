<?php

if(!defined('IN_MYMPS')) exit('FORBIDDEN');

$catid = isset($catid) ? intval($catid) : '';

$city = get_city_caches($cityid);

if($action == 'input'){



	/*如果为分类选择页*/

	if(!$catid){

		

		$loc 		= get_location('post','','Select Category - Post Categorized Information');

		$page_title = $loc['page_title'];

		globalassign();

		$categories = get_categories_tree(0,'category');

		include mymps_tpl('info_post');

		

	}else{

		

		if(!empty($mymps_global['cfg_allow_post_area']) && !empty($ip2area)){

			$i = 1;

			$allow_post_area = array();

			$allow_post_area = explode('=',$mymps_global['cfg_allow_post_area']);

			$allow_post_areas = explode(',',$allow_post_area[0]);

			foreach($allow_post_areas as $k => $v){

				if(strstr($ip2area,$v)) {

					$i=$i+1;

				}

			}

			if($allow_post_area[1] == '-1' && $i == 1){

				write_msg("The system has detected that your IP is not<b style='color:red'>".$allow_post_area[0]."</b>the local IP!<br />If you wish to proceed, please contact our customer service staff.");

				exit;

			} elseif($allow_post_area[1] == 0 && $i == 1) {

				$info_level = 0;

			}

			unset($allow_post_area,$ip2area,$address,$ipdata,$allow_post_areas,$i);

		}

		

		if(!empty($mymps_global['cfg_forbidden_post_ip'])){

			foreach(explode(",", $mymps_global['cfg_forbidden_post_ip']) as $ctrlip) {

				if(preg_match("/^(".preg_quote(($ctrlip = trim($ctrlip)), '/').")/", $ip)) {

					$ctrlip = $ctrlip.'%';

					write_msg("Your current IP <b style='color:red'>".$ip."</b> has been blacklisted by the administrator, and therefore you are not allowed to make posts.");

					exit;

				}

			}

		}

		

		$cat = post_cat_info($catid);

		if($cat['parentid'] == 0) {

			$loc 		= get_location('post','','Select Catrgory - Post'.$cat[catname].'Information');

			$page_title = $loc['page_title'];

			$categories = get_categories_tree($catid,'category');

			globalassign();

			include mymps_tpl('info_post');

			exit;

		}elseif($db->getOne("SELECT COUNT(catid) FROM `{$db_mymps}category` WHERE parentid = '$catid'")){

			//���Ϊ��ײ����

			$cat_option = $db->getAll("SELECT catid,catname FROM `{$db_mymps}category` WHERE parentid = '$catid' ORDER BY catorder ASC");

		}

		

		require_once MYMPS_DATA."/info_lasttime.php";

		require_once MYMPS_DATA."/info.type.inc.php";

		require_once MYMPS_INC."/member.class.php";

		

		$document_domain = str_replace('http://www.','',$mymps_global['SiteUrl']);

		if($log = $member_log->chk_in()) chk_member_purview("purview_info");

		

		if($mymps_global['cfg_post_editor'] == 1){

			$acontent 	= get_editor('content','information','','400px','300px','include/kindeditor');

		} else {

			$acontent = "<textarea name=\"content\" style=\"width:400px;height:300px;\" class=\"input\" require=\"true\" datatype=\"limit\" msg=\"Please input the description of the content of the post.\"></textarea>";

		}

		

		if($log){

			//�жϽ���Ƿ��㹻

			$memberinfo			= $member_log -> get_info();

			$his_money 			= $memberinfo['money_own'];

			($his_money - $mymps_global['cfg_member_perpost_consume']) < 0 && write_msg('The credit on your account is <font color=red><b>'.$his_money.'</b></font>not sufficient for a post, please contact the administrator to recharge.');

			$per = $db->getRow("SELECT b.perday_maxpost FROM `{$db_mymps}member` AS a LEFT JOIN `{$db_mymps}member_level` AS b ON a.levelid = b.id WHERE a.userid = '$s_uid'");

			$perday_maxpost = $per[perday_maxpost];

			if(!empty($perday_maxpost)){

				$count = mymps_count("information","WHERE userid LIKE '$s_uid' AND begintime > '".mktime(0,0,0)."'");

				$count >= $perday_maxpost && write_msg("We are really sorry, members at your current membership level are allowed to make only".$perday_maxpost."posts a day.");

			}

			$onload 				= '';

			$areaid 				= $memberinfo['areaid'];

			$post['mobile'] 		= $memberinfo['mobile'];

			$post['qq'] 			= $memberinfo['qq'];

			$post['email'] 			= $memberinfo['email'];

			$post['userid'] 		= $memberinfo['userid'];

			$post['contact_who']  	= $memberinfo['cname'];

			$post['ismember'] 		= 1;

			$post['manage_pwd'] 	= '';

			$post['imgcode']= $authcodesettings['memberpost'] == 1 ? 1 : '';

			

		}else{

			if(!empty($mymps_global['cfg_nonmember_perday_post'])){

				$count = mymps_count("information","WHERE ip = '$ip' AND begintime > '".mktime(0,0,0)."' AND ismember = '0'");

				$count >= $mymps_global[cfg_nonmember_perday_post] && write_msg("We are really sorry, tourists are allowed to make only".$mymps_global[cfg_nonmember_perday_post]."posts a day.");

			}

			

			$mymps_global['cfg_if_nonmember_info']=='0' && write_msg("Sorry, making post requires signing in, please log-in before making a post.",$mymps_global['cfg_member_logfile']."?url=".urlencode(getUrl()));

			

			$onload = ($mymps_global['cfg_if_nonmember_info_box'] == 1)?"javascript:setbg('We suggest that you log-in before this operation.',450,70,'box.php?part=memberinfopost&url=".urlencode(urlencode(getUrl()))."')":"";

			$post['manage_pwd'] =  1;

			$post['ismember'] = 0;

			$post['imgcode']= $authcodesettings['post'] == 1 ? 1 : '';

			//write_msg('������¼���ٷ�����Ϣ��','login.php?url='.urlencode(GetUrl()));

		}

	

		$post['mymps_extra_value'] 	 = return_category_info_options($cat['modid']);

		$post['mymps_extra_value']   = is_array($post['mymps_extra_value']) ? $post['mymps_extra_value'] : array();

		$post['upload_img'] 		 = $cat['if_upimg'] == 1 ? get_upload_image_view(1,$id) : '';

		$post['GetInfoLastTime']	 = GetInfoLastTime();

		$post['action']		 	  	 ="input";

		$post['submit']		  	 	 = "Submit";

		$post['ip']				 	 = $ip;

		$post['catid']			  	 = $catid;

		$post['mixcode']			 = md5($cookiepre);

		$post['select_where_option'] = select_where_option('/include/selectwhere.php',$cityid,$areaid,$streetid);

		$loc 						 = get_location('post','','Input Content - Post Categorized Information');

		$page_title 				 = $loc['page_title'];

		

		/*��֤�ش�����*/

		$whenpost = '';

		$whenpost = $db -> getOne("SELECT value FROM `{$db_mymps}config` WHERE description = 'whenpost' AND type = 'checkanswe'");

		if($whenpost == '1' && $checkanswer = read_static_cache('checkanswer')){

			$checkquestion['id']		= $randid = array_rand($checkanswer,1);

			$checkquestion['question']  = $checkanswer[$randid]['question'];

			$checkquestion['answer']	= $checkanswer[$randid]['answer'];

		}

		

		globalassign();

		include mymps_tpl('info_post_write');

	}



} elseif ($action == 'edit') {



	require_once MYMPS_DATA."/info_lasttime.php";

	require_once MYMPS_DATA."/info.type.inc.php";

	require_once MYMPS_INC."/member.class.php";

	

	$id 	= intval($id);

	if(!$post = is_member_info($id)) write_msg('Operation failed, for the post you requested does not exist.');

	$catid 	= $post['catid'];

	$areaid = $post['areaid'];

	

	$document_domain = str_replace('http://www.','',$mymps_global['SiteUrl']);

	

	$cat = $db->getRow("SELECT a.if_upimg,a.modid,b.catid FROM `{$db_mymps}category` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.parentid = b.catid WHERE a.catid = '$catid'");

	

	if($post['ismember'] == 1){

		if(!$log = $member_log -> chk_in()){

			write_msg('',$mymps_global['SiteUrl'].'/'.$mymps_global['cfg_member_logfile'].'?url='.urlencode($mymps_global['cfg_postfile'].'?action=edit&id='.$id));

		}elseif($log && $s_uid != $post['userid']){

			write_msg('Operation failed, for this post is not made by you.','olmsg');

		}

		$nav_bar 		= '<a href="info.php?id='.$id.'">'.$post['title'].'</a> &raquo; Revise Post';

	}elseif($post[ismember] == 0 &&!empty($manage_pwd)){

		if(mymps_count("information","WHERE id = '$id' AND manage_pwd = '".md5($manage_pwd)."' AND ismember = 0") == 0){

			write_msg("Operation failed, for you have input the wrong administrator password.");

		}

		$post['manage_pwd']= "<tr><td class=\"tdr\">Administrator Password��</td><td><input type=\"password\" name=\"manage_pwd\" class=\"text\"/>

If no changes are to make, please leave it blank</td></tr>";

		$post[ismember] = 0;

		$nav_bar 		= '<a href="info.php?id='.$id.'">'.$post['title'].'</a> &raquo; <a href="../member/info.php?part=edit&id='.$id.'">Input Administrator Password</a> &raquo; Revise Post';

	}elseif($post[ismember] == 0 && empty($manage_pwd)){

		write_pwd("Revise");

	}

	

	if($mymps_global['cfg_post_editor'] == 1){

		$acontent 	= get_editor('content','information',$post[content],'400px','300px','include/kindeditor');

	} else {

		$acontent = "<textarea name=\"content\" style='width:400px;height:300px;'>".de_textarea_post_change($post[content])."</textarea>";

	}



	$title 	  = "Revise Content - ".$post['title'];

	$post['GetInfoLastTime']	 = GetInfoLastTime($post['activetime']);

	$post['mymps_extra_value'] 	 = return_category_info_options($cat['modid'],$id);

	$post['upload_img'] 		 = get_upload_image_edit($cat['if_upimg'],$id,'yes');

	$post['action']				 = "edit";

	$post['submit'] 			 = "Save Changes";

	$post['select_where_option'] = select_where_option('/include/selectwhere.php',$post['cityid'],$post['areaid'],$post['streetid']);

	$post['mixcode']			 = md5($cookiepre);

	$cat 					 	 = post_cat_info($catid);

	

	globalassign();

	include mymps_tpl('info_post_write');

	

} elseif($action == 'ok'){



	$ok['id']	   	= intval($id);

	$ok['filepath'] = trim(mhtmlspecialchars($filepath));

	$ok['title']	= trim(mhtmlspecialchars($title));

	$ok['level']	= intval($level);

	$r	= $db ->getRow("SELECT a.cityid,b.dir_typename FROM `{$db_mymps}information` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.catid = b.catid WHERE a.id = '$ok[id]'");

	$city = get_city_caches($r['cityid']);

	$ok['info_uri'] = Rewrite('info',array('id'=>$ok['id'],'cityid'=>$r['cityid'],'dir_typename'=>$r['dir_typename']));

	

	if(!$title || !$id) exit('Access Denied!');

	

	$nav_bar = 'Notification on Post';

	globalassign();

	include mymps_tpl('info_post_write_ok');

	

}



function post_cat_info($catid){

	global $db,$db_mymps;

	return $db -> getRow("SELECT a.catid,a.modid,a.if_upimg,a.catname,b.catid as parentid,a.if_mappoint,b.catname as parentname FROM `{$db_mymps}category` AS a LEFT JOIN `{$db_mymps}category` AS b ON a.parentid = b.catid WHERE a.catid = '$catid'");

}

?>

