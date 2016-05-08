<?php mymps_admin_tpl_global_head();?>

<style>

.vbm td li{ margin:10px 0!important;}

</style>

<div id="<?=MPS_SOFTNAME?>" style="padding-bottom:0">

	<div class="mpstopic-category">

		<div class="panel-tab">

			<ul class="clearfix tab-list">

				<li><a href="config.php?part=imgcode" <?php if($part == 'imgcode'){?>class="current"<?php }?>>Identifying Code Control</a></li>

				<li><a href="config.php?part=checkask" <?php if($part == 'checkask'){?>class="current"<?php }?>>Identifying Questions and Answers Settings</a></li>

				<li><a href="config.php?part=badwords" <?php if($part == 'badwords'){?>class="current"<?php }?>>Filtering Settings</a></li>

				<li><a href="config.php?part=commentsettings" <?php if($part == 'commentsettings'){?>class="current"<?php }?>>Comment Settings</a></li>

			</ul>

		</div>

	</div>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

  <tr class="firstr">

  	<td colspan="2">Instructions</td>

  </tr>

  <tr bgcolor="#ffffff">

    <td id="menu_tip">

 <li>To make the system more adaptable, please disable identifying code on corresponding files if your hosting does not support GD Library.</li>

 <li>Logged-in members are not required to go through identification check when making or altering posts, no matter the settings here.</li>

 <li>If you wish to change the background of the identifying code image, you may replace the .jpg image in<font color="#666">/images/authcode/background1.jpg</font>with other .jpg files��</li>

    </td>

  </tr>

</table>

</div>

<form action="?part=imgcode" method="post">

<input name="action" type="hidden" value="do_post">

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

      <td colspan="2" align="left">Enable Identifying Code</td>

    </tr>

	<tr bgcolor="#ffffff">

      <td align="left" width="200">

      <?php foreach(array('login'=>'Member Log-in/login','register'=>'Registration/register','forgetpass'=>'Password Retrieval /forgetpass','post'=>'Post Making by Guests/post','memberpost'=>'Post Making by Members/memberpost','adminlogin'=>'Background Administrator Log-in /adminlogin') as $key => $val){?>

        <li><label for="<?php echo $key; ?>"><input class="checkbox" type="checkbox" name="settingsnew[open][<?php echo $key; ?>]" value="1" id="<?php echo $key; ?>" <?php if($res[$key] == 1) echo 'checked'; ?>><?php echo $val; ?></label></li>

	  <?php }?>

       </td>

      <td align="left" valign="top">

      <div style="margin-top:20px; color:#999">

Identifying code mechanism helps stopping malicious registration and posting. You may select proceedings that you wish to apply Identifying question to. Note: Enabling this will complicate some Proceedings, so we recommend that it be enabled only when necessary.<br /><br />

<img src="../<?php echo $mymps_global['cfg_authcodefile']?>?action=preview" id="authcode" style="border:1px #ddd solid;"><br /><br />

<a href="#" onClick="$('authcode').src=$('authcode').src+'&'">[Refresh]</a>

	  </div>

      </td>

    </tr>



</table>

</div>

<div id="<?=MPS_SOFTNAME?>">

<table border="0" cellspacing="0" cellpadding="0" class="vbm">

    <tr class="firstr">

      <td colspan="2" align="left">Identifying Code Type</td>

    </tr>

	<tr bgcolor="#ffffff">

      <td align="left" width="200">

      	<?php foreach(array('english'=>'Image of English Letters','number'=>'Image of Digits','engber'=>'Image with English Letters and Digits','plus'=>'Image with a Summation Problem','minus'=>'Image with a Subtraction Problem','chinese'=>'����ͼƬ��֤�� (�й�Ԫ��)') as $key => $val){?>

           <li><label for="<?php echo $key; ?>"><input class="radio" type="radio" name="settingsnew[type]" value="<?php echo $key; ?>" <?php if($res[type] == $key) echo 'checked'; ?> id="<?php echo $key; ?>"><?php echo $val; ?></label></li>

        <?php }?>

		<div class="clear"></div>

		<hr style="width:80%;text-align:center">

		   <li><label for="rand"><input class="radio" type="radio" name="settingsnew[type]" value="rand" <?php if($res[type] == 'rand') echo 'checked'; ?> id="rand">Random</label></li>

       </td>

      <td align="left" valign="top">

      <div style="margin-top:10px; color:#999">

      	Set type of identifying code here. Regular changes to types of identifying code helps better preventing malicious registration and posting.<br /><br />

Selecting Random also helps better preventing malicious registration and posting.

      </div>

      </td>

    </tr>

    <tr bgcolor="#ffffff">

    	<td> 

        <li>Background Dots</li>

        <li><input name="settingsnew[noise]" type="text" class="txt" value="<?php echo $res['noise']; ?>"></li>

        </td>

        <td><div style="margin-top:10px; color:#999">Set to put a number of dots on the background of the identifying code image. It helps preventing malicious registration and posting, but may bring inconvenience to regular user as it blocks makes the identifying code harder to be seen clearly.<br /><br />Usually set between 0 and 30, with 0 meaning no dots will be seen.</div></td>

    </tr>

    <tr bgcolor="#ffffff">

    	<td> 

        <li>Background Slashes</li>

        <li><input name="settingsnew[line]" type="text" class="txt" value="<?php echo $res['line']; ?>"></li>

        </td>

        <td><div style="margin-top:10px; color:#999">Set to put a number of slashing lines on the background of the identifying code image. It helps preventing malicious registration and posting, but may bring inconvenience to regular user as it blocks makes the identifying code harder to be seen clearly.<br /><br />Usually set between 0 and 30, with 0 meaning no slashing lines will be seen.</div></td>

    </tr>

    <tr bgcolor="#ffffff">

    	<td> 

        <li>Background Flakes</li>

        <li><input name="settingsnew[snow]" type="text" class="txt" value="<?php echo $res['snow']; ?>"></li>

        </td>

        <td><div style="margin-top:10px; color:#999">Set to put a number of flakes on the background of the identifying code image. It helps preventing malicious registration and posting, but may bring inconvenience to regular user as it blocks makes the identifying code harder to be seen clearly.<br /><br />Usually set between 0 and 30, with 0 meaning no flakes will be seen.</div></td>

    </tr>

</table>

</div>



<center>

<input class="mymps large" value="Submit" type="submit" > &nbsp;

</center>

</form>

<?php mymps_admin_tpl_global_foot();?>

