<?php
if(ifplugin('goods')){
	require_once MYMPS_ROOT.'/plugin/goods/include/functions.php';
	$goods = get_goods($tpl_index['goods'],1,'');
}
if(ifplugin('group')){
	require_once MYMPS_ROOT.'/plugin/group/include/functions.php';
	$groups = get_groups(3);
	$groupclass = get_group_class();
}
$faquri['tel'] = Rewrite('about',array('part'=>'faq','id'=>'32','html_path'=>'/faq/32'.$seo['seo_htmlext']));
$faquri['del'] = Rewrite('about',array('part'=>'faq','id'=>'33','html_path'=>'/faq/33'.$seo['seo_htmlext']));
$faquri['upgrade'] = Rewrite('about',array('part'=>'faq','id'=>'24','html_path'=>'/faq/24'.$seo['seo_htmlext']));
$faquri['infonosee'] =  Rewrite('about',array('part'=>'faq','id'=>'34','html_path'=>'/faq/34'.$seo['seo_htmlext']));
$faquri['infofirst'] = Rewrite('about',array('part'=>'faq','id'=>'27','html_path'=>'/faq/27'.$seo['seo_htmlext']));
$faquri['certify'] = Rewrite('about',array('part'=>'faq','id'=>'22','html_path'=>'/faq/22'.$seo['seo_htmlext']));
$firstcats = get_smplist_cats($tpl_index['smp_cats']['first'],$tpl_index['showstyle']);
$secondcats = get_smplist_cats($tpl_index['smp_cats']['second'],$tpl_index['showstyle']);
$thirdcats = get_smplist_cats($tpl_index['smp_cats']['third'],$tpl_index['showstyle']);
$fourthcats = get_smplist_cats($tpl_index['smp_cats']['fourth'],$tpl_index['showstyle']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta name="keywords" content="<?=$city[keywords]?>"/>
<meta name="description" content="<?=$city[description]?>"/>
<title><?=$city[title]?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
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
	<? if($index_topinfo){?>
		<div class="imginfo"> 
			<div class="leftarr"><a href="javascript:void(0);" id="LeftArr">Move Left</a></div>
			<div class="centerinfo" id="ISL_Cont_1">
				<ul>
				<? foreach($index_topinfo as $k =>$topinfo){?>
				<li><a href="<?=$topinfo[uri]?>" target="_blank" title="Post Placed at the Top of the Homepage&#13;<?=$topinfo[title]?>">
				<? if($topinfo[img_path]){?><img src="<?=$mymps_global[SiteUrl]?><?=$topinfo[img_path]?>" border="0" alt="<?=$topinfo[title]?>"><? }else{?><?=$topinfo[title]?><? }?></a></li>
				</ul>
				<? }?>
			</div>
			<div class="rightarr"><a href="javascript:void(0);" id="RightArr">Move Right</a></div>
		</div>
		<div class="clear"></div>
	<? }?>
	<div class="category_inner">
	<div id="ni-flist">
	
	<div class="ni-flist1">
	<? foreach($firstcats as $k =>$v){?>
	<div class="ni-fbg">
		<? if($v[icon]){?><div class="ni-f-icon"><img src="<?=$mymps_global[SiteUrl]?><?=$v[icon]?>" width="30" height="30" /></div><? }?>
		<span><a style="color:<?=$v[color]?>" href="<?=$v[caturi]?>" target="_blank"><?=$v[catname]?></a></span>
	</div>
	<div class="ni-glist-section <? if($v[showstyle] == 3){?>tiny<? }elseif($v[showstyle]  == 2){?>short<? }else{?>long<? }?>">
		<? if(is_array($v[children])){foreach($v[children] as $u =>$w){?>
		<li><a style="color:<?=$w[color]?>" href="<?=$w[caturi]?>" target="_blank"><?=$w[catname]?></a></li>
		<? }}?>
	</div>
	<div id="ad_indexcatad_<?=$v[catid]?>"></div>
	<div class="clear"></div>
	<? }?>
	</div>
	
	<div class="ni-flist2">
	
	<? foreach($secondcats as $k =>$v){?>
	<div class="ni-fbg">
		<? if($v[icon]){?><div class="ni-f-icon"><img src="<?=$mymps_global[SiteUrl]?><?=$v[icon]?>" width="30" height="30" /></div><? }?>
		<span><a style="color:<?=$v[color]?>" href="<?=$v[caturi]?>" target="_blank"><?=$v[catname]?></a></span>
	</div>
	<div class="ni-glist-section <? if($v[showstyle] == 3){?>tiny<? }elseif($v[showstyle]  == 2){?>short<? }else{?>long<? }?>">
		<? if(is_array($v[children])){foreach($v[children] as $u =>$w){?>
		<li><a style="color:<?=$w[color]?>" href="<?=$w[caturi]?>" target="_blank"><?=$w[catname]?></a></li>
		<? }}?>
	</div>
	<div id="ad_indexcatad_<?=$v[catid]?>"></div>
	<div class="clear"></div>
	<? }?>
	
	</div>
	
	<div class="ni-flist2">
	
	<? foreach($thirdcats as $k =>$v){?>
	<div class="ni-fbg">
		<? if($v[icon]){?><div class="ni-f-icon"><img src="<?=$mymps_global[SiteUrl]?><?=$v[icon]?>" width="30" height="30" /></div><? }?>
		<span><a style="color:<?=$v[color]?>" href="<?=$v[caturi]?>" target="_blank"><?=$v[catname]?></a></span>
	</div>
	<div class="ni-glist-section <? if($v[showstyle] == 3){?>tiny<? }elseif($v[showstyle]  == 2){?>short<? }else{?>long<? }?>">
		<? if(is_array($v[children])){foreach($v[children] as $u =>$w){?>
		<li><a style="color:<?=$w[color]?>" href="<?=$w[caturi]?>" target="_blank"><?=$w[catname]?></a></li>
		<? }}?>
	</div>
	<div id="ad_indexcatad_<?=$v[catid]?>"></div>
	<div class="clear"></div>
	<? }?>
	
	</div>
	
	<div class="ni-flist3">
	<? foreach($fourthcats as $k =>$v){?>
	<div class="ni-fbg">
		<? if($v[icon]){?><div class="ni-f-icon"><img src="<?=$mymps_global[SiteUrl]?><?=$v[icon]?>" width="30" height="30" /></div><? }?>
		<span><a style="color:<?=$v[color]?>" href="<?=$v[caturi]?>" target="_blank"><?=$v[catname]?></a></span>
	</div>
	<div class="ni-glist-section <? if($v[showstyle] == 3){?>tiny<? }elseif($v[showstyle]  == 2){?>short<? }else{?>long<? }?>">
		<? if(is_array($v[children])){foreach($v[children] as $u =>$w){?>
		<li><a style="color:<?=$w[color]?>" href="<?=$w[caturi]?>" target="_blank"><?=$w[catname]?></a></li>
		<? }}?>
	</div>
	<div id="ad_indexcatad_<?=$v[catid]?>"></div>
	<div class="clear"></div>
	<? }?>
	</div>
	
	</div>
	</div>
	<div class="clear"></div>
	<!--<div class="smp_service">
		<div class="hd"><span>Service Centre</span>(Customer Service Telephone Number: <?=$mymps_global[SiteTel]?>)</div>
		<div class="bd">
			<ul>
				<li class="icon_1"><a href="<?=$faquri[tel]?>" target="_blank">My Phone Number Is Misused</a></li>
				<li class="icon_2"><a href="<?=$faquri[del]?>" target="_blank">I wish To Popularize A Post</a></li>
				<li class="icon_3"><a href="<?=$faquri[upgrade]?>" target="_blank">I wish To Popularize A Post</a></li>
				<li class="icon_4"><a href="http://tousu.baidu.com/webmaster/add" target="_blank" rel="nofollow">删除百度快照(中国元素，建议斟酌)</a></li>
				<li class="icon_5"><a href="<?=$faquri[infonosee]?>" target="_blank">Post Cannot Be Displayed</a></li>
				<li class="icon_6"><a href="<?=$faquri[infofirst]?>" target="_blank">How To Top Post</a></li>
				<li class="icon_7"><a href="<?=$faquri[certify]?>" target="_blank">I Want To Verify</a></li>
				<li class="icon_8"><a href="<?=$about[aboutus_uri]?>" target="_blank">I Want To Report</a></li>
			</ul>
		</div>
	</div>-->
	<div class="clear"></div>
	<? if(is_array($members)){?>
	<div class="smp_shoplist">
	<div class="hd">
		<span class="shop">
		<? foreach($shopclass as $k => $v){$i=1;if($i < 9){?>
            <div align="right"><a href="<?=$v[uri]?>" target="_blank"><?=$v[corpname]?></a></div>
            <? $i=$i+1;}?>
            <? }?>
		</span>
		<span class="more"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>?mod=register&action=store&cityid=<?=$city[cityid]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?>/template/default/images/index/ruzhu.gif"></a> <a href="<?=$city[domain]?><?=$about[yp_uri]?>" target="_blank"></a>
		</span>
	</div>
	<div id="shop">
	<div class="bd" id="shop1">
	<? foreach($members as $k =>$v){?>
		<li class="item"><a href="<?=$v[uri]?>" target="_blank" ><img src="<?=$mymps_global[SiteUrl]?><?=$v[prelogo]?>"  alt="<?=$v[tname]?>"/></a> <span class="title"><a title="<?=$v[tname]?>" href="<?=$v[uri]?>" target="_blank"><?=$v[tname]?></a></span><span  class="sale">By:  <?=$v[userid]?></span></li>
		<? }?>
	 </div>
	</div>
	</div>
	<div class="clear"></div>
	<? }?>
	<? if(is_array($goods)){?>
	<div class="smp_goods">
	<div align="left"><font color="Green" size="2"><b>Vouchers in Your Selected City</b></font></div>
		<div class="hd">
			<div class="span"></div>
			<div class="more"><a href="<?=$city[domain]?>goods.php" target="_blank">More</a></div>
		</div>
		<div class="bd">
			<ul>
			<? foreach($goods as $k => $v){?>
			<li>
			<a href="<?=$v[uri]?>"  target=_blank><img src="<?=$mymps_global[SiteUrl]?>/<?=$v[pre_picture]?>" title="<?=$v[goodsname]?>"/>
			<h3><?=$v[goodsname]?></h3>
			</a>
			<span><font color="Red"><b>RM </b></font><del><?=$v[oldprice]?></del><font color="Red"><?=$v[nowprice]?></font></span>
			</li>
			<? }?>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
	<? }?>
	<? if(is_array($groups)){?>
	<div class="smp_group">
	<div class="hd">
	<div align="left"><font color="Green" size="2"><b>Latest Group Purchase</b></font></div>
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
	<div class="smp_telephone">
		<div class="hd"><span class="hdleft">Convenience Line</span><span class="hdright">Seller wanted for convenience line slot.<font color="red">Rent: 300/year</font>, can be 400/year if bolding and colour changing are applied. Should you wish to apply, we may add an industry category just for you, and for one industry category, only one number will be displayed! For more information and application, please call:  <font color="green"><?=$mymps_global[SiteTel]?></font></span></div>
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
	<div class="smp_lifebox">
		<? foreach($city['lifebox'] as $k => $v){?><a rel="nofollow" href="<?=$mymps_global[SiteUrl]?>/lifebox.php?id=<?=$v[id]?>" target="_blank"><?=$v[lifename]?></a><? }?>
	</div>
	<div class="clear"></div>
	<? }?>
	<div class="smp_flink">
	<div class="hd"><div class="hd1" align="left"><font color="Green" size="2"><b>Related Links</b></font></div><!--<span class="hd2"><a href="<?=$about[friendlink_uri]?>">Apply</a></span>--></div>
	
	<div class="bd">
	<? if(is_array($city['flink'][img])){?>
	<ul class="image">
	<? foreach($city['flink'][img] as $k =>$v){?>
	<li><a href="<?=$v[url]?>" target="_blank" title="<?=$v[name]?>"><img src="<?=$v[logo]?>" border="0" /></a></li>
	<? }?>
	</ul>
	<? }?>
    
    <? if(is_array($city['flink'][txt])){?>
	<ul class="text">
	<? foreach($city['flink'][txt] as $k =>$v){?>
	<li><a href="<?=$v[url]?>" target="_blank" title="<?=$v[name]?>"><?=$v[name]?></a></li>
	<? }?>
	</ul>
    <? }?>
	</div>
	
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot');?>
</div>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/ScrollPic.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/index.<?=$mymps_global[screen_index]?>.js" type="text/javascript"></script>
</body>
</html>
