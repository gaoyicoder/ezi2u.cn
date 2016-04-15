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
		<? if($status == 'error2'){?>
		<div class="step2">
			<span><font class="number">1</font> Please Enter Email Address</span>
			<span class="cur"><font class="number">2</font> Identifying Information</span>
			<span><font class="number">3</font> Reset Password</span>
		</div>
		<? }else{?>
		<div class="step3">
			<span><font class="number">1</font> Please Enter Email Address</span>
			<span><font class="number">2</font> Identifying Information</span>
			<span class="cur"><font class="number">3</font> Reset Password</span>
		</div>
		<? }?>
		<div class="stepp">
			<? if($status == 'success'){?>
			<h1>Password successfully reset! Please use the new password to log-in now!</h1>
			<div class="clear15"></div>
			<div class="steppp">
				<div>User ID: <strong><?=$userid?></strong></div>
				<div class="clear15"></div>
				<div>Email Address: <strong><?=$email?></strong>(<font color="#666">This Email address can be used to log-in</font>)</div>
				<div class="clear15"></div>
				<div><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>?mod=login">Member Centre Log-in&raquo;</a></div>
			</div>
			<? }else{?>
			<div class="clear15"></div>
			<h2><?=$msg?></h2>
			<? }?>
		</div>
	</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>
</body>
</html>
