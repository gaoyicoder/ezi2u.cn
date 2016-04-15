<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$seo[keywords]?>" />
<meta name="description" content="<?=$seo[description]?>" />
<title><?=$page_title?></title>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/goods.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/newstyle.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/pagination2.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/dropdown.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
<? include mymps_tpl('inc_head');?>
<div class="body1000">
	<div class="clear"></div>
	<div class="location"><?=$location?></div>
	<div class="clear"></div>
	<div class="wrapper">
		<div class="goods_left">
			<div class="cate_seller">
				<div class="whiteborder">
					<div class="bd">
						<ul>
						<? $i=1;foreach($goods_cat as $k =>$fcat){?>
						<li class="item"><a href="javascript:void(0);" class="rights" onclick="showHide(this,'items<?=$fcat[catid]?>');"><?=$fcat[catname]?></a>
						<ul class="contnt" id="items<?=$fcat[catid]?>" 
						style="display:
						<? if($cat[catid] > 0){?>
							<? if($fcat[catid] == $cat[parentid] || $fcat[catid] == $catid){?><? }else{?>none
<? }?>
						<? }else{?>
							<? if($i == 1){?><? }else{?>none<? }?>
						<? $i=$i+1;}?>
						;">
						<li><a href="goods.php?catid=<?=$fcat[catid]?>">All</a></li>
						<? if(is_array($fcat[children])){foreach($fcat[children] as $t =>$scat){?>
						<li><a href="<?=$city[domain]?>goods.php?catid=<?=$scat[catid]?>"  <? if($catid == $scat[catid]){?> class="current"<? }?>><?=$scat[catname]?></a></li>
						<? }}?>
						</ul>
						</li>
						<div class="clearfix"></div>
						<? }?>
						</ul>
					
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="best_seller">
				<div class="contntt">
					<div class="hd">Rank Of Weekly Sales</div>
					<div class="bd">
						<ul>
							<? if($remai_goods){?>
							<? foreach($remai_goods as $k =>$remai){?>
							<li>
								<div class="goods_image"><a href="<?=$remai[uri]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$remai[pre_picture]?>" border="0" alt="<?=$remai[goodsname]?>"/></a></div>
								<div class="goods_title"><a href="<?=$remai[uri]?>" target="_blank"><?=$remai[goodsname]?></a></div>
								<div class="goods_price">RM <font color="Grey"><del><?=$remai[oldprice]?></del></font><?=$remai[nowprice]?></div>
							</li>
							<? }?>
							<? }?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="goods_right">
			<div class="hot_seller">
				<ul>
					<? if($tuijian_goods){?>
					<? foreach($tuijian_goods as $k =>$v){?>
					<li>
						<div class="goods_image"><a href="<?=$v[uri]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$v[pre_picture]?>" border="0" alt="<?=$v[goodsname]?>"/></a></div>
						<div class="goods_title"><a href="<?=$v[uri]?>" target="_blank"><?=$v[goodsname]?></a></div>

						<div class="goods_price">RM <font color="Grey"><del><?=$v[oldprice]?></del></font> <?=$v[nowprice]?></div>
					</li>
					<? }?>
					<? }?>
				</ul>
			</div>
			<div class="clear"></div>
			<div class="goods_list">
				<div class="hd">
					<li <? if($orderby == 'dateline'){?>class="currenth"<? }?>><a href="<?=$uri[dateline]?>">Sort By Posting Time</a></li>
					<li <? if($orderby == 'hit'){?>class="currenth"<? }?>><a href="<?=$uri[hit]?>">Sort By Popularity</a></li>
					<li <? if($tuijian == 1){?>class="currenth"<? }?>><a href="<?=$uri[tuijian]?>">Display Only Recommended Items </a></li>
					<li <? if($cuxiao == 1){?>class="currenth"<? }?>><a href="<?=$uri[cuxiao]?>">Display Only Items On Sale</a></li>
				</div>
				<div class="bd">
				<div class="main_list">
					<ul class="cfix">
					<? if(is_array($list)){foreach($list as $k =>$v){?>
					<li> <b><a href="<?=$v[uri]?>" target=_blank><img src="<?=$mymps_global[SiteUrl]?><?=$v[pre_picture]?>" class="img0" width=170 height=170 border=0 alt="<?=$v[goodsname]?>"/></a></b> <span class="price">RM <?=$v[nowprice]?><del><?=$v[oldprice]?></del></span> <span class="title"><a href="<?=$v[uri]?>" target=_blank><?=cutstr($v[goodsname],26)?></a></span> <a href="<?=$v[uri]?>" class="menu" target="_blank"><img src="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/images/pro_list_18.gif"/></a> <a href="<?=$v[uri]?>" target=_blank class="menu"><img src="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/images/pro_list_29.gif" alt="" /></a> </li>
					<? }}else{?>
					<li>There is no information on corresponding products!</li>
					<? }?>
	
				</ul>
	
			</div>
				<div class="clear15"></div>
				<div class="pagination2"><?=$page_view?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<? include mymps_tpl('inc_foot');?>
	</div>
</div>
</body>
</html>
