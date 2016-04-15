


<script type="text/javascript">

function showMessage()
   {
 	 var messageToShow = "You have to select a specific state first, then click post button. Thanks.";
 	 
	   if (confirm(messageToShow) == true) 
	   { 
	        window.location.href = "index.php?mod=changecity";	
	   }
	   else
	   { 
	        window.location.href = "index.php?cityid=0";	
	   }	    
   }
   
</script>


<?php
!defined('WAP') && exit('FORBIDDEN');
define('CURSCRIPT','post');

$catid = isset($_REQUEST['catid']) ? intval($_REQUEST['catid']) : '';
$areaid = isset($_REQUEST['areaid']) ? intval($_REQUEST['areaid']) : '1';
$streetid = isset($_REQUEST['streetid']) ? intval($_REQUEST['streetid']) : '';
$extra = isset($_POST['extra']) ? mhtmlspecialchars($_POST['extra']) : '';

$curCity = array("JOHOR", "KEDAH", "KELANTAN", "K. LUMPUR", "MELAKA", "N. SEMBLAN", "PAHANG", "P. PENANG", "PERAK", "PERLIS", "SELANGOR", "TERENGGANU", "SABAH", "SARAWAK");

if(!$cityid){
	
	//	echo '<div>'.$redirectmsg.' <a href="'.$url.'">Click To Continue</a></div>';
		
//	$url = 'http://www.ezi2u.com.my/m/index.php?mod=changecity';
		
	//	 echo "<script type='text/javascript'>alert('.$url.')</script>";
		 
   // curl_exec("http://www.ezi2u.com.my/m/index.php?mod=changecity");
    //$ch = curl_init("http://www.example.com/");
   //$ch = curl_init("http://www.example.com/");
   //curl_exec($ch);
   
 /*  echo "<script type='text/javascript'>
   var messageToShow = "Please select a state";
   if (confirm(messageToShow) == true) 
   { 
        window.location.href = "index.php?mod=changecity";	
   } 
   </script>"*/
   
    
	 echo "<script type='text/javascript'>showMessage();</script>";	
	 
	//redirectmsg("Please select the state you are from.","index.php?mod=changecity");
	exit;
}

if($action == 'post'){
	$title       = isset($_POST['title']) ? trim(mhtmlspecialchars($_POST['title'])) : '';
	$content     = isset($_POST['content']) ? textarea_post_change($_POST['content']) : '';
	$contact_who = isset($_POST['contact_who']) ? trim(mhtmlspecialchars($_POST['contact_who'])) : '';
	$space      = ", ";
	$country    = "Malaysia";
	$city       = $curCity[$cityid - 1];
	$areaname   = $streetid ? $db -> getOne("SELECT streetname FROM `{$db_mymps}street` WHERE streetid = '$streetid'") : $db -> getOne("SELECT areaname FROM `{$db_mymps}area` WHERE areaid = '$areaid'");
	$web_address = isset($_POST['web_address']) ? trim(mhtmlspecialchars($_POST['web_address'].$space.$areaname.$space.$city.$space.$country)) : '';
	$tel         = isset($_POST['tel']) ? trim(mhtmlspecialchars($_POST['tel'])) : '';
	$qq          = isset($_POST['qq']) ? trim(mhtmlspecialchars($_POST['qq'])) : '';
	$result 	= verify_badwords_filter($mymps_global['cfg_if_info_verify'],$title,$content);
	$title 		= $result['title'];
	$content 	= $result['content'];
	$content	= preg_replace("/<a[^>]+>(.+?)<\/a>/i","$1",$content);
	$info_level = $result['level'];
	$mixcode     = isset($_POST['mixcode']) ? mhtmlspecialchars($_POST['mixcode']) : '';
	$d = $db->getRow("SELECT catname,dir_typename,modid FROM `{$db_mymps}category` WHERE catid = '$catid'");
	$catname = $d['catname'];
	$dir_typename = $d['dir_typename'];
	if(!$mixcode || $mixcode != md5($cookiepre)){
		errormsg('The system recognizes your source to be incorrect!');
	}

	$backurl = "javascript:history.back()";
	if(empty($catid)) redirectmsg('The category you selected does not exist!','index.php?mod=category');
	if(!$areaid = $db -> getOne("SELECT areaid FROM `{$db_mymps}area` WHERE areaid = '$areaid'")){
		redirectmsg("The district you selected does not exist!","index.php?mod=post&catid=".$catid."&areaid=".$areaid."&cityid=".$cityid);
	}
	empty($areaid) && redirectmsg("Please select district you wish to post to!","index.php?mod=post&catid=".$catid);
	empty($title) && redirectmsg("Please enter title of post!",$backurl);
	$k = $v = NULL;
	if(is_array($extra) && $d['modid'] > 1){
		foreach($extra as $k =>$v){
			$sql1 .= ",`".$k."`";
			$sql2 .= ",'$v'";
		}
		$sql = "(id.$sql1)VALUES('$id','','')";
		$db->query("INSERT INTO `{$db_mymps}information_{$d[modid]}` (`id`{$sql1})VALUES('$id'{$sql2})");
		$sql1 = $sql2 = NULL;
	}	
	empty($content) && redirectmsg("You have not yet input post description!",$backurl);
	empty($contact_who) && redirectmsg("Contact cannot be empty!",$backurl);
	empty($web_address) && redirectmsg("Address cannot be empty!",$backurl);
	empty($tel) && redirectmsg("Phone number cannot be empty!",$backurl);
	
	require_once MYMPS_INC."/upfile.fun.php";
	require_once MYMPS_DATA."/config.inc.php";
	
	mymps_check_upimage_wap("mymps_img_");

	$checkcode = isset($_POST['checkcode']) ? mhtmlspecialchars($_POST['checkcode']) : '';
	if($mobile_settings['authcode'] == 1 && !$randcode = mymps_chk_randcode($checkcode)){
		redirectmsg("Wrong identifying code! Please return to the previous page and try again!",$backurl);
	}
	
	if(!empty($mymps_global['cfg_disallow_post_tel']) && !empty($tel)){
		$disallow_tel = array();
		$disallow_tel = explode('=',$mymps_global['cfg_disallow_post_tel']);
		$disallow_telarray = explode(',',$disallow_tel[0]);
		if($disallow_tel[1] == -1){
			in_array($tel,$disallow_telarray) && redirectmsg("Your phone number <b style='color:red'>".$tel."</b>  has been blacklisted by the administrator!    Should you wish to continue, please contact our customer service staff.","index.php?mod=post&catid=".$catid."&areaid=".$areaid);
		} elseif($disallow_tel[1] == 0) {
			in_array($tel,$disallow_telarray) && $info_level = 0;
		}
		unset($disallow_tel,$disallow_telarray);
	}

	$ip = GetIP();
	//发布信息IP限制
	if(!empty($mymps_global['cfg_forbidden_post_ip'])){
		foreach(explode(",", $mymps_global['cfg_forbidden_post_ip']) as $ctrlip) {
			if(preg_match("/^(".preg_quote(($ctrlip = trim($ctrlip)), '/').")/", $ip)) {
				$ctrlip = $ctrlip.'%';
				redirectmsg("Your current IP <b style='color:red'>".$ip."</b> has been blacklisted by the administrator, and you are not allowed to make posts with this IP! <br /> Should you wish to continue, please contact our customer service staff.","index.php?mod=post&catid=".$catid."&areaid=".$areaid);
				exit;
			}
		}
	}
	//非该分站用户不能发布
	if($mymps_global['cfg_if_post_othercity'] == 0 && $cityid && is_array($cityarr = get_ip2city($ip))){
		if($cityid != $cityarr[cityid]) errormsg('Your IP is not from this state, so you cannot make any posts in this state.^_^');
	}

	$post_time = 1;
	if(!empty($post_time)){
		$count = mymps_count("information","WHERE ip = '$ip' AND begintime > (".time()." - 1*60)");
		$count >= $post_time && redirectmsg("You have been making post too frequently! Please rest for a while and try again.","index.php?mod=zuixin");
	}

	$img_count	= upload_img_num('mymps_img_');
	
	if($iflogin == 1){
		
		$db->getOne("SELECT id FROM `{$db_mymps}information` WHERE title = '$title' AND userid = '$s_uid'") && redirectmsg("Post with this title already exists, and we do not allow repeated posts! if you wish to highlight a made post one more time, please Refresh it in the Account Management Page",$backurl);

		//会员发布信息数量限制
		$per = $db->getRow("SELECT b.perday_maxpost FROM `{$db_mymps}member` AS a LEFT JOIN `{$db_mymps}member_level` AS b ON a.levelid = b.id WHERE a.userid = '$s_uid'");
		$perday_maxpost = $per['perday_maxpost'];
		if(!empty($perday_maxpost)){
			$count = mymps_count("information","WHERE userid LIKE '$s_uid' AND begintime > '".mktime(0,0,0)."'");
			$count >= $perday_maxpost && redirectmsg("Sorry, members at your level are only allowed to make <b style='color:red'>".$perday_maxpost."</b> posts every day. <br /> Should you wish to make more, please contact our customer service staff.","index.php?mod=post&catid=".$catid."&areaid=".$areaid);
		}
		
		$userid = trim($s_uid);
		$perpost_money_cost = $mymps_global['cfg_member_perpost_consume'] ? $mymps_global['cfg_member_perpost_consume'] : 0 ;

		/*信息认证情况*/
		if($userid){
			$row = $db ->getRow("SELECT per_certify,com_certify FROM `{$db_mymps}member` WHERE userid = '$userid'");
			if($row['per_certify'] == 1 || $row['com_certify'] == 1){
				$certify = 1;
			}else{
				$certify = 0;
			}
			unset($row);
		}
	
		$sql = "INSERT INTO `{$db_mymps}information` (title,content,begintime,activetime,endtime,catid,catname,dir_typename,cityid,areaid,streetid,userid,ismember,info_level,qq,email,tel,contact_who,web_address,img_count,certify,ip,ip2area) VALUES ('$title','$content','$timestamp','0','0','$catid','$catname','$dir_typename','$cityid','$areaid','$streetid','$userid','1','$info_level','$qq','$email','$tel','$contact_who','$web_address','$img_count','$certify','$ip','wap')";	
		//金币变化
		if(!empty($perpost_money_cost)){
			$db->query("UPDATE `{$db_mymps}member` SET money_own = money_own - '$perpost_money_cost' WHERE userid = '$userid'");
		}

	}else{
	    //游客发布信息数量限制
		if($mymps_global['cfg_if_nonmember_info'] == 1 && $mymps_global['cfg_nonmember_perday_post'] > 0){
			$count = mymps_count("information","WHERE ip = '$ip' AND begintime > '".mktime(0,0,0)."' AND ismember = '0'");
			$count >= $mymps_global[cfg_nonmember_perday_post] && redirectmsg("Sorry, tourists are only allowed to make  <b style='color:red'>".$mymps_global[cfg_nonmember_perday_post]."</b> posts every day. <br /> Should you wish to make more, please contact our customer service staff.","index.php?mod=post&catid=".$catid."&areaid=".$areaid);
		}
		
		$sql = "INSERT INTO `{$db_mymps}information` (title,content,begintime,activetime,endtime,catid,catname,dir_typename,cityid,areaid,streetid,info_level,qq,email,tel,contact_who,web_address,img_count,certify,ip,ip2area) VALUES ('$title','$content','$timestamp','0','0','$catid','$catname','$dir_typename','$cityid','$areaid','$streetid','$info_level','$qq','$email','$tel','$contact_who','$web_address','$img_count','$certify','$ip','wap')";	
	}
	
	$db -> query($sql);
	$id = $db -> insert_id();
	
	$k = $v = NULL;
	if(is_array($extra) && $d['modid'] > 1){
		foreach($extra as $k =>$v){
			$sql1 .= ",`".$k."`";
			$sql2 .= ",'$v'";
		}
		$db->query("INSERT INTO `{$db_mymps}information_{$d[modid]}` (`id`{$sql1})VALUES('$id'{$sql2})");
		$sql1 = $sql2 = NULL;
	}

	//上传图片
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
	
	$msg = $info_level > 0 ? 'Post successfully made!' : 'Your post will be viewable after it passes the revision!';
	redirectmsg($msg,'index.php?mod=category&catid='.$catid);

} else {
	
	if(!$catid){
		$categories = get_categories_tree(0,'category');
		include mymps_tpl('post_cat');
		exit;
	}
	
	if($catid && !$areaid && $cityid){
		$area_list = $db ->getAll("SELECT * FROM `{$db_mymps}area` WHERE cityid = '$cityid'");
		if(!empty($area_list)){
			include mymps_tpl('post_area');
			exit;
		}
	}
	
	if($areaid && !$streetid && $cityid){
		$street_list = $db ->getAll("SELECT * FROM `{$db_mymps}street` WHERE areaid = '$areaid'");
		if(!empty($street_list)){
			include mymps_tpl('post_street');
			exit;
		}
	}

	
	require_once MYMPS_DATA.'/wap_info.type.inc.php';
	$cat = $db -> getRow("SELECT catid,catname,parentid,modid,if_upimg FROM `{$db_mymps}category` WHERE catid = '$catid'");
	$cat['parentname'] = $db -> getOne("SELECT catname FROM `{$db_mymps}category` WHERE catid = '$cat[parentid]'");
	
	if($cat['parentid'] == 0){
		//如果为根分类
		$categories = get_categories_tree($catid,'category');
		include mymps_tpl('post_cat');
	} elseif($cat['parentid'] > 0){
		//如果为二级分类
		if($iflogin != 1){
			if($mymps_global['cfg_if_nonmember_info'] != 1){
				//游客不能发布信息
				$returnurl = 'index.php?mod=post&cityid='.$cityid.'&areaid='.$areaid.'&streetid='.$streetid;
				$returnurl = urlencode($returnurl);
				redirectmsg("Unfortunately, tourists are not allowed to make posts, please log-in before making any posts!","index.php?mod=login&returnurl=".$returnurl);	
			}
		}elseif($user = $db -> getRow("SELECT qq,email,mobile,cname FROM `{$db_mymps}member` WHERE userid = '$s_uid'")){
			$tel = $tel ? $tel : $user['mobile'];
			$contact_who = $contact_who ? $contact_who : $user['cname'];
			$qq = $qq ? $qq : $user['qq'];
		}
		$areaname = $streetid ? $db -> getOne("SELECT streetname FROM `{$db_mymps}street` WHERE streetid = '$streetid'") : $db -> getOne("SELECT areaname FROM `{$db_mymps}area` WHERE areaid = '$areaid'");
		//如果为三级分类
		if($child = $db ->getAll("SELECT catid,catname FROM `{$db_mymps}category` WHERE parentid = '$catid'")){
			$catname = '<select name="catid" style="width:60%">';
			foreach($child as $k => $v){
				$catname .= '<option value="'.$v[catid].'">'.$v[catname].'</option>';
			}
			$catname .= '</select>';
		}else{
			$catname = $db ->getOne("SELECT catname FROM `{$db_mymps}category` WHERE catid = '$catid'");
		}
		$return_url = 'index.php?mod=post&catid='.$catid.'&areaid='.$areaid.'&cityid='.$cityid;
		$show_mod_option = return_category_info_options($cat['modid']);
		$upload_img   = $cat['if_upimg'] == 1 ? get_upload_image_view_wap(1) : '';
		$mixcode = md5($cookiepre);
		include mymps_tpl("post");
	}
	
}

function check_upimage_wap($file="filename")
{
	global $mymps_global;
	$size=$mymps_global['cfg_upimg_size']*1024;
	$upimg_allow = explode(',',$mymps_global['cfg_upimg_type']);
	if($_FILES[$file]['size']>$size){
		redirectmsg('The file to be uploaded should not be larger than '.$mymps_global['cfg_upimg_size'].'KB','javascript:history.back()');
	}
	
	if(!in_array(FileExt($_FILES[$file]['name']),$upimg_allow)){
		redirectmsg('Only Images in '.$mymps_global['cfg_upimg_type'].' formats are supported by the system!','javascript:history.back()');
	}
	
	if(!preg_match('/^image\//i',$_FILES[$file]['type'])){
		redirectmsg ('Sorry, the system does not support the format of the image you uploaded; please try an image in the supporting format!','javascript:history.back()');
	}
	return true;
}

function mymps_check_upimage_wap($file="filename")
{
	if(is_array($_FILES)){
		for($i=0;$i<count($_FILES);$i++){
			if($_FILES[$file.$i]['name']){
				check_upimage_wap($file.$i);
			}
		}
	}
}

function get_upload_image_view_wap($if_upimg = 1 , $infoid = '')
{
	global $mymps_global,$db,$db_mymps;
	if($if_upimg == 1){
		$cfg_upimg_number = $mymps_global[cfg_upimg_number]?$mymps_global[cfg_upimg_number]:'3';
		for($i=0;$i<$cfg_upimg_number;$i++){;
			$mymps .= '<input class="input" style="width:210px;overflow: hidden;padding:5px 0;" type="file" name="mymps_img_'.$i.'" datatype="filter" msg="The format to image is incorrect!">';
		}
	}
	return $mymps;
}
?>