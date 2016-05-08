<?php mymps_admin_tpl_global_head();?>

<script language=javascript>

function chkform(){

	if(document.form.corpname.value==""){

		alert('Please Enter Category Name!');

		document.form.corpname.focus();

		return false;

	}

}

</script>

<form method=post onSubmit="return chkform()" name="form" action="?part=edit">

<div id="<?=MPS_SOFTNAME?>">

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">

<input name="part" value="update" type="hidden">

<input type="hidden" name="corpid" value="<?=$corp[corpid]?>">

<tr bgcolor="#f5fbff">

  <td>Seller Category Name</td>

  <td> 

  <input name="corpname" class="text" type="text" id="corpname" value="<?=$corp[corpname]?>" size="30">

   <font color="red">*</font></td>

</tr>

<tr bgcolor="#f5fbff">

  <td>From Category </td>

  <td><select name="parentid" id="parentid" >

    	<option value="0">Set as Root category...</option>

		<?=cat_list('corp',0,$corp[parentid],true,1)?>

  </select>

  </td>

</tr>

<tr bgcolor="#f5fbff">

  <td>Category Sorting</td>

  <td><input name="corporder" class="text" type="text" id="corporder" value="<?=$corp[corporder]?>" size="30"></td>

</tr>

</table>

</div>

<center>

<input type="submit" name="<?=CURSCRIPT?>_submit" value="Submit & Save" class="mymps mini"/>

&nbsp;&nbsp;

<input type="button" onClick=history.back() value="Return" class="mymps mini">

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

