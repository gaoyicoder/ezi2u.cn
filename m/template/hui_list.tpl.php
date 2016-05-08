<!DOCTYPE html>

<html lang="zh-CN" class="index_page">

<head>

	<?php include mymps_tpl('header');?>

	<title>My Posts - <?=$mymps_global[SiteName]?></title>

	<link type="text/css" rel="stylesheet" href="template/css/global.css">

	<link type="text/css" rel="stylesheet" href="template/css/style.css">

	<link type="text/css" rel="stylesheet" href="template/css/member.css">
    <script language="javascript" src="../admin/js/jquery.172.min.js"></script>
</head>



<body>

<div class="body_div">



	<?php include mymps_tpl('header_search');?>	

	

	<div class="dl_nav">

		<span>

			<a href="index.php">Homepage</a>&gt;<a href="index.php?mod=member">Member Centre</a>&gt;<a href="index.php?mod=hui_list">Discounted Purchases</a>

		</span>

	</div>

    <? if($msg){ ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#message").fadeOut(2000);
            });
        </script>
        <div id="message" style="padding-left: 10px;background-color: #008800;">
            <?=$msg ?>
        </div>
    <? } ?>
	<div class="ucenter">

		<ul class="u_infolst">

			<?php 

			if(empty($hui_list)) echo '<div style="margin:30px 0;text-align:center">You have not yet bought any vouchers!</div>';

			foreach($hui_list as $k => $v){?>

				<li >

				<a href="index.php?mod=hui&id=<?=$v['infoid']?>&good=<?=$v['goodsid']?>">

				<h2><?=$v['title']?> &nbsp;&nbsp;&nbsp; <span style="float: right;">Code:<?=$v['msg'];?></span></h2>

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