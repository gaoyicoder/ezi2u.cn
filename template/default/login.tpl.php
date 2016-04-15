<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/login.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script language="javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/login.js"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_log');?>
<div class="clearfix"></div>
<div class="inner">
	<div class="body">
		<div class="log">
			<form name="formLogin" method="post" action="<?=$mymps_global[cfg_member_logfile]?>" onSubmit="return submitForm();">
			<input name="mod" type="hidden" value="login">
			<input name="action" type="hidden" value="dopost">
			<input name="url" type="hidden" value="<?=$url?>">
			<table class="formlogin" cellpadding="0" cellspacing="0">
			<tr>
			<td class="tdright">User ID</td>
			<td colspan="2">
			<input name="userid" type="text" class="input input-large" placeholder="User ID"/></td>
			</tr>
			<tr>
			<td class="tdright">Password</td>
			<td colspan="2"><input name="userpwd" type="password" class="input input-large" placeholder="Password"/></td>
			</tr>
			<? if($mymps_imgcode == 1){?>
			<tr>
			<td class="tdright">Identifying Code</td>
			<td colspan="2"><input type="text" name="checkcode" class="input input-small" placeholder="Identifying Code"> <img src="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_authcodefile]?>" alt="Cannot see clearly? Click to refresh" class="authcode" align="absmiddle" onClick="this.src=this.src+'?'"/>			</td>
			</tr>
			<? }?>
			<tr>
			<td>&nbsp;</td>
			<td class="font12">&nbsp;<label for="remember"><input id="remember" name="memory" value="on" type="checkbox" class="checkbox" checked="checked"/> Auto Log-in Next Time</label></td>
			<td class="font12right"><a href="?mod=forgetpass">Forgotten Password?</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
			<td class="tdright"></td>
			<td align="left" colspan="2">
<input type="submit" name="log_submit"  class="typebtn" value="Log-in Now"/>
</td>
			</tr>
			<? if($mymps_global[iflogin] == 1){?>
			<tr>
			<td class="tdright qqlogin" style="height:60px"></td>
			<td colspan="2" class="qqlogin"><br />
			You may also log-in via methods below: 
			<br /><br />
			<a href="<?=$mymps_global[SiteUrl]?>/include/qqlogin/qq_login.php"><img src="/include/qqlogin/qq_login.png" align="absmiddle"></a>
			</td>
			</tr>
			<? }?>
			</table>
			</form>
		</div>
		<div class="reg">
			<div class="cont">
				<div class="font">Do not have an account yet?</div>
				<div class="register_submit">
					<a href="?mod=register&cityid=<?=$city[cityid]?>" class="registerbutton">Register Now</a>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>

</body>
</html>
