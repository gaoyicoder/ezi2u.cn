<?php mymps_admin_tpl_global_head();?>
<script language=javascript>
function chkform(){
	if(document.form1.catname.value==""){
		alert('Please enter category title!');
		document.form1.catname.focus();
		return false;
	}
	if(document.form1.cat.value==""){
		alert('Please select category!');
		document.form1.cat.focus();
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
                <li><a href="?part=list">Goods Categories</a></li>
                <li><a href="?part=add">Add Category</a></li>
			    <li><a href="?part=edit&catid=<?=$catid?>" class="current">Edit Category</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Hint</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
  <li>When categorization is not enabled, it is stored only as a categorization tool and can be enabled when needed.</li>
    </td>
  </tr>
</table>
</div>
<form method=post onSubmit="return chkform()" name="form1" action="?part=edit">
<input name="catid" value="<?=$cat[catid]?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td colspan="2">
    <div class="left"><a href="javascript:collapse_change('1')">Category  Basic information</a></div>
    <div class="right"><a href="javascript:collapse_change('1')"><img id="menuimg_1" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_1">
<tr bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">Type:  </td>
    <td><? foreach($mymps_mymps['cfg_voucher_types'] as $key => $value) {?>
            <input <?=$key==$cat[type] ? "checked" : "" ?> id="type" type="radio" name="type" value="<?=$key ?>" onclick="change_type(<?=$key ?>)" /> <?=$value ?> &nbsp;&nbsp;
        <? } ?>
    </td>
</tr>
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Category Name:  </td>
  <td><input name="catname" type="text" class="text" id="catname" value="<?=$cat[catname]?>" size="30"> 
  		<select name="fontcolor">
          <option value="">Default Colour</option>
          <?foreach ($cat_color as $k){?>
          <option value="<?=$k?>" style="background-color:<?=$k?>;" <?if($cat[color] == $k) echo 'selected';?>></option>
          <?}?>
        </select>
  		<font color="red">*</font></td>
</tr>
<tr style="<?if($cat[type] == 0) echo 'display: none;';?>" class="solid" bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">Cost:  </td>
    <td><input name="cost" type="text" id="cost" value="<?=$cat[cost]?>" class="txt"></td>
</tr>
<tr style="<?if($cat[type] == 0) echo 'display: none;';?>" class="solid" bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">Pay:  </td>
    <td><input name="pay" type="text" id="pay" value="<?=$cat[pay]?>" class="txt"></td>
</tr>

<tr style="<?if($cat[type] == 1) echo 'display: none;';?>" class="loose" bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">Discount:  </td>
    <td><input name="discount" type="text" id="discount" value="<?=$cat[discount]?>" class="txt">% (0 ~ 100)</td>
</tr>

<tr style="<?if($cat[type] == 1) echo 'display: none;';?>" class="loose" bgcolor="white">
    <td width="15%" bgcolor="#F1F5F8">折扣条件:  </td>
    <td><input name="greaterthan" type="text" id="greaterthan" value="<?=$cat[greaterthan]?>" class="txt"></td>
</tr>
<!--
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">From Category:  </td>
  <td><select name="parentid" id="parentid" >
    <option value="0">Set as Root category...</option>
	<?=goods_cat_list(1,$cat[parentid],true,1)?>
  </select>  </td>
</tr>
-->
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Category Sorting:  </td>
  <td><input name="catorder" type="text" class="txt" id="catorder" value="<?=$cat[catorder]?>" size="13"></td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Enable/Disable:  </td>
  <td> <select name="isview">
      <?=get_ifview_options($cat[if_view])?>
      </select></td>
</tr>
</tbody>
</table>
</div>
    <!--
<div id="<?=MPS_SOFTNAME?>">
<table cellpadding="0" cellspacing="0" class="vbm">
<tr class="firstr">
<td colspan="2">
    <div class="left"><a href="javascript:collapse_change('2')">SEO Optimization Settings<font style="color:#FF6600; font-weight:100">(If it is identical to category name, 
<label for="copy">
click on <input name="radio" id="copy" class="radio" type="radio" onClick="do_copy();" /> to copy.</label>
)</font></a></div>
    <div class="right"><a href="javascript:collapse_change('2')"><img id="menuimg_2" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_2">
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Display Title:  </td>
  <td> <input name="title" type="text" id="title" class="text" value="<?=$cat[title]?>" size="50"> <font color="red">*</font>(<font style="color:#FF6600">Example: Sports/Outdoors/Casual Goods </font>;Use <font color="red">{city}</font> to replace the Sub-site Name.)
  </td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Keyword:  </td>
  <td><input name="keywords" type="text" id="keywords" class="text" value="<?=$cat[keywords]?>" size="50">   (For multiple keywords, separate each of them with a comma; Use <font color="red">{city}</font> to replace the Sub-site Name.)</td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Description�� </td>
  <td><textarea name="description" cols="49" rows="5" id="description"><?=$cat[description]?></textarea> (Use <font color="red">{city}</font> to replace the Sub-site Name.)</td>
</tr>
</tbody>
</table>
</div>
    -->
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="Save Changes" class="mymps mini" />��
<input type="button" onClick=history.back() value="Return" class="mymps mini">
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
