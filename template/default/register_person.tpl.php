<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/login.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator.common.js"></script> 
<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator.js"></script> 
<title><?=$page_title?></title>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">
<? include mymps_tpl('inc_head_log');?>
<div class="clearfix"></div>
<div class="inner">
	<div class="body">
		<div class="registerpart">
			<div class="step2">
				<span>1. Select Type<a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>?mod=register&cityid=<?=$city[cityid]?>"> (Click to Reselect)</a></span>
				<span class="cur">2. Register To Become an Individual Member</span>
				<span>3. Log Into the Member Centre</span>
			</div>
			<div class="regdetail">
				<div class="partname">
					<div class="li1">Account Information</div>
					<div class="li2">(Items with <font color="red">*</font>are required items)</div>
				</div>
				<form method="post" action="<?=$mymps_global[cfg_member_logfile]?>" name="registerform" id="registerform">
				<div class="partinput">
					
					<input name="mod" value="register" type="hidden"/>
					<input name="reg_corp" value="0" type="hidden"/>
					<input name="mixcode" value="<?=$mixcode?>" type="hidden">
					<table class="formlogin" cellpadding="0" cellspacing="0">
					<tr>
					<td class="tdright"><font color=red>*</font>User ID: </td>
					<td>
					<input name="userid" id="reg_username" type="text" class="input input-large" require="true" datatype="userName|limit|ajax" url="<?=$mymps_global[SiteUrl]?>/javascript.php?part=chk_remember" min="5" max="20" msg="User ID must consist of 5 to 20 characters of letters with digits and must not begin with a digit||">&nbsp;
					</td>
					</tr>
					<tr>
					<td class="tdright"><font color=red>*</font>Email: </td>
					<td><input name="email" type="text" class="input input-large" require="true" datatype="email|limit|ajax" url="<?=$mymps_global[SiteUrl]?>/javascript.php?part=chk_remail" id="email" msg="The Email address entered is in the wrong format|">
					</td>
					</tr>
					<tr>
					<td class="tdright"><font color=red>*</font>Password: </td>
					<td>
					<input id="reg_password" name="userpwd" type="password" class="input input-large" require="true" datatype="limitB" min="6" max="16" msg="Password must be between 6 and 16 characters in length!" maxlength="16">
					</td>
					</tr>
					<tr>
					<td scope="row" class="tdright">Complexity: </td>
					<td>
					<div id="pw_check_1" class="pw_check">
						<span><strong class="c_orange">Easy</strong></span>
						<span>Plain</span>
						<span>Hard</span>
					</div>
					<div id="pw_check_2" class="pw_check" style="display:none;">
						<span>Easy</span>
						<span><strong class="c_orange">Plain</strong></span>
						<span>Hard</span>
					</div>
					<div id="pw_check_3" class="pw_check" style="display:none;">
						<span>Easy</span>
						<span>Plain</span>
						<span><strong class="c_orange">Hard</strong></span>
					</div>
					</td>
					</tr>
					<tr>
					<td class="tdright"><font color=red>*</font>Confirm PW: </td>
					<td><input name="reuserpwd" type="password" to="userpwd" class="input input-large" msg="The passwords entered are not identical!" id="pwdconfirm" require="true" datatype="repeat">
					</td>
					</tr>
					<? if($mymps_imgcode == 1){?>
					<tr>
					<td class="tdright"><font color=red>*</font>Id. Code: </td>
					<td><input type="text" name="checkcode" datatype="limit|ajax" require="true" class="input" id="checkcode" min="1" msgid="code" msg="Please enter the Identifying Code" url="<?=$mymps_global[SiteUrl]?>/javascript.php?part=chk_authcode"> <img src="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_authcodefile]?>" id="checkcode" align="absmiddle" title="Cannot see clearly? Click to Refresh." onClick="this.src=this.src+'?'" class="authcode"/> <span id="code"></span>
					</td>
					</tr>
					<? }?>
					<? if($checkquestion){?>
					<tr>
					<td class="tdright"><font color=red>*</font>Id. Question: </td>
					<td><input name="checkquestion[answer]" id="checkanswer" msgid="wer" value="" type="text" class="input" datatype="limit|ajax" require="true" msg="Please enter answer to the identifying question" url="<?=$mymps_global[SiteUrl]?>/javascript.php?part=chk_answer&id=<?=$checkquestion[id]?>"/>
					<div class="qfont"><?=$checkquestion[question]?></div>
					<input name="checkquestion[id]" type="hidden" value="<?=$checkquestion[id]?>"/>
					<span id="wer"></span>
					</td>
					</tr>
					<? }?>
					<tr>
						<td class="tdright" style="height: 44px"></td>
						<td style="height: 44px"><input type="submit" name="log_submit" value="Accept the Terms and Conditions and Complete Registration" onclick="return AllInputCheck();" id="agreereg" class="go_reg" />
						</td>
					</tr>
					</table>
				</div>
				</form>
				<div class="xiyi">
				<div id="xieyi">
				<div class="xieye_nr">
					<p>Welcome to <?=$mymps_global[SiteName]?>. We <?=$mymps_global[SiteName]?> are a website aiming at providing you with the best service in the fastest manner. While browsing <?=$mymps_global[SiteName]?> , please also take your time to read carefully our Terms and Conditions, because you will have to accept them to become a member. Becoming member denotes full acceptance of the Terms and Conditions.<br /></p>
					<br />
					<p>
					1. Users should register and log-in according to the rules and procedures set by <?=$mymps_global[SiteName]?> and keep the information used truthful, reliable and timely updated.<br />
					<br />
					2. All users should make posts in proper columns or districts and make sure that the content of the posts are truthful and reliable. Upon making a post, Prohibitions set by <?=$mymps_global[SiteName]?> should be abided by, and a user will be responsible for all his/her posted, uploaded and transferred information. <br />
					<br />
					</p>
				</div>
				</div>
			 </div>
			</div>
			
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot_about');?>
</div>

</body>
</html>
<script language="javascript" type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/validator2.js"></script> 
