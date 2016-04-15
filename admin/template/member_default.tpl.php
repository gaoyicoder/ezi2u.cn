<?php mymps_admin_tpl_global_head();
$admindir = getcwdOL();
?>

<script language="javascript" src="js/vbm.js"></script>
<script type='text/javascript' src='js/calendar.js'></script>

<form name='form1' method='post' action='member.php' onSubmit='return checkSubmit();'>
<input type='hidden' name='part' value='default'/>
<input name="url" type="hidden" value="<?=GetUrl()?>">
<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="30">Select</td>
      <td width="30">Number</td>
      <td>User ID</td>
      <td width="50">Coins</td>
      <td width="50">User Group</td>
      <td>IP Address Used for Registration</td>
      <td>Date of Registration</td>
      <td>Last time Logged in</td>
      <td width="30">Edit</td>
    </tr>
    <tbody onmouseover="addMouseEvent(this);">
<?php if(is_array($member)){foreach($member AS $member){
if($admin_id != 1 && $member[userid] == 'admin'){}else{
?>
    <tr align="center" bgcolor="white">
      <td><input type='checkbox' name='id[]' value='<?=$member[id]?>' class='checkbox' id="<?=$member[id]?>"></td>
      <td><?=$member[id]?></td>
	  <td><?php if($member['if_corp'] == 1 && $member['ifindex'] == 2){ echo '[<a href="?ifindex=2&moreoptions=yes&if_corp=1&cityid='.$cityid.'#lists" style="color:red" title="Recommend on Homepage">Homepage</a>] ';}?><?php if($member['if_corp'] == 1 && $member['iflist'] == 2){ echo '[<a href="?iflist=2&moreoptions=yes&&if_corp=1&cityid='.$cityid.'#lists" style="color:#ff6600" title="Recommend on List">List</a>] ';}?><a href="javascript:void(0);" onclick="
setbg('<?=MPS_SOFTNAME?>Member Centre',400,110,'../box.php?part=member&userid=<?=$member[userid]?>&admindir=<?=$admindir?>')"><?=$member[userid]?> <?php echo $member['if_corp'] ? $member['tname'] : ''; ?></a> <img align="absmiddle" title="Credit:<?=$member['credit']?>" alt="Credit:<?=$member['credit']?>" src="../images/credit/<?=$member[credits]?>.gif"> <?php if($member['per_certify'] == 1){?><img src="../images/person1.gif" align="absmiddle" title="Real-time ID Verification Passed"/><?php }?> <?php if($member['com_certify'] == 1){?><img src="../images/company1.gif" align="absmiddle" title="Business Licence Verification Passed"/><?php }?></td>
	  <td><img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"> <?=$member[money_own]?></td>
      <td><?=$member[levelname]?><?php if(!empty($member['levelup_time'])){ echo '<br /><em style=color:red>Until'.date("Y-m-d",$member['levelup_time']).'</em>';}?></td>
      <td><a href="
javascript:setbg('View Location of IP Address',400,110,'../box.php?part=iptoarea&ip=<?=$member[joinip]?>&admindir=<?=$admindir?>')" title="Click to View Location of Registration"><?=$member[joinip]?></a></td>
      <td><em><?=GetTime($member[jointime])?></em></td>
      <td><em><?=GetTime($member[logintime])?></em></td>
      <td><a href="member.php?part=edit&id=<?=$member[id]?>">Details</a></td>
    </tr>
<?php }}}?>
</tbody>
<tr bgcolor="#ffffff" height="28">
    <td style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/></td>
    <td colspan="10">
    <label for="delall">
	<b>תΪ-></b> <?php echo get_member_level_label(); ?> | <?php if($if_corp == '1'){?><label for="person"><input name="do_action" class="radio" id="person" value="person" type="radio">Individual Member</label><?}else{?><label for="corp"><input name="do_action" class="radio" id="corp" value="corp" type="radio">Seller Member</label><?php }?>
	  <hr style="height:1px; border:1px #c5d8e8 solid;"/><b>Pass-></b>
	  <label for="per_certify"><input type="radio" id="per_certify" value="per_certify" name="do_action">Real-time ID Verification</label> <label for="com_certify"><input type="radio" id="com_certify" value="com_certify" name="do_action">Business Licence Verification</label>
      <hr style="height:1px; border:1px #c5d8e8 solid;"/>
      <b>Delete-></b> <label for="delall"><input type="radio" value="delall" id="delall" name="do_action" class="radio">This Member Account and All Affiliated Information</label><?php if($if_corp == '1'){?> | <label for="delinfo"><input type="radio" value="delinfo" id="delinfo" name="do_action" class="radio">Categorized Posts</label> <label for="deldoc"><input type="radio" value="deldoc" id="deldoc" name="do_action" class="radio">Files in Personal Space</label> <label for="delalbum"><input type="radio" value="delalbum" id="delalbum" name="do_action" class="radio">Album</label> <label for="delcomment"><input type="radio" value="delcomment" id="delcomment" name="do_action" class="radio">Comments</label><?php }?> <label for="delpm"><input type="radio" value="delpm" id="delpm" name="do_action" class="radio">Messages</label>
	  <?php if($if_corp == 1){?>
	  <hr style="height:1px; border:1px #c5d8e8 solid;"/>
	  <b>Display On-></b>
	  <label for="ifindex2"><input name="do_action" value="ifindex2" id="ifindex2" type="radio">Recommended Sellers on Homepage</label>
	  <label for="ifindex1"><input name="do_action" value="ifindex1" id="ifindex1" type="radio">Cancel Recommendation on Homepage</label>
	  |
	  <label for="iflist2"><input name="do_action" value="iflist2" id="iflist2" type="radio">Recommended Seller on Seller List Page</label>
	  <label for="iflist1"><input name="do_action" value="iflist1" id="iflist1" type="radio">Cancel Recommendation on List</label>
	  <?php }?>
    </td>
</tr>
</table>
</div>
<center>
<input type="submit" value="Submit" class="mymps large"/></center>
</form>
<div class="pagination"><?=page2()?></div>
<div class="clear"></div>
<form action="member.php" method="get">
<input type='hidden' name='part' value='default'/>
<input name="if_corp" value="<?=$if_corp?>" type="hidden" />
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Search By Requirements<?php echo $if_corp == '0' ? 'Individual Member' : 'Seller Member'; ?></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">UserID</td>
    <td>&nbsp;<input name="userid" class="text" value="<?php echo $userid; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%"><?php echo $if_corp == '1' ? 'Name of Seller' : 'Name of User'; ?></td>
    <td>&nbsp;<input name="tname" class="text" value="<?php echo $tname; ?>"></td>
  </tr>
<tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">From User Group</td>
    <td>&nbsp;<?php echo get_member_level($levelid);?></td>
  </tr>
  <tr>
<?php if($if_corp == '1'){?>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">From Category</td>
    <td>&nbsp;<?=get_member_cat($catid,false)?></td>
  </tr>
  <?php if(!$admin_cityid){?>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">From District Sub-sire</td>
    <td>&nbsp;<select name="cityid">
    <option value="">>City Sub-site</option>
    <?php echo get_cityoptions($cityid); ?>
    </select></td>
  </tr>
  <? }else{ ?>
  <input name="cityid" value="<?php echo $admin_cityid?>" type="hidden" />
  <? }?>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8; width:40%">Recommend?</td>
    <td>&nbsp;<select name="tuijian">
    <option value="all" <?php if($tuijian == 'all'){?>selected="selected"<?php }?>>All Sellers</option>
	<option value="index" <?php if($tuijian == 'index'){?>selected="selected"<?php }?>>Recommended Seller on Homepage</option>
	<option value="list" <?php if($tuijian == 'list'){?>selected="selected"<?php }?>>Recommended Seller on Seller List Page</option>
    </select></td>
  </tr>
  <?php }?>
  <tr>
  	<td style="background-color:#fff; text-align:right" colspan="2"><label for="moreoptions"><input name="moreoptions" value="yes" type="checkbox" class="checkbox" onclick="blocknone('showtbody');" id="moreoptions" <?php if($moreoptions == 'yes') echo 'checked'?>>More Options</label></td>
  </tr>
  <tbody id="showtbody" <?php if($moreoptions != 'yes'){?>style="display:none"<?php }?>>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Coins Less Than:</td>
    <td>&nbsp;<input name="moneylower" class="txt" value="<?php echo $moneylower; ?>"> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Coins More Than:</td>
    <td>&nbsp;<input name="moneyhigher" class="txt" value="<?php echo $moneyhigher; ?>"> <img src="../member/images/mymps_icon_incomes.gif" align="absmiddle"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Starting of IP Address Used for Registering (Use Asterisk Wild Card, Like 127.0.*.*):</td>
    <td>&nbsp;<input name="regip" class="text" value="<?php echo $regip; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Starting of IP Address Used for Last Visit  (Use Asterisk Wild Card, Like 127.0.*.*):</td>
    <td>&nbsp;<input name="lastip" class="text" value="<?php echo $lastip; ?>"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Registered Earlier Than (Format: yy/mm/dd):</td>
    <td>&nbsp;<input name="regdatebefore" style="width:100px;" class="txt" value="<?php echo $regdatebefore; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Registered Later Than (Format: yy/mm/dd):</td>
    <td>&nbsp;<input name="regdateafter" style="width:100px;" class="txt" value="<?php echo $regdateafter; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Last Visit Earlier Than (Format: yy/mm/dd):</td>
    <td>&nbsp;<input name="lastvisitbefore" style="width:100px;" class="txt" value="<?php echo $lastvisitbefore; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  <tr bgcolor="#ffffff">
    <td style="background-color:#f1f5f8">Last Visit Later Than (Format: yy/mm/dd):</td>
    <td>&nbsp;<input name="lastvisitafter" style="width:100px;"  class="txt" value="<?php echo $lastvisitafter; ?>" onclick="popUpCalendar(this, this, &quot;yyyy-mm-dd&quot;)"></td>
  </tr>
  </tbody>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large" /></center>
<div class="clear" style="margin-bottom:5px"></div>
</form>
<?=mymps_admin_tpl_global_foot();?>
