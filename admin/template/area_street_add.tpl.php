<?php mymps_admin_tpl_global_head();?>
<form method=post onSubmit="return chkform()" name="form" action="?part=add">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
  <td colspan="2" align="left">Add Street/Road to District</td>
</tr>
<tr bgcolor="#ffffff">
  <td width="15%">Street/Road Name: </td>
  <td>
  <textarea rows="3" name="newstreet[streetname]" cols="50"></textarea><br />
<div style="margin-top:3px">The system supports adding streets/roads by batches. To do it, separate each street/road with space.<br />
<font color="red">Example: Street1 Street2 Street3 Street4 Street5</font></div></td>
</tr>
<tr bgcolor="#ffffff">
  <td >From District: </td>
  <td>
  <select name="newstreet[areaid]">
  <?php if(is_array($city_area)){
  	foreach($city_area as $k => $v){
  ?>
  <optgroup label="<?=$v['firstletter']?>.<?=$v['cityname']?>">
	<?php if(is_array($v['area'])){foreach($v['area'] as $t => $w){?>
    	<option value="<?=$w['areaid']?>"><?=$w['areaname']?></option>
    <?php }}else {?>
    	<option value="0" disabled="disabled">You have not yet added any districts for the sub-site, please add a district before continuing.</option>
    <?}?>
  </optgroup>
  <?
  	}
  		}else{
  ?>
  	<option value="0" disabled="disabled">You have not yet created any sub-sites, please create a sub-site before continuing.</option>
  <?php }?>
  </select>
  </td>
</tr>
<tr bgcolor="#ffffff">
  <td >Sort Streets/Roads: </td>
  <td><input name="newstreet[displayorder]" class="txt" type="text"></td>
</tr>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="Submit" class="mymps large"/>
&nbsp;&nbsp;
</center>
</form>
<?php mymps_admin_tpl_global_foot();?>
