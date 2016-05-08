<?php mymps_admin_tpl_global_head();?>

<script language='javascript'>

function CheckSubmit()

{

	if(document.form1.typename.value=="")

	{

   		document.form1.typename.focus();

   		alert("Site category cannot be empty!");

   		return false;

	}

	return true;

}

</script>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

      <td width="40"align="center" valign="top">Category ID</td>

      <td align="center" valign="top">Category Name</td>

      <td width="36%" align="center">Status</td>

    </tr>

    <?php 

    foreach($links AS $row){

    ?>

    <form action="friendlink_type.php" method="post" enctype="multipart/form-data" name="form2";>

    <input name="part" value="update" type="hidden"/>

    <input name="id" value="<?=$row[id]?>" type="hidden"/>

    <tr bgcolor="#f5fbff" onMouseOver="this.className='Ipt IptIn'"  onmouseout="this.className='Ipt'">

      <td align="center"><?=$row[id]?></td>

      <td valign="top"><input name="typename" value="<?=$row[typename]?>" type="text" class="text' class='pubinputs' style="width:90%" /> </td>

      <td align="center">

	  <input type="submit" value="Change" class="mymps mini"/>��<input type="button" onClick="location.href='friendlink_type.php?part=delete&typeid=<?=$row[id]?>'" value="Delete" class="mymps mini"/>	   </td>

    </tr>

    </form>

    <?php

	}

	?>

    <tr class="firstr">

      <td colspan="5" valign="top"><strong>Add a Member Category: </strong></td>

    </tr>

    <form action="friendlink_type.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="return CheckSubmit();";>

    <input name="part" value="insert" type="hidden"/>

    <tr bgcolor="#f5fbff" onMouseOver="this.className='Ipt IptIn'"  onmouseout="this.className='Ipt'">

      <td colspan="2" valign="top">

      <input name="typename" type="text" class="text' class='pubinputs' style="width:90%" />

      </td>

      <td align="center">

      <input type="submit" name="submit" value="Add" class="mymps mini"/>

        </td>

    </tr>

   </form>

    <tr>

      <td height="34" colspan="5" align="center" bgcolor="white">

      ��<input type="button" onClick=history.back() value="Return" class="mymps mini">    </td>

    </tr>



</table>

</div>

<?php mymps_admin_tpl_global_foot();?>

