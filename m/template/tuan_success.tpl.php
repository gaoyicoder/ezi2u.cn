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
<header>
    <a class="back" href="index.php?cityid=<?=$city['cityid']?>">&nbsp;</a>
    <div class="placeholder"></div>
    <div class="title"><?= $info['title'];?></div>
</header>
<div class="container-wrapper">
    <div class="data-wrapper">
        <div class="cashier-container">
            <div class="promo-box">
                <div class="promo-hui J-promo-hui">
                    <ul class="discount">
                        <li class="J-promo">
                            付款成功！
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>