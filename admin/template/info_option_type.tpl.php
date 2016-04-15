<?php mymps_admin_tpl_global_head();?>
<script language='javascript'>
function CheckSubmit()
{
	if(document.form1.typename.value=="")
	{
   		document.form1.typename.focus();
   		alert("Field category cannot be empty!");
   		return false;
	}
	return true;
}
</script>
<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="40" align="center" valign="top">Category  ID</td>
      <td align="center" valign="top">Category Name</td>
      <td width="36%" align="center">Status</td>
    </tr>
    <?php 
    foreach($type AS $row){
    ?>
    <form action="info_type.php?part=option_type&action=update&id=<?=$row[optionid]?>" method="post" name="form2";>
    <tr bgcolor="#f5fbff">
      <td align="center"><?=$row[optionid]?></td>
      <td valign="top"><input name="title" value="<?=$row[title]?>" type="text" class="text" style="width:90%" /> </td>
      <td align="center">
	  <input type="submit" value="Change" class="gray mini"/>¡¡
      <input type="button" onClick="location.href='?part=option_type&action=del&id=<?=$row[optionid]?>'" value="Delete" class="gray mini"/></td>
    </tr>
    </form>
    <?php
	}
	?>
    <tr class="firstr">
      <td colspan="5" align="left"><strong>Add a field category: </strong></td>
    </tr>
    <form action="?part=option_type&action=insert" method="post" name="form1" onSubmit="return CheckSubmit();";>
    <tr bgcolor="#f5fbff">
      <td colspan="2" valign="top">
      <input name="title" type="text" class="text" style="width:70%" />
      </td>
      <td align="center">
      <input type="submit" name="submit" value="Add" class="mymps mini"/>
        </td>
    </tr>
   </form>
</table>
</div>
<?php mymps_admin_tpl_global_foot();?>
