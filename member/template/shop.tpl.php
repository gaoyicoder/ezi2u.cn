<?php include mymps_tpl('inc_header'); ?>
<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />
<script language="javascript" src="template/javascript.js"></script>
<script type="text/javascript" src="../template/global/messagebox.js"></script>
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
                                    <h3 class="ptitle"><span>Shop Info <a target="_blank" style="font-size:12px; font-weight:100;" href="<?php echo Rewrite('store',array('uid'=>$uid));?>">View My Shop</a></span></h3>
                                </div></div></div>
                                <div class="pbody">
                                    <div class="cleafix pagetab-wrap">
                                        <ul class="pagetab">
                                            <li><a href="?m=shop&ac=base&type=corp" <?php if($ac == 'base'){?>class="current"<?php }?>><span><?php echo $if_corp != 1 ? 'Apply for an Online Shop' : 'Edit Basic Information'; ?></span></a></li>
											<?php if($if_corp == 1){?>
                                            <li><a href="?m=shop&ac=template&type=corp" <?php if($ac == 'contact'){?>class="current"<?php }?>><span>Edit Shop Template</span></a></li>
											<?php }?>
                                        </ul>
                                    </div>
									
									<div id="msg_success"></div>
									<div id="msg_error"></div>
									<div id="msg_alert"></div>
									
                                    <div style="display:none;">
                                        <iframe width=0 height=0 src='' id="iframe_area" name="iframe_area"></iframe> 
                                        <iframe width=0 height=0 src='' id="iframe_street" name="iframe_street"></iframe> 
                                        <form method="post" target="iframe_area" id="form_area"></form>
                                    </div>
                                    <form action="?m=shop" method="post" name="form1">
                                    <div class="formgroup">
                                        <div class="formrow">
                                            <h3 class="label"><label>Seller Name</label></h3>
                                            <div class="form-enter">
                                                <input type="text" name="tname" class="text" value="<?php echo $row['tname']; ?>"/>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="formrow">
                                            <h3 class="label">From Category</h3>
                                            <div class="form-enter">
                                               <?=$get_member_cat?>
                                            </div>
                                        </div>
                                       
                                        <div class="formrow">
                                            <h3 class="label">From District </h3>
                                            <div class="form-enter">
												<script type="text/javascript">
												document.domain = '<?php echo str_replace("http://www.","",$mymps_global[SiteUrl]); ?>';
												</script>
												<?php echo select_where_option('/include/selectwhere.php',$row['cityid'],$row['areaid'],$row['streetid']); ?>
											</div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Landline Number</h3>
                                            <div class="form-enter">     
												<input type="text" class="text" name="tel" value="<?php echo $row['tel']?>" /></div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Detailed Address</h3>
                                            <div class="form-enter">     
												<input type="text" class="text" name="address" value="<?php echo $row['address']?>" /></div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Bus Route</h3>
                                            <div class="form-enter">     
											<textarea name="busway" style="width:300px; height:100px"><?php echo $row['busway']; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Coordinates</h3>
                                            <div class="form-enter">     
											<input id='mappoint' name='mappoint' type='text' value="<?=$row['mappoint']?>" class="text"> <input type="button" class="gray mini" value="I Want to Mark" onClick="setbg('Mark on the Map',500,360,'../map.php?action=markpoint&width=500&height=260&p=<?=$mappoint?>&cityname=<?=$row[citypy]?>')"/>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                        <h3 class="label">Seller Intro</h3>
                                        <?php echo $acontent; ?>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Website URL</h3>
                                            <div class="form-enter">     
												<input type="text" class="text" name="web" value="<?php echo $row['web']?>" /></div>
                                        </div>

                                        <div class="formrow formrow-action">
                                            <span class="minbtn-wrap"><span class="btn"><input type="submit" value="I Want to Submit<?php echo $if_corp == 1 ? 'Save' : 'Apply'; ?>" class="button" name="shop_submit" /></span></span>
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