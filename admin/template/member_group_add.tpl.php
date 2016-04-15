<?php include mymps_tpl('inc_head');?>
<style>
label{float:left; width:180px}
</style>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="?do=group" <?php if($part == 'list'){?>class="current"<?php }?>>Member Group Category</a></li>
				<li><a href="?do=group&part=add" <?php if($part == 'add'){?>class="current"<?php }?>>Add Member Group</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<form name="form1" action="member.php?do=group&part=insert" onSubmit="return checkSubmit();" method="post">
  <tr class="firstr">
  <td colspan="4">Member Group Basic Settings</td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td width="15%" height="30">User Group Name: </td>
    <td ><input name="levelname" type="text" class="text" size="16" style="width:200px;" value=""/></td>
  </tr>
  <tr class="firstr">
  <td colspan="4">User Group Authority Settings</td>
  </tr>
  <?php echo mymps_member_purview();?>
  <tr class="firstr">
  <td colspan="4">Other Settings</td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="30">Default Coin Possession</td>
    <td ><input name="money_own" type="text" class="txt" value=""/> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"> </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="30">Selectable Member Template<br />
<font color="#006acd">(Only Applicable to Seller Members)</font></td>
    <td>
    <select name="allow_tpl[]" multiple="multiple" style="width:100px; height:80px">
    <?=get_memtpl_options()?>
    </select>
    </td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="30">Maximum Number of Posts Allowed a Day</td>
    <td ><input name="perday_maxpost" type="text" class="text" size="16" style="width:200px;" value=""/></td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="30">Coin cost for upgrading to your requested member level<br /><font color="red">(You must select at least one period.)</font></td>
    <td >
    <?php foreach(array('month'=>'One Month','halfyear'=>'Six Months','year'=>'One Year','forever'=>'Always') as $k => $v){?>
    <div style="width:100%; margin:5px auto; line-height:25px">
<input name="settings[ifopen][<?php echo $k; ?>]" type="checkbox" class="checkbox" value="1" checked="checked">Apply <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"> <input name="settings[money][<?php echo $k; ?>]" class="txt" value=""> <?php echo $v; ?>
    </div>
    <?php }?>
</td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="30">Display Contact of Member<br />
<font color="#006acd">(Only Applicable to Seller Members)</font></td>
    <td><select name="member_contact">
    	<option value="0">Display as Contact of Site Staff</option>
        <option value="1">Display as Contact of Member</option>
        </select></td>
  </tr>
  <tr bgcolor="#f5fbff">
    <td height="60">&nbsp;</td>
    <td>
    <input type="submit" name="Submit" class="mymps mini" value="Confirm and Submit"/>
    ¡¡<input type="button" onClick=history.back() class="mymps mini" value="Return">           </td>
  </tr>  
    </form>
    </table>
</div>
<?php mymps_admin_tpl_global_foot();?>