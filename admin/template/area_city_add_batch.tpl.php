<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="?part=area_city_add">Add A Sub-site</a></li>
				<li><a href="?part=area_city_add&action=batch" class="current">Add Sub-site by Batches</a></li>
            </ul>
        </div>
    </div>
</div>
<?php if($step == '2'){?>
<form name="form_mymps" action="?" method="post">
<input name="step" value="2" type="hidden">
<input name="batchnewprovinceid" value="<?php echo $batchnew[provinceid]; ?>" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="80">From Region</td>
	  <td width="80">Sub-site Name</td>
      <td>Storage Directory Name</td>
	  <td>Name in English</td>
	  <td>Initials</td>
	  <td>Second-level Domain Name</td>
	  <td>Order of City</td>
	  <td>Favourite City</td>
    </tr>
<?php if(is_array($array)) {foreach($array as $k => $v){?>
  <tr>
  <td><?php echo $provincename ? $provincename : '<font color=red>Individual </font>'; ?></td>
  <td><input name="batchnewcityname[]" value="<?php echo $v['cityname']; ?>" class="txt" type="text"/></td>
  <td><input name="batchnewdirectory[]" class="txt" type="text" value="<?php echo $v['directory']; ?>"></td>
  <td><input name="batchnewcitypy[]" class="text" type="text" value="<?php echo $v['citypy']; ?>"></td>
  <td><input name="batchnewfirstletter[]" class="txt" type="text" value="<?php echo $v['firstletter']; ?>"></td>
  <td><input name="batchnewdomain[]" class="text" type="text" value="<?php echo $v['domain']; ?>"></td>
  <td><input name="batchnewdisplayorder[]" class="txt" type="text" value="<?php echo $v['displayorder']; ?>"></td>
  <td><input name="batchnewifhot[]" type="checkbox" class="checkbox"></td>
  </tr>
<?php }}?>
<?php if($repeatwarning){?>
	<tr>
		<td colspan="8" bgcolor="#f6ffdd"><?php echo $repeatwarning; ?></td>
	</tr>
<?php }?>
</table>
</div>
<center><input type="button" onclick="history.go(-1);" value="< Return" class="gray large"/> &nbsp; <input name="<?=CURSCRIPT?>_submit" type="submit" value="Next >" class="mymps large"/></center>
</form>
<?php }else{?>
<form method="post" name="form" action="?">
<input name="step" value="1" type="hidden">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
  <td colspan="2" align="left">Create Suib-site for City</td>
</tr>
<tr bgcolor="#ffffff">
  <td width="15%" valign="top">From Region:  </td>
  <td>
  <select name="batchnew[provinceid]">
  <option value="0">Individual</option>
  <?php if(is_array($province)){foreach($province as $k => $v){?>
  <option value="<?=$v[provinceid]?>"><?=$v[provincename]?></option>
  <?php }}?>
  </select></td>
</tr>

<tr bgcolor="#ffffff">
  <td width="15%" valign="top">City Name: </td>
  <td><textarea name="batchnew[cityname]" id="newcityname" style="width:400px; height:200px;"></textarea> <font color="red">*</font><div style="color:#666; margin-top:5px">For multiple sub-site names, separate each of them with a space, like KLumpor Malaka Johor.</div></td>
</tr>
</table>
</div>
<center>
<input type="submit" name="<?=CURSCRIPT?>_submit" value="ÏÂÒ»²½" class="mymps large"/>
&nbsp;&nbsp;
</center>
</form>
<?php }?>
<?php mymps_admin_tpl_global_foot();?>
