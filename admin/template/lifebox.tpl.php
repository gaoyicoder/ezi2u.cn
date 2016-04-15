<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td>Instructions</td>
    <td style="text-align:right">
    <?php if(!$admin_cityid){?>
    Select Sub-site£º<select name="cityid" onChange="location.href='?page=<?=$page?>&cityid='+(this.options[this.selectedIndex].value)">
       	<option value="0">Master Site</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
    <?php }?>
    &nbsp;
    </td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip" colspan="2">
 <li>Useful Tools section is displayed on the right side of the first screen on the homepage. It displays the latest 24 links in text. We suggest that each piece of text should not be more than 10 characters.</li>
 <li>The links are all click-and-jump links. Upon clicking, the browser will jump to the link.</li>
 <li>When entering exterior link, make sure that the URL contains http://. </li>
    </td>
  </tr>
</table>
</div>
<form action="?part=service" method="post">
<input name="forward_url" value="<?=GetUrl()?>" type="hidden"/>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr style="font-weight:bold; background-color:#dff6ff">
      <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/> Delete?</td>
	  <?php if(!$admin_cityid){?><td>From Sub-site</td><?php }?>
      <td>Text for Link(<font color="red">*</font>)</td>
      <td>Category</td>
      <td>URL(<font color="red">*</font>)</td>
      <td>Order of Display</td>
      <td>Enabled/Disabled</td>
    </tr>
    <?php foreach($lifebox as $k =>$value){?>
        <tr bgcolor="#ffffff">
          <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$value[id]?>' id="<?=$value[id]?>"></td>

		<?php if(!$admin_cityid){?>
		<td>
			<select name="edit[<?=$value[id]?>][cityid]">
				<option value="0">Master Site</option>
				<?php echo get_cityoptions($value['cityid']); ?>
			</select>
        <?}else{?>
			<input name="edit[<?=$value[id]?>][cityid]" type="hidden" value="<?php echo $admin_cityid; ?>">
		</td>
		<?php }?> 
		
          <td bgcolor="white"><input class="text" name="edit[<?=$value[id]?>][lifename]" value="<?=$value[lifename]?>" />       
		  </td>
          
        <td><select name="edit[<?=$value[id]?>][typeid]">
      <?php echo get_servtype_options($value[typeid]);?>
      </select></td>
          <td bgcolor="white"><input class="text" value="<?=$value[lifeurl]?>" name="edit[<?=$value[id]?>][lifeurl]"/></td>
          <td ><input name="edit[<?=$value[id]?>][displayorder]" value="<?=$value[displayorder]?>" type="text" class="txt"/></td>
          <td bgcolor="white"><select name="edit[<?=$value[id]?>][if_view]"><?=get_ifview_options($value[if_view])?></select></td>
        </tr>
    <?}?>
   <tbody id="secqaabody" bgcolor="white">
   <tr align="center">
       <td>Add:<a href="###" onclick="newnode = $('secqaabodyhidden').firstChild.cloneNode(true); $('secqaabody').appendChild(newnode)">[+]</a></td>
	  <?php if(!$admin_cityid){?>
	  <td bgcolor="white">
        <select name="newcityid[]">
       	<option value="0">Master Site</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
        <?}else{?>
		<input name="newcityid[]" type="hidden" value="<?php echo $admin_cityid; ?>">
	  </td>
	  <?php }?>
      <td bgcolor="white"><input name="newlifename[]" value="" type="text" class="text"/></td>
      <td><select name="newtypeid[]"><?php echo get_servtype_options($typeid);?></select></td>
      <td bgcolor="white"><input name="newlifeurl[]" value="" type="text" class="text"/></td>
      <td><input name="newdisplayorder[]" value="0" type="text" class="txt"/></td>
      <td bgcolor="white"><select name="newif_view[]">
      <?=get_ifview_options(2)?>
      </select></td>
   </tr>
   </tbody>
   
   <tbody id="secqaabodyhidden" style="display:none">
       <tr align="center" bgcolor="white">
      <td align="center">&nbsp;</td>
	  <?php if(!$admin_cityid){?>
	  <td bgcolor="white">
        <select name="newcityid[]">
       	<option value="0">Master Site</option>
        <?php echo get_cityoptions($cityid); ?>
       </select>
        <?}else{?>
		<input name="newcityid[]" type="hidden" value="<?php echo $admin_cityid; ?>">
	  </td>
	  <?php }?>
      <td bgcolor="white"><input name="newlifename[]" value="" type="text" class="text"/> </td>
      <td><select name="newtypeid[]"><?php echo get_servtype_options($typeid);?></select></td>
      <td bgcolor="white"><input name="newlifeurl[]" value="" type="text" class="text"/></td>
      <td><input name="newdisplayorder[]" value="0" type="text" class="txt"/></td>
      <td bgcolor="white"><select name="newif_view[]">
      <?=get_ifview_options(2)?>
      </select></td>
       </tr>
   </tbody>
</table>
</div>
<center>
<input class="mymps large" value="Submit" name="<?=CURSCRIPT?>_submit" type="submit"> &nbsp;
</center>
</form>
<div class="pagination"><?php echo page2()?></div>  
<?php mymps_admin_tpl_global_foot();?>
