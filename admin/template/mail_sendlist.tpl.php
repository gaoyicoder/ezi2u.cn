<?php mymps_admin_tpl_global_head();?>
<form action="?part=sendlist" method="post"/>
<div id="<?=MPS_SOFTNAME?>">
    <table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/> Delete?</td>
      <td>Mail Theme</td>
      <td>Send To</td>
      <td>Delivery Status</td>
      <td>Sent time</td>
    </tr>
	<?php foreach($list as $list){?>
        <tr bgcolor="white">
          <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$list[id]?>' id="<?=$list[id]?>"></td>
          <td><?=$list[email_subject]?></td>
          <td><?=$list[email]?></td>
          <td><?php echo $list[error] == 1 ? '<font color=red>Mail Not Successfully Sent.</font>' : '<font color=green>Mail Successfully Sent!</font>' ;?></td>
          <td><em><?=GetTime($list[last_send])?></em></td>
        </tr>
	<?php }?>
    </table>
</div>
<center><input type="submit" value="Submit" class="mymps large" name="mail_submit"/></center>
</form>
<?php mymps_admin_tpl_global_foot();?>
