<?php mymps_admin_tpl_global_head();?>
<script language=javascript>
function chkform(){
	if(document.form1.catname.value==""){
		alert('Please enter column title!');
		document.form1.catname.focus();
		return false;
	}
	if(document.form.catname.value.length<2){
		alert('Please make sure the column title is more than 2 characters!');
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
	$obj('jstemplate').focus();
	$obj('jstemplate').value=text;
}

function insertunit2(text) {
	$obj('jstemplate2').focus();
	$obj('jstemplate2').value=text;
}
</script>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Hint</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
  <li>When column is not enabled, it is stored as a categorization tool and can be enabled when needed.</li>
    </td>
  </tr>
</table>
</div>
<form method=post onSubmit="return chkform()" name="form1" action="?part=add">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td colspan="2">
    <div class="left"><a href="javascript:collapse_change('1')">Column Basic Information</a></div>
    <div class="right"><a href="javascript:collapse_change('1')"><img id="menuimg_1" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_1">
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Column Name:  </td>
  <td><textarea rows="20" name="catname" cols="20" style="float:left"></textarea>
<div style="margin-top:3px; float:left; margin-left:10px;">The system supports adding professions by batches. To do it, add profession one line at a time. <br />
<font color="red">Example:<br />Profession1<br />Profession2<br />Profession3<br />Profession4<br />Profession5</font></div></td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">From Column:  </td>
  <td><select name="parentid" id="parentid" >
    <option value="0">As Root Column...</option>
	<?=cat_list('category',0,0,true,2)?>
  </select>  </td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Column Sorting:  </td>
  <td><input name="catorder" type="text" id="catorder" value="<?=$maxorder?>" class="txt"></td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">From Model:  </td>
  <td><select name="modid"><?php echo info_typemodels(); ?></select> [<a href="info_type.php?part=mod">Model Management</a>]</td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">On/Off: </td>
  <td><select name="isview">
      <?=get_ifview_options()?>
      </select></td>
</tr>
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Picture Upload On/Off:  </td>
  <td>
  <label for="1"><input class="radio" type="radio" value="1" name="if_upimg" checked="checked">On</label> 
  <label for="0"><input class="radio" type="radio" value="0" name="if_upimg">Off</label></td>
</tr>
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Enable Mapmark: </td>
  <td>
  <label for="1"><input class="radio" type="radio" value="1" name="if_mappoint">On</label> 
  <label for="0"><input class="radio" type="radio" value="0" name="if_mappoint" checked="checked">Off</label></td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Pseudo-static Management:  </td>
  <td><?=GetHtmlType('2','dir_type','add')?></td>
</tr>
</tbody>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table cellpadding="0" cellspacing="0" class="vbm">
<tr class="firstr">
<td colspan="3">
    <div class="left"><a href="javascript:collapse_change('3')">Template for Column Application</a></div>
    <div class="right"><a href="javascript:collapse_change('3')"><img id="menuimg_3" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_3">
<tr bgcolor="white">
  <td bgcolor="#F1F5F8" width="15%">Template for Column List Application: </td>
  <td width="300">
  /template/default/ <input name="template" class="text" style="width:100px;" id="jstemplate" value="list"> .tpl.php <br />
  </td>
  <td><?php foreach($category_tpl as $k => $v){?>
   <a href="###" title="Click to Use<?=$v?>" onclick="insertunit('<?=$k?>')" class="temp"><?=$v?><br />£¨<?=$k?>£©</a>
   <?php if($k == 'category') echo '<div class=clear></div>'?>
  	 <?php }?>
	</td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Template for the Use of Column List Details: </td>
  <td>/template/default/ <input name="template_info" class="text" style="width:100px;" id="jstemplate2" value="info">  .tpl.php </td>
  <td>
  <?php foreach($information_tpl as $k => $v){?>
   <a href="###" title="Click to Use<?=$v?>" onclick="insertunit2('<?=$k?>')" class="temp <?php if($cat['template_info'] == $k) echo 'curtemp'?>"><?=$v?><br /><?=$k?></a>
  <?php }?>
</td>
</tr>
</tbody>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table cellpadding="0" cellspacing="0" class="vbm">
<tr class="firstr">
<td colspan="3">
    <div class="left"><a href="javascript:collapse_change('4')">Authority of Viewing Contacts in Posts</a></div>
    <div class="right"><a href="javascript:collapse_change('4')"><img id="menuimg_4" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_4">
<tr bgcolor="white">
  <td bgcolor="#F1F5F8" width="15%">Number of coin deducted for viewing contacts from posts in this column.</td>
  <td>
  <input name="usecoin" class="txt" id="usecoin" value="0"> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"> <font style="color:#777; margin-left:10px;">Note: Setting the value to 0 denotes that the viewing is free for guests.</font> <font color="red">Please type in only integers!</font>
  </td>
</tr>
</tbody>
</table>
</div>
<center>
<input type="submit" value="Confirm Submission" name="<?=CURSCRIPT?>_submit" class="mymps mini" />
<input type="button" onClick=history.back() value="Return" class="mymps mini">
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
