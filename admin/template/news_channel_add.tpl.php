<?php mymps_admin_tpl_global_head();?>

<script language=javascript>

function chkform(){

	if(document.form1.catname.value==""){

		alert('Please enter Column Name!');

		document.form1.catname.focus();

		return false;

	}

}

</script>

<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">

    <div class="mpstopic-category">

        <div class="panel-tab">

            <ul class="clearfix tab-list">

                <li><a title="Added News Category" href="channel.php" <?php if($part == 'list'){?>class="current"<?php }?>>Added News Category</a></li>

                <li><a title="Add News Category" href="channel.php?part=add" <?php if($part == 'add'){?>class="current"<?php }?>>Add News Category</a></li>

            </ul>

        </div>

    </div>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Hint</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

  <li>When column is not enabled, it is stored only as a categorization tool and can be enabled when needed.</li>

    </td>

  </tr>

</table>

</div>

<form method=post onSubmit="return chkform()" name="form1" action="?part=add">

<div id="<?=MPS_SOFTNAME?>">

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

<td colspan="2">

Column Basic Information

</td>

</tr>

<tbody id="menu_1">

<tr bgcolor="#f5fbff">

  <td width="15%">Column Name:  </td>

  <td><textarea rows="5" name="catname" cols="50"></textarea><br />

<div style="margin-top:3px">The system supports adding news categories by batches. To do it, separate each category with | . <br />

<font color="red">Example:  Category1| Category2| Category3| Category4| Category5</font></div></td>

</tr>

<tr bgcolor="#f5fbff">

  <td>From Column:  </td>

  <td><select name="parentid" id="parentid" >

    <option value="0">Set as Root Column...</option>

<?php echo cat_list('channel');?>

  </select>  </td>

</tr>

<tr bgcolor="#f5fbff">

  <td>Sorting Order of Columns:  </td>

  <td><input name="catorder" type="text" class="txt" id="catorder" value="<?=$maxorder?>" size="13"></td>

</tr>

<tr bgcolor="#f5fbff">

  <td>Enable/Disable:  </td>

  <td><select name="isview">

      <?=get_ifview_options($cat[if_view])?>

      </select></td>

</tr>

<tr bgcolor="#f5fbff">

  <td>Format of Directory Saving: <br /><i style="color:#666">Enabled when creating static directory</i> </td>

  <td><?=GetHtmlType('3','dir_type','add')?></td>

</tr>

</tbody>

</table>

</div>

<center>

<input type="submit" value="Confirm and Submit" name="<?=CURSCRIPT?>_submit" class="mymps mini" />��

<input type="button" onClick=history.back() value="Return" class="mymps mini">

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

