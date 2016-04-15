<?php include mymps_tpl('inc_header'); ?>
<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />
<script language="javascript" src="template/javascript.js"></script>
<script language="javascript">
function check_sub(){
	<?php if(!$id){?>
	if (document.form1.coupon_image.value=="") {
		alert('Please upload an image for your coupon!');
		document.form1.coupon_image.focus();
		return false;
	}
	<?php }?>
	if (document.form1.title.value=="") {
		alert('Please enter coupon name');
		document.form1.title.focus();
		return false;
	}
	if (document.form1.des.value=="") {
		alert('Please enter a brief description!');
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
                                    <h3 class="ptitle"><span><?php echo $id ? 'Change' : 'Issue'?>Coupon</span></h3>
                                    <p class="pextra"><a href="?m=coupon&type=corp"><span>&laquo; Return to Coupon that I Have Issued</span></a></p>
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
                                    <form action="?m=coupon&ac=detail" enctype="multipart/form-data" method="post" name="form1" onSubmit="return check_sub();">
                                    <?php if(!empty($id)){?>
                                    	<input name="id" value="<?=$id?>" type="hidden">
                                        <input name="picture_old" value="<?=$edit['picture']?>" type="hidden">
                                        <input name="pre_picture_old" value="<?=$edit['pre_picture']?>" type="hidden">
                                    <?php }?>
                                    <input name="tid" value="<?=$tid?>" type="hidden">
                                    <div class="formgroup">
                                        <div class="formrow">
                                            <h3 class="label"><label>Coupon Name<font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input name="title" type="text" class="text" value="<?=$edit['title']?>" style="width:300px">
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Coupon Category<font color="red">*</font></h3>
                                            <div class="form-enter">
                                                <?php echo get_couponclass_select('cate_id',$edit['cate_id']); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">From District<font color="red">*</font></h3>
                                            <div class="form-enter">
                                                <?php echo select_where('area','areaid',$edit['areaid'],$edit['cityid'] ? $edit['cityid'] : $cityid); ?>
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
                                            <h3 class="label"><?php echo $id ? 'Update Image' : 'Upload Image<font color=red>*</font>'; ?></h3>
                                            <div class="form-enter">
                                                <input type="file" name="coupon_image" size="30" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);">
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Valid Period</h3>
                                            <div class="form-enter">     
												<img src="images/mpview.gif" width="150" id="picview" name="picview" />
                                            </div>
                                       </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Valid Period</h3>
                                            <input name="begindate" id="begindate" type="text" class="text" value="<?php echo $begindate; ?>" style="width:100px"/> - <input name="enddate" id="begindate" type="text" class="text" value="<?php echo $enddate; ?>" style="width:100px" /> （日期格式如：2011-08-08）
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Brief Description<font color="red">*</font></h3>
                                            <div class="form-enter">
                                            	<textarea name="des" class="texttarea" style="width:360px; height:100px"><?=$edit['des']?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Detailed Description</h3>
                                           	<?php echo $acontent; ?>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Validity</h3>
                                            <div class="form-enter">
                                            	<input type="radio" name="status" value="1" id="radio_status_1"  checked="checked" class="radio"/><label for="radio_status_1">Valid</label>&nbsp;<input type="radio" name="status" value="2" id="radio_status_2" class="radio"/><label for="radio_status_2">Invalid</label>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Coupon Type</h3>
                                            <label for="1"><input name="ctype" type="radio" id="1" onclick='$("sup").style.display = "block";' class="radio" <?php if($edit['ctype'] == 'Discount Coupon' || empty($edit['ctype'])) echo 'checked'; ?>>Discount Coupon</label> <label for="2"><input name="ctype" onclick='$("sup").style.display = "none";' value="2" id="2" type="radio" <?php if($edit['ctype'] == 'Price-deducting Coupon') echo 'checked'; ?>>Price-deducting Coupon</label>
                                        </div>
                                        
                                        
                                         <div class="formrow" id="sup" <?php if($edit['sup'] == 'Price-deducting Coupon') echo 'style="display:none"'?>>
                                            <h3 class="label">Discount</h3>
                                            <input name="sup" type="text" class="text" style="width:60px" value="<?=$edit['sup']?>"> Per Cent Discount
                                        </div>

                                        <div class="formrow formrow-action">
                                            <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Submit<?php echo empty($id) ? 'Upload' : 'Save'; ?>" class="button" name="coupon_submit" /></span></span>
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
