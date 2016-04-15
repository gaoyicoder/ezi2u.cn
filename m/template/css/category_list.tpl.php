<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
	<?php include mymps_tpl('header');?>
	<title><?=$cat['catname']?> - <?=$mymps_global[SiteName]?></title>
	<link type="text/css" rel="stylesheet" href="template/css/global.css">
	<link type="text/css" rel="stylesheet" href="template/css/style.css">
	<link type="text/css" rel="stylesheet" href="template/css/list.css">
	<script src="template/js/jq.min.js"></script>
	<script src="template/js/list.js"></script>
</head>

<body>
<div class="body_div">

    <?php include mymps_tpl('header_search');?>

	<div class="dl_nav">
		<span><a href="index.php?cityid=<?=$cityid?>">Homepage</a><font class="raquo"></font><a href="index.php?mod=category&cityid=<?=$cityid?>">Local Posts</a>
        <? foreach($parentcats as $k =>$v){?>
        <font class="raquo"></font><a href="index.php?mod=category&cityid=<?=$cityid?>&catid=<?=$v['catid']?>"><?=$v['catname']?></a>
        <? }?>
        </span>
	</div>
	
	<div class="filter">
	
		<? foreach($cat_list as $k => $v){?>
		<dl class="filter_item cmcdata" type="cmc_cmcs">
			<dt>Category</dt>
			<dd style="padding-right: 30px;">
            <a href="index.php?mod=category&catid=<?=$v['catid']?>&cityid=<?=$cityid?>"<?php if($catid == $v['catid']){?>class="selected"<?php }?>>Any</a>
			<?php foreach($v['children'] as $u => $w){?>
				<a href="index.php?mod=category&catid=<?=$w['catid']?>&cityid=<?=$cityid?>" <?php echo $w['catid'] == $catid ? 'class="selected"' : ''; ?>><?=$w['catname']?></a>
			<?php }?>
			</dd>
		</dl>
		<?php }?>
		
        <?php if(is_array($area_list)){?>
		<dl class="filter_item cmcdata" type="cmc_cmcs">
			<dt>District</dt>
			<dd style="padding-right: 30px;">
			<?php foreach($area_list as $k => $v){?>
				<a href="<?=$v['uri']?>" <?php echo $v['select'] == 1 ? 'class="selected"' : ''; ?>><?=$v['areaname']?></a>
			<?php }?>
			</dd>
		</dl>
        <?php }elseif($hotcities){?>
        <dl class="filter_item cmcdata" type="cmc_cmcs">
			<dt>State</dt>
			<dd style="padding-right: 30px;">
			<?php foreach($hotcities as $k => $v){?>
				<a href="index.php?mod=category&&catid=<?=$catid?>&cityid=<?=$v['cityid']?>"><?=$v['cityname']?></a>
			<?php }?>
			</dd>
		</dl>
        <?php }?>
        <?php if(is_array($street_list)){?>
		<dl class="filter_item cmcdata" type="cmc_cmcs">
			<dt></dt>
			<dd style="padding-right: 30px;">
			<?php foreach($street_list as $k => $v){?>
				<a href="<?=$v['uri']?>" <?php echo $v['select'] == 1 ? 'class="selected"' : ''; ?>><?=$v['streetname']?></a>
			<?php }?>
			</dd>
		</dl>
		<?php }?>
		<?php if($mymps_extra_model){?>
			<?php foreach($mymps_extra_model as $k => $v){?>
			<dl class="filter_item cmcdata" type="cmc_cmcs" style="display:none;">
				<dt><?=cutstr($v['title'],8,'')?></dt>
				<dd style="padding-right:30px;">
				<?php foreach($v['list'] as $x => $c){?>
					<a href="<?=$c['uri']?>" <?php echo $c['select'] == 1 ? 'class="selected"' : ''?>><?=$c['name']?></a>
				<?php }?>
				</dd>
			</dl>
			<?php }?>
			
			<div class="filter_more">
				<a href="javascript:;"><span>More Filtering Conditions</span><b class="arrow"></b></a>
			</div>
			
		<?}?>
	</div>

	<div class="infolst_w">
		<ul class="list-info">
		<?php 
			if(empty($info_list)) echo '<div style="margin:30px 0; text-align:center;color:#999"">Sorry, on '.$cat[catname].' we currently do not have any posts found! <a href="index.php?mod=category&catid='.$parent['catid'].'">Return</a></div>';
			foreach((array)$info_list as $k => $v){ 
			$v['upgrade_type']	= !$cat['parentid'] ? ($v['upgrade_time'] >= $timestamp ? $v['upgrade_type'] : 1):($v['upgrade_time_list'] >= $timestamp ? $v['upgrade_type_list'] : 1);
		?>
    		<li>
                <a href="index.php?mod=information&id=<?php echo $v['id']; ?>">
				<?php if(!empty($v['img_path'])){?>
					<img class="thumbnail" src="<?=$mymps_global['SiteUrl']?><?php echo $v['img_path']; ?>" alt="<?php echo $v['title']; ?></strong>">
				<? } else {?>
					<img class="thumbnail" src="template/images/noimg.gif" alt="nopic">
				<?}?>
				<dl>
					<dt class="tit"><font color="chocolate" size="2"><?php echo $v['title']; ?></font>&nbsp;<?php if(!empty($v['img_path'])){?><sapn style="background:#339966; color:#FFFFFF; font-size:14px; padding:0 2px;text-align:center;"><?=$v['img_count']?>Image</sapn><? } else {?><?}?><?php echo $v['upgrade_type'] > 1 ? '<span class="ico ding"></span>' : ''?> </dt>
					<dd class="attr"><span><font color="black" size="1"><?=cutstr(clear_html($v['content']),50)?></font></span></dd>
					<dd class="attr pr5">
						<? 
                        if(is_array($v['extra'])){
                            foreach($v['extra'] as $u => $w){
								echo '<span>';
                                if($w) echo in_array($w,array('0元（中国元素）','0万元（中国元素）','0元/月（中国元素）')) ? ' Discuss Face to Face ' : $w;
								echo '</span>';
                            }
                        }
                        ?>
						<span class="lvzi"><?php echo get_format_time($v['begintime']); ?></span>
						<span>Views: <?php echo $v['hit']; ?></span>
					</dd>
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
