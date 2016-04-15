<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$v[title]?> - <?=$typename?> - <?=$store[tname]?></title> 
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
			<div class="hd"><span>News On Institution</span></div>
			<div class="bd">
				<ul>
					<? if(is_array($docu_list)){foreach($docu_list as $k =>$v){?>
					<li><a href="<?=$v[uri]?>" target="_blank"><?=$v[title]?></a></li>
					<? }}else{?>
					<li>No news on the institution for now!</li>
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
					<li>Contact Phone Number: <font color="#5A8EC8"><?=$store[tel]?></font></li>
				<!--	<li>联系QQ（中国元素，建议斟酌）：<a href="tencent://message/?uin=<?=$store[qq]?>&site=qq&menu=yes" title="点击这里给我发消息"><?=$store[qq]?></a></li>-->
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
			<div class="news_head">
				<h2><?=$docu[title]?></h2>
				<div class="artInfo">Post Maker111: <?=$docu[author]?> Time Of Post: <?=GetTime($v[pubtime])?> Source: <?=$docu[source]?></div>
			</div>
			<div class="news_content">
				<? if($docu[imgpath] != ''){?><div align=center style="margin:10px auto"><a href="<?=$docu[imgpath]?>" target="_blank"><img src="<?=$docu[pre_imgpath]?>" border="0" alt="Click to View Full Image"></a> </div><? }?>
				<?=$docu[content]?>
			</div>

		</div>
	</div>
	</div>
</div>
<div class="clear15"></div>
<? include mymps_tpl('footer');?>
</body>
</html>
