<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title>Log-in - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/login.css">
</head>

<body onload="load()">
<script type="text/javascript">
    function load() {
        document.getElementsByName('userpwd')[0].value = "";

    }
</script>
<div class="body_div">

	<?php include mymps_tpl('header_search');?>
	
  	<div class="dl_nav"><span><a href="index.php">Homepage</a><font class="raquo"></font><a href="javascript:;">Log-in</a></span></div> 

  	<div class="m311 log_reg_box">
		<div id="logRegTabCon">
			<div class="log_reg_item">  
				<form id="form1" method="post" action="index.php?mod=login&action=login">
				<input type="hidden" name="returnurl" value="<?=mhtmlspecialchars($returnurl)?>">			   
				<ul id="pptul" class="passport-login-input-ul">
					<li style="display:none" class="passport-login-input-li">
						<span id="loginTip" class="passport-login-tip"></span>
					</li>
					
					<li id="loginUserNameLi" class="passport-login-input-li">
						<span class="passport-login-input-span">User ID</span>
						<input type="text" name="userid" class="passport-login-input passport-login-input-username" placeholder="   Please enter user ID">
					</li>
					
					<li id="loginPasswordLi" class="passport-login-input-li">
						<span class="passport-login-input-span">Password</span>
						<input type="password" name="userpwd" class="passport-login-input passport-login-input-password" placeholder="   Please enter password">
					</li>
				
					<?php if($mobile_settings['authcode'] == 1){?>
					<li id="loginUserNameLi" class="passport-login-input-li">
						<span class="passport-login-input-span">Identifying Code</span>
						<input type="text" name="checkcode" class="passport-login-input passport-login-input-username"  style="width:130px;" placeholder="Please enter identifying code"  size="20" maxlength="75">
						<img src="<?php echo $mymps_global['SiteUrl']?>/<?php echo $mymps_global['cfg_authcodefile']?>?mod=m" alt="Cannot see clearly? Click here to refresh" width="70" height="25" align="absmiddle" style="cursor:pointer;" onClick="this.src=this.src+'?'"/>
					</li>
					<?php }?>
					
					<li id="loginButtonLi" class="passport-login-input-li">
						<span class="passport-login-input-span" jqmoldstyle="block" style="display: none;">&nbsp;</span>
						<label><input type="submit" name="button" value="login" class="passport-login-button btn_log" style="color: rgb(255, 254, 254);"></label>
					</li>
				</ul>
				</form>
			</div>
		</div>
		<div class="login_ff">
		  <div class="login_ffmain">
			  <a class="login_ffleft" href="index.php?mod=register">Register for Free</a>
		  </div>
<!--	      <div class="login_hezuo">Login From
		  <div class="login_hezuo_mian">
				<ul>
					<li class="bor" style=" margin:0 auto; float:none; border:none"><a href="<?=$mymps_global[SiteUrl]?>/include/qqlogin/qq_login.php"><i class="hzico-qq"></i>QQ account</a></li>
				</ul>
			  </div>
		  </div>-->
		</div>
  	</div>
	
	<?php include mymps_tpl('footer2');?>
</div>
</body>
</html>
