<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?=$store[tname]?></title>
<link href="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/css/style.css" type="text/css" rel="stylesheet" />
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/common.js"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<? include mymps_tpl('header');?>
<? if($goods){?>
<div class="goods">
	<div class="hd"><span>Products</span></div>
	<div class="clearfix"></div>
	<div class="bd">
		<ul>
			<div class="last"><a href="javascript:void(0);" id="LeftArr">Move Left</a></div>
			<div class="shop_info" id="ISL_Cont_1">
				<? foreach($goods as $k =>$list){?>
				<li><a href="<?=$mymps_global[SiteUrl]?>/<?=$list[uri]?>" title="<?=$list[goodsname]?>" target="_blank"><img src="<?=$mymps_global[SiteUrl]?><?=$list[pre_picture]?>"/></a><span><a href="<?=$list[uri]?>" title="<?=$list[goodsname]?>" target="_blank"><?=$list[goodsname]?></a></span><em>RM <?=$list[nowprice]?></em></li>
				<? }?>
				</div> 
			<div class="next"><a href="javascript:void(0);" id="RightArr">Move Right</a></div>
		</ul>
	</div>
</div>
<? }elseif($album){?>
<link rel="stylesheet" type="text/css" href="<?=$mymps_global[SiteUrl]?>/template/default/css/jquery.lightbox.css" media="screen"/>
<script language="javascript">var current_domain = '<?=$mymps_global[SiteUrl]?>';</script>
<script type="text/javascript" src="<?=$mymps_global[SiteUrl]?>/template/default/js/jquery.lightbox.js"></script>
<script type="text/javascript">$(function() {$('#ISL_Cont_1 a').lightBox();});</script>
<div class="goods">
	<div class="hd"><span>Album</span></div>
	<div class="clearfix"></div>
	<div class="bd">
		<ul>
			<div class="last"><a href="javascript:void(0);" id="LeftArr">Move Left</a></div>
			<div class="shop_info" id="ISL_Cont_1">
				<? foreach($album as $k =>$v){?>
				<li><a href="<?=$mymps_global[SiteUrl]?><?=$v[path]?>" title="<?=$v[title]?>"><img src="<?=$mymps_global[SiteUrl]?><?=$v[prepath]?>"/></a><span><a href="<?=$mymps_global[SiteUrl]?><?=$v[path]?>" title="<?=$v[title]?>" target="_blank"><?=$v[title]?></a></span></li>
				<? }?>
				</div> 
			<div class="next"><a href="javascript:void(0);" id="RightArr">Move Right</a></div>
		</ul>
	</div>
</div>
<? }?>
<div class="clear"></div>
<div class="showinfo">
	<div class="info ileft">
		<div class="hd"><span>Institution Introduction</span></div>
		<div class="clearfix"></div>
		<div class="bd intro">
			<ul>
				<? if(!$store[introduce]){?>There are currently no introduction to this institution<? }else{?><?=cutstr($store[introduce],480)?> <a target="_blank" href="<?=$uri[about]?>">[More]</a><? }?>
			</ul>
		</div>
	</div>
	<div class="info icenter">
		<div class="hd"><span>News On Institution</span></div>
		<div class="clearfix"></div>
		<div class="bd list">
			<ul>
				<? if(is_array($docu_list)){foreach($docu_list as $k =>$docu){?>
				<li><a href="<?=$docu[uri]?>" target="_blank">[<?=GetTime($docu[pubtime],'m-d')?>] <?=$docu[title]?></a></li>
				<? }}else{?>
				<div>Currently there is no news on the institution!</div>
				<? }?>
			</ul>
		</div>
	</div>
	<div class="info iright">
		<div class="hd"><span>Contact Us</span></div>
		<div class="clearfix"></div>
		<div class="bd contactus">
			<ul>
				<li>Institution Name: <?=$store[tname]?></li>
				<li>Contact: <?=$store[cname]?></li>
				<li>Contact Address: <?=$store[address]?></li>
				<li>Email Address: <?=$store[email]?></li>
				<div class="clear"></div>
				<div class="telephone"><?=$store[tel]?></div>
				<!--<div class="qqonline"><a target="_blank" href="tencent://message/?uin=<?=$store[qq]?>&site=qq&menu=yes"><img src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/images/qqonline.gif" border="0" title="Click to Contact with our Online Customer Service Staff"></a></div>-->
			</ul>
		</div>
	</div>
</div>
<div class="clear"></div>
<? include mymps_tpl('footer');?>
<script src="<?=$mymps_global[SiteUrl]?>/template/spaces/store/<?=$store[template]?>/js/scrollPic.js" type="text/javascript"></script>
<script type="text/javascript">
var scrollPic_02 = new ScrollPic();
scrollPic_02.scrollContId   = "ISL_Cont_1"; //内容容器ID
scrollPic_02.arrLeftId      = "LeftArr";//左箭头ID
scrollPic_02.arrRightId     = "RightArr"; //右箭头ID
scrollPic_02.frameWidth     = 900;//显示框宽度
scrollPic_02.pageWidth      = 180; //翻页宽度
scrollPic_02.speed          = 10; //移动速度(单位毫秒，越小越快)
scrollPic_02.space          = 15; //每次移动像素(单位px，越大越快)
scrollPic_02.autoPlay       = true; //自动播放
scrollPic_02.autoPlayTime   = 3; //自动播放间隔时间(秒)
scrollPic_02.initialize(); //初始化
</script>
</body>
</html>
