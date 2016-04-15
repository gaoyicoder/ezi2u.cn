<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>机构简介 - <?=$store[tname]?></title>
<link href="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/css/style.css" type="text/css" rel="stylesheet" />
<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/common.js"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/jquery.min.js" type="text/javascript"></script>
</head>
<body>

<? include mymps_tpl('header');?>
<div class="content">
	<? include mymps_tpl('sider');?>
	<div class="cright">
		<div class="location">Current Location: <?=$store[location]?></div>
		<div class="clear"></div>
		
		<div class="mainbox_body">
			<div class="about cfix">
			<?=$store[introduce]?>
			</div>
		</div>
	</div>
</div>
<div class="clear15"></div>
<? include mymps_tpl('footer');?>
</body>
</html>
