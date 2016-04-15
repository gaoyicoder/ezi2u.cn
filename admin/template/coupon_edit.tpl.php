<?php mymps_admin_tpl_global_head();?>
<script language="javascript" src="js/vbm.js"></script>
<script language="javascript">
function check_sub(){
	if (document.form1.title.value=="") {
		alert('Please enter coupon name');
		document.form1.title.focus();
		return false;
	}
	if (document.form1.userid.value=="") {
		alert('Please enter member account name of the issuer (seller)');
		document.form1.userid.focus();
		return false;
	}
	if (document.form1.des.value=="") {
		alert('Please enter a brief introduction to the coupon!');
		document.form1.des.focus();
		return false;
	}
	return true;
}
</script>
<style>
.vbm tr{ background:#ffffff}
.altbg1{ background-color:#f1f5f8}
</style>
<form action="?part=edit&id=<?=$id?>" method="post" enctype="multipart/form-data" name="form1" onSubmit="return check_sub();">
<input name="pre_picture" value="<?=$edit['pre_picture']?>" type="hidden">
<input name="picture" value="<?=$edit['picture']?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
	<td colspan="2">General  Information</td>
</tr>
<tr>
    <td class="altbg1">Coupon Name:<font color="red">*</font></td>
    <td>
        <input type="text" name="title" value="<?=$edit['title']?>" class="text" />
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">Issuer:<font color="red">*</font></td>
    <td width="75%">
        <input type="text" name="userid" id="userid" value="<?=$edit['userid']?>" class="text" style="background-color:#eee"/> <font color=red>Please don't make any changes to it unless necessary.</font>
    </td>
</tr>
<tr>
    <td class="altbg1">Coupon Category:<font color="red">*</font></td>
    <td>
        <?php echo get_couponclass_select('cate_id',$edit['cate_id']); ?>
    </td>
</tr>
<tr>
    <td class="altbg1">Valid in:<font color="red">*</font></td>
    <td>
        <?php echo select_where('area','areaid',$edit['areaid'],$edit['cityid']); ?>
    </td>
</tr>
<tr>
    <td class="altbg1">Valid Period:</td>
    <td><input type="text" id="datepicker1" readonly="readonly" name="begindate" value="<?=$begindate?>" class="text" style="width:150px"/> - <input type="text" name="enddate" value="<?=$enddate?>" id="datepicker2" readonly="readonly" class="text" style="width:150px" />&nbsp;</td>
</tr>
<tr>
    <td class="altbg1">Coupon Description:<font color="red">*</font></td>
    <td><textarea name="des" style="height:60px; width:500px;"><?=de_textarea_post_change($edit['des'])?></textarea></td>
</tr>
<tr>
    <td class="altbg1">Coupon Type:</td>
    <td>
         <label for="1"><input name="ctype" type="radio" id="1" onclick='$("sup").style.display = "";' class="radio" <?php if($edit['ctype'] == 'Discount Coupon' || empty($edit['ctype'])) echo 'checked'; ?>>Discount Coupon</label> <label for="2"><input name="ctype" class="radio" onclick='$("sup").style.display = "none";' value="2" id="2" type="radio" <?php if($edit['ctype'] == 'Price Deducting Coupon') echo 'checked'; ?>>Price Deducting Coupon</label>
    </td>
</tr>
<tr id="sup" <?php if($edit['sup'] == 'Price Deducting Coupon') echo 'style="display:none"'?>>
	<td class="altbg1">Discount</td>
    <td><input name="sup" class="txt" value="<?=$edit['sup']?>"> Per Cent Off</td>
</tr>
<tr>
    <td class="altbg1">Validity:</td>
    <td>
        <input type="radio" name="status" value="1" id="radio_status_1"  checked="checked" class="radio"/><label for="radio_status_1">Valid</label>&nbsp;<input type="radio" name="status" value="2" id="radio_status_2" class="radio"/><label for="radio_status_2">Invalid</label>                </td>
</tr>
<tr>
	<td class="altbg1">Status</td>
    <td>
    <select name="grade">
    Under Revision	<option value="0" <?php if($edit['grade'] == 0) echo 'selected style=\'background-color:#6eb00c; color:white!important;\''; ?>>Under Revision</option>
        <option value="1" <?php if($edit['grade'] == 1) echo 'selected style=\'background-color:#6eb00c; color:white!important;\''; ?>>Normal </option>
        <option value="2" <?php if($edit['grade'] == 2) echo 'selected style=\'background-color:#6eb00c; color:white!important;\''; ?>>Recommended</option>
    </select>
    </td>
</tr>
<tr class="firstr">
	<td colspan="2">Image for Previewing</td>
</tr>
<tr>
    <td class="altbg1">Coupon Image:</td>
    <td> 
    <?php
    echo "<img src=".$mymps_global[SiteUrl]."".$edit[pre_picture]." style='_margin-top:expression(( 180 - this.height ) / 2);' />\r\n";
    ?>
    </td>
</tr>
<tr>
    <td class="altbg1">Update Image:</td>
    <td> 
    <input type="file" name="coupon_image" size="30" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);">
    </td>
</tr>
<tr>
    <td class="altbg1">Preview:</td>
    <td> 
    <img src="template/images/mpview.gif" width="150" id="picview" name="picview" />
    </td>
</tr>
</table>
<div style="margin-top:3px;">
<?php echo $acontent; ?>
</div>
</div>
<center><input type="submit" name="coupon_submit" value="Submit" class="mymps large" /></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
