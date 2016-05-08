<!DOCTYPE html>

<html lang="zh-CN" class="index_page">

<head>

	<?php include mymps_tpl('header');?>

	<title>QQ��¼(�й�Ԫ��) - <?=$mymps_global[SiteName]?></title>

	<link type="text/css" rel="stylesheet" href="template/css/all.css">

	<link type="text/css" rel="stylesheet" href="template/css/login.css">

	<script src="template/js/jq.min.js"></script>

</head>



<body>

<div class="body_div">



	<div class="c_header">

		<a class="c_logo" href="index.php"></a>

		<a class="c_publish" href="index.php?mod=post"><i class="ico"></i>Post</a>

	</div> 

	

  	<div class="dl_nav"><span><a href="index.php">Homepage</a><font class="body_bg"></font><a href="javascript:;">QQ��¼(�й�Ԫ��)</a></span></div> 



	<div class="m311 log_reg_box">

    <div id="logRegTabCon">

		<div class="log_reg_item mt10"><img src="<?=$figureurl_qq_1?>" align="center" height="20" width="20"/> &nbsp;<?=$nickname?>&nbsp;������һ������Ϳ���ʹ��QQ�˺ŵ�¼�ˡ�(�й�Ԫ��)

	  

            <div class="reg-sf">

				<a href="index.php?mod=openlogin&action=reg" class="bindtab <?php if($action == reg) echo 'sel'?>"><i></i>I am a new user.</a>

				<a href="index.php?mod=openlogin&action=bind" class="bindtab <?php if($action == bind) echo 'sel'?>"><i></i>I am a registered user.</a>

            </div>



			<?php if($action == 'reg'){?>

				<div class="bindpanel">Register A New User ID

				<form action="index.php?mod=openlogin" method="post">

				<input name="action" value="reg" type="hidden">

				<input name="mixcode" value="<?=$mixcode?>" type="hidden">

				<ul class="passport-login-input-ul">

					<li class="passport-login-input-li">

						<span class="passport-login-input-span">User ID</span>

						<input name="userid" type="text" value="<?=$nickname?>" class="passport-login-input passport-login-input-password" style="color: rgb(182, 182, 182);" readonly >

					</li>

					

					<li class="passport-login-input-li">

						<span class="passport-login-input-span">Email Address</span>

						<input name="email" type="text" class="passport-login-input passport-login-input-password" style="color: rgb(182, 182, 182);">

					</li>

					

					<li class="passport-login-input-li">

						<span class="passport-login-input-span">Password</span>

						<input name="userpwd" type="password" class="passport-login-input passport-login-input-password" style="color: rgb(182, 182, 182);">

					</li>

					

					<li class="passport-login-input-li mt10">

					  <label><input name="log_submit" type="submit" value="Register And Bind" class="passport-login-button btn_log" style="color: rgb(255, 254, 254);"></label>

					</li>

				</ul>

				</form>

				</div>

			<?php } else {?>

				<div class="bindpanel">Bind With A Registered User ID

				<form action="index.php?mod=openlogin" method="post">

				<input name="action" value="bind" type="hidden">

				<input name="mixcode" value="<?=$mixcode?>" type="hidden">

				<ul class="passport-login-input-ul">

					<li class="passport-login-input-li">

						<span class="passport-login-input-span">Registered User ID</span>

						<input name="bind_userid" type="text" size="20" class="passport-login-input passport-login-input-mobile" style="color: rgb(182, 182, 182);">

					</li>

					

					<li class="passport-login-input-li">

						<span class="passport-login-input-span">Password</span>

						<input name="bind_userpwd" type="password" class="passport-login-input passport-login-input-password" style="color: rgb(182, 182, 182);">

					</li>

	

					<li class="passport-login-input-li mt10">

						<label><input name="log_submit" type="submit" value="Bind" class="passport-login-button btn_log" style="color: rgb(255, 254, 254);"></label>

					</li>

				</ul>

				</form>

				</div>

			<?php }?>

			

		</div>

    </div>

  </div>



</div>

<?php include mymps_tpl('footer');?>

</body>

</html>