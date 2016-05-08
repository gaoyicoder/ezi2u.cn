<?php

define('IN_SMT',true);

define('CURSCRIPT','about');

define('IN_MYMPS', true);

require_once dirname(__FILE__).'/include/global.php';

require_once dirname(__FILE__)."/data/config.php";

require_once MYMPS_DATA.'/config.db.php';

require_once MYMPS_INC.'/db.class.php';



ifsiteopen();

(!$part || !in_array($part,array('aboutus','friendlink','faq','announce','sitemap','googlemap'))) && $part = 'aboutus';

$id 	= isset($id) 	? intval($id) 	: '';

$page 	= isset($page) 	? intval($page) : '';



if(!submit_check(CURSCRIPT.'_submit')){

	if($part == 'aboutus'){

		!$id && $id = $db -> getOne("SELECT MIN(id) FROM `{$db_mymps}about`");

		$cityid = $_COOKIE['cityid'] ? $_COOKIE['cityid'] : '';

		$city = get_city_caches($cityid);

		$aboutus_all = get_aboutus(0);

		$aboutus	 = get_aboutus($id);

		$loc		 = get_location('aboutus','',$aboutus['typename']);

		$page_title  = $loc['page_title'];

		$location	 = $loc['location'];

	} elseif($part == 'announce'){

		$cityid 	= $cityid ? intval($cityid) : 0;

		$city 		= get_city_caches($cityid);

		$city_limit = $city['cityid'] ? " AND cityid = '$city[cityid]'" : " AND cityid = '0'";

		$loc 		= get_location('aboutus','','Site Announcement');

		$query = $db -> query("SELECT * FROM `{$db_mymps}announce` WHERE begintime<='$timestamp' AND (endtime='0' OR endtime>'$timestamp') {$city_limit} ORDER BY id DESC");

		while($row = $db -> fetchRow($query)){

			$arr['id'] 		= $row['id'];

			$arr['title'] 		= $row['title'];

			$arr['begintime']	= $row['begintime'] == 0 ? $row['pubdate'] : $row['begintime'];

			$arr['endtime'] 	= $row['endtime'];

			$arr['author'] 		= $row['author'];

			$arr['content'] 	= $row['redirecturl'] ? '<a href='.$row[redirecturl].' target=_blank>'.$row[redirecturl].'</a>' : $row['content'];

			$arr['uri'] 		= $row['redirecturl'] ? $row['redirecturl'] : Rewrite('about',array('part'=>'aboutus#'.$row['id']));

			$announce[]			= $arr;

		}

	}elseif($part == 'faq'){

		!$id && $id = $db -> getOne("SELECT MIN(id) FROM `{$db_mymps}faq`");

		$cityid = $_COOKIE['cityid'] ? $_COOKIE['cityid'] : '';

		$city = get_city_caches($cityid);

		$faq_type 	= get_faq();

		if(!$faq 	= get_faq($id)) write_msg('The help topic you requested does not exist!');

		$loc	  	= get_location('faq','',$faq['title']);

	} elseif($part == 'friendlink'){

		require MYMPS_INC."/flink.fun.php" ;

		$cityid 	= $cityid ? intval($cityid) : 0;

		$city 		= get_city_caches($cityid);

		$loc 		= get_location('friendlink','','Related Links');

		$flink 		= get_flink();

		$flink		= is_array($flink) ? $flink : array();

		$webtype_option = webtype_option();

	}elseif($part == 'sitemap'){

		$loc = get_location('','','Site Map');

		$city = get_city_caches($cityid);

		$categories = get_categories_tree(0,'category');

	}

	$page_title = $loc['page_title'];

	$location 	= $loc['location']; 

	globalassign();

	include mymps_tpl($part);

}else{

	if(!$randcode = mymps_chk_randcode($checkcode)){

		write_msg('Wrong identifying code, please return and retry.');

	}

	$url 	 = $url 	? trim(mhtmlspecialchars($url)) 	: '';

	$webname = $webname ? trim(mhtmlspecialchars($webname)) : '';

	$weblogo = $weblogo ? trim(mhtmlspecialchars($weblogo)) : '';

	$msg	 = $msg		? textarea_post_change($msg)  : '';

	$email	 = $email	? trim(mhtmlspecialchars($email))	  : '';

	$typeid	 = $typeid  ? intval($typeid) 			  : '';

	if(empty($webname) || empty($url)) write_msg('Domain name and URL cannot be empty!');

	if($email && !is_email($email)) write_msg("The Email address you input is incorrect!");

	$sql = "INSERT INTO `{$db_mymps}flink`(url,webname,weblogo,msg,email,typeid,createtime,ischeck)

		VALUES('$url','$webname','$weblogo','$msg','$email','$typeid','$timestamp','1'); ";

	$res = $db->query($sql);

	$city = get_city_caches($cityid);

	write_msg("Successfully Submitted the application for related link, and the link will be displayed after it passes the revision by an administrator.",Rewrite('about',array('part'=>'friendlink')));

}



is_object($db) && $db->Close();

exit;

?>

