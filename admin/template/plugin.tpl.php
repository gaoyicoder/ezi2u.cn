<?php mymps_admin_tpl_global_head();?>
<!--<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Notice</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
 <li>Plug-in directory denotes the directory within /plugin where the plug-in is stored, so please upload the new plug-in to the directory /plugin before installing.</li>
    </td>
  </tr>
</table>
</div>-->
<form action="?part=list" method="post">
<input name="url" type="hidden" value="<?=GetUrl()?>">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr style="font-weight:bold; background-color:#dff6ff">
      <td>Number</td>
      <td>Name</td>
      <td>Mark</td>
      <td>Directory</td>
      <td>Version</td>
      <td>Maker</td>
      <td>Time of Release</td>
      <td>Core</td>
      <td>Operation</td>
    </tr>
    <?php foreach($plugin as $list){?>
    <tr bgcolor="white">
     	<td><i><?=$list[id]?>.</i></td>
        <td><b><?=$list[name]?></b></td>
        <td><?=$list[flag]?></td>
        <td><?=$list[directory]?></td>
        <td align="left"><?=$list[version]?></td>
        <td align="left"><?=$list[author]?></td>
        <td align="left"><?=GetTime($list[releasetime])?></td>
        <td><?php echo $list[iscore] == 1 ? 'Y' : 'N'; ?></td>
        <td align="left"><?php if($list[iscore] != 1){?><a href="plugin.php?op=edit&id=<?=$list[id]?>">Configuration</a> | <a href="../<?=$list[flag]?>.php" target="_blank">Homepage for Preview</a> | <?php if($list[disable] == 0){?><a href="?op=disable&id=<?=$list[id]?>" style="color:red">Disable>></a><?}else{?><a href="?op=able&id=<?=$list[id]?>" style="color:green">Enable>></a><?}?> <?php } else {?>N/A<?php }?></td>
    </tr>
    <?php }?>
	<!--<tr bgcolor="#FFFFFF" valign="top">
      <td align="center"><b>Install</b></td>
      <td bgcolor="#f5fbff" ><input name="add[name]" value="" type="text" class="text" style="width:100px"/></td>
      <td><input name="add[flag]" value="" type="text" class="text" style="width:100px"/></td>
      <td bgcolor="#f5fbff"><input name="add[directory]" type="text" class="text" style="width:100px; margin-bottom:2px"><br />Within /plugin Directoy</td>
      <td><input name="add[version]" type="text" class="text" style="width:100px"></td>
      <td bgcolor="#f5fbff"><input name="add[author]" type="text" class="text" style="width:100px"></td>
      <td colspan="3"> -> Please Upload Plug-in to /plugin directory first!</td>
    </tr>-->
</table>
</div>
<center><input type="submit" value="Update Plug-in Cache" class="mymps large" name="<?=CURSCRIPT?>_submit"/></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
