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
        <p class="pextra addwebsite"><a href="?m=goods&ac=detail&type=corp"><span>Post Voucher</span></a></p>
    </div></div></div>
    <div class="pbody">

        <div class="cleafix pagetab-wrap">
            <ul class="pagetab">
                <li><a href="?m=goods&ac=list&type=corp" <?php if($ac == 'list') echo 'class="current"'; ?>><span>Posted Voucher</span></a></li>
                <li><a href="?m=goods&ac=order&type=corp" <?php if($ac == 'order') echo 'class="current"'; ?>><span>Order Management</span></a></li>
            </ul>
        </div>
		<div id="msg_success"></div>
<div id="msg_error"></div>
<div id="msg_alert"></div>
        <form method="post" action="?m=<?=$m?>&ac=<?=$ac?>&page=<?=$page?>">
        <div class="datatablewrap">
            <table class="datatable">
                <thead>
                    <tr>
                        <td>
                            <input class="checkall" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" disabled="disabled"/>
                        </td>
                        <td width="100">Contact</td>
                        <td>Voucher Name</td>
                        <td>Quantity</td>
                        <td>Time of Order</td>
			            <td>IP</td>
                        <td>Operation</td>
                    </tr>
                </thead>
                <tbody>
                <?php if($rows_num == 0 ){?>
                    <tr>
                        <td height="17" colspan="8">
                        <div class="nodata">There are no order records yet</div>
                        </td>
                    </tr>
                <?php } else {
                $i = 1;
                foreach($order as $d){
                ?>
                	<tr <?php if($i%2 == 0) echo 'class="row-even"'?>>
                        <td><input class="checkbox" type='checkbox' name='selectedids[]' value='<?=$d[id]?>' id="<?=$d[id]?>'" disabled="disabled"></td>
                        <td>
                        <?php echo $d['oname']; ?>
                        </td>
                        <td width="200">
                        <a href="../goods.php?id=<?=$d[goodsid]?>" target="_blank"><?=$d['goodsname']?></a>
                        </td>
                        <td>
                        <?=$d['ordernum']?>
                        </td>
                        <td>
                        <?=GetTime($d['dateline'])?>
                        </td>
                        <td>
                        <?=$d['ip']?>
                        </td>
                        <td>
                        <a href="?type=corp&m=goods&ac=order&id=<?=$d['id']?>">Details</a>
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
                <div class="dataaction">
                    <span class="minbtn-wrap"><span class="btn"><input disabled="disabled" type="submit" value="Delete" class="button" name="goods_order_submit" onClick="if(!confirm('Are you sure you want to delete these order records? This cannot be reverted!'))return false;"/></span></span> 
                </div>
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