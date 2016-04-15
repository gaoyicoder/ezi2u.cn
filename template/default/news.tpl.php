<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?=$mymps_global[SiteUrl]?>" />
<title><?=$page_title?></title>
<meta name="keywords" content="<?=$news[keywords]?>" />
<meta name="description" content="<?=$news[introduction]?>" />
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/news.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/newstyle.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/news_comment.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/news.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/comment.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
	<? include mymps_tpl('inc_head');?>
	<div class="clear"></div>
    <div class="body1000">
		<div class="location"><?=$location?></div>
		<div class="clear"></div>
		<div class="column">
			<div class="col1">
				<div class="article_module">
					<div id="article">
					<h1><?=$news[title]?></h1>
					<div id="article_extinfo">
						<div>
						Time Of Post: <?=GetTime($news[begintime])?>&nbsp;&nbsp;Source: <?=$news[source]?>&nbsp;&nbsp;Views: <font id="hit"><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/javascript.php?part=news&id=<?=$news[id]?>"></script></font>&nbsp;&nbsp; [<a href="javascript:fontZoom(16)">Large</a>][<a href="javascript:fontZoom(14)">Medium</a>][<a href="javascript:fontZoom(12)">Small</a>]
						</div>
						</div>
						<? if($news[introduction]){?><div id="introduction"><?=$news[introduction]?></div><? }?>
						<div id="article_body">
						<?=$news[content]?>
						<div class="bianji">Editor In Charge: <?=$news[author]?></div>
						</div>
						<div class="operation">
							<span><a href="javascript:window.external.addFavorite(window.location.href,'<?=$news[title]?>');">Favourites</a></span>
							<span><a href="javascript:window.print();">Print</a></span>
							<span><a href="javascript:window.close();">Close</a></span>
							<span><a href="javascript:window.scrollTo(0,0);">Top</a></span>
						</div>
						<div class="relatenews">
							<div class="relatetitle">Related Articles: </div>
							<div class="relateli">
								<ul>
									<? foreach($relate_news as $k =>$v){?>
									<li><a href="<?=$v[uri]?>" title="<?=$v[title]?>"><?=$v[title]?></a></li>
									<? }?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="newscomment">
				<!--<div class="hd"><span class="hd1">Related Comments</span><span class="hd2"><a href="#comment_write">I Want To Comment</a></span></div>-->
				<div class="bd">
				<div><script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/comment.php?part=news&id=<?=$news[id]?>"></script></div>
				</div>
				</div>
				<div class="clear"></div>
			</div>
			<? include mymps_tpl('news_right');?>
		</div>
		<? include mymps_tpl('inc_foot');?>
	</div>
</body>
</html>
