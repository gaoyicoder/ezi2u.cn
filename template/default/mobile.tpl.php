<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mobile Version</title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/m.css" />
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_post');?>
<div class="body1000">
	<div class="clear"></div>
	<div class="wapcontent">
		<div class="wap_left">
		</div>
		<div class="wap_right">
			<div class="input_domain">
				<div class="input_words">Visit our site via URL using your mobile/tablet browser.</div>
				<div class="inputdomain"><?=$mobile_settings[mdomain]?></div>
				<div class="input_image"><img src="<?=$mymps_global[SiteUrl]?>/qrcode.php?value=<?=$mobile_settings[mdomain]?>" valign="absmiddle"><br />Scanning Two-dimension Code To Visit</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>
</body>
</html>
