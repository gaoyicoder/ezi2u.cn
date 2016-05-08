<?php mymps_admin_tpl_global_head();?>

<style>

label{float:left; display:block; height:20px;}

</style>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

<form name="form1" action="member.php?do=group&part=update" onSubmit="return checkSubmit();" method="post">

<input type="hidden" name="id" value="<?=$group[id]?>">

  <tr class="firstr">

  <td colspan="4">Member Group Basic Settings</td>

  </tr>

  <tr bgcolor="#f5fbff">

    <td width="80" height="30">User Group Name: </td>

    <td ><input name="levelname" type="text" class="text" id="levelname" size="16" style="width:200px;" value="<?=$group[levelname]?>" /></td>

  </tr>

  <tr class="firstr">

  <td colspan="4">User Group Authority Settings</td>

  </tr>

  <?=mymps_member_purview($purviews)?>

  <tr class="firstr">

  <td colspan="4">Other Settings</td>

  </tr>

  <?php if($id == '1'){?>

  <tr bgcolor="#f5fbff">

    <td height="30">Default Coin Possession</td>

    <td ><input name="money_own" type="text" class="txt" value="<?=$group['money_own']?>"/> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"> </td>

  </tr>

  <?php }?>

  <tr bgcolor="#f5fbff">

    <td height="30">Selectable Member Template<br />

<font color="#006acd">(Only Applicable to Seller Members)</font></td>

    <td>

    <select name="allow_tpl[]" multiple="multiple" style="width:100px; height:80px">

    <?=get_memtpl_options($group['allow_tpl'])?>

    </select>

    </td>

  </tr>

  <tr bgcolor="#f5fbff">

    <td height="30">Maximum Number of Posts Allowed a Day</td>

    <td ><input name="perday_maxpost" type="text" class="text" size="16" style="width:200px;" value="<?=$group['perday_maxpost']?>"/></td>

  </tr>

  <tr bgcolor="#f5fbff">

    <td height="30">Coin cost for upgrading to your requested member level<br /><font color="red">(You must select at least one period.)</font></td>

    <td >

    <?php foreach(array('month'=>'One Month','halfyear'=>'Six Months','year'=>'One Year','forever'=>'Always') as $k => $v){?>

    <div style="width:100%; margin:5px auto; line-height:25px">

<input name="settings[ifopen][<?php echo $k; ?>]" type="checkbox" class="checkbox" value="1" <?php if($settings['ifopen'][$k] == 1){?>checked="checked"<?php }?>>Apply <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"> <input name="settings[money][<?php echo $k; ?>]" class="txt" value="<?php echo $settings['money'][$k]?>"> <?php echo $v; ?>

    </div>

    <?php }?>

   </td>

  </tr>

  <tr bgcolor="#f5fbff">

    <td height="30">Display Contact of Member<br />

<font color="#006acd">(Only Applicable to Seller Members)</font></td>

    <td><select name="member_contact">

    	<option value="0" <?php if($group['member_contact'] == 0) echo 'selected style="background-color:#6EB00C;color:white"';?>>Display as Contact of Site Staff</option>

        <option value="1" <?php if($group['member_contact'] == 1) echo 'selected style="background-color:#6EB00C;color:white"';?>>Display as Contact of Member</option>

        </select></td>

  </tr>

  <tr bgcolor="#f5fbff">

    <td height="60">&nbsp;</td>

    <td>

    <input type="submit" name="Submit" class="mymps mini" value="Confirm and Submit"/>

    ��<input type="button" onClick=history.back() class="mymps mini" value="Return">           </td>

  </tr>  

    </form>

    </table>

</div>

<?php mymps_admin_tpl_global_foot();?>

