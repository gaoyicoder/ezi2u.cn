<?php include mymps_tpl('inc_head');?>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
            <li><a href="?part=option_type" <?php if($part == 'option_type'){?>class="current"<?php }?>>Type Management</a></li>
            <?php foreach($options as $k =>$value){?>
                <li><a href="?classid=<?=$value[optionid]?>" <?php if($edit[classid]==$value[optionid]){?>class="current"<?php }?>><?=$value[title]?></a></li>
            <?php }?>
            </ul>
        </div>
    </div>
</div>
<form name='form1' method='post' action='?part=option_edit&action=update&optionid=<?=$edit[optionid]?>'>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
    <td colspan="6">
    <div class="left"><a href="javascript:collapse_change('1')">Basic Settings on Categorized Options</a></div>
    <div class="right"><a href="javascript:collapse_change('1')"><img id="menuimg_1" src="template/images/menu_reduce.gif"/></a></div>
    </td>
    </tr>
    <tbody id="menu_1">
    <tr bgcolor="#f5fbff" width="45%">
      <td>Name</td>
      <td bgcolor="#f5fbff"><input name="title" value="<?=$edit['title']?>" type="text" class="text"></td>
    </tr>
    <tr bgcolor="#f5fbff" width="45%">
      <td>Variable Name</td>
      <td bgcolor="#f5fbff"><input name="identifier" value="<?=$edit['identifier']?>" type="text" class="text"></td>
    </tr>
    <tr bgcolor="#f5fbff" width="45%">
      <td>Type</td>
      <td><select name="typenew" onchange="var styles, key;styles=new Array('text','textarea','radio','checkbox','select','number'); for(key in styles) {var obj=$('style_'+styles[key]); obj.style.display=styles[key]==this.options[this.selectedIndex].value?'':'none';}">
        <?=get_type_option($edit[type])?>
      </select>
      </td>
    </tr>
    <tr bgcolor="#f5fbff" width="45%">
      <td>From Category</td>
      <td bgcolor="#f5fbff">
      <select name="classid">
      <?php foreach($class_option as $k => $value){?>
        <option value="<?=$value[optionid]?>" <?php echo ($edit[classid]==$value[optionid])?"selected":"";?>><?=$value[title]?></option>
      <?php }?>
      </select> 
      [<a href="?part=option_type">Type Management</a>]
      </td>
    </tr>
    <tr bgcolor="#f5fbff" width="45%">
      <td>Sorting Order</td>
      <td bgcolor="#f5fbff"><input name="displayorder" value="<?=$edit['displayorder']?>" type="text" class="text"></td>
    </tr>
    <tr bgcolor="#f5fbff" width="45%">
      <td>Other Properties</td>
      <td bgcolor="#f5fbff">
      <label for="available"><input name="available" type="checkbox" id="available" <?php if($edit['available']=='on'){echo 'checked';}?> class=checkbox>Available</label> 
      <label for="required"><input name="required" type="checkbox" id="required" <?php if($edit['required']=='on'){echo 'checked';}?> class=checkbox>Must-enter</label>
      <label for="search"><input name="search" type="checkbox" id="search" <?php if($edit['search']=='on'){echo 'checked';}?> class=checkbox>Join Search</label>
      </td>
    </tr>
    <tr bgcolor="#f5fbff" width="45%">
      <td>Brief<br />(Not Compulsory)</td>
      <td><textarea rows="10" cols="70" name="description"><?=$edit[description]?></textarea></td>
    </tr>
    </tbody>
</table>
</div>

<?php echo get_mymps_admin_info_type();?>

</div>
<center><input type="submit" value="Save Changes" class="mymps mini"/> <input type="button" onclick="location.href='?classid=<?=$edit[classid]?>';" value="Return" class="mymps mini"></center>
</form>
<?php mymps_admin_tpl_global_foot();?>