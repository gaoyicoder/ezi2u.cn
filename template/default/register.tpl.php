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

</head>



<body class="<?=$mymps_global[cfg_tpl_dir]?>">

<? include mymps_tpl('inc_head_log');?>

<div class="clearfix"></div>

<div class="inner">

	<div class="body">

		<div class="registerpart">

			<div class="step1">

				<span class="cur">1. Select Type of Registration</span>

				<span>2. Input Information for Registration</span>

				<span>3. Log Into the Member Centre </span>

			</div>

			<div class="select">

				<div class="ico"><span class="ico2"></span></div>

				<div class="des">

					<div class="tit"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>?mod=register&action=person&cityid=<?=$city[cityid]?>">I am an individual, Please Click to Register. ></a></div>

					<div class="intro">Becoming an individual member allows you to review and score a seller/institution.<br />An individual member can also make online inquires and get instant feedbacks.</div>

				</div>

				<div class="go"><span></span></div>

			</div>

			<? if($mymps_global[cfg_if_corp] == 1){?>

			<div class="select">

				<div class="ico"><span class="ico1"></span></div>

				<div class="des">

					<div class="tit"><a href="<?=$mymps_global[SiteUrl]?>/<?=$mymps_global[cfg_member_logfile]?>?mod=register&action=store&cityid=<?=$city[cityid]?>">I am a seller/Institution, Please Click to Register. ></a></div>

					<div class="intro">Becoming a seller/institution member allows you to open up an online shop on the site and post about news as well as promotion information.<br />Applying certification for your institution can raise your credit level, getting your institution a higher ranking and gaining you more attention. </div>

				</div>

				<div class="go"><span></span></div>

			</div>

			<? }?>

		</div>

	</div>

	<div class="clear"></div>

	<? include mymps_tpl('inc_foot_about');?>

</div>



</body>

</html>

