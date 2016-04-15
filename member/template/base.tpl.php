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
                                    <h3 class="ptitle"><span>Contact Details</span></h3>
                                </div></div></div>
                                <div class="pbody">

                                    <div class="formcaption-note">
                                        A detailed contact links you to other users more easily. 
                                    </div>
                                    
									<div id="msg_success"></div>
									<div id="msg_error"></div>
									<div id="msg_alert"></div>
                                    
                                    <form action="?m=base" method="post">
                                    <?php if($error == '41'){?><input name="url" value="../<?=$mymps_global['cfg_postfile']?>" type="hidden"><?}?>
                                    <div class="formgroup">
                                        <div class="formrow">
                                            <h3 class="label"><label>User ID</label></h3>
                                            <div class="form-enter">
                                                <input type="text" class="text" value="<?php echo $s_uid; ?>" disabled="disabled" />
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">User name</h3>
                                            <div class="form-enter">
                                                <input type="text" name="cname" class="text" value="<?php echo $row['cname']; ?>"/>
                                            </div>
                                        </div>
                                        
                                      <!--  <div class="formrow">
                                            <h3 class="label">Gender</h3>
                                            <div class="form-enter">
                                                <label for="gender1"><input type="radio" value="Male" name="sex"  id="gender1" <?php if($row['sex'] == 'Male') echo 'checked'; ?> />Male</label>
                                                <label for="gender2"><input type="radio" value="Female" name="sex"  id="gender2" <?php if($row['sex'] == 'Female') echo 'checked'; ?> />Female</label>
                                            </div>
                                        </div>-->
                                        
                                        <div class="formrow">
                                            <h3 class="label">Mobile</h3>
                                            <div class="form-enter">
                                                
<input type="text" class="text" name="mobile" value="<?php echo $row['mobile']?>" maxlength="" /> <label for="istel"><input type="checkbox" name="istel" value="1" id="istel">Update Phone Number for all Posts</label>
                                            </div>
                                            <div class="form-note"></div>
                                            
                                        </div>
                                        
                                     <!--   <div class="formrow">
                                            <h3 class="label">Facebook </h3>
                                            <div class="form-enter">
                                                <input type="text" class="text" name="qq" value="<?php echo $row['qq']?>" maxlength="" />
                                                <label for="isqq"><input type="checkbox" name="isqq" value="1" id="isqq">Update Facebook Number for all Posts</label></div>
                                            
                                        </div>-->
                                        
                                        <div class="formrow">
                                            <h3 class="label">EMAIL</h3>
                                            <div class="form-enter">     
												<input type="text" class="text" name="email" value="<?php echo $row['email']?>" maxlength="" />
                                                <label for="isemail"><input type="checkbox" name="isemail" value="1" id="isemail">Update Email Address for all Posts</label></div>
                                        </div>

                                        <div class="formrow formrow-action">
                                            <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Submit" class="button" name="base_submit" /></span></span>
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