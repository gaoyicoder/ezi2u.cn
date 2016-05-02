<?php include mymps_tpl('inc_header'); ?>
<link rel="Stylesheet" type="text/css" href="template/css/new.dialog.css" />
<link rel="stylesheet" type="text/css" href="template/css/new.my.css" />
<script language="javascript" src="template/javascript.js"></script>
<script language="javascript" src="template/jquery.172.min.js"></script>
<script language="javascript">
jQuery.noConflict();
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

function fast_add(category_selected)
{
    var catergory_list= new Array();
    <?php
    foreach($cats as $cat) {
        $description = json_decode($cat['description'], true);
    ?>
    var category = new Array();
    category['catname'] = <?="'".$cat['catname']."'" ?>;
    category['cost'] = <?="'".$description['cost']."'" ?>;
    category['pay'] = <?="'".$description['pay']."'" ?>;
    category['discount'] = <?="'".$description['discount']."'" ?>;
    category['greaterthan'] = <?="'".$description['greaterthan']."'" ?>;
    catergory_list[<?=$cat['catid'] ?>] =  category;
    <?php } ?>
    jQuery("input[name='goodsname']").val(catergory_list[category_selected.value]['catname']);
    if(jQuery('input:radio[name="type"]:checked').val() == 0) {
        jQuery("input[name='oldprice']").val(catergory_list[category_selected.value]['greaterthan']);
        jQuery("input[name='nowprice']").val(catergory_list[category_selected.value]['discount']);
    } else {
        jQuery("input[name='oldprice']").val(catergory_list[category_selected.value]['cost']);
        jQuery("input[name='nowprice']").val(catergory_list[category_selected.value]['pay']);
    }
}

function change_type(type_id)
{
    jQuery("option[templabel='type']:not(.type_"+type_id+")").hide();
    jQuery("option[templabel='type']:.type_"+type_id).show();
    jQuery("select[name='catid']").val("");
    jQuery("input[name='goodsname']").val("");
    jQuery("input[name='oldprice']").val("");
    jQuery("input[name='nowprice']").val("");
    if(type_id == 0) {
        jQuery("#oldprice_libel").html('折扣条件<font color="red">*</font>');
        jQuery("#nowprice_libel").html('Discount<font color="red">*</font>');
        jQuery("#nowprice_libel_moneytype").html('% (0 ~ 100)');
    } else {
        jQuery("#oldprice_libel").html('Cost<font color="red">*</font>');
        jQuery("#nowprice_libel").html('Pay<font color="red">*</font>');
        jQuery("#nowprice_libel_moneytype").html('<?php echo $moneytype; ?>');

    }
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
                                            <h3 class="label"><label>Type<font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <? if($edit['type'] == "") {
                                                    $edit['type'] = 0;
                                                }
                                                ?>
                                                <? foreach($mymps_mymps['cfg_voucher_types'] as $key => $value) {?>
                                                    <input <?=$key==$edit[type] ? "checked" : "" ?> id="type" type="radio" name="type" value="<?=$key ?>" onclick="change_type(<?=$key ?>)" /> <?=$value ?> &nbsp;&nbsp;
                                                <? } ?>
                                            </div>
                                        </div>

                                        <div class="formrow">
                                            <h3 class="label">快速添加<font color="red">*</font></h3>
                                            <div class="form-enter">
                                                <select name="catid" onchange="fast_add(this)">
                                                    <option value="">select</option>
                                                    <?=goods_cat_dropdown($edit['type'], $edit['catid'])?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="formrow">
                                            <h3 class="label"><label>Name<font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input readonly name="goodsname" type="text" class="text" value="<?=$edit['goodsname']?>" style="width:300px">
                                            </div>
                                        </div>
										<div style="display:none;" class="formrow">
                                            <h3 class="label"><label>District<font color="red">*</font></label></h3>
                                            <div class="form-enter">
												<select name="cityid">
												<?php echo get_cityoptions($edit['cityid']?$edit['cityid']:$cityid); ?>
												</select>
                                            </div>
                                        </div>
										<div class="formrow">
                                            <h3 class="label"><label id="oldprice_libel"><? if($edit['type']==0) echo '折扣条件'; else echo 'Cost' ?><font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input readonly name="oldprice" type="text" class="text" value="<?=$edit['oldprice']?>" style="width:70px">
                                                <label id="oldprice_libel_moneytype"><?php echo $moneytype; ?></label>
                                            </div>
                                        </div>
										
										<div class="formrow">
                                            <h3 class="label"><label id="nowprice_libel"><? if($edit['type']==0) echo 'Discount'; else echo 'Pay' ?><font color="red">*</font></label></h3>
                                            <div class="form-enter">
                                                <input readonly name="nowprice" type="text" class="text" value="<?=$edit['nowprice']?>" style="width:70px">
                                                <label id="nowprice_libel_moneytype"><? if($edit['type']==0) echo '% (0 ~ 100)'; else echo $moneytype ?></label>
                                            </div>
                                        </div>
										
										<div class="formrow">
                                            <h3 class="label"><label>Available<font color="red">*</font></label></h3>
                                            <div class="form-enter">
											<input name="huoyuan" type="radio" class="radio" value="2" <?php if($edit['huoyuan'] != 1) echo 'checked';?>>No
                                            <input name="huoyuan" type="radio" class="radio" value="1" <?php if($edit['huoyuan'] == 1 || empty($edit)) echo 'checked';?>>Yes
												
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