<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<?php include mymps_tpl('header');?>
    <title><?=$row['goodsname']?> - <?=$mymps_global[SiteName]?></title>
    <link type="text/css" rel="stylesheet" href="template/css/hui.css">
    <meta charset="UTF-8" />
    <script language="javascript" src="../admin/js/jquery.172.min.js"></script>
</head>
<body>
<script>
    function count_discount(val)
    {
        var good_list = new Array();
        var good_array;
        <?php foreach($goods_list as $good) {?>
        good_array = new Array();
        good_array['oldprice'] = <?=$good['oldprice']?>;
        good_array['nowprice'] = <?=$good['nowprice']?>;
        good_array['goodsid'] = <?=$good['goodsid']?>;
        good_list['<?=$good['goodsid']?>'] = good_array;
        <? } ?>
        var i = 0;
        var good_id = 0;
        var oldprice = 0;
        good_list.forEach(function(e){
            $('#discount_num_'+e['goodsid']).html('');
            $('.J-promo-check').remove();
            if(val >= e['oldprice']) {
                if (e['oldprice'] > oldprice) {
                    good_id = e['goodsid'];
                    oldprice = e['oldprice'];
                }
            }
        });
        if(good_id > 0) {
            var discount;
            var off;
            discount = val*good_list[good_id]['nowprice']/100;
            off = val - discount;
            off = off.toFixed(2);
            discount = val-off;
            discount = discount.toFixed(2);
            $('#discount_num_'+good_id).html(off);
            $('#discount_num_'+good_id).after('<i class="mb-select J-promo-check mutiple-selected"></i>');
            $('#discount_show').html(discount);
            $('.J-submit-payment').html(discount+'RM Confirm');
            $('.J-submit-payment').attr('data-amount', discount);
            $("input[name='goodsid']").val(good_id);
            $("input[name='real_amount']").val(discount);
        } else {
            $('#discount_show').html(val);
            $('.J-submit-payment').html(val+'RM Confirm');
            $('.J-submit-payment').attr('data-amount', val);
            $("input[name='goodsid']").val(0);
            $("input[name='real_amount']").val(val);
        }
    }
    function check_sub() {
        if($("input[name='total_amount']").val() == '') {
            alert('The Cost Can\'t Be Empty!');
            return false;
        }
        if($("input[name='total_amount']").val() > <?=$money_own ?>) {
            alert('You Don\'t Have Enough Coin!');
            return false;
        }
    }

    function submit_form() {
        $("#form_hui").submit();
    }
</script>
<header>
    <a class="back" href="javascript:history.go(-1);">&nbsp;</a>
    <div class="placeholder"></div>
    <div class="title"><?= $info['title'];?></div>
</header>
<form id="form_hui" action="?mod=hui&id=<?=$info_id?>&good=<?=$good_id?>" enctype="multipart/form-data" method="post" name="form1" onSubmit="return check_sub();">
<div class="container-wrapper">
    <div class="data-wrapper">
        <div class="cashier-container">
            <div class="amount-total has-value" data-placeholder="询问服务员后输入">
                <div class="label">Cost:</div>
                <input name="total_amount" onkeyup="count_discount(this.value)" type="number" class="amount J-total-amount" autocomplete="off" maxlength="7">
                <input type="hidden" value="" name="goodsid" />
                <input type="hidden" value="" name="real_amount" />
            </div>
            <div class="promo-box">
                <div class="promo-hui J-promo-hui">
                    <ul class="discount">
                        <?php foreach($goods_list as $good) {?>
                        <li class="J-promo">
                            <div class="checkbox">
                                <div class="pic"></div>
                                <div class="content"> <span class="title"><?=$good['goodsname']?></span></div>
                                <div id="discount_num_<?=$good['goodsid']?>" class="tip amount J-promo-tip"></div>
                            </div>
                        </li>
                        <? } ?>
                    </ul>
                </div>
            </div>
            <div class="ui-rpay" id="rpay">
                <div class="syt-pay-contanier" data-reactid=".1">
                    <div data-reactid=".1.0" class="syt-balance-box syt-mb-list-fix mb-list-wrapper mb-line-tb">
                        <div data-reactid=".1.0.0"></div>
                        <div class="mb-list-line" id="syt-pay-total" data-reactid=".1.0.1">
                            <span data-reactid=".1.0.1.0">Pay</span><div class="p-r" data-reactid=".1.0.1.1">
                                <p class="syt-price" data-reactid=".1.0.1.1.0">
                                    <span data-reactid=".1.0.1.1.0.0">¥</span>
                                    <strong id="discount_show" data-reactid=".1.0.1.1.0.1"></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div data-reactid=".1.1">
                        <h3 class="syt-pay-bar" data-reactid=".1.1.0">Pay By</h3>
                        <div class="syt-pay-way syt-mb-list-fix mb-list-wrapper mb-line-tb" data-reactid=".1.1.1">
                            <div class="mb-list-line mb-line-b" data-reactid=".1.1.1.0:$alipay">
                                <i class="syt-pay-icon syt-alipay" data-reactid=".1.1.1.0:$alipay.0"></i>
                                <span data-reactid=".1.1.1.0:$alipay.1">Coin</span>
                                <div class="p-r" data-reactid=".1.1.1.0:$alipay.3">
                                    <i class="mb-select single-selected" data-reactid=".1.1.1.0:$alipay.3.0"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pay-wrap">
                <div onclick="submit_form()" class="btn-pay J-submit-payment" data-amount="">Confirm Payment</div>
            </div>
        </div>
    </div>
</div>
</form>
</body>