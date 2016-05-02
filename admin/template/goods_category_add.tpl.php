<?php mymps_admin_tpl_global_head();?>
<script language=javascript>
function chkform(){
	if(document.form1.catname.value==""){
		alert('Please enter category title!');
		document.form1.catname.focus();
		return false;
	}
	if(document.form.catname.value.length<2){
		alert('Please make sure the category title is more than 2 characters!');
		document.form1.catname.focus();
		return false;
	}
}
function do_copy(){
  ff = document.form1;
  ff.title.value=document.getElementById("catname").value;
  ff.keywords.value=document.getElementById("catname").value;
}

function isUndefined(variable) {
	return typeof variable == 'undefined' ? true : false;
}

function insertunit(text) {
	$('jstemplate').focus();
	$('jstemplate').value=text;
}

function changeElementByClass(className, status)
{
    var element = document.getElementsByClassName(className);
    for(var i=0; i < element.length; i++) {
        element[i].style.display= status;
    }
}

function hideElementByClass(className)
{
    changeElementByClass(className, "none");
}

function showElementByClass(className)
{
    changeElementByClass(className, "");
}

function change_type(type_id) {
    if (type_id == 0) {
        hideElementByClass("solid");
        showElementByClass("loose");
    } else if (type_id == 1) {
        hideElementByClass("loose");
        showElementByClass("solid");
    }
}
</script>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?part=list">Voucher Categorization</a></li>
                <li><a href="?part=add" class="current">Add Category</a></li>
            </ul>
        </div>
    </div>
</div>
<form method=post onSubmit="return chkform()" name="form1" action="?part=add">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td colspan="2">
    <div class="left"><a href="javascript:collapse_change('1')">Category Basic Information</a></div>
    <div class="right"><a href="javascript:collapse_change('1')"><img id="menuimg_1" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_1">
<tr bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">Type:  </td>
    <td><? foreach($mymps_mymps['cfg_voucher_types'] as $key => $value) {?>
        <input <?=$key==0 ? "checked" : "" ?> id="type" type="radio" name="type" value="<?=$key ?>" onclick="change_type(<?=$key ?>)" /> <?=$value ?> &nbsp;&nbsp;
        <? } ?>
    </td>
</tr>
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Category Name:  </td>
  <td><input name="catname" type="text" id="catname" value="" class="text"></td>
</tr>
<tr style="display: none;" class="solid" bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">Cost:  </td>
    <td><input name="cost" type="text" id="cost" value="" class="txt"></td>
</tr>
<tr style="display: none;" class="solid" bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">Pay:  </td>
    <td><input name="pay" type="text" id="pay" value="" class="txt"></td>
</tr>

<tr class="loose" bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">Discount:  </td>
    <td><input name="discount" type="text" id="discount" value="" class="txt">% (0 ~ 100)</td>
</tr>

<tr class="loose" bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">折扣条件:  </td>
    <td><input name="greaterthan" type="text" id="greaterthan" value="" class="txt"></td>
</tr>
<!--
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">From Category:  </td>
  <td><select name="parentid" id="parentid" >
    <option value="0">Set as Root category...</option>
	<?=goods_cat_list(1,0,true,1)?>
  </select>  </td>
</tr>
-->
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Category Sorting: </td>
  <td><input name="catorder" type="text" id="catorder" value="<?=$maxorder?>" class="txt"></td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Enable/Disable: </td>
  <td><select name="isview">
      <?=get_ifview_options()?>
      </select></td>
</tr>
</tbody>
</table>
</div>
<center>
<input type="submit" value="Confirm Submission" name="<?=CURSCRIPT?>_submit" class="mymps mini" />��
<input type="button" onClick=history.back() value="Return" class="mymps mini">
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
