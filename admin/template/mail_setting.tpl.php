<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Instructions</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
  <li>If your server supports mail function (please consult your hosting provider for details), we recommend you to use mail function provided by the system. </li>
  <li>If your server doesn't support mail function, you may also choose SMTP to be your mail server.</li>
    </td>
  </tr>
</table>
</div>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">Common SMTP addresses that support SMTP service.</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
  <li> <span>qq Mail</span>=> SMTP.qq.com<font color="red">(Recommended)</font>&nbsp;&nbsp;&nbsp;<span>163 Mail</span> => SMTP.163.com&nbsp;&nbsp;&nbsp;<span>188 Mail</span> => SMTP.188.com&nbsp;&nbsp;&nbsp;</li>
    </td>
  </tr>
</table>
</div>
<form method="post" action="mail.php?part=<?=$part?>">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr"><td colspan="2">Configure Mail Server Settings</td></tr>
<tr bgcolor="#ffffff">
<td width="25%">
Mail Service:  &nbsp;&nbsp;
</td>
<td>
<label for="mail"><input name="mail_service" type="radio" class="radio" id="mail" value="mail" onclick='document.getElementById("smtp_div").style.display = "none";document.getElementById("mail_div").style.display = "";' <?php if($mail_config[mail_service] != 'smtp'){?>checked="checked"<?}?>>Apply Server-embedded Mail Service</label> 
<label for="smtp"><input class="radio" name="mail_service" type="radio" id="smtp" value="smtp" onclick='document.getElementById("smtp_div").style.display = "";document.getElementById("mail_div").style.display = "none";' <?php if($mail_config[mail_service] == 'smtp'){?>checked="checked"<?}?>>Apply Other SMTP Service</label>
<label for="no"><input class="radio" name="mail_service" type="radio" id="no" value="no" onclick='document.getElementById("smtp_div").style.display = "none";document.getElementById("mail_div").style.display = "none";' <?php if($mail_config[mail_service] == 'no'){?>checked="checked"<?}?>>Do Not use Mail Service</label>
</td>
</tr>
<tbody id="smtp_div" <?php if($mail_config[mail_service] != 'smtp'){?> style="display:none"<?}?>>
<!--<tr bgcolor="#ffffff">
<td>
Whether Mail Server Require SSL Encrypted Connection Or Not
</td>
<td>
<label for="0"><input type="radio" name="ssl" value="0" id="0" class="radio" checked="checked">No</label>
<label for="1"><input type="radio" class="radio" name="ssl" value="1" id="1" onclick="return confirm('This requires that your php must support OpenSSL module. Should you wish to take advantage of it, please contact your hosting provider to confirm that the system supports the module in the first place.');">Yes</label>
</td>
</tr>-->
<tr bgcolor="#ffffff">
<td>
SMTP Server Address
</td>
<td>
<input class="text" type="text" name="smtp_server" value="<?=$mail_config[smtp_server]?>">
<div style="color:#666; margin-top:5px">This requires that your Email account supports SMTP service. </div></td>
</tr>
<tr bgcolor="#ffffff">
<td>
SMTP Server Port
</td>
<td><input class="text" type="text" name="smtp_serverport" value="<?php echo $mail_config[smtp_serverport] ? $mail_config[smtp_serverport] : 25;?>"></td>
</tr>
<tr bgcolor="#ffffff">
<td>
User Mailbox on SMTP Server
</td>
<td><input class="text" type="text" name="smtp_mail" value="<?=$mail_config[smtp_mail]?>"></td>
</tr>
<tr bgcolor="#ffffff">
<td>
Your Email Account
</td>
<td><input class="text" type="text" name="mail_user" value="<?=$mail_config[mail_user]?>"></td>
</tr>
<tr bgcolor="#ffffff">
<td>
Your Mailbox Password
</td>
<td><input class="text" type="password" name="mail_pass" value="<?=$mail_config[mail_pass]?>"></td>
</tr>
</tbody>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large" name="mail_submit"/>  </center>
</form>
<div class="clear" style="height:10px;"></div>
<form method="post" action="mail.php?part=<?=$part?>">
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr"><td colspan="2">Send a Test Mail</td></tr>
<tr bgcolor="#ffffff">
<td width="25%">
To 
</td>
<td><input class="text" type="text" name="test_mail" value=""></td>
</tr>
</table>
</div>
<center><input type="submit" value="Submit" class="mymps large" name="mail_submit"/>  </center>
</form>
<?php mymps_admin_tpl_global_foot();?>
