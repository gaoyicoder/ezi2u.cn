<?php mymps_admin_tpl_global_head();?>

<script language=javascript>

function chkform(){

	if(document.form.corpname.value==""){

		alert('Please enter category names for sellers, and separate each category with | !');

		document.form.corpname.focus();

		return false;

	}

}

</script>

<form method=post onSubmit="return chkform()" name="form" action="?part=add">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr bgcolor="#f5fbff">

  <td >Category Name </td>

  <td>

  <textarea rows="5" name="corpname" cols="50"></textarea><br />

<div style="margin-top:3px">The system supports adding seller categories by batches. To do it, separate each category with | . <br />

<font color="red">Example:  Category1|Category2 Category3|Category4|Category5</font></div></td>

</tr>

<tr bgcolor="#f5fbff">

  <td >From Category </td>

  <td><select name="parentid" id="parentid" >

    <option value="0">Set as Root category...</option>

	<?=cat_list('corp',0,'',true,1)?>

  </select>  </td>

</tr>

<tr bgcolor="#f5fbff">

  <td >Category Sorting </td>

  <td><input name="corporder" class="text" type="text" id="corporder" value="<?=$maxorder?>" size="14"></td>

</tr>

</table>

</div>

<center>

<input type="submit" name="<?=CURSCRIPT?>_submit" value="Submit & Save" class="mymps mini"/>

&nbsp;&nbsp;

<input type="button" onClick=history.back() value="Return" class="mymps mini"></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

