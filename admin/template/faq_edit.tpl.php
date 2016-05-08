<?php mymps_admin_tpl_global_head();?>

<script language='javascript'>

function CheckSubmit()

{

	if(document.form1.typeid.value=="")

	{

   		document.form1.typeid.focus();

   		alert("Please select help category!");

   		return false;

	}

	if(document.form1.title.value=="")

	{

   		document.form1.title.focus();

   		alert("Please enter topic title!");

   		return false;

	}



	if(document.form1.content.value=="")

	{

   		document.form1.content.focus();

   		alert("Please enter topic content!");

   		return false;

	}



	return true;

}

</script>

<form method=post  name="form1" action="?part=edit&id=<?=$edit[id]?>" onSubmit="return CheckSubmit();">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<input name="action" type="hidden" value="dopost">

<tr bgcolor="#f5fbff" >

  <td width="10%" align="right">From Category:  </td>

  <td colspan="3">

  <select name="typeid">

  	<?php foreach($faq_type as $k){?>

    <option value="<?=$k[id]?>"<?php if($edit[typeid] == $k[id])echo "selected";?>><?=$k[typename]?></option>

    <?}?>

  </select> <font color="red">*</font></td>

</tr>

<tr bgcolor="#f5fbff" >

  <td width="10%" align="right">Topic Title:  </td>

  <td colspan="3"> <input name="title" type="text" class="text" value="<?=$edit[title]?>" size="50"> <font color="red">*</font></td>

</tr>

</table>

<div style="margin-top:3px;">

<?php echo $acontent?>

</div>

</div>

<center><input type="submit" value="Submit" class="mymps large"/></center>

</form>

<?php mymps_admin_tpl_global_foot();?>

