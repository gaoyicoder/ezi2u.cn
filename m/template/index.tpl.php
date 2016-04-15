<!DOCTYPE html>

<html lang="zh-CN" class="index_page">

<head>

	<?php include mymps_tpl('header');?>

	<meta name="keywords" content="<?=$mymps_global[SiteName]?>"/>

	<meta name="description" content="<?=$mymps_global[SiteName]?>Mobile Version"/>

	<title><?=$mymps_global[SiteName]?>-Mobile Version</title>

	<link type="text/css" rel="stylesheet" href="template/css/global.css">

	<link type="text/css" rel="stylesheet" href="template/css/style.css">

	<link type="text/css" rel="stylesheet" href="template/css/index.css">

</head>



<body>

<?php include mymps_tpl('header_search');?>



<div class="index_nav_dl">

	<?php foreach($categories as $k => $v){?>

	<dl>

		<dt><a href="index.php?mod=category&catid=<?=$v[catid]?>&cityid=<?=$cityid?>"><i class="ico" style="background:url(<?=$mymps_global[SiteUrl]?><?=$v[icon]?>) no-repeat;"></i><?=substring($v['catname'],0,10)?></a></dt>

		<dd>

			<?php foreach($v[children] as $k => $c){?>

				<a style="width:48%;text-align:left; font: bold 13px david, sans-serif;color:<?=$c[color]?>;" href="index.php?mod=category&catid=<?=$c[catid]?>&cityid=<?=$cityid?>"><?=substring($c['catname'],0,16)?></a>

			<?php }?>

		</dd>

	</dl>

	<?php }?>		

</div>

	

<?php include mymps_tpl('footer');?>



</body>

</html>