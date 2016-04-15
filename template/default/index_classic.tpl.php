<?php
if(ifplugin('group')){
	require_once MYMPS_ROOT.'/plugin/group/include/functions.php';
	$groups = get_groups(3);
	$groupclass = get_group_class();
}
if(ifplugin('news')) $news = mymps_get_news_list($tpl_index['news']);//取得网站最新新闻
if(ifplugin('goods')){
	require_once MYMPS_ROOT.'/plugin/goods/include/functions.php';
	$goods = get_goods($tpl_index['goods'],1,'');
}
$index_cat = get_categories_tree(0,'category');
if(is_array($index_cat)){
	foreach($index_cat as $firstcatkey => $firstcatval){
		$incatids = NULL;
		$incatids = get_children($firstcatval['catid']);
		$query	= $db -> query("SELECT a.catname,a.dir_typename,a.id,a.userid,a.catid,a.title,a.ifred,a.ifbold,a.begintime,a.cityid FROM {$db_mymps}information AS a WHERE $incatids AND a.info_level > '0' {$city_limit} ORDER BY a.begintime DESC LIMIT 0,".$tpl_index['foreachinfo']);
		$index_cat[$firstcatval['catid']]['information'] = array();
		while($irow   = $db -> fetchRow($query)){
			$arr['id'] 	      = $irow['id'];
			$arr['title'] 	  = $irow['title'];
			$arr['begintime'] = $irow['begintime'];
			$arr['catname']	  = $irow['catname'];
			$arr['ifred']	  = $irow['ifred'];
			$arr['ifbold']	  = $irow['ifbold'];
			$arr['caturi']	  = Rewrite('category',array('dir_typename'=>$irow['dir_typename'],'catid'=>$irow['catid'],'domain'=>$city['domain']));
			$arr['uri']		  = Rewrite('info',array('id'=>$irow['id'],'cityid'=>$irow['cityid'],'dir_typename'=>$irow['dir_typename']));
			$index_cat[$firstcatval['catid']]['information'][] = $arr;
		}
	}
}
$faq = mymps_get_faq($tpl_index['faq']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$city[title]?></title>
<meta name="keywords" content="<?=$city[keywords]?>"/>
<meta name="description" content="<?=$city[description]?>"/>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><?}?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/index.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/index.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_index]?>">
<? include mymps_tpl('inc_head');?>
<div class="body1000">
	<div class="clear"></div>
	<div class="location">
		Current Position: <a href="<?=$mymps_global[SiteUrl]?>"> <?=$mymps_global[SiteName]?> </a> <code> > </code> Site Homepage
	</div>
	<div class="clear"></div>
	<div class="wrapper">
		<div class="goahead">
			<div class="focus_news">
				<div class="classfocus" style="margin-bottom:10px;">
					<div id="MainPromotionBanner">
					<div class="container" id="idTransformView">
					<ul class="slider" id="idSlider">
					<? if(is_array($city['focus']['index'])){foreach($city['focus']['index'] as $k => $v){?>
					<li><a href="<?=$v[url]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$v[image]?>" alt="<?=$v[words]?>"/></a></li>
					<? }}?>
					</ul>
					<ul class="num" id="idNum">
					<li>1</li>
					<li>2</li>
					<li>3</li> 
					</ul>
					</div>
					</div>
				</div>
				<? if(is_array($news)){ ?>
				<div class="news">
					<div class="hd">
						<div class="span">Focus</div>
						<div class="more"><a href="<?=$about[news_uri]?>" target="_blank">More</a></div>
					</div>
					<div class="bd">
						<ul>
						<? foreach($news as $k => $v){?>
						<li><a href="<?=$v[caturi]?>" target="_blank" class="gray">[<?=$v[catname]?>]</a> <a target="_blank" href="<?=$v[uri]?>" title="<?=$v[title]?>" <? if($v[iscommend] == 1){?>style="color:red"<? }?>><?=$v[title]?></a></li>
						<? }?>
						</ul>
					</div>
				</div>
				<? }?>
			</div>
			<div class="indextopinfo">
				<? foreach($index_topinfo as $k => $v){?>
				<ul>
				<h2 class="h2">
				<a href="<?=$v[uri]?>" title="<?=$v[title]?>" target="_blank"><span class="str" style="<? if($v[ifred] == 1){ ?>color:red;<? }?><? if($v[ifbold] ==1){ ?>font-weight:bold;<? }?>"><?=$v[title]?></span></a> <span class="sp"><?=substr(clear_html($v[content]),0,140)?></span></h2>
				</ul>
				<? }?>
				<div class="more"><a href="javascript:alert('Register member enabling you to make posts, and Topping while Going on Homepage will display your post at the top of the homepage.');">Want to top your post?</a></div>
			</div>
			<div class="announce_faq">
				<? if(is_array($city['announce'])){?>
				<div class="announce">
					<div class="hd">
						<div class="span">Site Announcements</div>
						<div class="more"><a href="<?=$about[announce_uri]?>" target="_blank">More</a></div>
					</div>
					<div class="bd">
						<ul>
							<? foreach($city['announce'] as $k => $v){?>
							<li><span class="announcetitle"><a href="<?=$v[uri]?>" title="<?=$v[title]?>" target="_blank"><font color="<?=$v[titlecolor]?>"><?=$v[title]?></font></a></span><span class="announcetime"><?=GetTime($v[begintime],'m-d')?></span></a></li>
							<? }?>
						</ul>
					</div>
				</div>
				<div class="clear"></div>
				<? }?>
				<? if(is_array($faq)){?>
				<div class="faq">
					<div class="hd">
						<div class="span">Help Centre</div>
						<div class="more"><a href="<?=$about[faq_uri]?>" target="_blank">More</a></div>
					</div>
					<div class="bd">
						<ul>
							<? foreach($faq as $k => $v){?>
                            <li><a href="<?=$v[uri]?>" target="_blank"><?=$v[title]?></a></li>
                            <? }?>
						</ul>
					</div>
				</div>
				<? }?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="infolist">
			<? $i = 1;
				foreach($index_cat as $k => $fcat){
				if($i < 11){
					if($i%2 != 0){?><div id="ad_indexcatad_<?=$fcat[catid]?>"></div><? }?>
			<div class="showbox <? if($i%2 != 0){?>sleft<? }else{?>sright<? }?>">
				<div class="hd">
					<div class="cattitle"><? if($fcat[icon]){?><img alt="<?=$fcat[catname]?>" src="<?=$mymps_global[SiteUrl]?><?=$fcat[icon]?>" width="30" height="30" align="absmiddle"/>&nbsp;&nbsp;<? }?><?=$fcat[catname]?></div>
					<div class="postinfo"></div>
					<div class="moreinfo"><a href="<?=$fcat[uri]?>" target="_blank">More</a></div>
				</div>
				<div class="bd">
					<ul>
						<? $t = 1;
						foreach($fcat[information] as $u => $info){
						?>
						<li <? if($t%2 == 0){?>class="bg_gray"<? }?>>
						<span class="time">[<?=GetTime($info[begintime],'m-d')?>]</span>
						<span class="info"><a href="<?=$info[uri]?>" target="_blank" title="<?=$info[title]?>" style="<? if($info[ifred == 1]){?>color:red;<? }?> <? if($info[ifbold] == 1){?>font-weight:bold;<? }?>"><?=$info[title]?></a></span>
						<span class="catname"><a href="<?=$info[caturi]?>" target="_blank"><?=$info[catname]?></a></span>
						</li>
						<? 
							$t = $t + 1;
						}?>
					</ul>
				</div>
			</div>
			<? if($i%2 == 0){?><div id="ad_indexcatad_<?=$fcat[catid]?>"></div><? }?>
			<? }
			$i = $i + 1;
			}
			?>
		</div>
		<div class="clearfix"></div>
		<? if(is_array($members)){?>
		<div class="shoplist">
		<div class="intershop">
		<div class="hd">
			<span class="more"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>?mod=register&action=store&cityid=<?=$city[cityid]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?>/template/default/images/index/ruzhu.gif"></a> <a href="<?=$about[yp_uri]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?>/template/default/images/index/gdsj.gif"></a>
			</span>
            <span style="float:right;">
			<? foreach($shopclass as $k => $v){$i=1;if($i < 9){?>
            <a href="<?=$v[uri]?>" target="_blank"><?=$v[corpname]?></a>
            <? $i=$i+1;}?>
            <? }?>
            </span>
		</div>
		<div id="shop">
		<div class="bd" id="shop1">
		<? foreach($members as $k =>$v){?>
		<li class="item"><a href="<?=$v[uri]?>" target="_blank" ><img src="<?=$mymps_global[SiteUrl]?><?=$v[prelogo]?>"  alt="<?=$v[tname]?>"/></a> <span class="title"><a href="<?=$v[uri]?>" target="_blank"><?=substr($v[tname],0,16)?></a></span><span  class="sale">Owner: <?=$v[userid]?></span></li>
		<? }?>
		 </div>
		</div>
		</div>
		</div>
		<div class="clear"></div>
		<? }?>
		<? if(is_array($goods)){?>
		<div class="goods">
			<div class="hd">
				<div class="span">Online Purchase</div>
				<div class="more"><a href="<?=$city[domain]?>goods.php" target="_blank">More</a></div>
			</div>
			<div class="bd">
				<ul>
				<? foreach($goods as $k => $v){?>
				<li>
				<a href="<?=$v[uri]?>"  target=_blank><img src="<?=$mymps_global[SiteUrl]?>/<?=$v[pre_picture]?>" title="<?=$v[goodsname]?>"/>
				<h3><?=$v[goodsname]?></h3>
				</a>
				<div class="price"><font color="red"; font-size: 14px;  font-weight:bold;>RM </font><font color="brown"; font-size: 16px;><?=$v[nowprice]?></font></div>
				</li>
				<? }?>
              	</ul>
			</div>
		</div>
		<div class="clear"></div>
		<? }?>
		<? if(is_array($groups)){?>
		<div class="group">
		<div class="hd">
		<div class="span">Latest Group Purchase</div>
		<div class="more">
		<? foreach($groupclass as $k => $v){?>
		<a href="<?=$v[cate_uri]?>" target="_blank"><?=$v[cate_name]?></a>
		<? }?>
		<a href="<?=$city[domain]?>group.php" target="_blank" class="moree">More</a>
		</div>
		</div>
		<div class="bd">
		<? foreach($groups as $k => $v){?>
		<ul>
		<div class="img"><a href="<?=$v[uri]?>"><img src="<?=$mymps_global[SiteUrl]?><?=$v[pre_picture]?>"></a></div>
		<div class="detail">
		<span class="name">Activity Name: <a href="<?=$v[uri]?>" target="_blank"><?=$v[gname]?></a></span>
		<span>Ending Time: <font color="#404040"><?=GetTime($v[enddate],'Y-m-d')?></font></span>
		<span>Starting Time: <font color="#404040"><?=GetTime($v[meetdate],'Y-m-d')?></font></span>
		<span>Site: <font color="#404040"><?=$v[gaddress]?></font></span>
		</div>
		</ul>
		<? }?>
		</div>
		</div>
		<div class="clear"></div>
		<? }?>
		<? if(is_array($city['telephone'])){?>
		<div class="telephone">
			<div class="hd"><span class="hdleft">Convenience Line</span><span class="hdright">Seller wanted for convenience line slot,please contact us:  <font color="green"><?=$mymps_global[SiteTel]?></font></span></div>
			<div class="clearfix"></div>
			<div class="bd">
				<ul>
					<? foreach($city['telephone'] as $k => $v){?>
					<li><font style="color:<?=$v[color]?>;<? if($v[if_bold] == 1){?>font-weight:bold<? }?>"><?=$v[telname]?><br /><?=$v[telnumber]?></font></li>
					<? }?>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		<? }?>
		<? if(is_array($city['lifebox'])){?>
		<div class="lifebox">
			Useful tools:
			<? foreach($city['lifebox'] as $k => $v){?><a rel="nofollow" href="<?=$mymps_global[SiteUrl]?>/lifebox.php?id=<?=$v[id]?>" target="_blank"><?=$v[lifename]?></a><? }?>
		</div>
		<div class="clear"></div>
		<? }?>
		<div class="flink">
	<div class="hd"><span class="hd1">Related Links</span><span class="hd2"></span></div>
	<div class="bd">
		<? if(is_array($city['flink'][img])){?>
		<ul class="image">
		<? foreach($city['flink'][img] as $k =>$v){?>
		<li><a href="<?=$v[url]?>" target="_blank" title="<?=$v[name]?>"><img src="<?=$v[logo]?>" border="0" /></a></li>
		<? }?>
		</ul>
		<? }?>

	</div>
	</div>
		<div class="clear"></div>
		<? include mymps_tpl('inc_foot');?>
	</div>
</div>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/slide_classic.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/ScrollPic.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/index.js" type="text/javascript"></script>
<script type="text/javascript">
var scrollPic_02 = new ScrollPic();
scrollPic_02.scrollContId   = "ISL_Cont_1"; //内容容器ID
scrollPic_02.arrLeftId      = "LeftArr";//左箭头ID
scrollPic_02.arrRightId     = "RightArr"; //右箭头ID
scrollPic_02.frameWidth     = 944;//显示框宽度
scrollPic_02.pageWidth      = 94; //翻页宽度
scrollPic_02.speed          = 10; //移动速度(单位毫秒，越小越快)
scrollPic_02.space          = 10; //每次移动像素(单位px，越大越快)
scrollPic_02.autoPlay       = true; //自动播放
scrollPic_02.autoPlayTime   = 3; //自动播放间隔时间(秒)
scrollPic_02.initialize(); //初始化
</script>
</body>
</html>
