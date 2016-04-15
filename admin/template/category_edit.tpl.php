<?php mymps_admin_tpl_global_head();?>
<script language=javascript>
function chkform(){
	if(document.form1.catname.value==""){
		alert('Please enter column name! ');
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
<form method=post onSubmit="return chkform()" name="form1" action="?part=edit">
<input name="catid" value="<?=$cat[catid]?>" type="hidden">
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
  <td width="15%" bgcolor="#F1F5F8">Column Name: </td>
  <td><input name="catname" type="text" class="text" id="catname" value="<?=$cat[catname]?>" size="30"> 
  		<select name="fontcolor">
          <option value="">Default Colour</option>
          <?php echo get_color_options($cat['color']); ?>
        </select>
  		<font color="red">*</font></td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">From Column:  </td>
  <td><select name="parentid" id="parentid" >
    <?php if(!$cat[parentid]){?><option value="0">As Root Column...</option><?php }?>
	<?php echo $cat[parentid] ? cat_list('category',0,$cat[parentid],true,2) : ''; ?>
  </select>  </td>
</tr>
<?php if($cat[parentid] == 0){?>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Column Icon Directory: <br />Size/30*30</td>
  <td><input name="icon" type="text" class="text" id="icon" value="<?=$cat[icon]?>"> <?php if($cat[icon] != ''){?><img src="<?=$cat[icon]?>"><?php }?> &nbsp;&nbsp;&nbsp;&nbsp;Format such as: /template/default/images/index/icon_fang.gif</td>
</tr>
<?php }?>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Column Sorting:  </td>
  <td><input name="catorder" type="text" class="txt" id="catorder" value="<?=$cat[catorder]?>" size="13"></td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">From Model: <div style="margin-top:10px; color:#666"><label for="children_mod"><input name="children_mod" value="1" type="checkbox" class="checkbox" id="children_mod">Apply Also to Sub-columns</label></div></td>
  <td><select name="modid"><?php echo info_typemodels($cat[modid])?></select> [<a href="info_type.php?part=mod">Module Management</a>]</td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">On/Off: </td>
  <td> <select name="isview">
      <?=get_ifview_options($cat[if_view])?>
      </select></td>
</tr>
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Picture Upload On/Off: <?php if(!$cat['parentid']){?><div style="margin-top:10px; color:#666"><label for="children_upload"><input checked="checked" name="children_upload" value="1" type="checkbox" class="checkbox" id="children_upload">Apply Also to Sub-columns</label></div><?php }?></td>
  <td>
  <label for="up1"><input class="radio" type="radio" value="1" id="up1" name="if_upimg" <?php if($cat[if_upimg]=='1'){?>checked="checked"<?}?>>On </label> 
  <label for="up0"><input class="radio" type="radio" value="0" id="up0" name="if_upimg" <?php if($cat[if_upimg]=='0'){?>checked="checked"<?}?>>Off</label></td>
</tr>
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Map Mark On/Off: <?php if(!$cat['parentid']){?><div style="margin-top:10px; color:#666"><label for="children_map"><input checked="checked" name="children_map" value="1" type="checkbox" class="checkbox" id="children_map">Apply Also to Sub-columns</label></div><?php }?></td>
  <td>
  <label for="map1"><input class="radio" type="radio" value="1" id="map1" name="if_mappoint" <?php if($cat[if_mappoint]=='1'){?>checked="checked"<?}?>>On </label> 
  <label for="map0"><input class="radio" type="radio" value="0" id="map0" name="if_mappoint" <?php if($cat[if_mappoint]=='0'){?>checked="checked"<?}?>>Off</label></td>
</tr>
</tbody>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table cellpadding="0" cellspacing="0" class="vbm">
<tr class="firstr">
<td colspan="2">
    <div class="left"><a href="javascript:collapse_change('2')">SEO Optimization Settings <font style="color:#FF6600; font-weight:100">(If it is identical to column name,
<label for="copy">
click to<input name="radio" id="copy" class="radio" type="radio" onClick="do_copy();" />copy</label>
)</font></a></div>
    <div class="right"><a href="javascript:collapse_change('2')"><img id="menuimg_2" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_2">
<tr bgcolor="white">
  <td width="15%" bgcolor="#F1F5F8">Display Title: </td>
  <td> <input name="title" type="text" id="title" class="text" value="<?=$cat[title]?>" size="50"> <font color="red">*</font>(<font style="color:#FF6600">Example: Used Car Purchase _ Used Car Sales</font>,must be within 15 characters)
  </td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Keyword: </td>
  <td><input name="keywords" type="text" id="keywords" class="text" value="<?=$cat[keywords]?>" size="50">   (For multiple keywords, separate each of them with a comma.)</td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Note:  <div style="margin-top:10px; color:#666"><label for="children_des"><input name="children_des" value="1" type="checkbox" class="checkbox" id="children_des">Apply Also to Sub-columns</label></div></td>
  <td><textarea name="description" cols="49" rows="5" id="description"><?=$cat[description]?></textarea> (Please input keyword in a proper manner. The best form is in a sentence no more than 200 characters.)</td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Directory Pseudo-static<br />(Customized Name): </td>
  <td><?=GetHtmlType($cat[dir_type],'dir_type','edit',$cat[dir_typename])?> <font style="color:#666">Please type in LETTERS ONLY (A`Z).  Example: <span>fang</span></font></td>
</tr>
</tbody>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table cellpadding="0" cellspacing="0" class="vbm">
<tr class="firstr">
<td colspan="3">
    <div class="left"><a href="javascript:collapse_change('3')">Column Application Template</a></div>
    <div class="right"><a href="javascript:collapse_change('3')"><img id="menuimg_3" src="template/images/menu_reduce.gif"/></a></div>
</td>
</tr>
<tbody id="menu_3">
<tr bgcolor="white">
  <td bgcolor="#F1F5F8" width="15%">Column List Application Template:  <div style="margin-top:10px; color:#666"><label for="children_tpl"><input name="children_tpl" value="1" type="checkbox" class="checkbox" id="children_tpl">Apply Also to Sub-columns</label></div></td>
  <td width="300">/template/default/ <input name="template" class="text" style="width:100px;" id="jstemplate" value="<?php echo $cat['template'];?>">  .tpl.php   
  </td>
  <td>
  <?php foreach($category_tpl as $k => $v){?>
   <a href="###" title="Click to Use<?=$v?>" onclick="insertunit('<?=$k?>')" class="temp <?php if($cat['template'] == $k) echo 'curtemp'?>"><?=$v?><br />£¨<?=$k?>£©</a>
    <?php if($k == 'category') echo '<div class=clear></div>'?>
  <?php }?>
</td>
</tr>
<tr bgcolor="white">
  <td bgcolor="#F1F5F8">Detailed Column Information Application Template: <div style="margin-top:10px; color:#666"><label for="children_tplinfo"><input name="children_tplinfo" checked="checked" value="1" type="checkbox" class="checkbox" id="children_tplinfo">Apply Also to Sub-columns</label></div></td>
  <td>/template/default/ <input name="template_info" class="text" style="width:100px;" id="jstemplate2" value="<?php echo $cat['template_info'];?>">  .tpl.php 
  </td>
  <td>
  <?php foreach($information_tpl as $k => $v){?>
   <a href="###" title="Click to Use<?=$v?>" onclick="insertunit2('<?=$k?>')" class="temp <?php if($cat['template_info'] == $k) echo 'curtemp'?>"><?=$v?><br />£¨<?=$k?>£©</a>
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
  <td bgcolor="#F1F5F8" width="15%">Number of coin deducted for viewing contacts from posts in this column: <?php if(!$cat['parentid']){?><div style="margin-top:10px; color:#666"><label for="children_usecoin"><input name="children_usecoin" value="1" type="checkbox" class="checkbox" id="children_usecoin" checked="checked">Apply Also to Sub-columns</label></div><?php }?></td>
  <td>
  <input name="usecoin" class="txt" id="usecoin" value="<?php echo $cat['usecoin']; ?>"> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"> <font style="color:#777; margin-left:10px;">Note: Setting the value to 0 denotes that the viewing is free for guests.</font> <font color="red">Please type in only integers!</font>
  </td>
</tr>
</tbody>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="Save Changes" class="mymps mini" />
<input type="button" onClick=history.back() value="Return" class="mymps mini">
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
