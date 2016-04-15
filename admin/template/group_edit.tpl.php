<?php mymps_admin_tpl_global_head();?>
<script language="javascript" src="js/calendar.js"></script>
<script language="javascript" src="js/vbm.js"></script>
<script language="javascript">
function check_sub(){
	if (document.form1.gname.value=="") {
		alert('Please enter the activity title.');
		document.form1.gname.focus();
		return false;
	}
	if (document.form1.userid.value=="") {
		alert('Please enter the seller member ID of the starter of the Activity.');
		document.form1.userid.focus();
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
<style>
.vbm tr{ background:#ffffff}
.altbg1{ background-color:#f1f5f8}
.vbm span{ margin:0!important}
</style>
<form action="?part=edit&id=<?=$id?>" method="post" enctype="multipart/form-data" name="form1" onSubmit="return check_sub();">
<input name="pre_picture" value="<?=$edit['pre_picture']?>" type="hidden">
<input name="picture" value="<?=$edit['picture']?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
	<td colspan="2">Basic Information</td>
</tr>
<tr>
    <td class="altbg1">Title:<font color="red">*</font></td>
    <td>
        <input type="text" name="gname" value="<?=$edit['gname']?>" class="text" />
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">Member ID of the Seller Who Started the Activity:<font color="red">*</font></td>
    <td width="75%">
        <input type="text" name="userid" id="userid" value="<?=$edit['userid']?>" class="text" style="background-color:#eee"/> <font color=red>Please make no changes unless necessary.</font>
    </td>
</tr>
<tr>
    <td class="altbg1">Category:<font color="red">*</font></td>
    <td>
        <?php echo get_groupclass_select('cate_id',$edit['cate_id']); ?>
    </td>
</tr>
<tr>
    <td class="altbg1">District:<font color="red">*</font></td>
    <td>
        <?php echo select_where('area','areaid',$edit['areaid'],$edit['cityid']); ?>
    </td>
</tr>
<tr>
    <td class="altbg1">Site:<font color="red">*</font></td>
    <td><input type="text" name="gaddress" value="<?=$edit['gaddress']?>" class="text" /></td>
</tr>
<tr>
    <td class="altbg1">Time:<font color="red">*</font></td>
    <td><input id="datepicker1" type="text" name="meetdate" readonly="readonly" value="<?=$meetdate?>" class="text" style="width:180px" /></td>
</tr>
<tr>
    <td class="altbg1">Ending:<font color="red">*</font></td>
    <td><input id="datepicker2" type="text" name="enddate" readonly="readonly" value="<?=$enddate?>" class="text" style="width:180px" /></td>
</tr>
<tr>
    <td class="altbg1">Brief:<font color="red">*</font></td>
    <td><textarea name="des" style="height:60px; width:500px;"><?=de_textarea_post_change($edit['des'])?></textarea></td>
</tr>
<tr>
    <td class="altbg1">Details:<font color="red">*</font></td>
    <td><?php echo $acontent; ?></td>
</tr>
<tr class="firstr">
	<td colspan="2">Preview</td>
</tr>
<tr>
    <td class="altbg1">Group Purchase Image:</td>
    <td> 
    <?php
    echo "<img src=".$mymps_global[SiteUrl]."".$edit[pre_picture]." style='_margin-top:expression(( 180 - this.height ) / 2);' />\r\n";
    ?>
    </td>
</tr>
<tr>
    <td class="altbg1">Update Image:</td>
    <td> 
    <input type="file" name="group_image" size="30">
    </td>
</tr>
<tr class="firstr">
	<td colspan="2">Affiliated</td>
</tr>
<tr>
	<td class="altbg1">Sorting Order</td>
    <td>
    <input name="displayorder" class="txt" value="<?=$edit['displayorder']?>">
    <br><br>
    The bigger the number, the closer the activity is placed to the front.
    </td>
</tr>
<tr>
	<td class="altbg1">Number of Members Signed-up</td>
    <td>
    <input name="signintotal" class="txt" value="<?=$edit['signintotal']?>">
    <br><br>
    Putting a proper number on display helps your activity gain attention of members. The number of members who signed up after your setting will be added to this number.
    </td>
</tr>
<tr>
	<td class="altbg1">Status</td>
    <td>
    <select name="glevel">
    	<?php foreach($glevel as $k => $v){?>
    	<option value="<?=$k?>" <?php if($edit['glevel'] == $k) echo 'selected style=\'background-color:#6eb00c; color:white!important;\''; ?>><?=$v?></option>
        <?php }?>
    </select><br><br>
    Should the activity pass the revision, signing up will be shown; Should the activity be put under revision, failed or closed, signing up will be hidden.
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">Leader:</td>
    <td width="75%">
        <input type="text" name="mastername" id="mastername" value="<?=$edit['mastername']?>" class="text"/>
    </td>
</tr>

<tr>
    <td class="altbg1" width="15%">Discussion Board URL:</td>
    <td width="75%">
        <input type="text" name="commenturl" value="<?=$edit['commenturl']?>" class="text"/>
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">Relation to the Activity Starter (Seller):</td>
    <td width="75%">
        <input type="text" name="biztype" value="<?=$edit['biztype']?>" class="text"/> Example: In Cooperation/Not In Cooperation
    </td>
</tr>
<tr>
    <td class="altbg1" width="15%">Other Information:</td>
    <td width="75%">
        <textarea name="othercontent" style="width:300px; height:100px;"><?=$edit['othercontent']?></textarea>
    </td>
</tr>
</table>
</div>
<center><input type="submit" name="group_submit" value="Submit" class="mymps large" /></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
