<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>

<title><?=$page_title?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="shortcut icon" href="<?=$mymps_global[SiteUrl]?>/favicon.ico" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />

<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/post.css" />

<link rel="stylesheet" type="text/css" href="<?=$mymps_global[SiteUrl]?>/template/default/css/openlogin.css" />

<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>

<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>

<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>

</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?>">

<? include mymps_tpl('inc_head_post');?>

<div class="clearfix"></div>

<div class="body1000">

	<div id="main">

		<div class="openlogincontainer">

			<div class="openlogin">

				<div class="mpstopic-category">

					<div class="panel-tab">

						<ul class="tab-list">

							<li class="firsttab"><a href="?mod=openlogin&action=reg" <? if($action == 'reg'){?>class="current"<? }?>>Perfect Account Information</a></li>

							<li><a href="?mod=openlogin&action=bind" <? if($action == 'bind'){?>class="current"<? }?>>Have An Account Already</a></li>

						</ul>

					</div>

				</div>

				<div class="clear"></div>

				<form action="?" method="post">

				<input name="mod" value="openlogin" type="hidden">

				<input name="action" value="<?=$action?>" type="hidden">

				<input name="mixcode" value="<?=$mixcode]?>" type="hidden">

				<div class="after-mpstopic">

					<ul>

						<? if($action =='reg'){?>

						<input name="userid" type="hidden" value="<?=$nickname?>">

						<li class="firstli"> ��ʹ��QQ�ʺ�(�й�Ԫ�أ���������) <img src="<?=$figureurl_qq_1?>" align="absbottom"/> <b><?=$nickname?></b> ע�᱾վ��<a href="include/qqlogin/qq_login.php">��QQ�ʺ�(�й�Ԫ�أ���������)?</a></li>

						<li><span class="aleft"><font color="red">*</font>Email Address: </span><span class="aright"><input name="email" class="text"></span></li>

						<li><span class="aleft"><font color="red">*</font>Password: </span><span class="aright"><input name="userpwd" class="text" type="password"></span></li>

						<? }else{?>

						<li class="firstli">��ʹ��QQ�ʺ�(�й�Ԫ�أ���������) <img src="<?=$figureurl_qq_1?>" align="absbottom"/> <b><?=$nickname?></b> �󶨱�վ�û���<a href="include/qqlogin/qq_login.php">��QQ�ʺ�(�й�Ԫ�أ���������)?</a></li>

						<li><span class="aleft"><font color="red">*</font>Original User ID: </span><span class="aright"><input name="bind_userid" class="text"></span></li>

						<li><span class="aleft"><font color="red">*</font>Original Password: </span><span class="aright"><input name="bind_userpwd" class="text" type="password"></span></li>

						<? }?>

						<li class="lastli"><span class="aleft"></span><span class="aright"><input name="log_submit" type="submit" value="Account Upgrade" class="submit1" /> <a href="<?=$mymps_global[SiteUrl]?>" target="_blank" style="margin-left:10px;">Look Around and Do It Later</a></span></li>

					</ul>

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

