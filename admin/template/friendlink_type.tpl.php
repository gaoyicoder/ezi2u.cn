<?php mymps_admin_tpl_global_head();?>
<script language='javascript'>
function CheckSubmit()
{
	if(document.form1.typename.value=="")
	{
   		document.form1.typename.focus();
   		alert("Site Type cannot be Empty!");
   		return false;
	}
	return true;
}
</script>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="friendlink.php?part=list">Added Related Sites</a></li>
                <li><a href="friendlink.php?part=add" <?php if($part=='add'){?>class="current"<?php }?>>Add Related Site</a></li>
                <?php if(!$admin_cityid){?><li><a href="friendlink.php?do=type" <?php if($do=='type'){?>class="current"<?php }?>>Site Type Management</a></li><?php }?>
            </ul>
        </div>
    </div>
</div>

<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="40" align="center" valign="top">Type ID</td>
      <td align="center" valign="top">Type Name</td>
      <td width="36%" align="center">Type</td>
    </tr>
    <?php 
    foreach($links AS $row){
    ?>
    <form action="?do=type" method="post" name="form2";>
    <input name="part" value="update" type="hidden"/>
    <input name="id" value="<?=$row[id]?>" type="hidden"/>
    <tr bgcolor="#f5fbff">
      <td align="center"><?=$row[id]?></td>
      <td valign="top"><input name="typename" value="<?=$row[typename]?>" type="text" class=text style="width:90%" /> </td>
      <td align="center">
	  <input type="submit" value="Change" class="gray mini"/>¡¡<input type="button" onClick="location.href='?do=type&part=delete&id=<?=$row[id]?>'" value="Delete" class="gray mini"/>	   </td>
    </tr>
    </form>
    <?php
	}
	?>
    <tr class="firstr">
      <td colspan="5" align="left"><strong>Add a New Site Type: </strong></td>
    </tr>
    <form action="friendlink.php?do=type" method="post" enctype="multipart/form-data" name="form1" onSubmit="return CheckSubmit();";>
    <input name="part" value="insert" type="hidden"/>
    <tr bgcolor="#f5fbff">
      <td colspan="2" valign="top">
      <input name="typename" type="text" class=text style="width:70%" />
      </td>
      <td align="center">
      <input type="submit" name="submit" value="Add" class="mymps mini"/>
        </td>
    </tr>
   </form>
</table>
</div>
<?php mymps_admin_tpl_global_foot();?>
