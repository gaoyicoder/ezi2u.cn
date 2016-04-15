﻿<?php
if($cat['modid'] > 1 && $idin) {
	$des = get_info_option_array();
	$extra = $db ->getAll("SELECT a.* FROM `{$db_mymps}information_{$cat[modid]}` AS a WHERE 1 {$idin}"); 
	foreach($extra as $k => $v){
		unset($v['iid']);
		unset($v['content']);
		foreach($v as $u => $w){
			$g = get_info_option_titval($des[$u],$w);
			if($u != 'id' && !is_numeric($u)) $info_list[$v[id]][$u] = $g['value'];
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<meta name="keywords" content="<?=$cat[keywords]?>" />
<meta name="description" content="<?=$cat[description]?>" />
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/category.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/pagination2.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/hover_bg.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_cat]?>">
<? include mymps_tpl('inc_head');?>
<div class="body1000">
	<div class="clear"></div>
	<div class="location">
		<?=$location?>
	</div>
	<div class="clear"></div>
	<div class="wrapper">
		<? include mymps_tpl('list_select');?>
	</div>
	
	<div class="clear"></div>
	<div class="<?=$mymps_global[head_style]?>_listhd">
		<div class="listhdleft">
			<div><a href="#" class="currentr"><span></span><?=$cat[catname]?> Post</a></div>
		</div>
		<div class="listhdcenter">
			Total Number of Posts: <span><?=$rows_num?></span>. Topped posts can be 5 times more likely to bring successful business!
		</div>
		<div class="listhdright">
			<a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?catid=<?=$cat[catid]?>&cityid=<?=$city[cityid]?>" target="_blank">Make Post on <?=$city[cityname]?> <?=$cat[catname]?> For Free>></a>
		</div>
	</div>
	<div class="clear5"></div>
	<div class="body1000">
		<div id="ad_intercatdiv"></div>
		<div class="infolists">
			<div class="list_jianli">
				<div id="ad_interlistad_top"></div>
				<ul>
					<div class="firstr">
						<span class="ltitle">Position</span>
						<span class="ltime">Posted</span>
						<span class="lterm">Graduate</span>
						<span class="lxb">Gender</span>
						<span class="lage">Age</span>
						<span class="lxueli">Education</span>
						<span class="lexp">Service Years</span>
					</div>
					<? foreach($info_list as $k =>$v){?>
					<div class="hover <? if($v[upgrade_type] > 1){?>ding<? }?>">
						<span class="ltitle">
						<a title="<?=$v[title]?>" href="<?=$info[uri]?>" target="_blank" style="<? if($info[ifred] == 1){?>color:red;<? }?> <? if($info[ifbold] == 1){?>font-weight:bold;<? }?>"><?=cutstr($v[title],20)?></a><? if($info[img_count]){?><span class="img_count"><?=$v[img_count]?>Image</span><? }?><? if($v[certify] == 1){?><span class="certify">Certification</span><? }?>
						</span>
						<span class="ltime"><?=$v[begintime]?>&nbsp;</span>
						<span class="lterm"><?=$v[graduate]?>&nbsp;</span>
						<span class="lxb"><?=$v[sex]?>&nbsp;</span>
						<span class="lage"><?=$v[age]?>&nbsp;</span>
						<span class="lxueli"><?=$v[education]?>&nbsp;</span>
						<span class="lexp"><?=$v[work_life]?>&nbsp;</span>
					</div>
					<? }?>
				</ul>
				<!--��Ŀ�б�ҳβ����濪ʼ-->
				<div id="ad_interlistad_bottom"></div>
				<!--��Ŀ�б�ҳβ��������-->
			</div>
			<div class="clear"></div>
			<div class="pagination2"><?=$pageview?></div>
			<div class="clear"></div>
			<div class="totalpost"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_postfile]?>?catid=<?=$cat[catid]?>&cityid=<?=$city[cityid]?>" target="_blank">Make A Post On<?=$city[cityname]?> <?=$cat[catname]?> Now&raquo;</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="cateintro relate">
		<div class="introleft"><?=$cat[catname]?> Related States</div>
		<div class="introright">
			<? foreach($hotcities as $k => $v){?><a href='<?=$v[domain]?><?=$cat[caturi]?>' target="_blank"><?=$v[cityname]?></a><? }?>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="cateintro">
		<div class="introleft"><?=$cat[catname]?> Channel</div>
		<div class="introright"><?=$city[cityname]?> <?=$cat[catname]?> The channel provides you with posts about <?=$city[cityname]?> <?=$cat[catname]?>, and we have large numbers of posts concerning  <?=$city[cityname]?> <?=$cat[catname]?> for you to choose. You may also view and make posts on <?=$city[cityname]?> <?=$cat[catname]?> for free.</div>
	</div>
	<? if(is_array($friendlink)){?>
	<div class="clearfix"></div>
	<div class="cateintro">
		<div class="introleft">Related Links</div>
		<div class="introflink">
			<? foreach($friendlink as $k => $v){ ?>
			<a href='<?=$friendlink[url]?>' target='_blank'><?=$friendlink[name]?></a>
			<? }?>
			<a href="<?=$city[domain]?><?=$about[friendlink_uri]?>" target="_blank">More</a>
		</div>
	</div>
	<? }?>
	<? include mymps_tpl('inc_foot');?>
</div>
</body>
</html>
