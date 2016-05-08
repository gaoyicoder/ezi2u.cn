<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=gbk" />

<title><?=$page_title?></title>

<meta name="keywords" content="<?=$s[keywords]?>" />

<meta name="description" content="<?=$s[description]?>"" />

<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />

<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/news.head_<?=$mymps_global[head_style]?>.css" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/newstyle.css" />

<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>

<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>

</head>



<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">

	<? include mymps_tpl('inc_head');?>

	<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.jcarousel.pack.js"></script>

	<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.flashSlider-1.0.min.js"></script>

	<div class="clear"></div>

    <div class="body1000">

		<div class="location"><?=$location?></div>

		<div class="clear"></div>

		<div class="column">

			<div class="col3">

				<div class="newsfocus">

					<div id="slider">

					<ul>

					<? foreach($focus as $k => $v){?>

					<li><a href="<?=$v[url]?>" title="<?=$v[words]?>" target="_blank"><img src="<?=$v[image]?>" alt="<?=$v[words]?>" width="333" height="226" border="0" /></a></li>

					<? }?>

					</ul>

					</div>

					<script type="text/javascript">

					$(document).ready(function() {

					$("#slider").flashSlider();

					});

					</script>

				</div>

				<div class="clear"></div>

				<div class="newinfo">

					<div class="hd">Latest Posts</div>

					<div class="bd">

					<div id="indextop">

							<div id="indextop1">

							<? foreach($latest_info as $k => $v){?>

							<div class="li"><span class="tm">[<?=GetTime($v[begintime],'y-m-d')?>]</span><span class="tt"><a href="<?=$v[uri]?>" title="<?=$v[title]?>" target="_blank" style="<? if($v[ifred] == 1){?>color:red;<? }?> <? if($v[ifbold] == 1){?>font-weight:bold;<? }?>"><?=$v[title]?></a></span></div>

							<? }?>

							</div>

							<div id="indextop2"></div>

						</div>

					</div>

					<div class="postinfo">

						<input type="button" value="Make Post Now" class="footsearch_post" onclick="window.open('<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>')" style="margin-left:43px;">

						<input type="button" value="Edit/Delete Post" class="footsearch_submit" onclick="window.open('<?=$mymps_global[SiteUrl]?>/delinfo.php')">

					</div>

				</div>

			</div>

			<div class="col4">

				<div class="todaynews">

					<ul>

						<? $i=1;foreach($top_news as $k => $v){?>

						<? if($i == 1){?>

						 <div class="head">

							 <h1><a href="<?=$v[uri]?>" target="_blank" ><?=$v[title]?></a></h1>

							 <p><?=cutstr($v[content],254)?><a href="<?=$v[uri]?>" style="margin-left:20px" target="_blank">View Whole Article>></a></p>

						</div>

						<? }else{?>

						<div class="li"><span class="date"><?=GetTime($v[begintime],'y-m-d')?></span><a href="<?=$v[caturi]?>" class="catname"><?=$v[catname]?></a><a href="<?=$v[uri]?>" title="<?=$v[title]?>" target="_blank"><?=$v[title]?></a></div>

						<? }?>

						<? $i=$i+1;}?>

					</ul>

				</div>

			</div>

			<div class="col5">

				<div class="top10">

				<h3 class="top_tips">Rank Of Most Recommended Institutions</h3>

				<ul>

					<? $i=1;if(is_array($hot_member)){foreach($hot_member as $k =>$v){?>

					<li class="stitle" id="s_tle_<?=$i?>" onmouseover="show_top10(<?=$i?>);" <? if($i == 1){?>style="display:none;"<? }?>><span><?=$i?></span><a href="<?=$v[uri]?>" target="_blank"><?=cutstr($v[tname],28)?></a></li>

					<li class="ithumb" id="i_img_<?=$i?>" <? if($i > 1){?>style="display:none;"<? }?>>

						<div class="ithumb_c">

						<p class="i_num"><?=$i?></p>

						<p class="i_img"><a href="<?=$v[uri]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$v[prelogo]?>" width="78" height="58" alt="<?=$v[tname]?>" border="0" /></a></p>

						<p class="i_tle"><a href="<?=$v[uri]?>" target="_blank"><?=$v[tname]?></a></p>

						</div>

					</li>

					<? $i=$i+1;}}?>

					<script type="text/javascript" language="javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/news.js"></script>

				</ul>

				<p class="top_more"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>?mod=register&action=store" target="_blank">Register Seller Member Now>></a></p>

				</div>

			</div>

		</div>

		<div class="clear"></div>

		<div class="column2">

			<div class="tuwen">

				<div class="hd">Fantastic Articles With Pictures</div>

				<div class="bd">

					<ul>

					<? foreach($image_news as $k =>$v){?>

					<li><a href="<?=$v[uri]?>" target="_blank"><img src="<?=$v[imgpath]?>" alt="<?=$v[title]?>"/></a><span><a href="<?=$v[uri]?>" title="<?=$v[title]?>" <? if($v[iscommend] == 1){?>style="color:red"<? }?>><?=$v[title]?></a></span></li>

					<? }?>

					</ul>

				</div>

			</div>

		</div>

		<div class="clear"></div>

		<div class="column3">

			<div class="news_daohang">

				<div class="bd">

					<ul>

					<? $i=1; if(is_array($channel)){foreach($channel as $k =>$v){?>

						<div class="square <? if($i%2 != 0){?>fl<? }else{?>fr<? }?>">

							<div class="hc">

								<span class="cate"><?=$v[catname]?></span>

								<span class="more"><a href="<?=$v[uri]?>" target="_blank">More</a></span>

							</div>

							<div class="bc">

							<? if(is_array($v[news])){foreach($v[news] as $u=>$w){?>

								<div class="li"><span class="title"><a href="<?=$w[uri]?>" title="<?=$w[title]?>" target="_blank" <? if($w.iscommend == 1){?>style="color:red"<? }?>><?=$w[title]?></a></span><span class="time"><?=GetTime($w[begintime],'y-m-d')?></span></div>

							<? }}?>

							</div>

						</div>

					<? $i=$i+1;}}?>

						

					</ul>

				</div>

			</div>

			<div class="read">

				<div class="hd"><span>Rank Of Most Popular Articles</span></div>

				<div class="bd">

					<ul>

						<? foreach($hot_news as $k =>$v){?>

						<div class="li"><a target="_blank" href="<?=$v[uri]?>" title="<?=$v[title]?>" <? if($v[iscommend] == 1){?>style="color:red"<? }?>><?=cutstr($v[title],28)?></a></div>

						<? }?>

					</ul>

				</div>

			</div>

		</div>

		<div class="clear"></div>

		<? include mymps_tpl('inc_foot');?>

	</div>

</body>

</html>

<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/ppRoll.js"></script>

<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/newsppRoll.js"></script>