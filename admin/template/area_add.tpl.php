<?php mymps_admin_tpl_global_head();?>

<form method=post onSubmit="return chkform()" name="form" action="?part=add">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<tr class="firstr">

  <td colspan="2" align="left">Add District for Sub-site</td>

</tr>

<tr bgcolor="#ffffff">

  <td width="15%">District Name: </td>

  <td>

  <textarea rows="3" name="newarea[areaname]" cols="50"></textarea><br />

<div style="margin-top:3px">The system supports adding districts by batches. To do it, separate each district with | . <br />

<font color="red">Example:  District 1|District 2|Disterict 3|District 4|District 5</font></div></td>

</tr>

<tr bgcolor="#ffffff">

  <td >From Sub-site:  </td>

  <td>

  <select name="newarea[cityid]">

  <?php if(is_array($city_area)){

  	foreach($city_area as $k => $v){

  ?>

    <option value="<?=$v['cityid']?>"><?=$v['firstletter']?>.<?=$v['cityname']?></option>

  <?

  	}   } else {

   ?>

   		<option value="0" disabled="disabled">You have not yet created a sub-site for the city, please create one before continuing. </option>

   <?

  		}

  ?>

  </select>

  </td>

</tr>

<tr bgcolor="#ffffff">

  <td >District Order: </td>

  <td><input name="newarea[displayorder]" class="txt" type="text" value=""></td>

</tr>

</table>

</div>

<center>

<input type="submit" name="<?=CURSCRIPT?>_submit" value="Submit" class="mymps large"/>

&nbsp;&nbsp;

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

