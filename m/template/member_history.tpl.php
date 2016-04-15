<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title>Viewing Records - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/member.css">
</head>

<body>
<div class="body_div">

	<div class="header">
		<a class="logo_a" href="index.php"><img src="template/images/waplogo.jpg" alt="<?=$mymps_global[SiteName]?>" width="100%"></a>
		<a class="city_a"><?=$mymps_global[SiteCity]?></a>
		<div class="login">
			<span class="login_txt"><a href="index.php?mod=member" rel="nofollow">Member Centre</a></span>
			<span><a class="publish" href="index.php?mod=post&catid=<?=$row['catid']?>" rel="nofollow"><i class="ico"></i>Make Post</a></span>
		</div>
	</div>
	
	<div class="search">
	<form action="index.php?" method="get">
		<div class="search_input">
		<input name="mod" type="hidden" value="search">
		<input class="input_keys" name="keywords" type="text" value="<?php echo $keywords; ?>" x-webkit-speech lang="zh-CN" placeholder="Please enter keywords here">
		</div>
		<input class="search_but body_bg" id="qixc" type="submit" value="Search for Post">
	</form>
	
</div>

	<div class="ucenter">
		<ul class="u_infolst" id="userHistory" style="margin-top:-40px">				
			<script src="template/js/history.js"></script>
		</ul>
		<!--<div class="btn_clearhistory">Clear</div>-->
	</div>

</div>
<?php include mymps_tpl('footer');?>
</body>
</html>
