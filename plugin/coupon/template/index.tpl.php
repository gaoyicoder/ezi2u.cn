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
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/coupon.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/plugin/coupon/template/style.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/pagination2.css" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
	<? include mymps_tpl('inc_head');?>
	<div class="body1000">
    <div class="location"><?=$location?></div>
    <div class="indexcontent mt5">
    	<div class="cleft">
        	<div class="categoryclass">
            	<div class="hd"><span>Coupons(Total:<?=$count[total]?>)</span></div>
                <div class="bd">
                	<div class="subtitle">Category: </div>
                    <div class="li">
						<? foreach($coupon_class as $k =>$class){?>
                        <li <? if($cate_id == $class[cate_id]){?>class="current"<? }?>><a href="<?=$class[cate_uri]?>"><?=$class[cate_name]?></a> <?=$count[$class[cate_id]]?></li>
                        <? }?>
                    </div>
					<? if(is_array($area_class)){?>
                    <div class="clear"></div>
                    <div class="subtitle">District: </div>
                    <div class="li">
					   <? foreach($area_class as $k =>$v){?>
                       <li <? if($v[select] == 1){?>class="current"<? }?>><a href="<?=$v[uri]?>"><?=$v[areaname]?></a></li>
                       <? }?>
                    </div>
					<? }?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="controlcoupon">
                <div class="button"><button value="Issue Coupons" class="fbyhq" onclick="window.open('<?=$mymps_global[SiteUrl]?>/member/index.php?m=coupon&ac=detail');"></button> <button value="Manage Coupons" class="glyhq" onclick="window.open('<?=$mymps_global[SiteUrl]?>/member/index.php?m=coupon');"></button>
                </div>
                <div class="clearfix"></div>
                <div class="tel">
                	Contact Hotline: <span><?=$mymps_global[SiteTel]?></span>
                </div>
            </div>
        </div>
        <div class="cright">
        	<div class="modulelist">
            	<div class="modulehd">
                    <div class="hdleft"><span><?=$currentlocate?></span></div>
                	<div class="hdright"><span>Sort By: </span>
					<? foreach($orderby_url as $k =>$v){?>
                    <a href="<?=$v[url]?>" <? if($v[selected] == 1){?>class="current"<? }?>><?=$v[name]?></a>
                    <? }?>
                    </div>
                </div>
                <div class="clearfix"></div>
            	<div class="modulebd">
                	<? foreach($list as $k =>$v){?>
                    <div class="coupon">
                    	<div class="preimg">
						<? if($v[sup]){?><sup><?=$v[sup]?>Per Cent Discount</sup><? }?>
						<a href="<?=$v[uri]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$v[pre_picture]?>"></a>
                        </div>
                        <div class="middle">
                        	<div class="title"><a href="<?=$v[uri]?>" target="_blank"><?=$v[title]?></a></div>
                            <div class="introduction"><?=cutstr($v[des],150)?></div>
                            <div class="enddate">Valid From: <?=GetTime($v[begindate])?></div>
                            <div class="enddate">Valid to: <?=GetTime($v[enddate])?></div>
                        </div>
                        <div class="fordetail">
                        	<div class="detail"><button class="ckxq" value="View Details" onclick="window.open('<?=$v[uri]?>')"></button></div>
                            <div class="print"><?=$v[prints]?>times</div>
                        </div>
                    </div>
                    <? }?>
                    
                    <div class="pagination"><?=$page_view?></div>
                    
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
