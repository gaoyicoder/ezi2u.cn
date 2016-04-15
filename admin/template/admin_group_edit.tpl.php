<?php mymps_admin_tpl_global_head();?>
<style>
label{float:left; width:180px; height:16px; display:block}
</style>
<script language='javascript'>
	function checkSubmit()
  {
     if(document.form1.typename.value==""){
	     alert("Group name cannot be empty!");
	     document.form1.userid.focus();
	     return false;
     }
     return true;
 }
</script>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<form name="form1" action="admin.php?do=group" onSubmit="return checkSubmit();" method="post">
<input type="hidden" name="ifsystem" value="<?=$group[ifsystem]?>">
<input type="hidden" name="part" value="update" />
<input name="id" value="<?=$group[id]?>" type="hidden"/>
  <tr class="firstr">
  <td colspan="4">User Group Basic Settings</td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td width="80" height="30">User Group Name£º</td>
    <td ><input name="typename"class="text" type="text" id="userid" size="16" value="<?=$group[typename]?>"/></td>
  </tr>
  <tr class="firstr">
  <td colspan="2">
    <div class="left"><a href="javascript:collapse_change('2')">User Group Authority Settings</a></div>
    <div class="right"><a href="javascript:collapse_change('2')"><img id="menuimg_2" src="template/images/menu_reduce.gif"/></a></div>
  </td>
  </tr>
  <tbody id="menu_2">
  <?php echo mymps_admin_purview($purview);?>
  </tbody>
  <tr bgcolor="#f5fbff">
    <td height="60">&nbsp;</td>
    <td>
    <input type="submit" name="Submit" value="Save Changes" class="mymps mini">
      <input type="button" onClick=history.back() value="Return" class="mymps mini">          </td>
  </tr>
    </form>
    </table>
</div>
<?php mymps_admin_tpl_global_foot();?>
