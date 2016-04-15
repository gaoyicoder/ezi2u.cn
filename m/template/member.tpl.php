<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title>Member Centre - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/member.css">
</head>

<body>
<div class="body_div">

	<?php include mymps_tpl('header_search');?>

	<div class="c_logn"> 
		<img src="template/images/center_ico.png" width="43" height="43" class="fl u_img">
		<?php echo $loginfo; ?>
	</div>
	
	<div class="c_center">
		<ul>
			<li class="border_m border_r"><?php echo $loginfomypost; ?></li>
			<li class="border_m"><?php echo $loginfomyshoucang; ?></li>
		</ul>
		<ul>
			<li class="border_m border_r"><a class="my_record" href="index.php?mod=history">Viewing Records</a></li>
			<li class="border_m"><a class="my_del" href="index.php?mod=delete">Delete Post</a></li>
		</ul>
		<ul>
			<li class="border_m border_r"><a class="my_order" href="index.php?mod=newinfo">Get a Glimpse</a></li>
			<li class="border_m"><a class="my_back" href="index.php?mod=about">Contact Us</a></li>
		</ul>
	</div>
		
<?php include mymps_tpl('footer');?>
</div>
</body>
</html>
