<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$channel[keywords]?>" />
<meta name="description" content="<?=$channel[description]?>"" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/news.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/newstyle.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/pagination2.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
	<? include mymps_tpl('inc_head');?>
    <div class="clear"></div>
	<div class="body1000">
		<div class="location"><?=$location?></div>
		<div class="clear"></div>
		<div class="column">
			<div class="col1">
				<div class="list_module">
					<div class="catename"><span><?=$channel[catname]?></span></div>
					<div class="category">
						<ul class="subcls schitem"> 
						<? foreach($cat_list as $k =>$v){?>
						<li <? if($v[catid] == $channel[catid]){?>class='thiscls'<? }?>><a href="<?=$v[uri]?>">全部</a></li>
							<? if(is_array($v[children])){foreach($v[children] as $u => $w){?>
							<li <? if($w[catid] == $channel[catid]){?>class='thiscls'<? }?>><a href="<?=$w[uri]?>"><?=$w[catname]?></a></li> 
							<? }}?>
						<? }?>
						</ul> 
					</div>
					<div class="clear"></div>
					<div class="nowlist">
						<ul>
							<? $i=1;foreach($news as $k =>$v){?>
							<li><span class="title"><a href="<?=$v[uri]?>" class="title" target="_blank" <? if($v[iscommend] == 1){?>style="color:red"<? }?>><?=$v[title]?></a></span><span class="time"><?=GetTime($v[begintime],'y-m-d')?></span></li>
							<? if($i%5 == 0){?><li style="background:none"></li><? }?>
							<? $i=$i+1;}?>
						</ul>
					</div>
					<div class="pagination2"><?=$pageview?></div>
				</div>
			</div>
			<? include mymps_tpl('news_right');?>
		</div>
		<div class="clear"></div>
		<? include mymps_tpl('inc_foot');?>
	</div>
</body>
</html>