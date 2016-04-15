<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/findpwd.css" />
<title>Retrieve Password</title>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_log');?>
<div class="inner">
	<div class="body">
	<div class="clearfix"></div>
	<div id="main" class="wrapper">
		<div class="step2">
			<span><font class="number">1</font> Please Enter Email Address</span>
			<span class="cur"><font class="number">2</font> Identifying Information</span>
			<span><font class="number">3</font> Reset Password</span>
		</div>
		<div class="stepp">
			<h1> Password retrieval Email has successfully been sent!</h1>
			<div class="clear15"></div>
			<div class="detail">An Email has been sent to your Email address <strong><?=$email?></strong> , Please check the Email and reset you password according to the instructions within! </div>
		</div>
	</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>
</body>
</html>
