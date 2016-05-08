<!DOCTYPE html>

<html lang="zh-CN" class="index_page">

<head>

	<?php include mymps_tpl('header');?>

	<title>Contact Us - <?=$mymps_global[SiteName]?></title>

	<link type="text/css" rel="stylesheet" href="template/css/global.css">

	<link type="text/css" rel="stylesheet" href="template/css/style.css">

	<link type="text/css" rel="stylesheet" href="template/css/about.css">

</head>



<body>

<?php include mymps_tpl('header_search');?>

<div id="cont">

    <div class="mbox">

    	<h3 class="tit">Contact Us</h3>

        <ul class="mcontact">

        	<li>

				<i class="ico user"></i>Phone Number:

				<span class="telbox">

					<a href="tel:<?=$mymps_global['SiteTel']?>" class="telbg"><?=$mymps_global['SiteTel']?><i class="ico tel"></i></a>

				</span>

        	</li>

            <li><i class="ico email"></i>Email Address: <?=$mymps_global['SiteEmail']?></li>

		</ul>

    </div>

</div>

<?php include mymps_tpl('footer');?>