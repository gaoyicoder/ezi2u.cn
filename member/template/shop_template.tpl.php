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
                                    <h3 class="ptitle"><span>Shop Info</span></h3>
                                </div></div></div>
                                <div class="pbody">
                                    <div class="cleafix pagetab-wrap">
                                        <ul class="pagetab">
                                            <li><a href="?m=shop&ac=base&type=corp" <?php if($ac == 'base'){?>class="current"<?php }?>><span><?php echo $if_corp != 1 ? 'Apply for an Online Shop' : 'Edit Basic Information'; ?></span></a></li>
                                            <li><a href="?m=shop&ac=templat&type=corpe" <?php if($ac == 'template'){?>class="current"<?php }?>><span>Edit Shop Template</span></a></li>
                                        </ul>
                                    </div>
									
									<div id="msg_success"></div>
									<div id="msg_error"></div>
									<div id="msg_alert"></div>
                                    
                                    <form action="?m=shop" method="post" name="form1" enctype="multipart/form-data" >
									<input name="ac" value="template" type="hidden">
									<input name="oldbanner" value="<?=$row[banner]?>" type="hidden">
                                    <div class="formgroup">
                                        
                                        <div class="formrow">
                                            <h3 class="label">Style of Your Space</h3>
                                            <div class="form-enter">     
                                            <select name="template">
                                            <?=get_shop_tpl($row['template'],$s_uid);?>
                                            </select>
                                            </div>
                                        </div>
										
										<div class="formrow">
										<h3 class="label">Background of the Top</h3>
										<div class="form-enter">
											 <?php if($row['banner'] != ''){?><img src="<?=$row[banner]?>" onload="if(this.width > 728) this.width = 728"><br><font style="color:#666">After you have changed the background image, please <a href="javascript:window.location.reload();">refresh</a> your browser.</font><br>
<?php }else{?>Change<?php }?> 
										</div>
										</div>
										
										<div class="formrow">
										<h3 class="label"><?php echo $row[banner] ? 'Change' : 'Upload'; ?>Background</h3>
										<div class="form-enter">
											 <input name="banner" type="file" style="width:250px;"/> 
											 Image Size<?php echo $mymps_mymps['cfg_banner_limit']['width'];?>¡Á<?php echo $mymps_mymps['cfg_banner_limit']['height'];?><br />
										Supported Formats of Uploaded Image<?=$mymps_global[cfg_upimg_type]?>
										</div>
										</div>
										
										<div class="formrow">
										<h3 class="label">Note</h3>
										<div class="form-enter">
										 Please keep the image clear.  The format of the Image should be <?=$mymps_global['cfg_upimg_type']?> , and its size should not be more than <?=$mymps_global[cfg_upimg_size]?>KB ¡£<br />
										If the uploading is stuck for too long, please either cancel and try again or downsize the image and retry.
										</div>
										</div>

                                        <div class="formrow formrow-action">
                                            <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Submit" class="button" name="shop_submit" /></span></span>
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