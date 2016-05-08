<!DOCTYPE html>

<html lang="zh-CN" class="index_page">

<head>

	<?php include mymps_tpl('header');?>

	<title>My Posts - <?=$mymps_global[SiteName]?></title>

	<link type="text/css" rel="stylesheet" href="template/css/global.css">

	<link type="text/css" rel="stylesheet" href="template/css/style.css">

	<link type="text/css" rel="stylesheet" href="template/css/member.css">

</head>



<body>

<div class="body_div">



	<?php include mymps_tpl('header_search');?>	

	

	<div class="dl_nav">

		<span>

			<a href="index.php">Homepage</a>&gt;<a href="index.php?mod=member">Member Centre</a>&gt;<a href="index.php?mod=hui_list">Discounted Sales</a>

		</span>

	</div>



	<div class="ucenter">

		<ul class="u_infolst">

			<?php 

			if(empty($hui_list)) echo '<div style="margin:30px 0;text-align:center">You have not yet bought any vouchers!</div>';

			foreach($hui_list as $k => $v){?>

				<li >

				<a href="index.php?mod=hui&id=<?=$v['infoid']?>&good=<?=$v['goodsid']?>">

				<h2>ID: <?=$v['userid']?> &nbsp;&nbsp;&nbsp;Identify code:<?=$v['msg'];?></h2>

				<div class="attr">

					<span><?=$v['oname']?></span>

					<span>Cost:<s><?=$v['totalamount']?></s> &nbsp;&nbsp;Pay:<?=$v['realamount']?></span>

					<!--<span class="del"><i class="ico_del"></i>Delete</span>-->

				</div>

				<div class="attr">

					<span class="status">Time of Purchase:</span>

					<span><?=get_format_time($v['dateline'])?></span>

				</div>

				</a>

				</li>

			<?php }?>

		</ul>

	</div>

	

</div>

<?php include mymps_tpl('footer');?>

</body>

</html>