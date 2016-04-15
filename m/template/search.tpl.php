<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title>Search - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/list.css">
</head>

<body>
<div class="body_div">

	<?php include mymps_tpl('header_search');?>

	<div class="dl_nav"><span><a href="index.php">Homepage</a>&gt;<a href="#">Search</a></span></div>

	<div class="se_nav">On "<?php echo $keywords; ?>" , currently <?php echo $rows_num; ?> posts are found.</div>

	<div class="infolst_w">
		<ul class="list-info">
			<?php if(empty($info_list)) echo '<div style="margin:20px;color:#999999">Sorry, no relevant posts are found! Please try and search again.</div>';
			foreach($info_list as $k => $v){ ?>
			<li>
				<a href="index.php?mod=information&id=<?php echo $v['id']; ?>">
				<dl>
					<dt class="tit"><strong><?php echo HighLight($v['title'],$keywords); ?></strong>&nbsp;<?php if(!empty($v['img_path'])){?><sapn style="background:#339966; color:#FFFFFF; font-size:14px; padding:0 2px;text-align:center;"><?=$v[img_count]?>Image</sapn><? } else {?><?}?></dt>
					<dd class="attr"><span><?=substring($v['content'],0,50)?></span></dd>
					<dd class="attr"><?php echo $v['userid'] ? ''.$v[userid].'' : $v['contact_who']; ?>&nbsp;&nbsp;<?php echo get_format_time($v['begintime']); ?> &nbsp;Read<?php echo $v['hit']; ?></dd>
				</dl>
				</a>
			</li>
			<?php }?>
		</ul>  
	</div>

	<?php if(!empty($info_list)){?>
		<div class="pager">
		<?php if($totalpage == 1 && $page == 1){?>
			<?=$rows_num?>Results
		<?php }else{?>		
			<?php if($page-1 < 1){?>
				<a href="javascript:void();" class="pageprev pagedisable">Prev.</a>
				<a class="pageno pagecur"><?=$page?></a>
				<a href="index.php?mod=search&keywords=<?=$keywords?>&page=<?=$page+1?>" class="pageno"><?=$page+1?></a>
				<?php if($totalpage > $page+1){?>
				<a href="index.php?mod=search&keywords=<?=$keywords?>&page=<?=$page+2?>" class="pageno"><?=$page+2?></a>
				<?php }?>
			<?}else{?>
				<a href="index.php?mod=search&keywords=<?=$keywords?>&page=<?php echo ($page-1 < 1 ? 1 : $page-1)?>" class="pageprev">Prev.</a>
				<?php if($totalpage == 3 && $page==3){?>
				<a href="index.php?mod=search&keywords=<?=$keywords?>&page=<?=$page-2?>" class="pageno"><?=$page-2?></a>	
				<?php }?>
				<a href="index.php?mod=search&keywords=<?=$keywords?>&page=<?=$page-1?>" class="pageno"><?=$page-1?></a>	
				<a class="pageno pagecur"><?=$page?></a>
				<?php if($totalpage > $page){?>
				<a href="index.php?mod=search&keywords=<?=$keywords?>&page=<?=$page+1?>" class="pageno"><?=$page+1?></a>
				<?php }?>
			<?php }?>
			<?php if($totalpage > $page){?>
				<a href="index.php?mod=search&keywords=<?=$keywords?>&page=<?=$page+1?>" class="pagenext">Next</a>
			<? }else{?>
				<a href="javascript:void();" class="pagenext pagedisable">Next</a>
			<?php }?>
		<?php }?>
		</div>
	<?php }?>
	
<?php include mymps_tpl('footer');?>
</div>
</body>
</html>