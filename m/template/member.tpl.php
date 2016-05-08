<!DOCTYPE html>

<html lang="zh-CN" class="index_page">

<head>

	<?php include mymps_tpl('header');?>

	<title>Member Centre - <?=$mymps_global[SiteName]?></title>

	<link type="text/css" rel="stylesheet" href="template/css/global.css">

	<link type="text/css" rel="stylesheet" href="template/css/style.css">

	<link type="text/css" rel="stylesheet" href="template/css/member.css">

</head>



<body>

<div class="body_div">



	<?php include mymps_tpl('header_search');?>



	<div class="c_logn"> 

		<div style="float: left"><img src="template/images/center_ico.png" width="43" height="43" class="fl u_img"></div>
        <div style="float: left">
            <?php echo $loginfo; ?>
        </div>

	</div>
    <div class="c_logn">
        <? if($s_uid) { ?>
        Ecoin Balance: <?=$row['money_own'] ?>
        <? } ?>
    </div>


    <? if($s_uid) { ?>
	<div class="c_center">
        <? if($row['if_corp'] != 1) { ?>
            <ul>

                <li class="border_m border_r"><a class="my_order" href="index.php?mod=hui_list">Discounted Purchases</a></li>

                <li class="border_m"><a class="my_order" href="index.php?mod=tuan_list">Less for More Purchases</a></li>

            </ul>
        <? } ?>
        <? if($row['if_corp'] == 1) { ?>
            <ul>
                <li class="border_m border_r"><a class="my_order" href="index.php?mod=store_tuan_list">Unused Less for More Vouchers</a></li>
                <li class="border_m"><a class="my_order" href="index.php?mod=store_tuan_list_fi">Used Less for More Vouchers</a></li>
            </ul>
        <? } ?>

        <? if($row['if_corp'] == 1) { ?>
            <ul>
                <li class="border_m border_r"><a class="my_order" href="index.php?mod=store_hui_list">Discounted Sales</a></li>
                <li class="border_m"><a class="my_order" href="index.php?mod=receive_money_list&received_money=0">Coin Exchange</a></li>

            </ul>
        <? } ?>

		<ul>

			<li class="border_m border_r">
                <? if($row['if_corp'] != 1) { ?>
                    <a class="my_record" href="index.php?mod=history">Viewing Records</a>
                <? } else {?>
                    <?php echo $loginfomypost; ?>
                <? } ?>
            </li>

			<li class="border_m">
                <? if($row['if_corp'] != 1) { ?>
                    <?php echo $loginfomyshoucang; ?>
                <? } else {?>
                    <a class="my_del" href="index.php?mod=delete">Delete Post</a>
                <? } ?>
            </li>

		</ul>
 <!--
		<ul>

			<li class="border_m border_r"><a class="my_record" href="index.php?mod=history">Viewing Records</a></li>

			<li class="border_m"><a class="my_del" href="index.php?mod=delete">Delete Post</a></li>

		</ul>
-->
<!--
		<ul>

			<li class="border_m border_r"><a class="my_order" href="index.php?mod=newinfo">Get a Glimpse</a></li>

			<li class="border_m"><a class="my_back" href="index.php?mod=about">Contact Us</a></li>

		</ul>
-->
	</div>
<? } ?>
		

<?php include mymps_tpl('footer');?>

</div>

</body>

</html>

