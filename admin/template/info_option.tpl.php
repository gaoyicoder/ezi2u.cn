<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
            <li><a href="?part=option_type" <?php if($part == 'option_type'){?>class="current"<?php }?>>Type Management</a></li>
            <?php foreach($options as $k =>$value){?>
                <li><a href="?classid=<?=$value[optionid]?>" <?php if($classid==$value[optionid]){?>class="current"<?php }?>><?=$value[title]?></a></li>
            <?php }?>
            </ul>
        </div>
    </div>
</div>
<form name='form1' method='post' action='?'>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  	<input name="part" value="option_delall" type="hidden">
    <input name="url" value="<?=GetUrl()?>" type="hidden">
    <tr class="firstr">
    <td colspan="7"><b><?=$detail['title']?></b> Categorized Information Field Management</td>
    </tr>
    
    <tr style="font-weight:bold; height:24px; background-color:#f1f5f8">
      <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/>Delete?</td>
      <td>Model ID</td>
      <td>Name</td>
      <td>Variable Name</td>
      <td>Type</td>
      <td>Order of Display</td>
      <td>Edit</td>
    </tr>
	<tbody onmouseover="addMouseEvent(this);">
<?php foreach($option as $k =>$value){?>
    <tr bgcolor="white">
      <td><input <?php if($value[optionid]==1) echo 'disabled'; ?> class="checkbox" type='checkbox' name='id[]' value='<?=$value[optionid]?>' id="<?=$value[optionid]?>"></td>
      <td><?=$value[optionid]?></td>
      <td><?=$value[title]?></td>
      <td><?=$value[identifier]?></td>
      <td><?=$var_type[$value[type]]?>(<?=$value[type]?>)</td>
      <td><?=$value[displayorder]?></td>
      <td><a href="?part=option_edit&optionid=<?=$value[optionid]?>">Details</a></td>
    </tr>
    <?}?>
    </tbody>
	</table>
	</div>
	<center><input type="submit" onClick="if(!confirm('Are you sure you want to proceed? \n\n This cannot be undone!'))return false;" value="Submit" class="mymps large" name="deloption"/></center>
</form>
<div class="clear" style="height:10px"></div>
<form action="?part=option_add" method="post" name="form2">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td colspan="2"><?=$detail['title']?> Add Field for Models</td>
</tr>
<tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:15%;">Field Name</td>
    <td><input name="title" type="text" class="text"> <br /><i style="color:#555; margin-top:3px;">An English word like Price.</i></td>
</tr>
<tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8;">Variable Name</td>
    <td><input name="identifier" type="text" class="text"> <br /><i style="color:#555; margin-top:3px;">You may use Field Name in full or in initials.</i></td>
</tr>
<tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8;">Type</td>
    <td>
	<select name="type">
		<?=get_type_option()?>
    </select>
	</td>
</tr>
<tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8;">Other Properties</td>
    <td>
<label for="available"><input name="available" type="checkbox" id="available" class="checkbox">Available</label> 
<label for="required"><input name="required" type="checkbox" id="required" class="checkbox">Must-enter</label>
<label for="search"><input name="search" type="checkbox" id="search" class="checkbox">Join Search</label>
	</td>
</tr>
<tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8;">Order of Display</td>
    <td><input name="displayorder" type="text" class="text" value="0"></td>
</tr>
    <input name="classid" value="<?=$detail[optionid]?>" type="hidden" />
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large" name="optionnew"/></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
