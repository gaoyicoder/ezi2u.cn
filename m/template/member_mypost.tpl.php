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
			<a href="index.php">Homepage</a>&gt;<a href="index.php?mod=member">Member Centre</a>&gt;<a href="index.php?mod=mypost&userid=<?=$userid?>">My Posts</a>
		</span>
	</div>

	<div class="ucenter">
		<ul class="u_infolst">
			<?php 
			if(empty($info_list)) echo '<div style="margin:30px 0;text-align:center">You have not yet made any posts!</div>';
			foreach($info_list as $k => $v){?>
				<li >
				<a href="index.php?mod=information&id=<?=$v['id']?>">
				<h2><?=$v['title']?></h2>
				<div class="attr">
					<span><?=$v['catname']?></span>
					<span></span>
					<!--<span class="del"><i class="ico_del"></i>Delete</span>-->
				</div>
				<div class="attr">
					<span class="status">Displayed</span>
					<span><?=get_format_time($v['begintime'])?></span>
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