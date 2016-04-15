<?php mymps_admin_tpl_global_head();?>
<script language='javascript'>
function checkSubmit()
{
	 if(document.form1.userid.value==""){
	     alert("User Name Cannot be Empty");
	     document.form1.userid.focus();
	     return false;
     }
     return true;
}
</script>
<div id="<?=MPS_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a title="Add Individual Member" href="?part=add" <?php if(!$if_corp){?>class="current"<?php }?>>Individual</a></li>
                <li><a title="Add Seller Member" href="?part=add&if_corp=1" <?php if($if_corp == 1){?>class="current"<?php }?>>Seller</a></li>
            </ul>
        </div>
    </div>
</div>
<form name="form1" action="member.php?do=member&part=<?=$action?>" method="post" onSubmit="return checkSubmit();">
<?if ($part == 'edit'){ ?>
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="if_corp" value="<?=$edit['if_corp']?>" />
<?} ?>
<div id="<?=MPS_SOFTNAME?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="vbm">
	<tr class="firstr">
		<td colspan="2">Account Information</td>
	</tr>
     <tr bgcolor="#ffffff">
      <td height="30">User Account:</td>
      <td><input name="userid" type="text" class="text" value="<?=$edit[userid]?>"/> <?php if($edit){?>¡¾Note: Please do not make any changes unless necessary, <font color="red"><b>especially after the system has merged with other systems (such as ucenter).</b></font>¡¿<?php }?></td>
     </tr>
      <tr bgcolor="#ffffff">
        <td width="16%" height="30">Email Address:</td>
        <td width="84%">
        <input name="cname" type="text" class="text" value="<?=$edit[cname]?>"/>
        </td>
      </tr>

    <tr bgcolor="#ffffff">
        <td height="30">Email:</td>
        <td>
            <input name="email" type="text" class="text" value="<?=$edit[email]?>"/>
        </td>
    </tr>
    <tr bgcolor="#ffffff">
            <td height="30">From User Group</td>
            <td>
				<?php echo get_member_level($edit[levelid]);?>
                [<a href="member.php?do=group">Set Authority of User Group</a>]
		    </td>
        </tr>
    <tr bgcolor="#ffffff">
      <td height="30">Log-in Password:</td>
      <td><input name="userpwd" type="text" class="text" /> <?if($part == 'edit'){?>[If you do not wish to make any changes, please leave it blank.]<?}?></td>
    </tr>
	<tr class="firstr">
      <td height="30" colspan="2">Other Information</td>
    </tr>
    <tr bgcolor="#ffffff">
      <td height="30">Personal ID Verification:</td>
      <td>
      <select name="per_certify">
      	<option value="1" <?php if($edit['per_certify'] == 1) echo 'selected style="background-color:#6EB00C;color:white"';?>>Verification Passed</option>
        <option value="0" <?php if(empty($edit['per_certify'])) echo 'selected style="background-color:#6EB00C;color:white"';?>>Verification Not Passed</option>
      </select></td>
    </tr>
 <tr bgcolor="#ffffff">
      <td height="30">Number of Coin Owned:</td>
      <td><input name="money_own" type="text" class="txt" value="<?=$edit[money_own]?>"/> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"></td>
    </tr>
    <tr bgcolor="#ffffff">
      <td height="30">Score:</td>
      <td><input name="score" type="text" class="txt" value="<?=$edit[score]?>"/></td>
    </tr>
    <tr bgcolor="#ffffff">
      <td height="30">Credit:</td>
      <td><input name="credit" type="text" class="txt" value="<?=$edit[credit]?>"/> 
	  <?php if($edit[credits]){?>
	  <img src="../images/credit/<?=$edit[credits]?>.gif" align="absmiddle">
	  <?} ?>
	  </td>
    </tr>
</table>
</div>
<center><input type="submit" class="mymps mini" value="Submit">   <input type="button" onClick="location.href='member.php'"  class="mymps mini" value="Return"></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
