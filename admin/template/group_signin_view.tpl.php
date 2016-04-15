<?php mymps_admin_tpl_global_head();?>
<div id="<?=MPS_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
      <td colspan="2">
       Basic Information
      </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>Activity</td>
        <td bgcolor="white">
        <a href="group_list.php?part=edit&id=<?php echo $view['groupid']; ?>" target="_blank"><?php echo $view['gname']; ?></a>
        </td>
      </tr>
	  <tr bgcolor="#f5fbff">
        <td>Real Name</td>
        <td bgcolor="white">
        <?php echo $view['sname']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>Phone Number</td>
        <td bgcolor="white">
        <?php echo $view['tel']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>QQ£¨ÖÐ¹úÔªËØ£©</td>
        <td bgcolor="white">
        <?php echo $view['qqmsn']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>Age</td>
        <td bgcolor="white">
        <?php echo $view['age']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>Number of Participants</td>
        <td bgcolor="white">
        <?php echo $view['totalnumber']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>Message</td>
        <td bgcolor="white">
        <?php echo $view['message']; ?>
        </td>
      </tr>
      <tr class="firstr">
      	<td colspan="2">Affiliated Information</td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>Time of Sign-up</td>
        <td bgcolor="white">
        <?php echo GetTime($view['dateline']); ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>Signed-up From IP</td>
        <td bgcolor="white">
        <?php echo $view['signinip']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>Current Status</td>
        <td bgcolor="white">
        <?php echo $status[$view['status']]; ?>
        </td>
      </tr>
</table>
</div>
<center><input type="submit" class="mymps large" value="Return" onClick="history.back();"></center>
<?php mymps_admin_tpl_global_foot();?>
