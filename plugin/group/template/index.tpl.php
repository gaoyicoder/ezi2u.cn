<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$seo[keywords]?>" />
<meta name="description" content="<?=$seo[description]?>" />
<title><?=$page_title?></title>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/group.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/plugin/group/template/style.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/pagination.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
	<? include mymps_tpl('inc_head');?>
	<div class="body1000">
		<div class="clear"></div>
		<div class="location"><?=$location?></div>
		<div class="clear"></div>
		<div class="indexcontent">
			<div class="cleft">
				<div class="categoryclass">
					<li id="all" <? if(!$cate_id){?>class="current"<? }?>><a href="group.php">All Activities</a></li>
					<? foreach($group_class as $k =>$class){?>
					<li <? if($cate_id == $class[cate_id]){?>class="current"<? }?>><a href="<?=$class[cate_uri]?>"><?=$class[cate_name]?></a></li>
					<? }?>
				</div>
				<div class="clearfix"></div>
				<? if(is_array($area_class)){?>
				<div class="area"><span>Search By District: </span>
					<? foreach($area_class as $k =>$v){?>
					<a href="<?=$v[uri]?>" <? if($v[select] == 1){?>class="current"<? }?>><?=$v[areaname]?></a> 
					<? }?>
				</div>
				<div class="clearfix"></div>
				<? }?>
				<div class="listgroup">
					<? $i=1;foreach($list as $k=>$v){?>
					<div class="list <? if($i%2==0){?>defaultbg<? }else{?>otherbg<? }?>">
						<div class="preimg"><img src="<?=$mymps_global[SiteUrl]?><?=$v[pre_picture]?>"></div>
						<div class="middle">
							<div class="title"><span class="ttitle"><a href="<?=$v[uri]?>" target="_blank" ><?=$v[gname]?></a></span><span class="number">Activity Number: <?=$v[groupid]?></span></div>
							<div class="introduction"><?=cutstr($v[des],160)?></div>
							<div class="subintro"><div class="floatleft">
							<button class="hdxq" value="Activity Details" onclick="window.open('<?=$v[uri]?>')"></button> 
							<? if($v[commenturl]){?><button value="Join Discussion" class="cytl" onclick="window.open('<?=$v[commenturl]?>')"></button><? }?>
							</div> <div class="floatright"><span class="zz">Organized by the Site.</span> <span class="zt">Status: <?=$glevel[$v[glevel]]?></span> <span class="enddate">Valid To: <?=GetTime($v[enddate],'y-m-d')?></span></div></div>
						</div>
						<div class="signin">
							<div class="ybm"><?=$v[signintotal]?></div>
							<div class="wybm"></div>
							<div class="bmjr"><button class="bmjr" value="Sign-up" onclick="window.open('<?=$v[uri]?>#signin')"></button></div>
						</div>
					</div>
					<? $i=$i+1;}?>
					<div class="pagination"><?=$page_view?></div>
				</div>
			</div>
			<div class="cright">
				<div class="box">
					<div class="hd">Popular Group Purchase Activities</div>
					<div class="bd">
						<div class="hotbdbg">
						<ul>
							<? foreach($hotgroup as $k =>$hot){?>
							<li><a href="<?=$hot[uri]?>" target="_blank" title="<?=$hot[gname]?>"><?=cutstr($hot[gname],18)?></a></li>
							<? }?>
						</ul>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="controlgroup">
					<div class="button"><button value="Start Group Purchase" class="fqtg" onclick="window.open('<?=$mymps_global[SiteUrl]?>/member/index.php?m=group&ac=detail')"></button> <button value="Manage Group Purchase" class="gltg" onclick="window.open('<?=$mymps_global[SiteUrl]?>/member/index.php?m=group')"></button>
					</div>
					<div class="clearfix"></div>
					<div class="tel">
						Contact Hotline: <span><?=$mymps_global[SiteTel]?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<? include mymps_tpl('inc_foot');?>
	</div>
</div>
</body>
</html>
