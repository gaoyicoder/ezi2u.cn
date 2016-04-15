<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title>Register - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/login.css">
</head>

<body>
<div class="body_div">

	<?php include mymps_tpl('header_search');?>
	
  	<div class="dl_nav"><span><a href="index.php">Homepage</a><font class="raquo"></font><a href="javascript:;">Register</a></span></div> 
	

  	<div class="m311 log_reg_box">
		<div id="logRegTabCon">
			<div class="log_reg_item">  
				<form id="form1" method="post" action="index.php?mod=register&action=register">
					<input type="hidden" value="<?=$mixcode?>" name="mixcode"/>			   
					<ul id="pptul" class="passport-login-input-ul">
						<li style="display:none" class="passport-login-input-li">
							<span id="loginTip" class="passport-login-tip"></span>
						</li>
						
						<li id="loginUserNameLi" class="passport-login-input-li">
							<span class="passport-login-input-span">User ID</span>
							<input type="text" name="userid" id="regname" size="20" maxlength="15" class="passport-login-input passport-login-input-username" placeholder="Please Enter User ID (3-15 Characters)">
						</li>
						
						<li id="loginPasswordLi" class="passport-login-input-li">
							<span class="passport-login-input-span">Pass &nbsp;&nbsp;  Word</span>
							<input type="password" name="userpwd" id="regpwd" size="20" maxlength="16" class="passport-login-input passport-login-input-password" placeholder="Please Enter Password (6-16 Characters)">
						</li>
						
						<li id="loginPasswordLi" class="passport-login-input-li">
							<span class="passport-login-input-span">Confirm Password</span>
							<input type="password" name="reuserpwd" id="regpwdrepeat" size="20" maxlength="16" class="passport-login-input passport-login-input-password" placeholder="Please Reenter Password">
						</li>
						
						<li id="loginUserNameLi" class="passport-login-input-li">
							<span class="passport-login-input-span">Email</span>
							<input type="text" name="email" id="regemail" size="20" class="passport-login-input passport-login-input-username" placeholder="Please Enter Email Address" maxlength="75">
						</li>
						
						<?php if($mobile_settings['authcode'] == 1){?>
						<li id="loginUserNameLi" class="passport-login-input-li">
							<span class="passport-login-input-span">Identifying Code</span>
							<input type="text" name="checkcode" class="passport-login-input passport-login-input-username" style="width:130px;" placeholder="Please Enter Identifying Code"  size="20" maxlength="75">
							<img src="<?php echo $mymps_global['SiteUrl']?>/<?php echo $mymps_global['cfg_authcodefile']?>?mod=m" alt="Cannot see clearly? Please click on Refresh." width="70" height="25" align="absmiddle" style="cursor:pointer;" onClick="this.src=this.src+'?'"/>
						</li>
						<?php }?>
						
						<li id="rememberLi" class="passport-login-input-li">
							<div class="login_ffle"><input type="checkbox" name="agreergpermit" value="1" id="checkbox" checked /> I have read and fully agreed to <a href="index.php?mod=items">The Terms And Conditions</a></div>
						</li>
	
						<li id="loginButtonLi" class="passport-login-input-li">
							<span class="passport-login-input-span" jqmoldstyle="block" style="display: none;">&nbsp;</span>
							<label><input type="submit" name="button"  id="button" value="Register" class="passport-login-button btn_log" style="color: rgb(255, 254, 254);"></label>
						</li>
					</ul>
			   </form>
			</div>
		</div>
	</div>
	<p>&nbsp;</p>
<?php include mymps_tpl('footer2');?>
</div>
</body>
</html>
