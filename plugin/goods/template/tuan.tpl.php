<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<base href="<?=$mymps_global[SiteUrl]?>" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.css" />
<? if($mymps_global[bodybg] == 1){?><link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/bodybg.css" /><? }?>
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/style.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="<?=$mymps_global[SiteUrl]?>/template/default/css/goods.head_<?=$mymps_global[head_style]?>.css" />
<link rel="stylesheet" href="plugin/goods/template/style.css" />
<link rel="stylesheet" href="plugin/goods/template/view.css" />
    <link type="text/css" rel="stylesheet" href="plugin/goods/template/tuan.css">
<script language="javascript">
var current_domain = '<?=$mymps_global[SiteUrl]?>';
</script>
<script src="<?=$mymps_global[SiteUrl]?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$mymps_global[SiteUrl]?>/admin/js/jquery.172.min.js" type="text/javascript"></script>
<script type="text/javascript" src="template/global/messagebox.js"></script>
<script language="JavaScript" src="plugin/goods/template/goods.js"></script>
</head>

<body class="<?=$mymps_global[cfg_tpl_dir]?> <?=$mymps_global[screen_search]?>">
<script>
    $(document).ready(function(){
        $(".minus").click(function(){
            var ordernum = $("input[name='ordernum']").val();
            ordernum = parseInt(ordernum);
            if(ordernum>1) {
                ordernum = ordernum-1;
                $("input[name='ordernum']").val(ordernum);
                $(".J_price").html(ordernum*<?= $goods['nowprice'];?>);
            }
        });
        $(".plus").click(function(){
            var ordernum = $("input[name='ordernum']").val();
            ordernum = parseInt(ordernum);
            ordernum = ordernum+1;
            $("input[name='ordernum']").val(ordernum);
            $(".J_price").html(ordernum*<?= $goods['nowprice'];?>);
        });
        $("input[name='ordernum']").change(function(){
            var ordernum = $("input[name='ordernum']").val();
            ordernum = parseInt(ordernum);
            $(".J_price").html(ordernum*<?= $goods['nowprice'];?>);
        });

        $("#buybutton").click(function(){
            var url = '<?=$mymps_global[SiteUrl]?>/box.php?part=tuanorder&id=<?=$goods[goodsid]?>&info=<?=$info?>&ordernum='+$("input[name='ordernum']").val();
            setbg('Purchase Voucher - 请输入输入密码',510,480, url);
        });
    });
</script>
	<? include mymps_tpl('inc_head');?>
	<div class="body1000">
	<div class="clear"></div>
	<div class="location"><?=$location?></div>
	<div class="clear"></div>
		<div class="indexcontent mt5" style="overflow:hidden">
			<div class="cfix"> 
				<div class="pro_mainPic">
					<img src="<?=$mymps_global[SiteUrl]?><?=$goods[picture]?>" width="280" height="260" alt="" />
				</div>
				<div class="pro_mainInfo">
					<div class="hd cfix">
						<h2 title="<?=$goods[goodsname]?>"><?=cutstr($goods[goodsname],46)?>
						<img src="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/images/remai.gif" alt=""  style="display:<? if($goods[remai] != 1){?>none<? }?>"/>
						<img src="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/images/tuijian.gif" alt=""  style="display:<? if($goods[tuijian] != 1){?>none<? }?>"/>
						<img src="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/images/cuxiao.gif" alt=""   style="display:<? if($goods[cuxiao] != 1){?>none<? }?>"/>
						</h2>
						<span class="right"></span>
						<div class="clear"></div>

					</div>
					<div class="bd">
						<ul class="cfix">
							<li>Voucher Number: <?=$goods[goodsbh]?></li>
							<li>On Sale: No</li>
							<li class="cfix"><span class="shangjia_name">Supplier: <a target="_blank" href='<?=$goods[tname_uri]?>'><?=$goods[tname]?></a></span><span class="shangjia"><img src="../template/default/images/pro_show_25.gif" alt="" style="display:none"/></span></li>
							<li>Available: <? if($goods[huoyuan] == 1){?><span>Yes</span><? }else{?><span>No</span><? }?></li>
						</ul>
						<div  class="price">
							<span class="title"> <del><?=$goods[oldprice]?></del>  <b><?=$goods[nowprice]?></b></span>
						</div>
						<div class="presentation cfix"><a href="javascript:window.external.AddFavorite(window.location.href,document.title)" class="fav_pro">Favourites</a>Gifts: <?=$goods[gift]?></div>
						<br />
                        <br />
                        <div style="padding-right: 100px;">
                            <form id="form_tuan" action="?mod=tuan&id=<?=$info_id?>&good=<?=$good_id?>" enctype="multipart/form-data" method="post" name="form1" onSubmit="return check_sub();">
                                <div class="mb-list-fix mb-list-wrapper mb-line-tb m-b-10">
                                    <div class="mb-list-line mb-line-b">
                                        <span>Amount</span>

                                        <div class="p-r number-box J_number_box">
                                            <span class="J_minus minus ">—</span>
                                            <input name="ordernum" type="number" class="num J_result"
                                                   data-min="1"
                                                   value="1"
                                                   data-max="9999">
                                            <span class="plus on J_plus ">+</span>
                                        </div>
                                    </div>
                                    <div class="mb-list-line">
                                        <span>Total</span>

                                        <div class="p-r">
                                            <p class="price">¥<strong class="J_price"><?= $good['nowprice'];?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
						<div class="push_button">
							<div class="buy"><img id="buybutton" src="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/images/pro_show_24.png" alt=""  style="cursor:pointer"  /></div>
							<!--<div class="alipay"><img src="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/images/pro_show_26.png" alt="" /></div>-->
							<div class="service cfix"> 
								<ul>
								
								</ul> 
							</div> 
							
						</div>
					</div>
				</div>
			</div>
			<!-- ��Ʒ���� -->
			<div class="pro_info cfix">
				<div class="hd">
					<ul class="subtab cfix">
						<li name="s8" class="selected" id="s8_jieshao" onclick="show_tab('jieshao');"><a href="javascript:;">Highlight</a></li>
						<li name="s8" id="s8_quhuo" onclick="show_tab('quhuo');"><a href="javascript:;">Terms of Use</a></li>
						<li name="s8" id="s8_fukuan" onclick="show_tab('fukuan');"><a href="javascript:;">Other1</a></li>
						<li name="s8" id="s8_service" onclick="show_tab('service');"><a href="javascript:;">Other2</a></li>
					</ul>
				</div>
				
				<div id="desc">
					<ul class="bd" id="jieshao">
						<?=$goods[content]?>
					</ul>
					<ul class="bd" id="quhuo" style="display:none">
						<?=$goods[quhuo]?>
					</ul>
					<ul class="bd" id="fukuan" style="display:none">
						<?=$goods[fukuan]?>
					</ul>
					<ul class="bd" id="service" style="display:none">
						<?=$goods[service]?>
					</ul>
				</div>
				
	
			</div>
			<!-- ͬ����Ʒ -->
			<div class="bl_module cfix">
				<span class="tp_rc"></span>
				<div class="bd">
					<h3 class="yellow">Other Recommended Corresponding Vouchers</h3>
					<span class="line_yellow"></span>
					<div class="cont_proList">
						<ul class="cfix">
						<? foreach($relategoods as $k =>$relate){?>
							<li> <b><a href="<?=$relate[uri]?>" target=_blank><img src="<?=$mymps_global[SiteUrl]?><?=$relate[pre_picture]?>" alt=""  width="130" height="120"/></a></b> <span class="price"><?=$relate[nowprice]?><del><?=$relate[old_price]?></del></span> <span class="title"><a href="<?=$relate[uri]?>"  target=_blank><?=cutstr($relate[goodsname],20)?></a></span> </li>
						<? }?>
							
						</ul>
					</div>
				</div>
				<div class="ft"><a href="#top"><img src="<?=$mymps_global[SiteUrl]?>/plugin/goods/template/images/returnTop_08.gif" alt="top" /></a></div>
				<span class="ft_rc"></span>
			</div>
			<!-- ���� ���� -->
		</div>
		<div class="clear"></div>
		<? include mymps_tpl('inc_foot');?>
	</div>
</div>
</body>
</html>
