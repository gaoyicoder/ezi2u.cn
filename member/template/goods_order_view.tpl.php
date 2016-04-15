<?php include mymps_tpl('inc_header'); ?>
<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />
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
                            <div class="pwrap setting-userinfo">
                                <div class="phead"><div class="phead-inner"><div class="phead-inner">
                                    <h3 class="ptitle"><span>Order Details</span></h3>
                                </div></div></div>
                                <div class="pbody">
                                    
                                    <div class="formgoods">
                                    
                                        <div class="formrow">
                                            <h3 class="label"><label>Product</label></h3>
                                            <div class="form-enter">
                                                <a href="../goods.php?id=<?=$order['goodsid']?>" target="_blank"><?php echo $order['goodsname']?></a>
                                            </div>
                                        </div>
                                    
                                        <div class="formrow">
                                            <h3 class="label"><label>Contact</label></h3>
                                            <div class="form-enter">
                                                <?php echo $order['oname']?>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Quantity</h3>
                                            <div class="form-enter">
                                                <?php echo $order['ordernum']?>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="formrow">
                                            <h3 class="label">Mobile</h3>
                                        	<div class="form-enter">
                                                <?php echo $order['mobile']?>
                                            </div>
                                        </div>
										
                                        <div class="formrow">
                                            <h3 class="label">ID Code</h3>
                                        	<div class="form-enter">
                                                <?php echo $order['address']?>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Time</h3>
                                        	<div class="form-enter">
                                                <?php echo GetTime($order['dateline'])?>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">FromIP </h3>
                                        	<div class="form-enter">
                                                <?php echo $order['ip']?>
                                            </div>
                                        </div>
										
                                        <div class="formrow">
                                            <h3 class="label">Remark</h3>
                                            <div class="form-enter">
                                                <?php echo $order['msg']?>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow formrow-action">
                                            <span class="minbtn-wrap"><span class="btn"><input type="button" value="Return" class="button" onClick="history.back();" /></span></span>
                                        </div>

                                    </div>
                                    
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