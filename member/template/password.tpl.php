<?php include mymps_tpl('inc_header');?>
<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />
<script language="javascript" src="template/javascript.js"></script>
</head>
<body class="<?php echo $mymps_global['cfg_tpl_dir']; ?>">
<div class="container">

<?php include mymps_tpl('inc_head');?>

    <div id="main" class="main section-setting">
        <div class="clearfix main-inner">
            <div class="content">
                <div class="clearfix content-inner">
                    <div class="content-main">
                        <div class="content-main-inner">
                             <div class="pwrap setting-password">
                                <div class="phead"><div class="phead-inner"><div class="phead-inner">
                                    <h3 class="ptitle"><span>Change Password</span></h3>
                                </div></div></div>
                                <div class="pbody">
                                	<div class="formcaption-note alertmsg">
                                        <font color="#ff3300">After changing password, you will be logged out and need to use the new password to log-in.</font>
                                    </div>
                                    <div id="msg_success"></div>
                                    <div id="msg_error"></div>
                                    <div id="msg_alert"></div>
                                    <form action="?m=password" method="post">
                                    
                                    <div class="formgroup">
                                        
										<div class="formrow">
                                            <h3 class="label"><label for="newpasswd">Current </label></h3>
                                            <div class="form-enter">
                                                <input id="curuserpwd" class="text" name="curuserpwd" type="password" value="" />
                                            </div>
                                        </div>
                                        <div class="formrow">
                                            <h3 class="label"><label for="newpasswd">New </label></h3>
                                            <div class="form-enter">
                                                <input id="userpwd" class="text" name="userpwd" type="password" value="" />
                                            </div>
                                        </div>
                                        <div class="formrow">
                                            <h3 class="label"><label for="newpasswd2">Confirm New </label></h3>
                                            <div class="form-enter">
                                                <input id="reuserpwd" class="text" name="reuserpwd" type="password" value="" />
                                            </div>
                                        </div>
                                        <div class="formrow formrow-action">
                                            <span class="minbtn-wrap"><span class="btn"><input class="button" name="password_submit" type="submit" value="Change Password" /></span></span>
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
            <?php include mymps_tpl('inc_sidebar');?>
        </div>
    </div>
<?php include mymps_tpl('inc_foot');?>
</div>
</body>
</html>