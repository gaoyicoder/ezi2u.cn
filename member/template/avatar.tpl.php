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
                                    <h3 class="ptitle"><span><?php echo $if_corp == 1 ? 'Shop LOGO' : 'Avatar'; ?>Update</span></h3>
                                </div></div></div>
                                <div class="pbody">
                                    
									<div id="msg_success"></div>
									<div id="msg_error"></div>
									<div id="msg_alert"></div>
                                    
                                    <form method="post" name="form1" action="?m=avatar" enctype="multipart/form-data" onSubmit="return AvatarSubmit();">
                                    <div class="formgroup section-setting">
                               	    <?php if($face != ''){?>
                                        <div class="formrow">
                                            <h3 class="label">
                                              <label>Original<?php echo $if_corp == 1 ? 'Shop LOGO' : 'Avatar'; ?>��</label>
                                            </h3>
                                            <div class="form-enter">
                                                <?php echo "<img src='$mymps_global[SiteUrl].$face' border='0'/>\r\n"; ?>
                                            </div>
                                        </div>
                                        <?php }?>
                                <div class="formrow">
                                            <h3 class="label">Select File: </h3>
                                            <div class="form-enter">
                                               <input type=file name="mymps_member_logo" size=45 id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"><br />
          Supported Format of Image: <?=$mymps_global[cfg_upimg_type]?>, Image Size: <?=$mymps_mymps[cfg_memberlogo_limit][width]?> * <?=$mymps_mymps[cfg_memberlogo_limit][height]?>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">预览区：</h3>
                                            <div class="form-enter">
                                             <img src="images/mpview.gif" width="150" id="picview" name="picview" />
                                            </div>
                                        </div>

                                        <div class="formrow formrow-action"><span class="minbtn-wrap"><span class="btn">
                                          <input type="submit" value="Update" class="button" name="avatar_submit" />
                                        </span></span></div>
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
