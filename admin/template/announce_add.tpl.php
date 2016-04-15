<?php mymps_admin_tpl_global_head();?>
<script language='javascript'>
function CheckSubmit()
{
	if(document.form1.title.value=="")
	{
   		document.form1.title.focus();
   		alert("Please type in the announcement title!");
   		return false;
	}
	if(document.form1.author.value=="")
	{
   		document.form1.author.focus();
   		alert("Please type in the name of the author!!");
   		return false;
	}

	return true;
}
</script>
<form method=post  name="form1" action="announce.php?part=insert" onSubmit="return CheckSubmit();">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">
<td colspan="2"><b>Add Site Announcement</b></td>
</tr>
<?php if(!$admin_cityid){?>
<tr bgcolor="#f5fbff">
    <td align="right">From Sub-site£º</td>
    <td>
    <select name="cityid">
    <option value="0">Master Site</option>
    <?php echo get_cityoptions($cityid); ?>
   </select>
    </td>
</tr>
<?}else{?>
<input name="cityid" type="hidden" value="<?php echo $admin_cityid; ?>">
<?php }?> 
<tr bgcolor="#f5fbff" >
  <td width="12%" align="right">Announcement Title£º </td>
  <td colspan="3"> <input name="title" class="text" type="text" value="" size="50"> 
  <select name="titlecolor">
  <option value="">Default Colour of Announcement Title</option>
  <?foreach ($mymps_title_color as $k){?>
  <option value="<?=$k?>" style="background-color:<?=$k?>;"></option>
  <?}?>
  </select><font color="red">*</font></td>
</tr>
<tr bgcolor="#f5fbff" >
  <td width="12%" align="right">Announcement Starts From</td>
  <td><input id="datepicker1" readonly="readonly" name="begintime" class="text" type="text"/> 
  Please fill in the date with format of yyyy-mm-dd. If there is no need to specify the starting date of the announcement, please leave it blank.</td>
</tr>
<tr bgcolor="#f5fbff" >
  <td width="12%" align="right">Announcement Ends By</td>
  <td><input id="datepicker2" readonly="readonly" name="endtime" class="text" type="text"/> 
  Please fill in the date with format of yyyy-mm-dd. If there is no need to specify the ending date of the announcement, please leave it blank.</td>
</tr>
<tr bgcolor="#f5fbff" >
  <td width="12%" align="right">Jump to</td>
  <td>
    <input name="redirecturl" class="text" type="text" value="" size="50"> If this part is filled, then you will not need to fill in the following parts
  </td>
</tr>
<tr bgcolor="#f5fbff" >
  <td width="12%" align="right">Author</td>
  <td><input name="author" class="text" type="text" style="width:100px" value="<?=$admin_name?>"><font color="red">*</font></td>
</tr>
</table>
<div style="margin-top:3px;">
<?php echo $acontent?>
</div>
</div>
<center><input type="submit" value="Submit" class="mymps large"/></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
