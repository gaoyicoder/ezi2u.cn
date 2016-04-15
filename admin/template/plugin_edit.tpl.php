<?php mymps_admin_tpl_global_head();?>
<form action="plugin.php" method="post" name="form1">
<input name="op" value="edit" type="hidden">
<input name="id" value="<?=$id?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td colspan="5">
       		Plug-in Details - <?php echo $edit['name']; ?>
        </td>
      </tr>
      <tbody id="menu_1">
	  <tr bgcolor="#f5fbff">
        <td width="19%" height="25">Plug-in Name</td>
        <td><?php echo $edit['name']; ?></td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Plug-in Mark</td>
        <td><?php echo $edit['flag']; ?></td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Plug-in Directory</td>
        <td>/plugin/<?php echo $edit['directory']; ?></td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td width="19%" height="25">Version</td>
        <td><?php echo $edit['version']; ?></td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td width="19%" height="25">Maker</td>
        <td><?php echo $edit['author']; ?>    
		</td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Time Of Release</td>
        <td><?php echo GetTime($edit['releasetime']); ?> </td>
      </tr>
      <tr class="firstr">
        <td colspan="5">
            Foreground Settings
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25"><strong>Display Caption</strong><br />Use <font color="red">{city}</font> to replace sub-site name</td>
        <td><input name="config[seotitle]" value="<?php echo $edit[config][seotitle]?>" class="text" type="text"></td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25"><strong>Meta Keywords</strong><br />Use <font color="red">{city}</font> to replace sub-site name</td>
        <td><input name="config[seokeywords]" value="<?php echo $edit[config][seokeywords]?>" class="text" type="text"></td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25"><strong>Meta Description</strong><br />Use <font color="red">{city}</font> to replace sub-site name</td>
        <td><textarea name="config[seodescription]" style="width:300px; height:100px"><?php echo $edit[config][seodescription]?></textarea></td>
      </tr>
      <tr class="firstr">
        <td colspan="5">
            Menu Settings
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Management Centre Menu<br /><i style="color:#666">No changes should be made unless necessary.£¨<font color="red">Important</font>£©</i></td>
        <td><textarea name="config[adminmenu]" style="width:300px; height:100px"><?php echo $edit[config][adminmenu]?></textarea></td>
      </tr>
	  <?php if($edit['flag'] == 'goods'){?>
	  <tr class="firstr">
        <td colspan="5">
            Public Information
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">Redeem</td>
        <td><textarea name="config[quhuo]" style="width:300px; height:100px"><?php echo $edit[config][quhuo]?></textarea></td>
      </tr>
	  <tr bgcolor="#f5fbff">
        <td height="25">Terms&Conditions</td>
        <td><textarea name="config[fukuan]" style="width:300px; height:100px"><?php echo $edit[config][fukuan]?></textarea></td>
      </tr>
	  <tr bgcolor="#f5fbff">
        <td height="25">Other</td>
        <td><textarea name="config[service]" style="width:300px; height:100px"><?php echo $edit[config][service]?></textarea></td>
      </tr>
	  <?php }?>
      </tbody>
      </table>
</div>
<center><input type="submit" name="plugin_submit" value="Submit" class="mymps large" /></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
