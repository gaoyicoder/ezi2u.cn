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
		<div class="step3">
			<span><font class="number">1</font> Please Enter Email Address</span>
			<span><font class="number">2</font> Identifying Information</span>
			<span class="cur"><font class="number">3</font> Reset Password</span>
		</div>
		<div class="stepp">
			<form action="<?=$mymps_global[cfg_member_logfile]?>" method="post" name="ForpwdFrom">
			<input name="mod" type="hidden" value="forgetpass" />
			<input name="action" type="hidden" value="resetpwd" />
			<input name="uid" type="hidden" value="<?=$uid?>" />
			<input name="userid" type="hidden" value="<?=$userid?>" />
			<input name="email" type="hidden" value="<?=$email?>" />
			<div class="clear"></div>
			<div>
			<span class="cl">User Name: </span>
			<span class="cr font"><?=$userid?></span>
			</div>
			<div class="clear"></div>
			<div>
			<span class="cl">New PW: </span>
			<span class="cr">
			<input id="reg_password" name="userpwd" type="password" class="input input-large" require="true" datatype="limitB" min="6" max="16" msg="The password should be between 6 and 16 characters in length!" maxlength="16">
			</span>
			</div>
			<div class="clear"></div>
			<div>
			<span class="cl">Repeat PW: </span>
			<span class="cr">
			<input name="reuserpwd" type="password" to="userpwd" class="input input-large" msg="The passwords you have entered are not identical!" id="pwdconfirm" require="true" datatype="repeat">
			</span>
			</div>
			<div class="clear"></div>
			<div><span class="cl">&nbsp;</span><span class="cr"><input name="log_submit" class="typebtn" value="Confirm" type="submit" onclick="return CheckForm();"/></span></div>
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
