<?php mymps_admin_tpl_global_head();?>
<?php if($do == 'admin'){?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="?do=<?=$do?>&part=login" <?php if($part == 'login'){?>class="current"<?php }?>>Manage Log-in Records</a></li>
				<li><a href="?do=<?=$do?>&part=action" <?php if($part == 'action'){?>class="current"<?php }?>>Manage Operation Records</a></li>
			</ul>
		</div>
	</div>
</div>
<?} ?>
<div class="ccc2">
	<ul>
      <form action="?" name="form1" method="get">
        <select name="result">
            <option value=""<?php if(empty($result))echo "selected";?>>Filter&raquo;&nbsp;&nbsp;All Log-in Records</option>
            <option value="false"<?php if($result == 'false')echo "selected";?>>Filter&raquo;&nbsp;&nbsp;Log-in Failure Records</option>
            <option value="true"<?php if($result == 'true')echo "selected";?>>Filter&raquo;&nbsp;&nbsp;Log-in Success Records</option>
        </select>
      &nbsp;&nbsp;
     	<input name="keywords" class="text" value="<?=$keywords?>">
        <input name="do" value="<?=$do?>" type="hidden">
        <input name="part" value="login" type="hidden">
        <input type="submit" value="Blur Search" class="gray mini">&nbsp;&nbsp;
     </form>
	</ul>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <form name='form1' method='post' action='?do=<?=$do?>&part=<?=$part?>' onSubmit='return checkSubmit();'>
    <input type='hidden' name='action' value='delall'/>
    <input name="url" type="hidden" value="<?=GetUrl()?>">
    <tr class="firstr">
    <td width="30">Select</td>
    <td align="center">Try User ID</td>
    <td align="center">Try Password</td>
    <td align="center">IP Address</td>
    <td align="center">Time</td>
    <td align="center">Online/Offline</td>
    </tr>
  	<tbody onmouseover="addMouseEvent(this);">
    <?
foreach($record AS $k)
{
?>
    <tr align="center" bgcolor="white">
    <td><input type='checkbox' class="checkbox" name='id[]' value='<?=$k[id]?>' id="<?=$k[id]?>"></td>
    <td><?=$k[adminid]?></td>
    <td><?if($k[result] == '0'){echo $k[adminpwd];}else{echo "******";}?></td>
    <td><?=$k[ip]?></td>
    <td><em><?=$k[pubdate]?></em></td>
    <td><?php 
    if($k[result] == '0'){echo "<font color=red>Log-in Failed</font>";}else{echo "<font color=green>Log-in Successful</font>";}?></td>
  </tr>
    <?
}
?>	</tbody>
    <tr bgcolor="#ffffff" height="28">
    <td align="center" style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" class="checkbox" id="checkall" onClick="CheckAll(this.form)"/></td>
    <td colspan="10"><input type="submit" onClick="if(!confirm('Are you sure you want to continue? \n\n This cannot be undone!'))return false;" value="Delete by Batches" class="mymps mini" <?php if($do == 'admin'){echo "disabled";}?>/>  
         <input type="button" value="Save only the latest<?=$mymps_mymps['cfg_record_save']?>Records" class="mymps mini" onclick="location.href='?do=<?=$do?>&part=<?=$part?>&action=delrecord&url=<?=urlencode(GetUrl())?>'">    
    </td>
    </tr>
    </form>
</table>
</div>
<div class="pagination"><?echo page2()?></div>
<?php mymps_admin_tpl_global_foot();?>
