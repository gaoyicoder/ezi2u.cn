<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/findpwd.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator.common.js"></script> 
<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator.js"></script> 
<title>Retrieve Password</title>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_log');?>
<div class="inner">
	<div class="body">
	<div class="clearfix"></div>
	<div id="main" class="wrapper">
		<div class="step1">
			<span class="cur"><font class="number">1</font> Enter Email Address</span>
			<span><font class="number">2</font> Identifying Information</span>
			<span><font class="number">3</font> Reset Password</span>
		</div>
		<div class="clear15"></div>
		<div class="stepp">
			<form action="<?=$mymps_global[cfg_member_logfile]?>" method="post" name="ForpwdFrom">
			<input name="mod" type="hidden" value="forgetpass">
			<input name="action" type="hidden" value="sendmail">
			<div>
			<input type="text" class="typeinput" name="email" placeholder="Email Address" require="true" datatype="email|limit|ajax" url="<?=$mymps_global[SiteUrl]?>/javascript.php?part=chk_remail&mod=1" id="email" msg="This Email address is in the wrong format|">
			</div>
			<div class="clear"></div>
			<? if($mymps_imgcode == 1){?>
			<div>
			<input type="text" placeholder="Identifying Code: " name="checkcode" datatype="limit|ajax" require="true" class="typeinputimg" id="checkcode" min="1" msgid="code" msg="Please enter identifying code" url="<?=$mymps_global[SiteUrl]?>/javascript.php?part=chk_authcode"><img src="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_authcodefile]?>" alt="Cannot see clearly? Click to Refresh." class="authcode" align="absmiddle" onClick="this.src=this.src+'?'"/> <span id="code"></span>
			</div>
			<div class="clear"></div>
			<? }?>
			<div>
			<input name="log_submit" class="typebtn" value="Next" type="submit" onclick="return CheckForm();"/>
			</div>
			</form>
		</div>
	</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>
</body>
</html>
<script language="javascript" type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator2.js"></script> 
