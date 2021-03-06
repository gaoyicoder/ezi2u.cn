<?php

define('IN_SMT',true);

define('CURSCRIPT','post');

define('IN_MYMPS', true);

define('IN_MANAGE',true);



require_once dirname(__FILE__)."/include/global.php";

require_once dirname(__FILE__)."/data/config.php";

require_once MYMPS_DATA."/config.db.php";

require_once MYMPS_INC."/db.class.php";

require_once MYMPS_INC."/upfile.fun.php";

require_once MYMPS_DATA."/config.inc.php";



$curCity = array("JOHOR", "KEDAH", "KELANTAN", "K. LUMPUR", "MELAKA", "N. SEMBLAN", "PAHANG", "P. PENANG", "PERAK", "PERLIS", "SELANGOR", "TERENGGANU", "SABAH", "SARAWAK");



ifsiteopen();

$data = '';

@include MYMPS_DATA.'/caches/authcodesettings.php';

$authcodesettings = $data;

$data = NULL;



!in_array($action,array('input','edit','ok')) && $action = 'input';

$action = isset($action) ? trim($action) : '';



if($action != 'ok')

{

	$ip = '';

	$ip = GetIP();

	$ip2area 	= $address = $ipdata = '';

	require_once MYMPS_INC.'/ip.class.php';

	$ipdata  = new ip();

	$address = $ipdata -> getaddress($ip);

	$ip2area = $address['area1'].$address['area2'];

	$ip2area = iconv('GB2312','UTF-8',$ip2area);

	if($mymps_global['cfg_if_post_othercity'] == 0 && $cityid && is_array($cityarr = get_ip2city($ip))){

		if($cityid != $cityarr[cityid]) write_msg('Your IP is not from this sub-site, so please do not make any posts in this sub-site.^_^');

	}

	unset($ipdata,$address);

}



if($act == 'dopost') {



	if(!$mixcode || $mixcode != md5($cookiepre)){

		die('FORBIDDEN');

		exit();

	}

	

	empty($cityid) && write_msg('Please select a sub-site to post to!');

	empty($title) && write_msg("Please enter post title!");

	empty($content) && write_msg("You have not yet entered description of content!");

	empty($tel) && write_msg("Phone number cannot be empty!");

	empty($contact_who) && write_msg("Contact cannot be empty!");

	empty($web_address) && write_msg("Address cannot be empty!");

	

	mymps_check_upimage("mymps_img_");

	$id = $action == 'edit' ? intval($id) : '';

	$userid 	= isset($userid) ? mhtmlspecialchars($userid) : '';

	$manage_pwd	= isset($manage_pwd) ? trim($manage_pwd) : '';

	$catid 		= intval($catid);

	if(empty($catid)) write_msg('You have not yet designate a column to post to');

	$cityid		= intval($cityid);

	$areaid 	= intval($areaid);

	$streetid	= intval($streetid);

	$title 		= trim(mhtmlspecialchars($title));

	$content	= $mymps_global['cfg_post_editor'] == 1 ? $content : textarea_post_change($content) ;

	$begintime 	= $timestamp;

	$activetime	= $endtime 	= intval($endtime);

	$endtime 	= ($endtime == 0)?0:(($endtime*3600*24)+$begintime);

	$ismember 	= intval($ismember);

	$mappoint   = isset($mappoint) ? trim(mhtmlspecialchars($mappoint)) : '';

	$tel		= isset($tel) ? trim(mhtmlspecialchars($tel)) : '';

	$qq			= isset($qq) ? trim(mhtmlspecialchars($qq)) : '';

	$space      = ", ";

	$country    = "Malaysia";

	$city       = $curCity[$cityid - 1];

	$areaname   = get_areaname($areaid);

	$web_address= trim(mhtmlspecialchars($web_address.$space.$areaname.$space.$city.$space.$country));

	$email		= isset($email) ? trim(mhtmlspecialchars($email)) : '';

	$result 	= verify_badwords_filter($mymps_global['cfg_if_info_verify'],$title,$content);

	$title 		= $result['title'];

	$content 	= $result['content'];

	$content	= preg_replace("/<a[^>]+>(.+?)<\/a>/i","$1",$content);;//ȥ���������ֺʹ���

	$info_level = $result['level'];

	unset($result);

	$extra		= isset($extra) ? $extra : '';

	

	$d = $db->getRow("SELECT catname,dir_typename,modid FROM `{$db_mymps}category` WHERE catid = '$catid'");

	

	if($action == 'input'){



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

				write_msg("The system has found that your IP is not a <b style='color:red'>".$allow_post_area[0]."</b> local IP! <br />Should you wish to continue, please contact our customer service staff.");

				exit;

			} elseif($allow_post_area[1] == 0 && $i == 1) {

				$info_level = 0;

			}

			unset($allow_post_area,$address,$ipdata,$allow_post_areas,$i);

		}

		

		$checkquestion = isset($checkquestion) ? $checkquestion : '';

		$data = '';

		@include MYMPS_DATA.'/caches/checkanswer_settings.php';

		if(is_array($data)){

			$whenpost = $data['whenpost'];

			$result   = read_static_cache('checkanswer');

			if($whenpost == 1 && is_array($result)){

				if(!is_array($checkquestion) || empty($checkquestion['answer']) || empty($checkquestion['id'])){

					write_msg('You have not entered the identifying question!');

					exit;

				}

				if($result[$checkquestion['id']]['answer'] != $checkquestion['answer']){

					write_msg('The answer you entered to the identifying question is incorrect, please retry!');

				}

			}

			$result = $checkquestion = $whenpost = $data = NULL;

		}

		

		$img_count	= upload_img_num('mymps_img_');

		

		if(!empty($mymps_global['cfg_disallow_post_tel']) && !empty($tel)){

			$disallow_tel = array();

			$disallow_tel = explode('=',$mymps_global['cfg_disallow_post_tel']);

			$disallow_telarray = explode(',',$disallow_tel[0]);

			if($disallow_tel[1] == -1){

				in_array($tel,$disallow_telarray) && write_msg("Your phone number <b style='color:red'>".$tel."</b> has been blacklisted by the administrator! <br />Should you wish to continue, please contact our customer service staff.");

			} elseif($disallow_tel[1] == 0) {

				in_array($tel,$disallow_telarray) && $info_level = 0;

			}

			unset($disallow_tel,$disallow_telarray);

		}

		

		if (empty($ismember)){

			if($mymps_global['cfg_if_nonmember_info'] != 1) write_msg('Unfortunately, you have not yet logged in! Please log-in before making any posts!');

			 //�οͷ�����Ϣ��������

			if($mymps_global['cfg_if_nonmember_info'] == 1 && $mymps_global['cfg_nonmember_perday_post'] > 0){

				$count = mymps_count("information","WHERE ip = '$ip' AND begintime > '".mktime(0,0,0)."' AND ismember = '0'");

				$count >= $mymps_global[cfg_nonmember_perday_post] && write_msg("Unfortunately, tourists are only allowed to make <b style='color:red'>".$mymps_global[cfg_nonmember_perday_post]."</b> posts every day.<br />Should you wish to make more, please contact our customer service staff.");

			}

			empty($manage_pwd) && write_msg("Please enter your administrator code to make afterward editing and deleting of this post more convenient!");

			empty($contact_who) && write_msg("Please input contacts!");

			empty($web_address) && write_msg("Please input address!");

			$manage_pwd = md5($manage_pwd);

			

			if($authcodesettings['post'] == 1 && !$randcode = mymps_chk_randcode($checkcode)){

				write_msg('Incorrect identifying code, please return and retry.');

			}

			

			$sql = "INSERT INTO `{$db_mymps}information` (title,content,catid,catname,dir_typename,cityid,areaid,streetid,begintime,activetime,endtime,manage_pwd,ismember,ip,ip2area,info_level,qq,email,tel,contact_who,web_address,img_count,mappoint)VALUES('$title','$content','$catid','$d[catname]','$d[dir_typename]','$cityid','$areaid','$streetid','$begintime','$activetime','$endtime','$manage_pwd','$ismember','$ip','$ip2area','$info_level','$qq','$email','$tel','$contact_who','$web_address','$img_count','$mappoint')";

		}elseif($ismember == 1){

			$s_uid = '';

			require_once MYMPS_INC."/member.class.php";

			if(!$member_log->chk_in()) write_msg("Unfortunately, you have not yet logged in!");

			chk_member_purview("purview_info");

			$perpost_money_cost = $mymps_global['cfg_member_perpost_consume'] ? $mymps_global['cfg_member_perpost_consume'] : 0 ;

			$userid = trim($s_uid);

			

			/*��Ϣ��֤���*/

			if($userid){

				$row = $db ->getRow("SELECT per_certify,com_certify FROM `{$db_mymps}member` WHERE userid = '$userid'");

				if($row['per_certify'] == 1 || $row['com_certify'] == 1){

					$certify = 1;

				}else{

					$certify = 0;

				}

				unset($row);

			}

			

			if($authcodesettings['memberpost'] == 1 && !$randcode = mymps_chk_randcode($checkcode)){

				write_msg('Incorrect identifying code, please return and retry.');

			}

			

			$sql = "INSERT INTO `{$db_mymps}information` (title,content,begintime,activetime,endtime,catid,catname,dir_typename,cityid,areaid,streetid,userid,ismember,ip,ip2area,info_level,qq,email,tel,contact_who,web_address,img_count,mappoint,certify) Values ('$title','$content','$begintime','$activetime','$endtime','$catid','$d[catname]','$d[dir_typename]','$cityid','$areaid','$streetid','$userid','$ismember','$ip','$ip2area','$info_level','$qq','$email','$tel','$contact_who','$web_address','$img_count','$mappoint','$certify')";

			

			/*��ֱ仯*/

			$score_change = get_credit_score();

			$score_changer = $score_change['score']['rank']['information'];

			$score_changer = $score_changer == 0 ? '+0' : $score_changer;

			if($score_changer){

				$db->query("UPDATE `{$db_mymps}member` SET score = score".$score_changer." WHERE userid = '$userid'");

			}

			$score_change = $score_changer = NULL;

			

			/*��ұ仯*/

			if(!empty($perpost_money_cost)){

				$db->query("UPDATE `{$db_mymps}member` SET money_own = money_own - '$perpost_money_cost' WHERE userid = '$userid'");

			}

		} else {

			exit('Access Denied!');

		}

		

		$db -> query($sql);

		$id = $db -> insert_id();

		

		$k = $v = NULL;

		if(is_array($extra) && $d['modid'] > 1){

			foreach($extra as $k =>$v){

				$sql1 .= ",`".$k."`";

				$sql2 .= ",'$v'";

			}

			$sql = "(id.$sql1)VALUES('$id','','')";

			$db->query("INSERT INTO `{$db_mymps}information_{$d[modid]}` (`id`{$sql1})VALUES('$id'{$sql2})");

			unset($sql1,$sql2);

		}

		

		if($img_count > 0){

			for($i=0;$i<$img_count;$i++){

				$name_file = "mymps_img_".$i;

				if($_FILES[$name_file]['name']){

					$destination="/information/".date('Ym')."/";

					$mymps_image = start_upload($name_file,$destination,$mymps_global['cfg_upimg_watermark'],$mymps_mymps['cfg_information_limit']['width'],$mymps_mymps['cfg_information_limit']['height']);

					$db -> query("INSERT INTO `{$db_mymps}info_img` (image_id,path,prepath,infoid,uptime) VALUES ('$i','$mymps_image[0]','$mymps_image[1]','$id','$timestamp')");

				}

			}

			$db -> query("UPDATE `{$db_mymps}information` SET img_path = '$mymps_image[1]' WHERE id = '$id'");

		}

		

		write_msg("","?action=ok&id=".$id."&title=".urlencode($title)."&level=".$info_level."&filepath=".$infopath);

		

	} elseif($action == 'edit'){

		

		if(is_array($_FILES)){

			for($i=0;$i<count($_FILES);$i++){

				$name_file = "mymps_img_".$i;

				if($_FILES[$name_file]['name']){

					$destination = "/information/".date('Ym')."/";

					$mymps_image = start_upload($name_file,$destination,$mymps_global['cfg_upimg_watermark'],$mymps_mymps['cfg_information_limit']['width'],$mymps_mymps['cfg_information_limit']['height']);

					if($row = $db -> getRow("SELECT path,prepath FROM `{$db_mymps}info_img` WHERE infoid = '$id' AND image_id = '$i'")){

						@unlink(MYMPS_ROOT.$row['path']);

						@unlink(MYMPS_ROOT.$row['prepath']);

						$db->query("UPDATE `{$db_mymps}info_img` SET image_id = '$i' , path = '$mymps_image[0]' , prepath = '$mymps_image[1]' , uptime = '$timestamp' WHERE image_id = '$i' AND infoid = '$id'");

					} else {

						$db->query("INSERT INTO `{$db_mymps}info_img` (image_id,path,prepath,infoid,uptime) VALUES ('$i','$mymps_image[0]','$mymps_image[1]','$id','$timestamp')");

					}

					$db -> query("UPDATE `{$db_mymps}information` SET img_path = '$mymps_image[1]' WHERE id = '$id'");

				}

			}

		}

		

		if(is_array($delinfoimg)){

			foreach($delinfoimg as $key => $val){

				if($val == 'on'){

					$infoimgrow = $db -> getRow("SELECT id,path,prepath FROM `{$db_mymps}info_img` WHERE image_id = '$key' AND infoid = '$id'");

					if($infoimgrow){

						@unlink(MYMPS_ROOT.$infoimgrow['path']);

						//@unlink(MYMPS_ROOT.$infoimgrow['prepath']);

						mymps_delete("info_img","WHERE id = '$infoimgrow[id]'");

					}

					unset($infoimgrow);

				}

			}

		}



		$sql = $k = $v = NULL;

		if(is_array($extra) && $d['modid'] > 1){

			foreach($extra as $k =>$v){

				$sql .= "`".$k ."` = '$v',";

			}

			$sql = $sql ? substr($sql,0,-1) : NULL;

			if($sql){

				$db->query("UPDATE `{$db_mymps}information_{$d[modid]}` SET {$sql} WHERE id = '$id'");

				unset($sql);

			}

		}

		

		$manage_pwd = empty($manage_pwd) ? "" : "manage_pwd='".md5($manage_pwd)."',";

		$userid 	= empty($userid) ? "" : "userid='$userid',";

		$img_count 	= mymps_count("info_img","WHERE infoid = '$id'");

		$img_path	= $mymps_image[1] ? $mymps_image[1] : '';

		

		$d = $db->getRow("SELECT catname,dir_typename FROM `{$db_mymps}category` WHERE catid = '$catid'");

		$sql 		= "UPDATE `{$db_mymps}information` SET {$manage_pwd} {$userid} title = '$title',content = '$content',catid = '$catid', cityid = '$cityid', areaid = '$areaid', streetid = '$streetid',begintime = '$begintime', activetime = '$activetime', endtime = '$endtime', ismember = '$ismember' , ip = '$ip' , ip2area = '$ip2area' , info_level = '$info_level' , qq = '$qq' , email = '$email' , tel = '$tel' , contact_who = '$contact_who' , web_address = '$web_address' , img_count = '$img_count' , mappoint = '$mappoint',catname='$d[catname]',dir_typename='$d[dir_typename]' WHERE id = '$id'";

		$db->query($sql);

		write_msg("Operation  is done! You have successfully edited this post!<br />Should no changes in display is made, please refresh the page!",Rewrite('info',array('id'=>$id,'domain'=>$mymps_global['SiteUrl'].'/')));

	}

} else {

	if(!$cityid && $_COOKIE['cityid']){

		$cityid = $_COOKIE['cityid'];

	}

	include MYMPS_ASS.'/'.CURSCRIPT.'.php';

}



is_object($db) && $db->Close();

$city = $maincity = NULL;

unset($city,$maincity);

exit();

?>

