<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/delinfo.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/chkdelinfo.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_post');?>
<div class="body1000">
	<div class="clear15"></div>
	<div id="main" class="wrapper">
		
		<div class="stepon2 cfix borderline">
			<li>
			<form action="<?=$mymps_global[SiteUrl]?>/search.php" method="get" name="DelinfoFrom">
			<input name="mod" type="hidden" value="information">
			<input type="text" class="typeinput" name="tel">
			<input class="typebtn" value=" Click to Inquire" type="submit"  onclick="return CheckForm();"/>
			</form>
			</li><br />
			<li>Enter your mobile phone number and click on Inquire button to commence inquiring</li>
		</div>
		<div><h2 class="balance-h2">Other Editing/Deleting Methods</h2></div>
		<div class="stepon cfix">
			<a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>">Edit/Delete Log-in Account &raquo;</a><br />
			<font color="#666666">Members Edit/Delete Made Posts Through Member Centre</font>
		</div>
		
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>
</body>
</html>
