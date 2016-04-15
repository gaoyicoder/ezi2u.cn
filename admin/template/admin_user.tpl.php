<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?do=user" class="current">Admin Table</a></li>
                <li><a href="?do=user&part=add">Add Admin</a></li>
            </ul>
            <?php if(!$admin_cityid){?>
            <ul style="float:right; text-align:right">
               <select name="cityid" onChange="location.href='?do=user&cityid='+(this.options[this.selectedIndex].value)">
                <option value="0">General Station</option>
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
  	<td colspan="2">Related Explain</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip" colspan="2">
 <li>Branch admin can only change branch's information</li>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
    <td align="center">Branch</td>
    <td align="center">User ID</td>
    <td width="100" align="center">Write name</td>
    <td width="100" align="center">Given name</td>
    <td width="50" align="center">Group</td>
    <td align="center">Last Loging</td>
    <td align="center">Admin item</td>
  </tr>
    <?
foreach($admin AS $row)
{
if($row[id] == 1 && $admin_id != 1){}else{
?>
    <tr align="center" bgcolor="#ffffff">
    <td><b><?=$allcities[$row['cityid']]['cityname'] ? $allcities[$row['cityid']]['cityname'] : 'General Station'?></b>&nbsp;</td>
    <td><?=$row[userid]?>&nbsp;</td>
    <td><?=$row[uname]?>&nbsp;</td>
    <td><?=$row[tname]?>&nbsp;</td>
    <td><?=$row[typename]?>&nbsp;</td>
    <td><em>Time<?=GetTime($row[logintime])?>&nbsp;<?=$row[loginip]?></em></td>
    <td>
	  <a href='admin.php?do=user&part=edit&id=<?=$row[id]?>'><u>Change</u></a> |
     <a href='admin.php?do=user&part=delete&id=<?=$row[id]?>' onClick="return confirm('Are you sure to delete?')"><u>Delete</u></a>  
    </td>
  </tr>

    <?}
}
?>
</table>
</div>
<?php mymps_admin_tpl_global_foot();?>
