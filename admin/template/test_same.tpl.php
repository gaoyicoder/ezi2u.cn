<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<form name="form1" action="test_same.php?" method="get" target='stafrm'>
<input name="part" value="do_list" type="hidden">
  <tr class="firstr">
  	<td colspan="2">Search for Repeated Categorized Post Theme</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:100px">Deletion Options:</td>
    <td>&nbsp;<select name="deltype">
    <option value="delold">Keep the Latest One</option>
    <option value="delnew" selected="selected">Keep the Earliest One</option>
    </select></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Display Record for Every Line:</td>
    <td>&nbsp;<input name="pagesize" type="text" class="txt" value="100">Items</td>
  </tr>
 <tr bgcolor="#ffffff">
 	<td>&nbsp;</td>
    <td colspan="2">&nbsp;<input name="test_same_submit" type="submit" value="Analysis on Repeated Post Themes" class="gray mini"></td>
  </tr>
</form>
<?php include mymps_tpl('html_runbox');?>
</table>
</div>
<div class="clear"></div>
<?php mymps_admin_tpl_global_foot();?>
