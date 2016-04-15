<?php mymps_admin_tpl_global_head();?>
<script language="javascript" src="js/vbm.js"></script>
<script language="javascript">
function check_sub(){
	if (document.form1.goodsname.value=="") {
		alert('Please enter product name');
		document.form1.goodsname.focus();
		return false;
	}
	if (document.form1.userid.value=="") {
		alert('Please enter the member ID of the poster of the product.');
		document.form1.userid.focus();
		return false;
	}
	if (document.form1.content.value=="") {
		alert('Please enter detailed description of the product!');
		document.form1.content.focus();
		return false;
	}
	return true;
}
</script>
<style>
.vbm tr{ background:#ffffff}
.altbg1{ background-color:#f1f5f8}
</style>
<form name="form1" action="?part=edit&id=<?=$id?>" method="post" enctype="multipart/form-data" onSubmit="return check_sub();">
<input name="pre_picture" value="<?=$edit['pre_picture']?>" type="hidden">
<input name="picture" value="<?=$edit['picture']?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
	<td colspan="2">Basic Information</td>
</tr>
<tr>
    <td class="altbg1">From Sub-Site:<font color="red">*</font></td>
    <td>
        <select name="cityid">
	<option value="">>Master Site</option>
	<?php echo get_cityoptions($edit['cityid']); ?>
	</select>
    </td>
</tr>
<tr>
    <td class="altbg1">Product Name:<font color="red">*</font></td>
    <td>
        <input type="text" name="goodsname" value="<?=$edit['goodsname']?>" class="text" />
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">Product Provider Account ID:<font color="red">*</font></td>
    <td width="75%">
        <input type="text" name="userid" id="userid" value="<?=$edit['userid']?>" class="text" style="background-color:#eee"/> <font color=red>Please make no changes unless necessary.</font>
    </td>
</tr>
<tr>
    <td class="altbg1">Cost:</td>
    <td>
	<input name="oldprice" value="<?=$edit['oldprice']?>" type="text" class="text" style="width:50px"/> <?php echo $moneytype; ?>
    </td>
</tr>
<tr>
    <td class="altbg1">Pay:</td>
    <td>
	<input name="nowprice" value="<?=$edit['nowprice']?>" type="text" class="text" style="width:50px"/> <?php echo $moneytype; ?>
    </td>
</tr>
<tr>
    <td class="altbg1">Product Category:<font color="red">*</font></td>
    <td>
        <select name="catid">
	<option value="">==Select Category for Product==</option>
	<?=goods_cat_list(0,$edit['catid'])?>
	</select>
    </td>
</tr>
<tr class="firstr">
	<td colspan="2">Preview Image</td>
</tr>
<tr>
    <td class="altbg1">Product Image:</td>
    <td> 
    <?php
    echo "<img src=".$mymps_global[SiteUrl]."".$edit[pre_picture]." style='_margin-top:expression(( 180 - this.height ) / 2);' />\r\n";
    ?>
    </td>
</tr>
<tr>
    <td class="altbg1">Update Image:</td>
    <td> 
    <input type="file" name="goods_image" size="30" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);">
    </td>
</tr>
<tr>
    <td class="altbg1">Preview:</td>
    <td> 
    <img src="template/images/mpview.gif" width="150" id="picview" name="picview" />
    </td>
</tr>
<tr class="firstr">
	<td colspan="2">More Information</td>
</tr>
<tr>
    <td class="altbg1">Gift:</td>
    <td>
	<input name="gift" value="<?php if($edit['gift'] == ''){echo 'This voucher does not come with any gifts.';}else{echo $edit['gift'];}?>" class="text">
    </td>
</tr>
<tr>
    <td class="altbg1">Available:</td>
    <td>
	<input name="huoyuan" type="radio" class="radio" value="1" <?php if($edit['huoyuan'] == 1 || !$id) echo 'checked';?>>Yes  
	<input name="huoyuan" type="radio" class="radio" value="2" <?php if($edit['huoyuan'] != 1) echo 'checked';?>>No
    </td>
</tr>
<tr>
    <td class="altbg1">Product Properties:</td>
    <td>
		<input name="rushi" type="checkbox" class="radio" value="1" <?php if($edit['rushi'] == 1 || !$id) echo 'checked';?>>Realistic description
		<input name="tuihuan" type="checkbox" class="radio" value="1" <?php if($edit['tuihuan'] == 1 || !$id) echo 'checked';?>>Return in 7 days
		<input name="jiayi" type="checkbox" class="radio" value="1" <?php if($edit['jiayi'] == 1 || !$id) echo 'checked';?>>Fake one compensate three
		<input name="weixiu" type="checkbox" class="radio" value="1" <?php if($edit['weixiu'] == 1) echo 'checked';?>>Repair in 30 days
		<input name="fahuo" type="checkbox" class="radio" value="1" <?php if($edit['fahuo'] == 1 || !$id) echo 'checked';?>>Quick delivery
		<input name="zhengpin" type="checkbox" class="radio" value="1" <?php if($edit['zhengpin'] == 1 || !$id) echo 'checked';?>>Quality product guarantee
    </td>
</tr>
<tr>
    <td class="altbg1">Product Status:</td>
    <td>
		<input name="onsale" type="checkbox" class="radio" value="1" <?php if($edit['onsale'] == 1) echo 'checked';?>>On Shelf
		<input name="tuijian" type="checkbox" class="radio" value="1" <?php if($edit['tuijian'] == 1) echo 'checked';?>>Recommended
		<input name="remai" type="checkbox" class="radio" value="1" <?php if($edit['remai'] == 1) echo 'checked';?>>Hot
		<input name="cuxiao" type="checkbox" class="radio" value="1" <?php if($edit['cuxiao'] == 1) echo 'checked';?>>In Promotion
		<input name="baozhang" type="checkbox" class="radio" value="1" <?php if($edit['baozhang'] == 1 || !$id) echo 'checked';?>>Join consumer protection plan
    </td>
</tr>
</table>
<div style="margin-top:3px;"><?php echo $acontent; ?></div>
</div>
<div style="padding-left:18%; padding-top:10px; padding-bottom:10px;">
<input type="submit" name="goods_submit" value="Submit" class="mymps large" style="margin-right:15px"/>
<input type="button" onclick="history.back();" value="Return" class="mymps large" />
</div>
</form>
<?php mymps_admin_tpl_global_foot();?>
