<?php include mymps_tpl('inc_header'); ?>
<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />
<script language="javascript" src="template/javascript.js"></script>
<script language="javascript">
function check_sub(){
	if (document.form1.goodsname.value=="") {
		alert('Please enter product name');
		document.form1.goodsname.focus();
		return false;
	}
	if (document.form1.catid.value=="") {
		alert('Please select category for your product');
		document.form1.catid.focus();
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
                                    <h3 class="ptitle"><span><?php echo $id ? 'Edit' : 'Post'?>Voucher</span></h3>
                                    <p class="pextra"><a href="?m=goods&type=corp"><span>&laquo; Return to My Posted Voucher</span></a></p>
                                </div></div></div>
                                <div class="pbody">
                                    
                                    <div id="msg_success"></div>
<div id="msg_error"></div>
<div id="msg_alert"></div>
                                    
                                    <form action="?m=goods&ac=detail" enctype="multipart/form-data" method="post" name="form1" onSubmit="return check_sub();">
                                    <?php if(!empty($id)){?>
                                    	<input name="id" value="<?=$id?>" type="hidden">
                                        <input name="picture_old" value="<?=$edit['picture']?>" type="hidden">
                                        <input name="pre_picture_old" value="<?=$edit['pre_picture']?>" type="hidden">
                                    <?php }?>
                                    <div class="formgoods">
                                        <div class="formrow">
                                            <h3 class="label"><label>Name<font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input name="goodsname" type="text" class="text" value="<?=$edit['goodsname']?>" style="width:300px">
                                            </div>
                                        </div>
										
										<div class="formrow">
                                            <h3 class="label"><label>District<font color="red">*</font></label></h3>
                                            <div class="form-enter">
												<select name="cityid">
												<?php echo get_cityoptions($edit['cityid']?$edit['cityid']:$cityid); ?>
												</select>
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Category<font color="red">*</font></h3>
                                            <div class="form-enter">
												<select name="catid">
												<option value="">select</option>
												<?=goods_cat_list(0,$edit[catid])?>
												</select>
                                            </div>
                                        </div>
			
										<div class="formrow">
                                            <h3 class="label"><label>Cost<font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input name="oldprice" type="text" class="text" value="<?=$edit['oldprice']?>" style="width:70px">
												<?php echo $moneytype; ?>
                                            </div>
                                        </div>
										
										<div class="formrow">
                                            <h3 class="label"><label>Pay<font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input name="nowprice" type="text" class="text" value="<?=$edit['nowprice']?>" style="width:70px"> 
												<?php echo $moneytype; ?>
                                            </div>
                                        </div>
										
										<div class="formrow">
                                            <h3 class="label"><label>Available<font color="red">*</font></label></h3>
                                            <div class="form-enter">
											<input name="huoyuan" type="radio" class="radio" value="2" <?php if($edit['huoyuan'] != 1) echo 'checked';?>>Yes
                                            <input name="huoyuan" type="radio" class="radio" value="1" <?php if($edit['huoyuan'] == 1 || empty($edit)) echo 'checked';?>>No
												
                                            </div>
                                        </div>
										
			
										
									
										<div class="formrow">
                                            <h3 class="label"><label>Gifts<font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input name="gift" type="text" class="text" value="<?php echo $edit['gift'] ? $edit['gift'] : 'This voucher does not come with any gifts'?>" style="width:300px">
                                            </div>
                                        </div>
										
                                        
                                        <div class="formrow">
                                            <h3 class="label">Description<font color="red">*</font></h3>
                                           	<?php echo $acontent; ?>
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
                                            <h3 class="label"><?php echo $id ? 'Update' : 'Upload'; ?>Image</h3>
                                            <div class="form-enter">
                                                <input type="file" name="goods_image" size="30" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);"> To keep the foreground well ordered, we recommend that you use images with length-width ratio to be 1 : 1.2 .
                                            </div>
                                        </div>
                                        
                                        <div class="formrow">
                                            <h3 class="label">Preview</h3>
                                            <div class="form-enter">     
												<img src="images/mpview.gif" width="150" id="picview" name="picview" />
                                            </div>
                                        </div>
                                        
                                        <div class="formrow formrow-action">
                                            <span class="minbtn-wrap"><span class="btn"><input type="submit" value="Submit<?php echo empty($id) ? 'Post' : 'Save'; ?>" class="button" name="goods_submit" /></span></span>
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