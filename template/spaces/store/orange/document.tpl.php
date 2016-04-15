<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$v[title]?> - <?=$typename?> - <?=$store[tname]?></title> 
<link href="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/css/style.css" type="text/css" rel="stylesheet" />
<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/common.js"></script>
</head>
<body>

<? include mymps_tpl('header');?>
<div class="content">
	<? include mymps_tpl('sider');?>
	<div class="cright">
		<div class="location">Current Location: <?=$store[location]?></div>
		<div class="clear"></div>
		<div class="news_main">
		<div class="bd">
			<div class="news_head">
				<h2><?=$docu[title]?></h2>
				<div class="artInfo">Post Maker222: <?=$docu[author]?> Time Of Post: <?=GetTime($v[pubtime])?> Source: <?=$docu[source]?></div>
			</div>
			<div class="news_content">
				<? if($docu[imgpath] != ''){?><div align=center style="margin:10px auto"><a href="<?=$docu[imgpath]?>" target="_blank"><img src="<?=$docu[pre_imgpath]?>" border="0" alt="Click to View Full Image"></a> </div><? }?>
				<?=$docu[content]?>
			</div>

		</div>
	</div>
	</div>
</div>
<div class="clear15"></div>
<? include mymps_tpl('footer');?>
</body>
</html>
