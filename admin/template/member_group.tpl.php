<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="?do=group" <?php if($part == 'list'){?>class="current"<?php }?>>Member Group Category</a></li>
				<li><a href="?do=group&part=add" <?php if($part == 'add'){?>class="current"<?php }?>>Add Member Group</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="60">Group Number</td>
      <td width="80">Group Name</td>
      <td width="80">Properties</td>
      <td>Manage</td>
    </tr>
<?
foreach($group AS $row)
{
?>
    <tr align="center" bgcolor="#f5fbff">
      <td> 
        <?=$row[id]?>
      </td>
      <td>
      	<?=$row[levelname]?>
      </td>
      <td>
      	<?if($row[ifsystem] == "1"){echo"<font color=red>System Group</font>";}else{echo "<font color=green>Customized Group</font>";}?>
      </td>
      <td>
        <a href='member.php?do=group&part=edit&id=<?=$row[id]?>'>Edit</a> / 
      	<a href='member.php?do=member&levelid=<?=$row[id]?>'>Group User</a>
      <?php if($row[ifsystem]!=1){ ?> / <a href='?do=group&part=delete&id=<?=$row[id]?>' onClick="return confirm('Are you sure you want to delete this user group? If you are not, Please click on Cancel.')">Delete Group</a><?php } ?>
      </td>
    </tr>
<?
}
?>
</table>
</div>
<form action="member.php?part=levelup" method="post">
<div id="<?=MPS_SOFTNAME?>" style="margin-top:10px; clear:both">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
<td colspan="2">Notice on Member Upgrading Self-service Panel</td>
</tr>
  <tr bgcolor="#f5fbff">
    <td width="12%" height="25">Hints: </td>
    <td>
   	<textarea name="levelup_notice" style="width:250px; height:120px"><?php echo $levelup_notice; ?></textarea>
    </td>
  </tr>
</table>
</div>
<center><input type="submit" name="member_submit" value="Submit" class="mymps large"/></center>
  </form>
<?php mymps_admin_tpl_global_foot();?>
