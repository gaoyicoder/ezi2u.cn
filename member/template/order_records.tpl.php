<?php include mymps_tpl('inc_header'); ?>
<link rel="stylesheet" type="text/css" href="template/css/new.exchange.css" />
<script language="javascript" src="template/javascript.js"></script>

</head>
<body class="<?php echo $mymps_global['cfg_tpl_dir']; ?>">
<div class="container">

	<?php include mymps_tpl('inc_head'); ?>
    <div id="main" class="main section-setting">
        <div class="clearfix main-inner">
            <div class="content">
            <div class="clearfix content-inner">
                <div class="content-main">
                    <div class="content-main-inner">

<div class="pwrap">
    <div class="phead"><div class="phead-inner"><div class="phead-inner">
        <h3 class="ptitle"><span>Voucher Order Management</span></h3>
    </div></div></div>
    <div class="pbody">
		<div id="msg_success"></div>
<div id="msg_error"></div>
<div id="msg_alert"></div>
        <div>Discount of Price</div>
        <form method="post" action="?m=<?=$m?>&ac=<?=$ac?>&page=<?=$page?>">
        <div class="datatablewrap">
            <table class="datatable">
                    <tr>
                <thead>
                        <td width="100">Customer ID</td>
                        <td>Voucher Name</td>
						<td>Pay</td>
						<td>Time of Purchase</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $rows_num = $hui_num;?>
					<?php if($rows_num == 0 ){?>
                    <tr>
                        <td colspan="4">
                        <div class="nodata">You have not yet posted any vouchers</div>
                        </td>
                    </tr>
					<?php } else {
					$i = 1;
					foreach($hui_list as $d){
					?>
                	<tr >
                        <td>
                        <?=$d[userid]?>
                        </td>
                        <td width="240">
                       <a href="../goods.php?id=<?=$d[goodsid]?>" target="_blank"><?=$d[oname]?></a>
                        </td>
                        <td>
                       <?=$d[realamount]?>
                        </td>
						<td>
                       <?=get_format_time($d[dateline])?>
                        </td>
                    </tr>
					<?php 
						$i++;
						}
						unset($i);
					}
					?>
                </tbody>
            </table>
            <div class="clearfix datacontrol">
                <div class="pagination"><?php echo page2(); ?></div>
            </div>
        </div>
		</form>
        <div>Less for More
            <a <? if($fi == 2){ ?>style="color: red;" <? } ?> href="<?php echo $mymps_global[SiteUrl]?>/member/index.php?m=orderrecords&type=corp">All</a> |
            <a <? if($fi == 0){ ?>style="color: red;" <? } ?> href="<?php echo $mymps_global[SiteUrl]?>/member/index.php?m=orderrecords&type=corp&fi=0">Not Used</a> |
            <a <? if($fi == 1){ ?>style="color: red;" <? } ?> href="<?php echo $mymps_global[SiteUrl]?>/member/index.php?m=orderrecords&type=corp&fi=1">Used</a>
        </div>
        <form method="post" action="?m=<?=$m?>&ac=<?=$ac?>&page=<?=$page?>">
            <div class="datatablewrap">
                <table class="datatable">
                    <thead>
                    <tr>
                        <td width="100">Customer ID</td>
                        <td>Identify code</td>
                        <td>Voucher Name</td>
                        <td>Amount</td>
                        <td>Total Pay</td>
                        <td>Time of Purchase</td>
                        <td>Time of Use</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rows_num = $tuan_num;?>
                    <?php if($rows_num == 0 ){?>
                        <tr>
                            <td colspan="8">
                                <div class="nodata">You have not yet posted any vouchers</div>
                            </td>
                        </tr>
                    <?php } else {
                        $i = 1;
                        foreach($tuan_list as $d){
                            ?>
                            <tr >
                                <td>
                                    <?=$d[userid]?>
                                </td>
                                <td width="100">
                                    <?=$d[msg]?>
                                </td>
                                <td>
                                    <a href="../goods.php?id=<?=$d[goodsid]?>" target="_blank"><?=$d[oname]?></a>
                                </td>
                                <td>
                                    <?=$d[ordernum]?>
                                </td>
                                <td>
                                    <?=$d[realamount]?>
                                </td>
                                <td>
                                    <?=get_format_time($d[dateline])?>
                                </td>
                                <td>
                                    <?if(!$d['useddate']) { echo "Not Used";} else { echo get_format_time($d['useddate']);}?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        unset($i);
                    }
                    ?>
                    </tbody>
                </table>
                <div class="clearfix datacontrol">
                    <div class="pagination"><?php echo page2(); ?></div>
                </div>
            </div>
        </form>
    </div>
    <div class="pfoot"><p><b>-</b></p></div>
</div>
                    </div>
                </div>
            </div>
        </div>
            <?php include mymps_tpl('inc_sidebar'); ?>
        </div>
    </div>
	<?php include mymps_tpl('inc_foot'); ?>
    
</div>
</body>
</html>