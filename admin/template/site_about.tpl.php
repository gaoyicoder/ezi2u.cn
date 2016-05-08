<?php mymps_admin_tpl_global_head();?>

  <form action="?part=list" method="post">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

      <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/>Delete?</td>

      <td valign="top">Column Name</td>

      <td>Column Directory</td>

      <td valign="top">Order of Columns</td>

      <td valign="top">Edit</td>

    </tr>

    <?php 

    foreach($about_type AS $row){

    ?>

    <tr bgcolor="#f5fbff">

          <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$row[id]?>' id="<?=$row[id]?>"></td>

      <td valign="top" bgcolor="white"><?=$row[typename]?></td>

      <td align="center"><?=$row[dir_typename]?></td>

      <td align="center" bgcolor="white"><input name="displayorder[<?=$row[id]?>]" value="<?=$row[displayorder]?>" type="text" class="txt"/></td>

      <td align="center"><a href="?part=<?=$part?>&id=<?=$row[id]?>">Details</a></td>

    </tr>

    <?php

	}

	?>

</table>

</div>

<center><input type="submit" name="site_about_submit" value="Submit" class="mymps large"></center>

</form>

<form action="site_about.php?part=edit" method="post">

<input type="hidden" name="id" value="<?=$id?>">

<div id="<?=MPS_SOFTNAME?>" style="margin-top:10px; clear:both">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

<td colspan="2"><?php echo !$id ? 'Add' : 'Change' ;?>Column</td>

</tr>

  <tr bgcolor="#f5fbff">

    <td width="12%" height="25">Column Name: </td>

    <td>

    <input name="typename" value="<?=$about[typename]?>" class="text"/>

    </td>

  </tr>

  <tr bgcolor="#f5fbff">

    <td width="12%" height="25">Order of Columns: </td>

    <td>

    <input name="displayorder" value="<?=$about[displayorder]?>" class="txt"/>

    </td>

  </tr>

<tr bgcolor="#f5fbff">

  <td>Directory Saving Style: <br /><i style="color:#666">Enabled Upon Creation of Static File</i> </td>

  <td><?=GetHtmlType($about[dir_type],'dir_type','edit',$about[dir_typename])?> </td>

</tr>

</table>

<div style="margin-top:3px;">

<?php echo $acontent; ?>

</div>

</div>

<center><input type="submit" name="site_about_submit" value="Submit" class="mymps large"/></center>

  </form>

<?php mymps_admin_tpl_global_foot();?>

