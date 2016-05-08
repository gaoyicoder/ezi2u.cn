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
        $("input[name='userpwd']").val('');
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

    <div class="title">Input Password</div>
</header>
<h3 class="headbar">
    <?= $info['title'];?>-<?= $good['goodsname'];?>
    <p class="p-r">Pay:<?=$real_amount ?></p>
</h3>
<form id="form_tuan" action="?mod=hui&id=<?=$infoid?>&good=<?=$goodsid?>" enctype="multipart/form-data" method="post" name="form1" onSubmit="return check_sub();">
<div class="mb-list-fix mb-list-wrapper mb-line-tb m-b-10">
    <div class="mb-list-line mb-line-b">
        <span>Password</span>
        <div class="p-r">
            <input style="width: 200px;" name="userpwd" type="password" class="">
            <input style="width: 200px;" name="good" type="hidden" value="<?=$goodsid ?>">
            <input style="width: 200px;" name="id" type="hidden" value="<?=$infoid ?>">
            <input style="width: 200px;" name="total_amount" type="hidden" value="<?=$total_amount ?>">
            <input style="width: 200px;" name="real_amount" type="hidden" value="<?=$real_amount ?>">

        </div>
    </div>

</div>
<span class="J_submit mb-btn-primary-block-single mb-btn-md">Submit</span>
</form>
</body>
