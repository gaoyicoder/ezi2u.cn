<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Instruction</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
		<li>
	    Data sheet optimization can rid data files of fragments, making the recording more compacted and accelerating reading/writing process.</li>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
<div class="mpstopic-category">
	<div class="panel-tab">
		<ul class="clearfix tab-list">
			<li><a href="database.php?part=optimize">Database Optimization</a></li>
			<li><a href="database.php?part=check">Database Checking</a></li>
			<li><a href="database.php?part=repair">Database Restoration</a></li>
			<li><a href="data_replace.php" class="current">Database Content Change</a></li>
		</ul>
	</div>
</div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="vbm">
  <form action="data_replace.php" name="form1" method="post" target="stafrm" onSubmit="return CheckSubmit()">
  	<input type='hidden' name='part' value='do_action'>
    <tr class="firstr">
      <td colspan="2">
        Database Content Change: 
      </td>
    </tr>
    <tr bgcolor="#ffffff">
      <td bgcolor="#FFFFFF" colspan="2">
			This program is used to replace by batches the content in certain database field. It could be very dangerous, so DO use it with caution.
            </td>
          </tr>

          <tr id='datasel' bgcolor="#ffffff">
            <td width="15%" style="background-color:#f1f5f8;" height="66">&nbsp;Select Data Sheet and Field: </td>
            <td> 
			<table width="98%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td id="tables">
                    <?php
  $mymps_tables = fetchtablelist($db_mymps);
  echo "<select name='exptable' id='exptable' size='10' style='width:60%' onchange='ShowFields()'>\r\n";
  foreach($mymps_tables as $key => $val){
	  echo "<option value='{$val[Name]}'>{$val[Name]}</option>\r\n";
  }
  echo "</select>\r\n";
	$db->Close();
				  ?>
                  </td>
                </tr>
                <tr>
                  <td height="28"> Field with Content to be Replaced: 
                    <input name="rpfield" type="text" id="rpfield" class="alltxt" />
                  </td>
                </tr>
              </table></td>
          </tr>

          <tr bgcolor="#ffffff">
            <td style="background-color:#f1f5f8;">&nbsp;Content to be Replaced: </td>
            <td><textarea name="rpstring" id="rpstring" class="alltxt" style="width:60%;height:50px"></textarea></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td style="background-color:#f1f5f8;">&nbsp;Replace by: </td>

            <td><textarea name="tostring" id="tostring" class="alltxt" style="width:60%;height:50px"></textarea></td>
          </tr>
    	<tr bgcolor="#ffffff">
			<td>&nbsp;</td>
      		<td height="31" bgcolor="#ffffff">
      		<input type="submit" name="Submit" value="Commence Replacing" class="mini gray" />
      	</td>
    </tr>
	<?php include mymps_tpl('html_runbox');?>
  </form>
</table>
</div>
<?php mymps_admin_tpl_global_foot();?>
