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
	<div class="clear"></div>
	<div class="faq">
		<? $i=1;foreach($faq_type as $k =>$v){?>
		<dl class="qlist cfix">
		<dt><i class="b-<?=$i?>"></i><?=$v[typename]?></dt>
		<dd class="cfix">
		<? foreach($v[faq] as $u => $w){?>
        <a class="<? if ($w[id] == $faq[id]){?>current<? }?>" href="<?=$w[uri]?>" title="<?=$w[title]?>"><?=substr($w[title],0,20)?></a>
        <? }?>
		</dd>
		</dl>
		<? $i=$i+1;}?>
		<div class="clear"></div>
		<div class="faqcontent">
			<h1><?=$faq[title]?></h1>
			<p>
			<?=$faq[content]?>
			</p>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</body>
</html>