<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>State list- <?=$mymps_global[SiteName]?></title>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/changecity.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_post');?>
<div class="body1000">
	<div class="clear15"></div>
	<div id="main" class="wrapper">
		<div class="changecitydiv">
			<div class="vhd">
				Please select:
			</div>


			<dl id="clist" class="<?=$mymps_global[cfg_cityshowtype]?>">
				<div><dt></dt><dd><a href="<?=$mymps_global[SiteUrl]?>" style="color:red;text-decoration:underline;">Any</a></dd></div>
				<? foreach($cities as $k =>$citie){?>
				<div>
				<dt></dt>
				<dd>
					<? foreach($citie as $u =>$w){?>
					<a href="<?=$w[domain]?>" <? if($w[ifhot] == 1){?>style="color:red;text-decoration:underline;"<? }?>><?=$w[cityname]?></a> 
					<? }?>
				</dd>
				</div>
				<div class="clearfix"></div>
				<? }?>
			</dl>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>
</body>
</html>
