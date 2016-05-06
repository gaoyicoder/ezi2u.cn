<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 4/25/16
 * Time: 8:21 PM
 */

?>

<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <?php include mymps_tpl('header');?>
    <title><?=$row['goodsname']?> - <?=$mymps_global[SiteName]?></title>
    <link type="text/css" rel="stylesheet" href="template/css/tuan.css">
    <meta charset="UTF-8" />
    <script language="javascript" src="../admin/js/jquery.172.min.js"></script>
</head>
<body>
<script>
    $(document).ready(function(){
        $(".minus").click(function(){
            var ordernum = $("input[name='ordernum']").val();
            ordernum = parseInt(ordernum);
            if(ordernum>1) {
                ordernum = ordernum-1;
                $("input[name='ordernum']").val(ordernum);
                $(".J_price").html(ordernum*<?= $good['nowprice'];?>);
            }
        });
        $(".plus").click(function(){
            var ordernum = $("input[name='ordernum']").val();
            ordernum = parseInt(ordernum);
            ordernum = ordernum+1;
            $("input[name='ordernum']").val(ordernum);
            $(".J_price").html(ordernum*<?= $good['nowprice'];?>);
        });
        $("input[name='ordernum']").change(function(){
            var ordernum = $("input[name='ordernum']").val();
            ordernum = parseInt(ordernum);
            $(".J_price").html(ordernum*<?= $good['nowprice'];?>);
        });
        $(".J_submit").click(function() {
            $("#form_tuan").submit();
        });
    });
    function check_sub() {
        return true;
    }
</script>
<header class="mb-line-b">
    <a class="back back-gray" href="javascript:history.go(-1)">Back</a>

    <div class="title">Order</div>
</header>
<h3 class="headbar">
    <?= $info['title'];?>-<?= $good['goodsname'];?>
    <p class="p-r">x1</p>
</h3>
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
<span class="J_submit mb-btn-primary-block-single mb-btn-md">Submit</span>
</form>
</body>
