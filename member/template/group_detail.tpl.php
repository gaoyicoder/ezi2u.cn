<?php include mymps_tpl('inc_header'); ?>
<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />
<script language="javascript" src="template/javascript.js"></script>
<script language="javascript">
function check_sub(){
	if (document.form1.gname.value=="") {
		alert('Please enter the activity title.');
		document.form1.gname.focus();
		return false;
	}
	if (document.form1.gaddress.value=="") {
		alert('Please enter site of activity!');
		document.form1.gaddress.focus();
		return false;
	}
	if (document.form1.meetdate.value=="") {
		alert('Please select starting time!');
		document.form1.meetdate.focus();
		return false;
	}
	if (document.form1.enddate.value=="") {
		alert('Please select ending time!');
		document.form1.enddate.focus();
		return false;
	}
	if (document.form1.des.value=="") {
		alert('Please enter activity brief!');
		document.form1.des.focus();
		return false;
	}
	return true;
}
</script>
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
                                    <h3 class="ptitle"><span><?php echo $id ? 'Edit' : 'Start'?>Group Purchase</span></h3>
                                    <p class="pextra"><a href="?m=group&type=corp"><span>&laquo; Return to my started group purchases</span></a></p>
                                </div></div></div>
                                <div class="pbody">
                                    
                                    <div id="msg_success"></div>
									<div id="msg_error"></div>
									<div id="msg_alert"></div>
                                    <div style="display:none;">
                                        <iframe width=0 height=0 src='' id="iframe_area" name="iframe_area"></iframe> 
                                        <iframe width=0 height=0 src='' id="iframe_street" name="iframe_street"></iframe> 
                                        <form method="post" target="iframe_area" id="form_area"></form>
                                    </div>
                                    <form action="?m=group&ac=detail" enctype="multipart/form-data" method="post" name="form1" onSubmit="return check_sub();">
                                    <?php if(!empty($id)){?>
                                    	<input name="id" value="<?=$id?>" type="hidden">
                                        <input name="picture_old" value="<?=$edit['picture']?>" type="hidden">
                                        <input name="pre_picture_old" value="<?=$edit['pre_picture']?>" type="hidden">
                                    <?php }?>
                                    <input name="tid" value="<?=$tid?>" type="hidden">
                                    <div class="formgroup">
                                        <div class="formrow">
                                            <h3 class="label"><label>Activity Name<font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input name="gname" type="text" class="text" value="<?=$edit['gname']?>" style="width:300px">
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Group Purchase Category<font color="red">*</font></h3>
                                            <div class="form-enter">
                                                <?php echo get_groupclass_select('cate_id',$edit['cate_id']); ?>
                                            </div>
                                        </div>
                                    
                                        <div class="formrow">
                                            <h3 class="label">District<font color="red">*</font></h3>
                                            <div class="form-enter">
											<script type="text/javascript">
												document.domain = '<?php echo str_replace("http://www.","",$mymps_global[SiteUrl]); ?>';
												</script>
												<?php echo select_where_option('/include/selectwhere.php',$row['cityid'],$row['areaid'],$row['streetid']); ?>
                                             <!--   <?php echo select_where('area','areaid',$edit['areaid'],$edit['cityid'] ? $edit['cityid'] : $cityid); ?>-->
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Site<font color="red">*</font></h3>
                                            <div class="form-enter">
                                                <input name="gaddress" value="<?php echo $edit['gaddress']; ?>" class="text" style="width:300px">
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Starting Time<font color="red">*</font></h3>
                                            <div class="form-enter">
                                                <input name="meetdate" value="<?php echo $edit['meetdate']; ?>" class="text"> 
                                                （Format: 2011-08-08）
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Ending Time<font color="red">*</font></h3>
                                            <div class="form-enter">
                                                <input name="enddate" value="<?php echo $edit['enddate']; ?>" class="text"> （Format: 2011-08-08）
                                            </div>
                                        </div>
                                        
                                        <?php if($edit[pre_picture]){?>
                                        <div class="formrow">
                                            <h3 class="label">Original Image</h3>
                                            <div class="form-enter">     
                                                <?php
                                                echo "<img src=".$mymps_global[SiteUrl]."".$edit[pre_picture]." style='_margin-top:expression(( 180 - this.height ) / 2);' />\r\n";
                                                ?>
                                            </div>
          								</div>
                                        <?php }?>
                                        
                                        <div class="formrow">
                                            <h3 class="label"><?php echo $id ? 'Update ' : 'Upload '; ?>Image</h3>
                                            <div class="form-enter">
                                                <input type="file" name="group_image" size="30" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);">
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Preview Here</h3>
                                            <div class="form-enter">     
												<img src="images/mpview.gif" width="150" id="picview" name="picview" />
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Brief Description<font color="red">*</font></h3>
                                            <div class="form-enter">
                                            	<textarea name="des" class="texttarea" style="width:360px; height:100px"><?=$edit['des']?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Detailed Description<font color="red">*</font></h3>
                                           	<?php echo $acontent; ?>
                                        </div>
                                        
                                        <div class="formrow formrow-action">
                                            <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Submit<?php echo empty($id) ? 'Start' : 'Save'; ?>" class="button" name="group_submit" /></span></span>
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