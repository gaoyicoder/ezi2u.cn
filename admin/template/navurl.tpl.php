<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
            <?php foreach($nav_type as $navtype =>$v){?>
                <li><a href="?typeid=<?=$navtype?>" <?php if($typeid==$navtype){?>class="current"<?php }?>><?=$v?></a></li>
            <?php }?>
            </ul>
        </div>
    </div>
</div>
<?php if($typeid == '2'){?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Hint</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
  <li>Text links in bottom navigation is displayed at the bottom of the page.</li>
  <li>You may<a href="?part=restorefooter" style="color:red; text-decoration:underline; font-weight:bold; font-size:18px">click on here to restore default text links in bottom navigation. &raquo;</a></li>
    </td>
  </tr>
</table>
</div>
<?}elseif($typeid == '1'){?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td>Hint</td>
    <td style="text-align:right">
    <?php if(!$admin_cityid){?>
    Select Sub-site: <select name="cityid" onChange="location.href='?typeid=<?=$typeid?>&page=<?=$page?>&cityid='+(this.options[this.selectedIndex].value)">
       	<option value="0">Master Site</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
    <? }?>
    &nbsp;
    </td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip" colspan="2">
  <li>Text links in sub navigation is displayed below the columns in main navigation.</li>
    </td>
  </tr>
</table>
</div>
<?}elseif($typeid == '3'){?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Hint</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
  <li>The number of text links in main navigation is no more than 10, so you may set order of display and disable a few links to optimize the effect of display.</li>
  <li>If this is an exterior URL to be linked, please do remember to add <font color="#006acd">http://</font> mark when inputting. <font color="#006acd">outlink</font></li>
  <li>You may also<a href="?part=restore" style="color:red; text-decoration:underline; font-weight:bold; font-size:18px">click on here to restore default text links in main navigation &raquo;</a></li>
    </td>
  </tr>
</table>
</div>
<?}?>
<form name='form1' method='post' action='navurl.php'>
<input name="forward_url" value="<?=GetUrl()?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
    <td colspan="10"><b><?=$nav_type[$typeid]?></b></td>
    </tr>
    <tr style="font-weight:bold; background-color:#F5F8FF">
      <td width="50"><input class="checkbox" name="chkall" type="checkbox" onclick="AllCheck('prefix', this.form, 'delids')"/> Delete?</td>
      <td>Apply</td>
      <td>Text(<font color="red">*</font>)</td>
      <td>Icon</td>
      <td>Open Window As</td>
      <td>Text Colour</td>
      <td>Link URL(<font color="red">*</font>)</td>
      <td>Category</td>
      <td>Order Of Display</td>
      <?php if($typeid == '3'){?><td>Mark</td><?php }?>
	  <?php if($typeid == '1'){?><td>From Sub-site</td><?php }?>
    </tr>
    <?php 
    if($typeid == 3 && empty($rows_num)){
    ?>
     <tr bgcolor="#ffffff">
          <td colspan="10"><br />There are currently no text links in main navigation.��<a href="?part=restore">Click on here to apply the default text links in main navigation. &raquo;</a><br />
<br />
</td>
      </tr>
  <?php }else{
    foreach($url as $k =>$value){?>
        <tr bgcolor="#ffffff">
          <td bgcolor="white"><input class="checkbox" type='checkbox' name='delids[]' value='<?=$value[id]?>' id="<?=$value[id]?>"></td>
          <td bgcolor="white" width="60px">
          <input name="isviewids[<?=$value[id]?>]" value="2" type="checkbox" class="checkbox" <?php if($value['isview'] == '2'){echo 'checked';}?>></td>
          <td bgcolor="white">
          <?php if($typeid == '3'){?>
<input name="navtitle[<?=$value[id]?>]" value="<?=$value[title]?>" type="text" class="text" style="width:80px"/>
          <?php }else{?>
          <input name="navtitle[<?=$value[id]?>]" value="<?=$value[title]?$value[title]:$value[name]?>" type="text" class="text" style="width:80px"/>
          <?php }?>
          </td>
          <td bgcolor="white">  
          <select name="icoids[<?=$value[id]?>]">
          	<option value="" <?php if($value['ico'] == ''){echo 'selected';}?>>None</option>
            <option value="re" <?php if($value['ico'] == 're'){echo 'selected';}?>>Hot</option>
            <option value="xin" <?php if($value['ico'] == 'xin'){echo 'selected';}?>>New</option>
            <option value="qiang" <?php if($value['ico'] == 'qiang'){echo 'selected';}?>>Popular</option>
          </select>    
          </td>
          <td bgcolor="white">  
            <select name="target[<?=$value[id]?>]">
            <?=get_target_options($value[target])?>
            </select>
          </td>
          <td bgcolor="white">
            <select name="showcolor[<?=$value[id]?>]">
            <option value="">Default Colour</option>
            <?=get_color_options($value[color])?>
            </select>  
          </td>
          <td bgcolor="white">
          <?php if($typeid == '3'){?>
<input name="navurl[<?=$value[id]?>]" value="<?=$value[url]?>" type="text" class="text" style="width:150px"/>
          <?php }else{?>
          	<input name="navurl[<?=$value[id]?>]" value="<?=$value[url]?$value[url]:$value[uri]?>" type="text" class="text" style="width:150px"/>
          <?php }?>
          </td>
          <td bgcolor="white"><?=$nav_type[$typeid]?></td>
          <td bgcolor="white"><input name="displayorder[<?=$value[id]?>]" value="<?=$value[displayorder] ? $value[displayorder] : 0?>" type="text" class="txt"/></td>
          <?php if($typeid == '3'){?><td bgcolor="white"><input name="flag[<?=$value[id]?>]" value="<?=$value[flag] ? $value[flag] : 'outlink'?>" type="text" class="txt"/>&nbsp;</td><?php }?>
          <?php if($typeid == '1'){?><td bgcolor="white"><select name="cityid[<?=$value[id]?>]">
       	<option value="0" <?php if($value[cityid] == 0) echo 'selected';?>>Master Site</option>
        <?php echo get_cityoptions($value[cityid]); ?>
       </select></td><?php }?>
        </tr>
    <?}}?>

    <tbody id="secqaabody" bgcolor="white">
    <tr bgcolor="#f5fbff">
      <td bgcolor="white" align="center">Add<a href="###" onclick="newnode = $('secqaabodyhidden').firstChild.cloneNode(true); $('secqaabody').appendChild(newnode)">[+]</a></td>
      <td bgcolor="white"><select name="newisview[]">
      <?=get_ifview_options(2)?>
      </select></td>
      <td bgcolor="white"><input name="newtitle[]" value="" type="text" class="text" style="width:80px;"/></td>
      <td bgcolor="white">
        <select name="newico[]">
        <option value="" >None</option>
        <option value="re" >Hot</option>
        <option value="xin" >New</option>
        <option value="qiang" >Popular</option>
        </select>    
      </td>
        <td bgcolor="white">  
        <select name="newtarget[]">
        <?=get_target_options()?>
        </select>
        </td>
        <td bgcolor="white">
        <select name="newshowcolor[]">
        <option value="">Default Colour</option>
        <?=get_color_options()?>
        </select>  
        </td>
      <td bgcolor="white"><input name="newurl[]" value="" type="text" class="text" style="width:150px"/></td>
      <td bgcolor="white">
      <?php echo $nav_type[$typeid]; ?>
      <input name="newtypeid[]" value="<?php echo $typeid; ?>" type="hidden" />
      </td>
      <td bgcolor="white"><input name="newdisplayorder[]" value="" type="text" class="txt"/></td>
	  <?php if($typeid == '3'){?><td bgcolor="white"><input name="newflag[]" value="outlink" type="text" class="txt"></td><?php }?>
	  <?php if($typeid == '1'){?>
      <td bgcolor="white">
      <?php if(!$admin_cityid && $typeid == 1){?>
        <select name="newcityid[]">
       	<option value="0">Default Colour</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
        <?}else{?>
		<input name="newcityid[]" type="hidden" value="<?php echo $admin_cityid; ?>">
       <?php }?></td>
	   <?php }?>
    </tr>
	
    </tbody>
    <tbody id="secqaabodyhidden" style="display:none">
      <tr bgcolor="#f5fbff">
      <td align="center" bgcolor="white">&nbsp;</td>
      <td bgcolor="white"><select name="newisview[]">
      <?=get_ifview_options(2)?>
      </select></td>
      <td bgcolor="white"><input name="newtitle[]" value="" type="text" class="text" style="width:80px;"/></td>
      <td bgcolor="white">
      <select name="newico[]">
        <option value="" >None</option>
        <option value="re" >Hot</option>
        <option value="xin" >New</option>
        <option value="qiang" >Popular</option>
        </select>  
      </td>
    <td bgcolor="white">  
        <select name="newtarget">
        <?=get_target_options($navurl[target])?>
        </select>
      </td>
      <td bgcolor="white">
        <select name="newshowcolor">
        <option value="">Default Colour</option>
        <?=get_color_options($navurl[color])?>
        </select>  
      </td>
      <td bgcolor="white"><input name="newurl[]" value="" type="text" class="text" style="width:150px"/></td>
      <td bgcolor="white">
      <?php echo $nav_type[$typeid]; ?>
      <input name="newtypeid[]" value="<?php echo $typeid; ?>" type="hidden" />
      </td>
      <td bgcolor="white"><input name="newdisplayorder[]" value="" type="text" class="txt"/></td>
	  <?php if($typeid == '3'){?><td bgcolor="white"><input name="newflag[]" value="outlink" type="text" class="txt"></td><?php }?>
	  <?php if($typeid == '1'){?>
      <td bgcolor="white">
      <?php if(!$admin_cityid && $typeid ==1){?>
        <select name="newcityid[]">
       	<option value="0">Master Site</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
        <?}else{?>
		<input name="newcityid[]" type="hidden" value="<?php echo $admin_cityid; ?>">
       <?php }?></td>
	   <?php }?>
    </tr>
    </tbody>

    </table>
</div>
<center>
<input type="submit" value="Submit" class="mymps large" name="navurl_submit"/>  
</center>
</form>
<div class="pagination"><?php echo page2();?></div>
<?php mymps_admin_tpl_global_foot();?>
