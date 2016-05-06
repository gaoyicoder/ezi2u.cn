<?php
define('IN_SMT',true);
define('CURSCRIPT','goods');
define('IN_MYMPS',TRUE);
define('DIR_NAV',dirname(__FILE__));

require_once DIR_NAV.'/include/global.php';
require_once MYMPS_DATA."/config.php";
require_once MYMPS_DATA."/config.db.php";
require_once MYMPS_INC."/db.class.php";

ifsiteopen();

$id 		= isset($id) 		? intval($id) 		: '';
$catid 		= isset($catid) 	? intval($catid) 	: 0;
$cityid 	= isset($cityid) 	? intval($cityid) 	: 0;
$page	 	= isset($page)	   	? intval($page)	  	: 1;
$mod        = isset($mod)       ? intval($mod)      : '';


!ifplugin(CURSCRIPT) && exit('The goods plug-in has either been disabled by the administrator or not been installed!');

if(!submit_check(CURSCRIPT.'_submit')){
	require_once DIR_NAV.'/plugin/goods/include/functions.php';
	
	if($id){

		$goods  = $db -> getRow("SELECT a.*,b.tname FROM `{$db_mymps}goods` AS a LEFT JOIN `{$db_mymps}member` AS b  ON a.userid = b.userid WHERE goodsid = '$id' AND onsale = '1'");
		$goods['tname'] = $goods['tname'] ? $goods['tname'] : $goods['userid'];
		$uid = $db -> getOne("SELECT id FROM `{$db_mymps}member` WHERE userid = '$goods[userid]'");
		$goods['tname_uri'] = Rewrite('store',array('uid'=>$uid,'action'=>'index'));
		if(!$goods['goodsid']) write_msg('This product either does not exist or has been removed!','olmsg');
		$city = get_city_caches($goods['cityid'] ? $goods['cityid'] : $cityid);
		
		$db->query("UPDATE `{$db_mymps}goods` SET hit = hit + 1 WHERE goodsid = '$id'");
		
		$goods['picture'] = $goods['picture'] ? $goods['picture'] : $mymps_global['SiteUrl'].'/images/nophoto.gif';
		/*��Ʒ������������*/
		$goods['content'] = replace_insidelink($goods['content'],'goods');
		
		$loc = get_goods_location($goods['catid'],$goods['goodsname']);
		$page_title = $loc['page_title'];
		$page_title = str_replace('{city}',$city['cityname'],$page_title);
		$location	= $loc['location'];

		$goods['quhuo'] = textarea_post_change($pluginsettings['goods']['quhuo']);
		$goods['fukuan'] = textarea_post_change($pluginsettings['goods']['fukuan']);
		$goods['service'] = textarea_post_change($pluginsettings['goods']['service']);
		unset($pluginsettings);
		
		$advertisement	= get_advertisement('other');
		$adveritems		= $city['advertisement'];
		$advertisement	= $advertisement['all'];
		
		$relategoods = get_goods(6,1,'',$goods['catid']);
		globalassign();
        if ($mod == 'tuan') {
            include DIR_NAV.'/plugin/'.CURSCRIPT.'/template/tuan.tpl.php';
        } else {
            include DIR_NAV.'/plugin/'.CURSCRIPT.'/template/view.tpl.php';
        }
	}else{
		$city = get_city_caches($cityid);
		/*�Զ�������վ���start*/
		if($mymps_global['cfg_independency'] && $cityid){
			$maincity = get_city_caches(0);
			$independency = explode(',',$mymps_global['cfg_independency']);
			$independency = is_array($independency) ? $independency : array();
			if(in_array('topnav',$independency)){
				$city['topnav'] = empty($city['topnav']) ? $maincity['topnav'] : $city['topnav'];
			}
			if(in_array('advertisement',$independency)){
				$city['advertisement'] = empty($city['advertisement']) ? $maincity['advertisement'] : $city['advertisement'];
			}
			$maincity = NULL;
		}
		/*�Զ�������վ���end*/
		
		$where = " WHERE onsale = '1'";
		$where .= $city[cityid] ? " AND cityid = '$city[cityid]'" : "";
		
		if($catid){
			$catid = intval($catid);
			$cat = $db -> getRow("SELECT * FROM `{$db_mymps}goods_category` WHERE catid = '$catid'");
			if(!$cat){
				$where = NULL;
				write_msg('This product category either does not exist or is deleted!','olmsg');
				exit;
			}
			$goods_children = get_goods_children($catid);
			$where .= " AND catid IN (".$goods_children.")";
		}
		$remai_goods = get_goods(5,1,'remai');
		$tuijian_goods = get_goods(3,1,'tuijian');

		$loc = get_goods_location($cat['catid']);
		$page_title = $loc['page_title'];
		$page_title = str_replace('{city}',$city['cityname'],$page_title);
		$location	= $loc['location'];
		$seo		= array();
		$seo['keywords'] 	= str_replace('{city}',$city['cityname'],$pluginsettings[CURSCRIPT]['seokeywords']);
		$seo['description'] = str_replace('{city}',$city['cityname'],$pluginsettings[CURSCRIPT]['seodescription']);
		
		$goods_cat = goods_category_tree(0);
		
		$advertisement	= get_advertisement('other');
		$adveritems		= $city['advertisement'];
		$advertisement	= $advertisement['all'];
		
		$where .= $tuijian == '1' ? " AND tuijian = '1'" : '';
		$where .= $cuxiao == '1' ? " AND cuxiao = '1'" : '';
		$orderby = in_array($orderby,array('dateline','hit')) ? $orderby : 'dateline';
		$rows_num = $db -> getOne("SELECT COUNT(goodsid) FROM `{$db_mymps}goods` $where");
		$param = setParam(array('catid','orderby','tuijian','cuxiao'));
		$goods = page1("SELECT * FROM `{$db_mymps}goods` $where ORDER BY ".$orderby." DESC",16);
		foreach($goods as $k => $v){
			$list[$v['goodsid']]['goodsid'] = $v['goodsid'];
			$list[$v['goodsid']]['goodsname'] = $v['goodsname'];
			$list[$v['goodsid']]['nowprice'] = $v['nowprice'];
			$list[$v['goodsid']]['pre_picture'] = $v['pre_picture'] ? $v['pre_picture'] : $mymps_global['SiteUrl'].'/images/nophoto.gif';
			$list[$v['goodsid']]['uri'] = plugin_url('goods',array('id'=>$v['goodsid']));
		}
		$page_view = page2();
		
		$uri = array();
		$uri['tuijian'] = plugin_url('goods',array('catid'=>$cat['catid'],'tuijian'=>'1'));
		$uri['cuxiao']	= plugin_url('goods',array('catid'=>$cat['catid'],'cuxiao'=>'1'));
		$uri['hit']     = plugin_url('goods',array('catid'=>$cat['catid'],'orderby'=>'hit'));
		$uri['dateline']= plugin_url('goods',array('catid'=>$cat['catid']));
		
		globalassign();
		include DIR_NAV.'/plugin/'.CURSCRIPT.'/template/index.tpl.php';
		
	}
}else{
    if ($mod == 'tuan') {
        if(1) {
            $goodsid = $goodsid ? intval($goodsid):'';
            $infoid = isset($infoid) ? intval($infoid):'';
            $ordernum = isset($ordernum) ? intval($ordernum):'';
            $sql_good = "select * from `{$db_mymps}goods` AS g where g.goodsid='".$goodsid."'";
            $good = $db->getRow($sql_good);

            $total_amount = $ordernum*$good['oldprice'];
            $real_amount = $ordernum*$good['nowprice'];
            $sql_user = "select * from `{$db_mymps}member` AS m where m.userid='".$s_uid."'";
            $dateline = time();
            $useddate = time();
            $user = $db->getRow($sql_user);
            $ip = GetIP();
            $msg = time();
            $sql_insert_order = "insert into {$db_mymps}goods_order (goodsid, ordernum, oname, mobile, ip, dateline, type, userid, useddate, infoid, totalamount, realamount, msg)
                                VALUES ('".$goodsid."', '".$ordernum."', '".$good['goodsname']."', '".$user['mobile']."', '".$ip."','".$dateline."','1','".$s_uid."','','".$infoid."','".$total_amount."','".$real_amount."','".$msg."')";
            $db -> query($sql_insert_order);

            $db->query("UPDATE `{$db_mymps}member` SET money_own = money_own - '$real_amount' WHERE userid='".$s_uid."'");

            $db->query("UPDATE `{$db_mymps}member` SET money_own = money_own + '$real_amount' WHERE userid='".$good['userid']."'");

            write_msg('You have successfully made the order!<br /><br /><input value="Close Window" type="button" onclick=\'parent.closeopendiv()\' style="margin-left:auto;margin-right:auto;" class="blue">','olmsg');

        } else {
            errormsg('错误的id');
        }
    } else {
        $oname = $oname ? mhtmlspecialchars($oname) : '';
        $goodsid = isset($goodsid) ? intval($goodsid) : '';
        $ordernum = isset($ordernum) ? intval($ordernum) : '';
        $qq = isset($qq) ? mhtmlspecialchars($qq) : '';
        $tel =  isset($tel) ? mhtmlspecialchars($tel) : '';
        $mobile =  isset($mobile) ? mhtmlspecialchars($mobile) : '';
        $ip = GetIP();
        $msg = isset($msg) ? textarea_post_change($msg) : '';
        $address = isset($address) ? mhtmlspecialchars($address) : '';

        $_COOKIE['goodsorder'.$goodsid] == 1 && write_msg('You have ordered this product already, so why not take a look at other products?','olmsg');
        if(empty($goodsid)) write_msg('The product you wish to buy either does not exist or has been removed!');
        if(empty($oname)) write_msg('Your name cannot be empty!');

        $db -> query("INSERT INTO `{$db_mymps}goods_order` (goodsid,ordernum,oname,qq,tel,mobile,ip,address,msg,dateline) VALUES ('$goodsid','$ordernum','$oname','$qq','$tel','$mobile','$ip','$address','$msg','$timestamp')");

        setcookie('goodsorder'.$goodsid,1,$timestamp+180,'/');
        write_msg('You have successfully made the order, and we will contact you as soon as possible!<br /><br /><input value="Close Window" type="button" onclick=\'parent.closeopendiv()\' style="margin-left:auto;margin-right:auto;" class="blue">','olmsg');
    }
}
is_object($db) && $db->Close();
$city = $maincity = NULL;
unset($city,$maincity);

function get_goods_location($catid=0,$str=''){
	global $db,$db_mymps,$pluginsettings,$city;
	
	$cat_arr = goods_parent_cats($catid);
	$raquo = $GLOBALS['mymps_global']['cfg_raquo'];
	$location   = 'Current Location: <a href="'.$GLOBALS['mymps_global']['SiteUrl'].'">'.$city['cityname'].$GLOBALS['mymps_global']['SiteName'].'</a>'.' <code>'.$raquo.'</code> '.' <a href="'.plugin_url(CURSCRIPT,array('catid'=>0)).'">'.$city[cityname].'Purchase Online</a>';
	$page_title = $pluginsettings['goods']['seotitle'] ? $pluginsettings['goods']['seotitle'] : $city['cityname'].'Purchase Online - '.$GLOBALS['mymps_global']['SiteName'];
	
	if(!empty($catid)){
		/* ѭ������ */
		if (!empty($cat_arr)){
			krsort($cat_arr);
			foreach ($cat_arr as $val){
				$page_title =  htmlspecialchars($GLOBALS['cat']['title'] && $GLOBALS['catid'] == $val['catid'] ? $GLOBALS['cat']['title'] :($type == 'corp' ? $val['corpname'] : $val['catname'])) . ' - ' . $page_title;
				$location   .= ' <code> '.$raquo.' </code> <a href="' . $val['uri'] . '">' .
								htmlspecialchars($type == 'corp' ? $val['corpname'] : $val['catname']) . '</a>';
			}
		}
	}
	
	if (!empty($str)){
        $page_title = $str.' - '.$page_title;
        $location   .= ' <code>'.$raquo.'</code> &nbsp;' .$str;
    }
	
	$cur = array('page_title'=>$page_title,'location'=>$location);
	unset($page_title,$cat,$location,$type,$goods_class);
    return $cur;

}
	exit;
?>