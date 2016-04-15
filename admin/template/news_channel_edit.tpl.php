<?php mymps_admin_tpl_global_head();?>
<script language=javascript>
function chkform(){
	if(document.form1.catname.value==""){
		alert('Please enter column title!');
		document.form1.catname.focus();
		return false;
	}
	if(document.form1.cat.value==""){
		alert('Please select column!');
		document.form1.cat.focus();
		return false;
	}
}
function do_copy(){
  ff = document.form1;
  ff.title.value=document.getElementById("catname").value;
  ff.keywords.value=document.getElementById("catname").value;
  ff.description.value=document.getElementById("catname").value;
}
function copyoption(s1, s2) {
	var s1 = $(s1);
	var s2 = $(s2);
	var len = s1.options.length;
	for(var i=0; i<len; i++) {
		op = s1.options[i];
		if(op.selected == true && !optionexists(s2, op.value)) {
			o = op.cloneNode(true);
			s2.appendChild(o);
		}
	}
}

function optionexists(s1, value) {
	var len = s1.options.length;
		for(var i=0; i<len; i++) {
			if(s1.options[i].value == value) {
				return true;
			}
		}
	return false;
}
</script>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a title="Added News Category" href="channel.php">Added News Category</a></li>
                <li><a title="Add News Category" href="channel.php?part=add">Add News Category</a></li>
				<li><a title="Edit News Category" href="channel.php?part=edit&catid=<?=$catid?>" class="current">Edit News Category</a></li>
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
    <td  id="menu_tip">
  <li>When column is not enabled, it is stored only as a categorization tool and can be enabled when needed.</li>
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
    <div class="left"><a href="javascript:collapse_change('1')">Basic Information on Column</a></div>
    <div class="right"><a href="javascript:collapse_change('1')"><img id="menuimg_1" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_1">
<tr bgcolor="#f5fbff">
  <td width="15%">Column Name: </td>
  <td><input name="catname" type="text" class="text" id="catname" value="<?=$cat[catname]?>" size="30"> 
  		<select name="fontcolor">
          <option value="">Default Colour</option>
          <?foreach ($cat_color as $k){?>
          <option value="<?=$k?>" style="background-color:<?=$k?>;" <?if($cat[color] == $k) echo 'selected';?>></option>
          <?}?>
        </select>
  		<font color="red">*</font></td>
</tr>
<tr bgcolor="#f5fbff">
  <td>From Column:  </td>
  <td><select name="parentid" id="parentid" >
    <option value="0">Set as Root Colum...</option>
<?php echo cat_list('channel',0,$cat[parentid]);?>
  </select>  </td>
</tr>
<tr bgcolor="#f5fbff">
  <td>Sorting Order of Columns: </td>
  <td><input name="catorder" type="text" class="text" id="catorder" value="<?=$cat[catorder]?>" size="13"></td>
</tr>
<tr bgcolor="#f5fbff">
  <td>Enable/Disable: </td>
  <td> <select name="isview">
      <?=get_ifview_options($cat[if_view])?>
      </select></td>
</tr>
</tbody>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table cellpadding="0" cellspacing="0" class="vbm">
<tr class="firstr">
<td colspan="2">
    <div class="left"><a href="javascript:collapse_change('2')">SEO Optimization Settings<font style="color:#FF6600; font-weight:100">(If it is the same with the column name,
<label for="copy">
click on here<input name="radio" id="copy" type="radio" onClick="do_copy();"  class="radio"/>to copy.</label>
)</font></div>
    <div class="right"><a href="javascript:collapse_change('2')"><img id="menuimg_2" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_2">
<tr bgcolor="#f5fbff">
  <td width="15%">Title to be Displayed:  </td>
  <td> <input name="title" type="text" class="text" id="title" value="<?=$cat[title]?>" size="50"> <font color="red">*</font>(<font style="color:#FF6600">Example: NewsA_NewsB,  no more than 15 characters·û)
  </td>
</tr>
<tr bgcolor="#f5fbff">
  <td>Keyword:  </td>
  <td><input name="keywords" type="text" class="text" id="keywords" value="<?=$cat[keywords]?>" size="50">   (For multiple keywords, separate each keyword with a comma when inputting, and use <font color="red">{city}</font> to replace name of sub-site .)</td>
</tr>
<tr bgcolor="#f5fbff">
  <td>Description:  </td>
  <td><textarea name="description" cols="49" rows="5" id="description"><?=$cat[description]?></textarea> (Use <font color="red">{city}</font> to replace name of sub-site .)</td>
</tr>
<tr bgcolor="#f5fbff">
  <td>Form of Directory Saving: <br /><i style="color:#666">Enable When Creating Static Directory</i> </td>
  <td><?=GetHtmlType($cat[dir_type],'dir_type','edit',$cat[dir_typename])?> </td>
</tr>
</tbody>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="Save Changes" class="mymps mini" />¡¡
<input type="button" onClick="location.href='?part=list'" value="Return" class="mymps mini">
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
