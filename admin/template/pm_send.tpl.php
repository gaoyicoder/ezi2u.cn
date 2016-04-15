<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="pm.php?part=send" <?php if($part == 'send'){?>class="current"<?php }?>>Send message to Multiple Receivers</a></li>
				<li><a href="pm.php?part=outbox" <?php if($part == 'outbox'){?>class="current"<?php }?>>Sent Messages</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Hints</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
  <li>Should you wish to send message to particular member group(s), please leave Send to Particular Member(s) blank.</li>
  <li>Should you wish to send message to particular member(s), please make no selections in Send to Particular Member Group.</li>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<form name="form1" action="pm.php?" method="post" target='stafrm'>
    <tr class="firstr">
      <td colspan="4">Enter Content of Message </td>
      </tr>
      <tr bgcolor="#f5fbff" >
        <td width="80" >Member Group(s): </td>
        <td><select name="group[]" size="5"  style="width:100px" multiple="multiple">
        <?=member_groups()?>
        </select><br /><br />Should you wish to send message to particular member(s), please make no selections in Send to Particular Member Group.</td>
      </tr>
      <tr bgcolor="#f5fbff" >
        <td width="80" >Particular Member(s): </td>
        <td ><input name="touser" style="width:300px" class="text" type="text" value="<?=$userid?>"/> To input multiple members, separate each member ID with a comma.</td>
      </tr>
      <tr bgcolor="#f5fbff" >
        <td width="80" >Title: </td>
        <td ><input name="title" style="width:300px" class="text" type="text" value="<?=$title?>"/></td>
      </tr>
      <tr bgcolor="#f5fbff" >
        <td width="80" >Content: </td>
        <td ><textarea name="content" style="width:400px; height:200px"/><?=$content?></textarea></td>
      </tr>
    <tr> 
      <td bgcolor="#f5f8ff">&nbsp;</td>
      <td bgcolor="#f5f8ff"><input name="pm_submit" style="margin:10px;" class="mymps large" type="submit" value="Submit and Send"></td>
    </tr>
    </form>
  <?php include mymps_tpl('html_runbox');?>
</table>
</div>
<?php mymps_admin_tpl_global_foot();?>
