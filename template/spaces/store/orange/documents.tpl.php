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
	<? include mymps_tpl('sider');?>
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
