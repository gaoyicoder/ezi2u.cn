<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="document.php?do=document" <?php if($do == 'document'){?>class="current"<?php }?>>Posted File</a></li>
				<li><a href="document.php" <?php if($do == 'type'){?>class="current"<?php }?>>File Module Management</a></li>
			</ul>
		</div>
	</div>
</div>
<form method=post onSubmit="return chkform()" name="form1" action="?part=edit">
<input name="typeid" value="<?=$edit[typeid]?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td colspan="2">Member File Module Basic Information
</td>
</tr>
<tr bgcolor="#f5fbff">
  <td width="15%">Module Name:  </td>
  <td><input name="typename" type="text" class="text" id="title" value="<?=$edit[typename]?>" size="30"> 
  		<font color="red">*</font></td>
</tr>
<tr bgcolor="#f5fbff">
    <td>Module Type:  </td>
    <td>
    <select name="arrid">
      <?=get_docuarr_options($edit[arrid])?>
      </select>
    </td>
</tr>
<tr bgcolor="#f5fbff">
  <td>Enabled/Disabled: </td>
  <td><select name="ifview">
      <?=get_ifview_options($edit[ifview])?>
      </select>  </td>
</tr>
<tr bgcolor="#f5fbff">
  <td>Order of Display:  </td>
  <td><input name="displayorder" type="text" class="txt" value="<?=$edit[displayorder]?>" size="13"></td>
</tr>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="Save Changes" class="mymps mini" />¡¡
<input type="button" onclick="location.href='?'" value="Return" class="mymps mini">
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
