<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$typename?> - <?=$store[tname]?></title> 
<link href="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/css/style.css" type="text/css" rel="stylesheet" />
<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/common.js"></script>
</head>
<body>

<? include mymps_tpl('header');?>
<div class="content">
	<div class="cleft">
		<div class="storelogo"><img src="<?=$mymps_global[SiteUrl]?><? if($store[logo]){?><?=$store[logo]?><? }else{?>/template/default/images/category/nophoto.gif<? }?>" border="0" /></div>
		<div class="clear"></div>
		<div class="square leftnews">
			<div class="hd"><span><?=$typename?></span></div>
			<div class="bd">
				<ul>
					<? if(is_array($docu_list)){foreach($docu_list as $k =>$v){?>
					<li><a href="<?=$v[uri]?>" target="_blank"><?=$v[title]?></a></li>
					<? }}else{?>
					<li>No relevant news for now!</li>
					<? }?>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		<div class="square leftcontact">
			<div class="hd"><span>Contact Us</span></div>
			<div class="bd">
				<ul>
					<li><span>Contact: </span><?=$store[cname]?></li>
					<li>Contact Phone: <font color="#5A8EC8"><?=$store[tel]?></font></li>
					<!--<li>Facebook:<?=$store[qq]?></li>-->
					<li>Contact Address: <?=$store[address]?> <a href="<?=$uri[contactus]?>" target="_blank">[View On The Map]</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="cright">
		<div class="location">Current Location: <?=$store[location]?></div>
		<div class="clear"></div>
		<div class="news_main">
		<div class="bd">
		<ul>
		<? if(is_array($docu)){foreach($docu as $k =>$v){?>
		<li class="item">
		<div class="title">
		<span class="time">(<?=GetTime($v[pubtime])?>) </span><a href="<?=$v[uri]?>"><?=$v[title]?></a></div>
		</li>
		<? }}else{?>
		<div class="clear"></div>
		<li>Currently there are no <?=$typename?></li>
		<? }?>
		</ul>
		</div>

	</div>
</div>
</div>
<div class="clear15"></div>
<? include mymps_tpl('footer');?>
</body>
</html>
