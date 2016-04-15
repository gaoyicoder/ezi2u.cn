<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/aboutus.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<title><?=$page_title?></title>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
	<? include mymps_tpl('inc_head_about');?>
	<div class="clearfix"></div>
	<div class="sitemap">
		<div class="ul">
			<? foreach($categories as $k => $v){?>
            <div class="h3"><a target="_blank" href='<?=$v[uri]?>'><?=$city[cityname]?><?=$v[catname]?></a></div>
			<div class="clearfix"></div>
            <ul>
            <? if(is_array($v[children])){foreach($v[children] as $u =>$w){?>
            <li><a target="_blank" href='<?=$w[uri]?>'><?=$city[cityname]?><?=$w[catname]?></a> </li>
            <? }}?>
            </ul>
            <? }?>
         </div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</body>
</html>