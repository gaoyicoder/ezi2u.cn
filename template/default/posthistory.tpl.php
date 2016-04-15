<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/posthistory.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_post');?>
<div class="body1000">
	<div class="clear15"></div>
	<div id="main" class="wrapper">
		<div class="top_info cfix">
			<img src="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_authcodefile]?>?part=contact&wid=110&strings=<?=$tel?>" align="absmiddle">Recently  <span class="numtotal"><?=$numtotal?></span> Posts are made with this number
		</div>
		<div class="fabu cfix" >
			<h2 class="balance-h2">Recent Posting Records of This Number</h2>
			<ul class="ggifyes">
			<li class="firstr">
				<span class="title">Post Title</span>
				<span class="cate">Category Of Post</span>
				<span class="user">Poster</span>
				<span class="time">Time Of Post</span>
			</li>
			 <? if(is_array($info)){
			 foreach($info as $k => $info){
			 ?>
			<li>
				<span class="title"><a href="<?=$info[uri]?>" target="_blank"><?=cutstr($info[title],'40')?></a></span>
				<span class="cate"><?=$info[catname]?>&nbsp;</span>
				<span class="user"><? if($info[userid]){?><a href="<?=$info[uri_tname]?>" target="_blank"><?=$info[userid]?></a><? }else{?><?=$info[contact_who]?><? }?>&nbsp;</span>
				<span class="time"><?=GetTime($info[begintime])?></span>
			</li>
			<? }}else{?>
			<li>No related records found!</li>
			<? }?>
			</ul> 
		</div>
		<dl class="prompt">
			<dt>Notice: </dt>
			<dd>1. If you see many accounts using the same phone number in their posts, this number may be held by an agency or seller.</dd>
			<dd>2. Should you finds an agency disguising as an individual, please <a href="<?=$about[aboutus_uri]?>" target="_blank">contact us immediately </a>¡£</dd>
		</dl>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>
</body>
</html>
