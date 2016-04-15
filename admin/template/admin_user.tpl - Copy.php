<?php include mymps_tpl('inc_head');?>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?do=user" class="current">Administrator List</a></li>
                <li><a href="?do=user&part=add">Add Administrator</a></li>
            </ul>
            <?php if(!$admin_cityid){?>
            <ul style="float:right; text-align:right">
               <select name="cityid" onChange="location.href='?do=user&cityid='+(this.options[this.selectedIndex].value)">
                <option value="0">Master Site</option>
                <?php echo get_cityoptions($cityid); ?>
               </select>
            </ul>
            <?php }?>
        </div>
    </div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Notes</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip" colspan="2">
 <li>After Logging in, a sub-site administrator can only make changes to informaion and posts on the corresponding sub-site.</li>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
    <td align="center">From Sub-site</td>
    <td align="center">Account Used to Log-in</td>
    <td width="100" align="center">Psudonym</td>
    <td width="100" align="center">Real Name</td>
    <td width="50" align="center">User Group</td>
    <td align="center">Last Time of Logging-in</td>
    <td align="center">Management Options</td>
  </tr>
    <?
foreach($admin AS $row)
{
if($row[id] == 1 && $admin_id != 1){}else{
?>
    <tr align="center" bgcolor="#ffffff">
    <td><b><?=$allcities[$row['cityid']]['cityname'] ? $allcities[$row['cityid']]['cityname'] : 'Master Site'?></b>&nbsp;</td>
    <td><?=$row[userid]?>&nbsp;</td>
    <td><?=$row[uname]?>&nbsp;</td>
    <td><?=$row[tname]?>&nbsp;</td>
    <td><?=$row[typename]?>&nbsp;</td>
    <td><em>Time£º<?=GetTime($row[logintime])?>&nbsp;¡¡IP£º<?=$row[loginip]?></em></td>
    <td>
	  <a href='admin.php?do=user&part=edit&id=<?=$row[id]?>'><u>Alter</u></a> |
     <a href='admin.php?do=user&part=delete&id=<?=$row[id]?>' onClick="return confirm('Are you sure you want to delete this administrator? If you are not, please click on Cancel.')"><u>Delete</u></a>¡¡
    </td>
  </tr>

    <?}
}
?>
</table>
</div>
<?php mymps_admin_tpl_global_foot();?>