<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/coupon.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/plugin/coupon/template/style.css" />
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
					<div class="hd"><span>Coupons(Total: <?=$count[total]?>)</span></div>
					<div class="bd">
                	<div class="subtitle">Select By Category: </div>
                    <div class="li">
						<? foreach($coupon_class as $k =>$class){?>
                        <li <? if($cate_id == $class[cate_id]){?>class="current"<? }?>><a href="<?=$class[cate_uri]?>"><?=$class[cate_name]?></a> <?=$count[$class[cate_id]]?></li>
                        <? }?>
                    </div>
					<? if(is_array($area_class)){?>
                    <div class="clear"></div>
                    <div class="subtitle">Select By District: </div>
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
						Cooperation Hotline: <span><?=$mymps_global[SiteTel]?></span>
					</div>
				</div>
			</div>
			<div class="cright">
				<div class="viewcoupon">
					<div class="ctitle"><?=$coupon[title]?></div>
					<div class="dateline">Popularity: <span><?=$coupon[hit]?></span> Date Of Issue: <?=GetTime($coupon[dateline])?></div>
					<div class="viewdetail">
						<div class="yhq"><span>Coupon</span></div>
						<div class="coupond">
							<div class="lefter">
								<div class="img"><img src="<?=$mymps_global[SiteUrl]?><?=$coupon[pre_picture]?>"><? if ($coupon[sup]){?><sup><?=$coupon[sup]?>off</sup><? }?></div>
								<div class="tips">
									<ul>
										<li>Please present the coupon (in black-and -white printing) before using it.  </li>
										<li>Unless mentioned, a coupon cannot be used together with other coupons.</li>
										<li>The seller holds the final right of interpretation for this coupon.</li>
									</ul>
								</div>
							</div>
							<div class="righter">
								<div class="rtitle"><?=$coupon[title]?></div>
								<div class="enddate">Valid to <?=GetTime($coupon[begindate])?> the date <font color="#ff3300"><?=GetTime($coupon[enddate])?></font></div>
								<div class="content"><?=$coupon[content]?></div>
							</div>
						</div>
					</div>
					<div class="printer">
						<div class="printbutton"><input type="button" value="Print" class="print" onclick="window.open('<?=$mymps_global[SiteUrl]?>/coupon.php?id=<?=$coupon[id]?>&action=print')"><br />
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="shopinfo">
					<div class="hd">Seller Info</hd>
					<div class="bd">
						<div class="shopname"><a href="<?=$space[uri]?>" target="_blank"><?=$space[tname]?></a></div>
						<div class="address">Contact Address: <?=$space[address]?></div>
						<div class="tel">Contact Phone: <?=$space[tel]?></div>
					</div>
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
