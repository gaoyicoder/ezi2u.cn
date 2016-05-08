<?php mymps_admin_tpl_global_head();?>

<script language=javascript>

function chkform(){

	if(document.form1.tpl_name.value==""){

		alert('Please Enter Template Name!');

		document.form1.tpl_name.focus();

		return false;

	}

	if(document.form1.tpl_path.value==""){

		alert('Please Enter Template Directory!');

		document.form1.tpl_path.focus();

		return false;

	}

}

</script>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

	<div class="mpstopic-category">

		<div class="panel-tab">

			<ul class="clearfix tab-list">

				<li><a href="member_tpl.php" class="current">Personal Space Template</a></li>

				<li><a href="member_comment.php">Comment on Personal Space</a></li>

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

  <li>When not enabled, it is stored only as link plan and can be enabled when needed.</li>

    </td>

  </tr>

</table>

</div>

<form method=post onSubmit="return chkform()" name="form1" action="?part=edit">

<input name="id" value="<?=$edit[id]?>" type="hidden">

<div id="<?=MPS_SOFTNAME?>">

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

<td colspan="2"><a href="javascript:collapse_change('1')">Basic Information on Navigation</a>

</td>

</tr>

<tr bgcolor="#f5fbff">

  <td width="15%">Template Name:  </td>

  <td><input name="tpl_name" type="text" class="text" id="title" value="<?=$edit[tpl_name]?>" size="30"> 

  		<font color="red">*</font></td>

</tr>

<tr bgcolor="#f5fbff">

  <td width="15%">Template Directory/Mark:  </td>

  <td><input name="tpl_path" type="text" class="text" id="title" value="<?=$edit[tpl_path]?>" size="30">

  		<font color="red">*</font></td>

</tr>

<tr bgcolor="#f5fbff">

  <td>Enable/Disabled:  </td>

  <td><select name="isview">

    <?=get_ifview_options($edit[if_view])?>

    </select>  </td>

</tr>

<tr bgcolor="#f5fbff">

  <td>Sorting Order of Items in Navigation:  </td>

  <td><input name="displayorder" type="text" class="txt" value="<?=$edit[displayorder]?>" size="13"></td>

</tr>

</table>

</div>

<center>

<input type="submit" name="<?=CURSCRIPT?>_submit" value="Save Changes" class="mymps mini" />��

<input type="button" onclick="location.href='?'" value="Return" class="mymps mini">

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

