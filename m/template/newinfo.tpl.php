<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title>Newest Posts - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/list.css">
</head>

<body>
<div class="body_div">

     <?php include mymps_tpl('header_search');?>
	 
	 <div class="dl_nav">
	<span><a href="index.php">Homepage</a><font class="raquo"></font><a href="index.php?mod=new_info">Newest Posts</a></span>
	</div>

	<div class="infolst_w">
		<ul class="list-info">
		<?php 
			if(empty($info_list)) echo '<div class="warning">Sorry, currently no posts on '.$GLOBALS[cat][catname].' is found! <a href="index.php?mod=category&catid='.$GLOBALS['parent']['catid'].'">Return</a></div>';
			foreach($info_list as $k => $v){ ?>
    		<li class="xinxizuo">
                <a href="index.php?mod=information&id=<?php echo $v['id']; ?>">
				<?php if(!empty($v['img_path'])){?>
					<img class="thumbnail" src="<?=$mymps_global['SiteUrl']?><?php echo $v['img_path']; ?>" alt="<?php echo $v['title']; ?></strong>">
				<? } else {?>
					<img class="thumbnail" src="template/images/noimg.gif" alt="nopic">
				<?}?>
				<dl class="xinxiliebiao">
					<dt class="tit"><?php echo $v['title']; ?>&nbsp;<?php if(!empty($v['img_path'])){?><span style="background:#339966; color:#FFFFFF; font-size:14px; padding:0 2px;text-align:center;"><?=$v[img_count]?>image</sapn><? } else {?><?}?></dt>
					<dd class="attr"><span><?=substring($v['content'],0,50)?></span></dd>
					<dd class="attr"><span class="chengzi"><?php echo $v['userid'] ? ''.$v[userid].'' : $v['contact_who']; ?></span>&nbsp;&nbsp;<span class="lvzi"><?php echo get_format_time($v['begintime']); ?></span>&nbsp;&nbsp;Read<?php echo $v['hit']; ?></dd>
				</dl>
                </a>
    		</li>
		<?php }?>
		</ul>  
	</div>
	

	<?php if(!empty($info_list)){?>
		<div class="pager">
		<?php pager();?>
		</div>
	<?php }?>

<?php include mymps_tpl('footer');?>
</div>
</body>
</html>