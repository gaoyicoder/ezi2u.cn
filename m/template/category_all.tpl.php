<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title>All Categories - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/all.css">
</head>

<body>
<div class="body_div">

<?php include mymps_tpl('header_search');?>

<?php foreach($cat_list as $k => $v){?>
<div class="nav_tt nav_ttbg1"><img src="<?=$mymps_global[SiteUrl]?>/<?=$v[icon]?>" align="center" valign="middle" class="icon"> &nbsp; <a href="index.php?mod=category&catid=<?=$v[catid]?>&cityid=<?=$cityid?>"><?=$v[catname]?></a></div>
<div class="big_dl sale">
	<ul>
		<?php foreach($v[children] as $x => $c){?>
		<li class="one_third"><a href="index.php?mod=category&catid=<?=$c[catid]?>&cityid=<?=$cityid?>"><?=substring($c['catname'],0,8)?></a></li>
		<?php }?>
	</ul>
</div>
<?php }?>
<?php include mymps_tpl('footer');?>
	
</div>
</body>
</html>